<?php

namespace Formapro\TelegramBot;

use function Formapro\Values\get_value;

class Contact
{
    private $values = [];

    private $objects = [];

    public function getPhoneNumber(): string
    {
        return get_value($this, 'phone_number');
    }

    public function getFirstName(): string
    {
        return get_value($this, 'first_name');
    }

    public function getLastName(): ?string
    {
        return get_value($this, 'last_name');
    }
}
