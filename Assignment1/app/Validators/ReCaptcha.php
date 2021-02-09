<?php

namespace App\Validators;

use GuzzleHttp\Client;

class ReCaptcha
{
    public function validate($value)
    {
        $client = new Client;                                                           // Initiate Client
        $response = $client->post(                                                      // POST to Google ReCaptcha API with client secret stored in config
            'https://www.google.com/recaptcha/api/siteverify',                      // and put response in $response
            [
                'form_params' =>
                    [
                        'secret' => config('services.recaptcha.secret'),
                        'response' => $value
                    ]
            ]
        );
        $body = json_decode((string)$response->getBody());                              // Get the JSON body of the response and decode it
        return $body->success;                                                          // Return TRUE if body success is true
    }
}
