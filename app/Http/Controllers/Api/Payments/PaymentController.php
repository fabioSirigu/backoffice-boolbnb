<?php

namespace App\Http\Controllers\Api\Payments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Braintree\Gateway;
use App\Models\Sponsored;

class PaymentController extends Controller
{
    public function getClientToken()
    {
        $gateway = new Gateway([
            'environment' => env('BRAINTREE_ENVIRONMENT'),
            'merchantId' => env('BRAINTREE_MERCHANT_ID'),
            'publicKey' => env('BRAINTREE_PUBLIC_KEY'),
            'privateKey' => env('BRAINTREE_PRIVATE_KEY'),
        ]);

        $clientToken = $gateway->clientToken()->generate();

        return response()->json([
            'token' => $clientToken
        ]);
    }

    public function checkout(Request $request)
    {
        $sponsoredId = $request->input('sponsored_id');

        $sponsored = Sponsored::findOrFail($sponsoredId);

        $gateway = new Gateway([
            'environment' => env('BRAINTREE_ENVIRONMENT'),
            'merchantId' => env('BRAINTREE_MERCHANT_ID'),
            'publicKey' => env('BRAINTREE_PUBLIC_KEY'),
            'privateKey' => env('BRAINTREE_PRIVATE_KEY'),
        ]);

        $result = $gateway->transaction()->sale([
            'amount' => $sponsored->price,
            'paymentMethodNonce' => 'fake-valid-nonce',
            'options' => [
                'submitForSettlement' => true
            ]
        ]);

        if ($result->success) {

            return response()->json([
                'message' => 'Il pagamento è stato effettuato con successo.'
            ]);
        } else {
            // Il pagamento è fallito, restituisci un messaggio di errore
            return response()->json([
                'error' => 'Il pagamento ha fallito.'
            ]);
        }
    }

    public function payWithCard(Request $request)
    {
        $sponsoredId = $request->input('sponsored_id');
        $nonce = $request->input('nonce');

        $sponsored = Sponsored::findOrFail($sponsoredId);

        $gateway = new Gateway([
            'environment' => env('BRAINTREE_ENVIRONMENT'),
            'merchantId' => env('BRAINTREE_MERCHANT_ID'),
            'publicKey' => env('BRAINTREE_PUBLIC_KEY'),
            'privateKey' => env('BRAINTREE_PRIVATE_KEY'),
        ]);

        $result = $gateway->transaction()->sale([
            'amount' => $sponsored->price,
            'paymentMethodNonce' => $nonce,
            'options' => [
                'submitForSettlement' => true
            ]
        ]);

        if ($result->success) {
            return response()->json([
                'message' => 'Il pagamento è stato effettuato con successo.'
            ]);
        } else {
            return response()->json([
                'error' => 'Il pagamento ha fallito.'
            ]);
        }
    }
}
