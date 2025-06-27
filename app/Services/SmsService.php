<?php

namespace App\Services;



use Twilio\Exceptions\ConfigurationException;
use Twilio\Rest\Client;

class SmsService
{
    protected Client $client;

    /**
     * @throws ConfigurationException
     */
    public function __construct()
    {
        $this->client = new Client(
            config('services.twilio.sid'),
            config('services.twilio.token')
        );
    }

    public function send(string $to, string $message): bool
    {
        try {
            $this->client->messages->create($to, [
                'from' => config('services.twilio.from'),
                'body' => $message,
                'ssl_verify' => false, // 🚫 pas sécurisé

            ]);
            return true;
        } catch (\Exception $e) {
            report($e);
            return false;
        }
    }
}
