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
     * @param bool $oneTimeKeyboard
     * @param bool $resizeKeyboard
     * @param bool $selective
     */
    public function __construct(array $keyboard, bool $oneTimeKeyboard = false, bool $resizeKeyboard = true, bool $selective = false)
    {
        if (empty($keyboard)) {
            throw new \InvalidArgumentException('keyboard argument is required');
        }

        foreach ($keyboard as $rowNumber => $row) {
            foreach ($row as $button) {
                $this->addButton($rowNumber, $button);
            }
        }

        set_value($this, 'one_time_keyboard', $oneTimeKeyboard);
        set_value($this, 'resize_keyboard', $resizeKeyboard);
        set_value($this, 'selective', $selective);
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

    public function isResizeKeyboard(): bool
    {
        return get_value($this, 'resize_keyboard', false);
    }

    public function isSelective(): bool
    {
        return get_value($this, 'selective', false);
    }
}
