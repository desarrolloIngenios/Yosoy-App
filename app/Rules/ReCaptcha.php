<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use GuzzleHttp\Client;

class ReCaptcha implements Rule
{
    public function passes($attribute, $value)
    {
        $client = new Client();
        $response = $client->post('https://www.google.com/recaptcha/api/siteverify', [
            'form_params' => [
                'secret' => env('RECAPTCHA_SECRET_KEY'),
                'response' => $value,
            ]
        ]);

        $body = json_decode((string)$response->getBody());
        return $body->success;
    }

    public function message()
    {
        return 'Por favor, verifica que no eres un robot.';
    }
}
