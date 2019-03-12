<?php

namespace Formapro\TelegramBot;

use function Formapro\Values\get_object;
use function Formapro\Values\get_value;

class Chat
{
    const PRIVATE = 'private';

    const GROUP = 'group';

    const SUPERGROUP = 'supergroup';

    const CHANNEL = 'channel';

    private $values = [];

    private $objects = [];

    public function getId(): int
    {
        return get_value($this, 'id');
    }

    public function getType(): string
    {
        return get_value($this, 'type');
    }

    public function getTitle(): ?string
    {
        return get_value($this, 'title');
    }

    public function getUsername(): ?string
    {
        return get_value($this, 'username');
    }

    public function getFirstName(): ?string
    {
        return get_value($this, 'first_name');
    }

    public function getLastName(): ?string
    {
        return get_value($this, 'last_name');
    }

    public function isAllMembersAreAdministrators(): bool
    {
        return get_value($this, 'all_members_are_administrators', false);
    }

    public function getPhoto(): ?ChatPhoto
    {
        return get_object($this, 'photo', ChatPhoto::class);
    }

    public function getDescription(): ?string
    {
        return get_value($this, 'description');
    }

    public function getInviteLink(): ?string
    {
        return get_value($this, 'invite_link');
    }

    public function getPinnedMessage(): ?Message
    {
        return get_object($this, 'pinned_message', Message::class);
    }

    public function getStickerSetName(): ?string
    {
        return get_value($this, 'sticker_set_name');
    }

    public function canSetStickerSet(): bool
    {
        return get_value($this, 'can_set_sticker_set', false);
    }
}
