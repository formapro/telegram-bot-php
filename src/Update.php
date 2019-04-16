<?php

namespace Formapro\TelegramBot;

use function Formapro\Values\get_object;
use function Formapro\Values\get_value;
use function Formapro\Values\set_values;

class Update
{
    private $values = [];

    private $objects = [];

    public function getUpdateId(): int
    {
        return get_value($this, 'update_id');
    }

    public function getMessage(): ?Message
    {
        return get_object($this, 'message', Message::class);
    }

    public function getChannelPost(): ?Message
    {
        return get_object($this, 'channel_post', Message::class);
    }

    public function getEditedMessage(): ?Message
    {
        return get_object($this, 'edited_message', Message::class);
    }

    public function getCallbackQuery(): ?CallbackQuery
    {
        return get_object($this, 'callback_query', CallbackQuery::class);
    }

    public function getPreCheckoutQuery(): ?PreCheckoutQuery
    {
        return get_object($this, 'pre_checkout_query', PreCheckoutQuery::class);
    }

    public static function create(array $data): self
    {
        $update = new self();
        set_values($update, $data);

        return $update;
    }
}
