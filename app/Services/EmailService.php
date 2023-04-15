<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\PendingRequest;

class EmailService
{
    private PendingRequest $http;

    public function __construct()
    {
        $user = env('EMAIL_SERVICE_USER');
        $password = env('EMAIL_SERVICE_PASSWORD');

        $this->http = Http::baseUrl(env('EMAIL_SERVICE_URL'))
                          ->asJson()
                          ->withBasicAuth($user, $password);
    }

    public function sendEmail(string $htmlMessage, array $toEmails, string $subject)
    {
        $response = $this->http->post('/api/send-email', [
            'to_emails' => $toEmails,
            'subject' => $subject,
            'message' => $htmlMessage,
        ]);

        $response->throw();

        return $response->json();
    }
}