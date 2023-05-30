<?php

namespace App\Http\Controllers;

use http\Client\Request;
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

        try {
            // Créez une charge avec les détails du paiement
            $charge = Charge::create([
                'amount' => $amount,
                'currency' => 'EUR', // Changez-le en fonction de votre devise
                'source' => $request->input('token'), // Le jeton Stripe que vous avez reçu depuis le terminal de paiement
            ]);

            // Redirigez l'utilisateur vers une page de succès
            return redirect()->route('payment.success');
        } catch (\Exception $e) {
            // Gérez les erreurs de paiement ici
            return redirect()->route('payment.error')->with('error', $e->getMessage());
        }
    }
}
