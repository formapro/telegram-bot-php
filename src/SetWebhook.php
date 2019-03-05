<?php

namespace Formapro\TelegramBot;

use function Formapro\Values\get_value;
use function Formapro\Values\set_value;

class SetWebhook
{
    private $values = [];

    private $objects = [];

    public function __construct(string $url)
    {
        set_value($this, 'url', $url);
    }

    public function getUrl(): string
    {
        return get_value($this, 'url');
    }

    public function setCertificate(string $cert): void
    {
        set_value($this, 'certificate', $cert);
    }

    public function getCertificate(): ?string
    {
        return get_value($this, 'certificate');
    }
}
