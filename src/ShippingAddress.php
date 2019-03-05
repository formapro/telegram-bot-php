<?php

namespace Formapro\TelegramBot;

use function Formapro\Values\get_object;
use function Formapro\Values\get_value;

class ShippingAddress
{
    private $values = [];

    private $objects = [];

    public function getCountryCode(): string
    {
        return get_value($this, 'country_code');
    }

    public function getState(): string
    {
        return get_value($this, 'state');
    }

    public function getCity(): string
    {
        return get_value($this, 'city');
    }

    public function getStreetLine1(): string
    {
        return get_object($this, 'street_line1');
    }

    public function getStreetLine2(): string
    {
        return get_object($this, 'street_line2');
    }

    public function getPostCode(): string
    {
        return get_object($this, 'post_code');
    }
}
