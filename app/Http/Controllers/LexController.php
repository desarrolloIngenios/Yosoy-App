<?php

// app/Http/Controllers/LexController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Aws\LexRuntimeV2\LexRuntimeV2Client;

class LexController extends Controller
{
    public function webhook(Request $request)
    {
        $message = $request->input('message');
        $sessionId = uniqid(); // Genera un ID de sesión único para cada interacción

        // Configurar el cliente de Lex
        $lexClient = new LexRuntimeV2Client([
            'version' => 'latest',
            'region' => config('services.lex.region'),
            'credentials' => [
                'key' => config('services.lex.key'),
                'secret' => config('services.lex.secret'),
            ],
        ]);

        // Realizar una solicitud a Lex
        $response = $lexClient->recognizeText([
            'botAliasId' => 'alias-de-tu-bot',
            'botId' => 'id-de-tu-bot',
            'localeId' => 'es-US', // Cambia según la configuración de tu bot
            'sessionState' => [
                'dialogAction' => [
                    'type' => 'ElicitSlot',
                    'slotToElicit' => 'nombre', // El slot que deseas obtener
                    'intentName' => 'NombreIntent', // El nombre de tu intent
                ],
            ],
            'text' => $message,
            'sessionId' => $sessionId,
        ]);

        // Procesa la respuesta de Lex y realiza las acciones necesarias
        $responseText = $response['messages'][0]['content'];

        // Devuelve la respuesta al cliente
        return response()->json(['message' => $responseText]);
    }
}
