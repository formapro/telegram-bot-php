<?php

namespace Formapro\TelegramBot;

use function Formapro\Values\get_value;

class ChatPhoto
{
    private $values = [];

    public function getSmallFileId(): string
    {
        return get_value($this, 'small_file_id');
    }

    public function getBigFileId(): string
    {
        return get_value($this, 'big_file_id');
    }
}
