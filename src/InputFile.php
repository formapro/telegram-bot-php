<?php
namespace Formapro\TelegramBot;

/**
 * @see https://core.telegram.org/bots/api#sending-files
 */
class InputFile
{
    private $fileName;

    private $content;

    public function __construct(string $fileName, string $content)
    {
        $this->fileName = $fileName;
        $this->content = $content;
    }

    public function getFileName(): string
    {
        return $this->fileName;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function __toString()
    {
        return $this->content;
    }
}