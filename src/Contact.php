<?php

namespace Formapro\TelegramBot;

use function Makasim\Values\get_value;

class Contact
{
    private $values = [];

    private $objects = [];

    public function getPhoneNumber(): string
    {
        return get_value($this, 'phone_number');
    }
}
