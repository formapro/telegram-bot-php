<?php

namespace Formapro\TelegramBot;

use function Makasim\Values\get_value;
use function Makasim\Values\get_values;
use function Makasim\Values\set_object;
use function Makasim\Values\set_value;

class SendPhoto
{
    private $values = [];

    private $objects = [];

    public function __construct(int $chatId, string $photo)
    {
        set_value($this, 'chat_id', $chatId);

        if (strpos($photo, 'http') !== false) {
            set_value($this, 'photo', $photo);
        } else {
            if (!file_exists($photo)) {
                throw new \InvalidArgumentException('Wrong path to file!');
            }
            set_value($this, 'photo', file_get_contents($photo));
        }
    }

    public function getChatId(): int
    {
        return get_value($this, 'chat_id');
    }

    public function getPhoto()
    {
        return get_value($this, 'photo');
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
