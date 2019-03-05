<?php

namespace Formapro\TelegramBot;

use function Formapro\Values\add_object;

class InlineKeyboardMarkup implements ReplyMarkup
{
    private $values = [];

    private $objects = [];

    /**
     * @param InlineKeyboardButton[] $keyboard
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

    public function addButton(int $row, InlineKeyboardButton $button): void
    {
        add_object($this, sprintf('inline_keyboard.%d', $row), $button);
    }
}
