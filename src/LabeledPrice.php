<?php

namespace Formapro\TelegramBot;

use function Formapro\Values\get_value;
use function Formapro\Values\get_values;
use function Formapro\Values\set_object;
use function Formapro\Values\set_value;

class LabeledPrice
{
    private $values = [];

    public function __construct(string $label, int $amount)
    {
        set_value($this, 'label', $label);
        set_value($this, 'amount', $amount);
    }

    public function getLabel(): string
    {
        return get_value($this, 'label');
    }

    public function getAmount(): int
    {
        return get_value($this, 'amount');
    }
}
