<?php

namespace Formapro\TelegramBot;

use Psr\Http\Message\ResponseInterface;
use function Formapro\Values\set_value;
use function Formapro\Values\get_values;

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

    public function sendPhoto(SendPhoto $sendPhoto): ResponseInterface
    {
        if (strpos($sendPhoto->getPhoto(), 'http') === 0) {
            return $this->httpClient->post($this->getMethodUrl('sendPhoto'), [
                'json' => get_values($sendPhoto),
            ]);
        }
        $values = get_values($sendPhoto);

        $data[] = [
            'name' => 'photo',
            'contents' => $values['photo'],
            'filename' => 'picture.jpg',
        ];
        unset($values['photo']);

        foreach ($values as $name => $value) {
            $data[] = [
                'name' => $name,
                'contents' => $value,
            ];
        }

        return $this->httpClient->post($this->getMethodUrl('sendPhoto'), [
            'multipart' => $data,
        ]);
    }

    public function sendDocument(SendDocument $sendDocument): ResponseInterface
    {
        if (strpos($sendDocument->getDocument(), 'http') === 0) {
            return $this->httpClient->post($this->getMethodUrl('sendDocument'), [
                'json' => get_values($sendDocument),
            ]);
        }
        $values = get_values($sendDocument);

        $data[] = [
            'name' => 'document',
            'contents' => $values['document'],
            'filename' => 'picture.jpg',
        ];
        unset($values['document']);

        foreach ($values as $name => $value) {
            $data[] = [
                'name' => $name,
                'contents' => $value,
            ];
        }

        return $this->httpClient->post($this->getMethodUrl('sendDocument'), [
            'multipart' => $data,
        ]);
    }

    public function sendInvoice(SendInvoice $sendInvoice)
    {
        return $this->httpClient->post($this->getMethodUrl('sendInvoice'), [
            'json' => get_values($sendInvoice),
        ]);
    }

    public function answerCallbackQuery(AnswerCallbackQuery $answerCallbackQuery): ResponseInterface
    {
        return $this->httpClient->post($this->getMethodUrl('answerCallbackQuery'), [
            'json' => get_values($answerCallbackQuery),
        ]);
    }

    public function answerPreCheckoutQuery(AnswerPreCheckoutQuery $answerPreCheckoutQuery): ResponseInterface
    {
        return $this->httpClient->post($this->getMethodUrl('answerPreCheckoutQuery'), [
            'json' => get_values($answerPreCheckoutQuery),
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
