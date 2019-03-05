<?php
namespace Formapro\TelegramBot;

use function Formapro\Values\get_value;
use function Formapro\Values\set_value;

class AnswerCallbackQuery
{
    private $values = [];

    public function __construct(string $callbackQueryId)
    {
        $this->setCallbackQueryId($callbackQueryId);
    }

    public function setCallbackQueryId(string $callbackQueryId): void
    {
        set_value($this, 'callback_query_id', $callbackQueryId);
    }

    public function getCallbackQueryId(): string
    {
        return get_value($this, 'callback_query_id');
    }

    public function setText(?string $text): void
    {
        set_value($this, 'text', $text);
    }

    public function getText(): ?string
    {
        return get_value($this, 'text');
    }

    public function setUrl(?string $url): void
    {
        set_value($this, 'url', $url);
    }

    public function getUrl(): ?string
    {
        return get_value($this, 'url');
    }

    public function setCacheTime(?int $cacheTime): void
    {
        set_value($this, 'cache_time', $cacheTime);
    }

    public function getCacheTime(): int
    {
        return get_value($this, 'cache_time', 0);
    }

    public function setShowAlert(?bool $showAlert): void
    {
        set_value($this, 'show_alert', $showAlert);
    }

    public function getShowAlert(): bool
    {
        return get_value($this, 'show_alert', false);
    }
}
