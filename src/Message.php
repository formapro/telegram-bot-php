<?php

namespace Formapro\TelegramBot;

use function Formapro\Values\get_object;
use function Formapro\Values\get_value;

class Message
{
    private $values = [];

    private $objects = [];

    public function getMessageId(): int
    {
        return get_value($this, 'message_id');
    }

    public function getDate(): int
    {
        return get_value($this, 'date');
    }

    public function getChat(): Chat
    {
        return get_object($this, 'chat', Chat::class);
    }

    public function getFrom(): ?User
    {
        return get_object($this, 'from', User::class);
    }

    public function getContact(): ?Contact
    {
        return get_object($this, 'contact', Contact::class);
    }

    public function getDocument(): ?Document
    {
        return get_object($this, 'document', Document::class);
    }

    /**
     * It can be used only after sending invoice and successful paying for it.
     *
     * @return SuccessfulPayment|null
     */
    public function getSuccessfulPayment(): ?SuccessfulPayment
    {
        return get_object($this, 'successful_payment', SuccessfulPayment::class);
    }

    public function getText(): ?string
    {
        return get_value($this, 'text');
    }
}
