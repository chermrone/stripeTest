<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\PaymentIntent;
use Stripe\Stripe;
use Stripe\Charge;

class PaymentController extends Controller
{
    public function processPayment(Request $request)
    {
        // Configurez votre clé secrète Stripe
        Stripe::setApiKey('VOTRE_CLE_SECRETE_STRIPE');

        // Récupérez le montant du paiement depuis la requête Angular
        $amount = $request->input('amount');

            // Créez une charge avec les détails du paiement
            $charge = Charge::create([
                'amount' => $amount,
                'currency' => 'EUR', // Changez-le en fonction de votre devise
                'source' => $request->input('token'), // Le jeton Stripe que vous avez reçu depuis le terminal de paiement
            ]);
    }

    public function createPaymentIntent(Request $request)
    {
        Stripe::setApiKey('sk_test_VePHdqKTYQjKNInc7u56JBrQ');

        $amount = $request->input('amount');

        // Créez un PaymentIntent avec les détails du paiement
        $paymentIntent = PaymentIntent::create([
            'amount' => $amount,
            'currency' => 'eur',
            // Autres détails du paiement
        ]);

        return response()->json(['client_secret' => $paymentIntent->client_secret]);
    }
}
