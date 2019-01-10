<?php

namespace Formapro\TelegramBot;

use Psr\Http\Message\ResponseInterface;
use function Makasim\Values\get_values;

class Bot
{
    private $token;

    private $httpClient;

    public function __construct(string $token)
    {
        $this->httpClient = new \GuzzleHttp\Client();
        $this->token = $token;
    }

    public function setWebhook(SetWebhook $setWebhook): ResponseInterface
    {
        $parts = [
            [
                'name' => 'url',
                'contents' => $setWebhook->getUrl(),
            ],
        ];

        if ($setWebhook->getCertificate()) {
            $parts[] = [
                'name' => 'certificate',
                'contents' => $setWebhook->getCertificate(),
                'filename' => 'self-signed-cert.pem',
            ];
        }

        return $this->httpClient->post($this->getMethodUrl('setWebhook'), [
            'multipart' => $parts,
        ]);
    }

    public function getWebhookInfo(): ResponseInterface
    {
        return $this->httpClient->post($this->getMethodUrl('getWebhookInfo'));
    }

    public function sendMessage(SendMessage $sendMessage): ResponseInterface
    {
        return $this->httpClient->post($this->getMethodUrl('sendMessage'), [
            'json' => get_values($sendMessage),
        ]);
    }

    public function answerCallbackQuery(AnswerCallbackQuery $answerCallbackQuery): ResponseInterface
    {
        return $this->httpClient->post($this->getMethodUrl('answerCallbackQuery'), [
            'json' => get_values($answerCallbackQuery),
        ]);
    }

    private function getMethodUrl(string $method): string
    {
        return sprintf('https://api.telegram.org/bot%s/%s', $this->token, $method);
    }

    public function getToken(): string
    {
        return $this->token;
    }
}
