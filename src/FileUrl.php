<?php
namespace Formapro\TelegramBot;

/**
 * @see https://core.telegram.org/bots/api#sending-files
 */
class FileUrl
{
    private $url;

    public function __construct(string $url)
    {
        $this->url = $url;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function __toString()
    {
        return $this->url;
    }
}