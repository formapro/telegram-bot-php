<?php
namespace Formapro\TelegramBot;

use function Formapro\Values\get_object;
use function Formapro\Values\get_value;

class CallbackQuery
{
    private $values = [];

    private $objects = [];

    public function getId(): string
    {
        return get_value($this, 'id');
    }

    public function getFrom(): ?User
    {
        return get_object($this, 'from', User::class);
    }

    public function getMessage(): ?Message
    {
        return get_object($this, 'message', Message::class);
    }

    public function getInlineMessageId(): ?string
    {
        return get_value($this, 'inline_message_id');
    }

    public function getChatInstance(): string
    {
        return get_value($this, 'chat_instance');
    }

    public function getData()
    {
        return get_value($this, 'data');
    }

    public function getGameShortName(): ?string
    {
        return get_value($this, 'game_short_name');
    }
}