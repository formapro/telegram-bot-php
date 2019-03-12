<?php declare(strict_types=1);

namespace Formapro\TelegramBot;

use function Formapro\Values\get_value;
use function Formapro\Values\get_values;
use function Formapro\Values\set_value;

class EditMessageText
{
    private $values = [];

    private $objects = [];

    private function __construct()
    {
    }

    public static function withChatId(string $text, $chatId, int $messageId): self
    {
        $edit = new static();

        set_value($edit, 'chat_id', $chatId);
        set_value($edit, 'message_id', $messageId);
        set_value($edit, 'text', $text);

        return $edit;
    }

    public static function withInlineMessageId(string $text, string $inlineMessageId): self
    {
        $edit = new static();

        set_value($edit, 'inline_message_id', $inlineMessageId);
        set_value($edit, 'text', $text);

        return $edit;
    }

    public function getChatId()
    {
        return get_value($this, 'chat_id');
    }

    public function getMessageId(): ?int
    {
        return get_value($this, 'message_id');
    }

    public function getInlineMessageId(): ?string
    {
        return get_value($this, 'inline_message_id');
    }

    public function getText(): string
    {
        return get_value($this, 'text');
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

    public function setDisableWebPagePreview(bool $disable): void
    {
        set_value($this, 'disable_web_page_preview', $disable);
    }

    public function isDisableWebPagePreview(): bool
    {
        return get_value($this, 'disable_web_page_preview', false);
    }
}
