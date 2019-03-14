<?php

namespace Formapro\TelegramBot;

use function Formapro\Values\get_value;
use function Formapro\Values\get_values;
use function Formapro\Values\set_value;

/**
 * @see https://core.telegram.org/bots/api#getfile
 */
class GetFile
{
    private $values = [];

    public function __construct(string $fileId)
    {
        set_value($this, 'file_id', $fileId);
    }
}
