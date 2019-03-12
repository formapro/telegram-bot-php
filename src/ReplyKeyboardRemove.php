<?php

namespace Formapro\TelegramBot;

use function Formapro\Values\get_value;
use function Formapro\Values\set_value;

class ReplyKeyboardRemove implements ReplyMarkup
{
    private $values = [];

    private $objects = [];

    public function __construct(bool $selective = false)
    {
        set_value($this, 'remove_keyboard', true);
        set_value($this, 'selective', $selective);
    }

    public function isSelective(): bool
    {
        return get_value($this, 'selective', false);
    }
}
