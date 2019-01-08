<?php

namespace Formapro\TelegramBot;

use function Makasim\Values\get_value;
use function Makasim\Values\set_value;

class InlineKeyboardButton
{
    private $values = [];

    private $objects = [];

    public function __construct(string $text)
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
}
