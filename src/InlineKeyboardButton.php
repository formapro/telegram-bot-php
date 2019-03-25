<?php

namespace Formapro\TelegramBot;

use function Formapro\Values\get_value;
use function Formapro\Values\set_value;

class InlineKeyboardButton
{
    private $values = [];

    private $objects = [];

    private function __construct(string $text)
    {
        set_value($this, 'text', $text);
    }

    public function setUrl(?string $url): void
    {
        set_value($this, 'url', $url);
    }

    public function getUrl(): ?string
    {
        return get_value($this, 'url');
    }

    public function setCallbackData(?string $callbackData): void
    {
        if (strlen($callbackData) > 64) {
            throw new \Exception('Too long callback data, maximum 64 bytes allowed.');
        }

        set_value($this, 'callback_data', $callbackData);
    }

    public function getCallbackData(): ?string
    {
        return get_value($this, 'callback_data');
    }

    public function setPay(bool $pay): void
    {
        set_value($this, 'pay', $pay);
    }

    public function isPay(): bool
    {
        return get_value($this, 'pay', false);
    }

    public static function withUrl(string $text, string $url): self
    {
        $button = new self($text);
        $button->setUrl($url);

        return $button;
    }

    public static function withTextAsCallbackData(string $text): self
    {
        $button = new self($text);
        $button->setCallbackData($text);

        return $button;
    }

    public static function withCallbackData(string $text, string $callbackData): self
    {
        $button = new self($text);
        $button->setCallbackData($callbackData);

        return $button;
    }
}
