<?php

declare(strict_types=1);

namespace Viking311\Costs\Domain\Entity;

use Viking311\Costs\Domain\ValueObject\ChatId;
use Viking311\Costs\Domain\ValueObject\UserName;

class User
{
    public function __construct(
        private UserName $userName,
        private ChatId $chatId,
        private ?int  $id = null
    )
    {
    }

    public function getUserName(): UserName
    {
        return $this->userName;
    }

    public function getChatId(): ChatId
    {
        return $this->chatId;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }
}
