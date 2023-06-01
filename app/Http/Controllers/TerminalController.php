<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Terminal\ConnectionToken;

class TerminalController extends Controller
{
    public function generateConnectionToken(Request $request)
    {
        echo('wsoooooooooooooooooooooooooooooooool');
        Stripe::setApiKey('sk_test_51IkY6wKbs8XEYkBloGYy426EhCBMNNsPnclBQkdaMbCDMIDVj7HkxeFPLka07IcGBMUOByjcfpeVS1vQmRdlFuKM00oPSs1cSy');

        // Générez le token de connexion avec les paramètres appropriés
        $token = ConnectionToken::create([
            'location' => 'your_location_id',
            // Autres paramètres requis selon votre configuration
        ]);

        echo json_encode(array('secret' => $token->secret));

        return response()->json(['secret' => $token->secret]);
    }
}
