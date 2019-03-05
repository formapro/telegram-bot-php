<?php

namespace Formapro\TelegramBot;

use function Formapro\Values\add_object;
use function Formapro\Values\get_value;
use function Formapro\Values\set_value;

class ReplyKeyboardMarkup implements ReplyMarkup
{
    private $values = [];

    private $objects = [];

    /**
     * @param KeyboardButton[] $keyboard
     */
    public function __construct(array $keyboard)
    {
        if (empty($keyboard)) {
            throw new \InvalidArgumentException('keyboard argument is required');
        }

        foreach ($keyboard as $rowNumber => $row) {
            foreach ($row as $button) {
                $this->addButton($rowNumber, $button);
            }
        }
    }

    public function addButton(int $row, KeyboardButton $button): void
    {
        add_object($this, sprintf('keyboard.%d', $row), $button);
    }

    public function setOneTimeKeyboard(bool $bool): void
    {
        set_value($this, 'one_time_keyboard', $bool);
    }

    public function isOneTimeKeyboard(): bool
    {
        return get_value($this, 'one_time_keyboard', false);
    }
}
