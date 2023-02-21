<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Braintree\Gateway;
use App\Models\Sponsored;
use App\Models\Home;

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

        return view('admin.sponsorship.checkout', compact('clientToken'));
    }

    public function processCheckout(Request $request)
    {
        $sponsoredId = $request->input('sponsored_id');
        $homeId = $request->input('homes_id');

        $sponsored = Sponsored::findOrFail($sponsoredId);
        $home = Home::findOrFail($homeId);

        $nonce = $request->input('payment_method_nonce');

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
            // Il pagamento è stato effettuato con successo, reindirizza l'utente a una view di conferma
            $home->sponsoreds()->attach($sponsoredId);
            return view('admin.sponsorship.confirmation', ['sponsoredId' => $sponsoredId]);
        } else {
            // Il pagamento è fallito, reindirizza l'utente a una view di errore
            return view('admin.sponsorship.index', ['message' => 'Il pagamento ha fallito.']);
        }
    }

    public function showCheckoutForm($sponsoredId)
    {
        $gateway = new Gateway([
            'environment' => env('BRAINTREE_ENVIRONMENT'),
            'merchantId' => env('BRAINTREE_MERCHANT_ID'),
            'publicKey' => env('BRAINTREE_PUBLIC_KEY'),
            'privateKey' => env('BRAINTREE_PRIVATE_KEY'),
        ]);


        $clientToken = $gateway->clientToken()->generate();
        $home = Home::findOrFail($sponsoredId);


        $sponsored = Sponsored::findOrFail($sponsoredId);

        return view('admin.sponsorship.checkout', compact('sponsored', 'clientToken', 'home'));
    }

    public function confirmation($sponsoredId)
    {
        $sponsored = Sponsored::findOrFail($sponsoredId);

        return view('admin.sponsorship.confirmation', compact('sponsored'));
    }
}
