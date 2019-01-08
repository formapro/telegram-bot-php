<?php

namespace Formapro\TelegramBot;

use function Makasim\Values\get_object;
use function Makasim\Values\get_value;
use function Makasim\Values\set_values;

class Update
{
    private $values = [];

    private $objects = [];

    public function getUpdateId(): int
    {
        return get_value($this, 'update_id');
    }

    public function getMessage(): Message
    {
        return get_object($this, 'message', Message::class);
    }

    public static function create(array $data): self
    {
        $update = new self();
        set_values($update, $data);

        return $update;
    }
}
