<?php

namespace Formapro\TelegramBot;

use function Formapro\Values\set_values;
use GuzzleHttp\ClientInterface;
use Psr\Http\Message\ResponseInterface;
use function Formapro\Values\set_value;
use function Formapro\Values\get_values;

class Bot
{
    private $token;

    private $httpClient;

    public function __construct(string $token, ClientInterface $httpClient = null)
    {
        $this->token = $token;
        $this->httpClient = $httpClient ?? new \GuzzleHttp\Client();
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

    public function sendMessage(SendMessage $sendMessage): Message
    {
        $response = $this->httpClient->post($this->getMethodUrl('sendMessage'), [
            'json' => get_values($sendMessage),
        ]);

        $json = json_decode((string) $response->getBody(), true);

        if (isset($json['ok']) && $json['ok']) {
            $message = new Message();
            set_values($message, $json['result']);

            return $message;
        }

        throw new \LogicException('Unexpected response: ' . (string)$response->getBody());
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

    public function sendDocument(SendDocument $sendDocument): Message
    {
        $doc = $sendDocument->getDocument();

        if ($doc instanceof FileId || $doc instanceof FileUrl) {
            $data = get_values($sendDocument);
            $data['document'] = (string)$doc;

            $response = $this->httpClient->post($this->getMethodUrl('sendDocument'), [
                'json' => $data,
            ]);

            $json = json_decode((string)$response->getBody(), true);
            if (isset($json['ok']) && $json['ok']) {
                $message = new Message();
                set_values($message, $json['result']);

                return $message;
            }

            throw new \LogicException('Unexpected response: ' . (string)$response->getBody());
        }

        if ($doc instanceof InputFile) {
            $data[] = [
                'name' => 'document',
                'contents' => $doc->getContent(),
                'filename' => $doc->getFileName(),
            ];

            $values = get_values($sendDocument);
            foreach ($values as $name => $value) {
                $data[] = [
                    'name' => $name,
                    'contents' => $value,
                ];
            }

            $response = $this->httpClient->post($this->getMethodUrl('sendDocument'), [
                'multipart' => $data,
            ]);

            $json = json_decode((string)$response->getBody(), true);
            if (isset($json['ok']) && $json['ok']) {
                $message = new Message();
                set_values($message, $json['result']);

                return $message;
            }

            throw new \LogicException('Unexpected response: ' . (string) $response->getBody());
        }

        throw new \LogicException(sprintf('Unexpected document: %s' . get_class($doc)));
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

    public function editMessageText(EditMessageText $editMessageText): ?Message
    {
        $response = $this->httpClient->post($this->getMethodUrl('editMessageText'), [
            'json' => get_values($editMessageText),
        ]);

        $json = json_decode((string)$response->getBody(), true);

        if (isset($json['ok']) && $json['ok']) {
            $message = new Message();
            set_values($message, $json['result']);

            return $message;
        }

        throw new \LogicException('Unexpected response: ' . (string) $response->getBody());
    }

    public function deleteMessage(DeleteMessage $deleteMessage): bool
    {
        $response = $this->httpClient->post($this->getMethodUrl('deleteMessage'), [
            'json' => get_values($deleteMessage),
        ]);

        $response = json_decode((string)$response->getBody(), true);

        if (isset($response['ok']) && $response['ok']) {
            return true;
        }

        return false;
    }

    /**
     * @see https://core.telegram.org/bots/api#getfile
     */
    public function getFile(GetFile $getFile): File
    {
        $response = $this->httpClient->post($this->getMethodUrl('getFile'), [
            'json' => get_values($getFile),
        ]);

        $json = json_decode((string) $response->getBody(), true);

        if (isset($json['ok']) && $json['ok']) {
            $file = new File();
            set_values($file, $json['result']);

            if ($path = $file->getFilePath()) {
                $file->setFileUrl(sprintf('https://api.telegram.org/file/bot%s/%s', $this->token, $path));
            }

            return $file;
        }

        throw new \LogicException('Unexpected response: ' . (string) $response->getBody());
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
