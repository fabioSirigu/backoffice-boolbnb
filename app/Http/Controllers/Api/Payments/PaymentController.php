<?php

namespace App\Http\Controllers\Api\Payments;

use App\Http\Controllers\Controller;
use App\Http\Requests\Payments\PaymentRequest;
use Illuminate\Http\Request;
use Braintree\Gateway;
use App\Models\Sponsored;

class PaymentController extends Controller
{
    public function generate(Request $request, Gateway $gateway)
    {
        $token = $gateway->clientToken()->generate();

        $data = [
            'success' => true,
            'token' => $token
        ];

        return response()->json($data, 200);
    }

    public function makePayment(PaymentRequest $request, Gateway $gateway)
    {
        $sponsored = Sponsored::find($request->sponsored);
        $result = $gateway->transaction()->sale([
            'amount' => $sponsored->price,
            'paymentMethodNonce' => $request->token,
            'options' => [
                'submitForSettlement' => true
            ]
        ]);

        if ($result->success) {
            $data = [
                'success' => true,
                'message' => 'Transazione eseguita con Successo!'
            ];
            return response()->json($data, 200);
        } else {
            $data = [
                'success' => false,
                'message' => 'Transazione Fallita!!'
            ];
            return response()->json($data, 401);
        }
    }
}
