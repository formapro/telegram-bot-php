<?php

namespace Formapro\TelegramBot;

use function Formapro\Values\get_value;

/**
 * https://core.telegram.org/bots/api#user
 */
class User
{
    private $values = [];

    private $objects = [];

    public function getId(): int
    {
        return get_value($this, 'id');
    }

    public function isBot(): bool
    {
        return get_value($this, 'is_bot', false);
    }

    public function getFirstName(): ?string
    {
        return get_value($this, 'first_name');
    }

    public function getLastName(): ?string
    {
        return get_value($this, 'last_name');
    }

    public function getUsername(): ?string
    {
        return get_value($this, 'username');
    }

    public function getLanguageCode(): ?string
    {
        return get_value($this, 'language_code');
    }
}
