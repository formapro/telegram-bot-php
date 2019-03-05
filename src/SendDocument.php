<?php

namespace Formapro\TelegramBot;

use function Formapro\Values\get_value;
use function Formapro\Values\get_values;
use function Formapro\Values\set_object;
use function Formapro\Values\set_value;

class SendDocument
{
    private $values = [];

    private $objects = [];

    public function __construct(int $chatId, string $document)
    {
        set_value($this, 'chat_id', $chatId);
        set_value($this, 'document', $document);
    }

    public function getChatId(): int
    {
        return get_value($this, 'chat_id');
    }

    public function getDocument(): string
    {
        return get_value($this, 'document');
    }

    public function getCaption(): string
    {
        return get_value($this, 'caption');
    }

    public function setCaption(string $caption): void
    {
        set_value($this, 'caption', $caption);
    }

    public function setParseMode(string $parseMode): void
    {
        set_value($this, 'parse_mode', $parseMode);
    }

    public function getParseMode(): ?string
    {
        return get_value($this, 'parse_mode');
    }

    public function setReplyMarkup(ReplyMarkup $replyMarkup): void
    {
        set_value($this, 'reply_markup', json_encode(get_values($replyMarkup)));
    }
}
