<?php

namespace Formapro\TelegramBot;

use function Makasim\Values\get_value;
use function Makasim\Values\get_values;
use function Makasim\Values\set_object;
use function Makasim\Values\set_objects;
use function Makasim\Values\set_value;

class SendInvoice
{
    private $values = [];

    private $objects = [];

    public function __construct(
        int $chatId,
        string $title,
        string $description,
        string $payload,
        string $providerToken,
        string $startParameter,
        string $currency,
        array $prices
    ) {
        set_value($this, 'chat_id', $chatId);
        set_value($this, 'title', $title);
        set_value($this, 'description', $description);
        set_value($this, 'payload', $payload);
        set_value($this, 'provider_token', $providerToken);
        set_value($this, 'start_parameter', $startParameter);
        set_value($this, 'currency', $currency);
        set_objects($this, 'prices', $prices);
    }

    public function getChatId(): int
    {
        return get_value($this, 'chat_id');
    }

    public function getTitle(): string
    {
        return get_value($this, 'title');
    }

    public function getDescription(): string
    {
        return get_value($this, 'description');
    }

    public function getPayload(): string
    {
        return get_value($this, 'payload');
    }

    public function getProviderToken(): string
    {
        return get_value($this, 'provider_token');
    }

    public function getStartParameter(): string
    {
        return get_value($this, 'start_parameter');
    }

    public function getCurrency(): string
    {
        return get_value($this, 'currency');
    }

    public function getPrices(): array
    {
        return get_value($this, 'prices');
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
