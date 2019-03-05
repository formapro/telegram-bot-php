<?php

namespace Formapro\TelegramBot;

use function Formapro\Values\get_object;
use function Formapro\Values\get_value;

class OrderInfo
{
    private $values = [];

    private $objects = [];

    public function getName(): ?string
    {
        return get_value($this, 'name');
    }

    public function setName(?string $name): void
    {
        set_value($this, 'name', $name);
    }

    public function getPhoneNumber(): ?string
    {
        return get_value($this, 'phone_number');
    }

    public function setPhoneNumber(?string $phoneNumber): void
    {
        set_value($this, 'phone_number', $phoneNumber);
    }

    public function getEmail(): ?string
    {
        return get_value($this, 'email');
    }

    public function setEmail(?string $email): void
    {
        set_value($this, 'email', $email);
    }

    public function getShippingAddress(): ?ShippingAddress
    {
        return get_object($this, 'shipping_address', ShippingAddress::class);
    }

    public function setShippingAddress(?ShippingAddress $shippingAddress): ?ShippingAddress
    {
         set_object($this, 'shipping_address', $shippingAddress);
    }
}
