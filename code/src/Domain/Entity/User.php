<?php

declare(strict_types=1);

namespace Viking311\Costs\Domain\Entity;

use Viking311\Costs\Domain\ValueObject\ChatId;
use Viking311\Costs\Domain\ValueObject\UserName;

class User
{
    /**
     * @param UserName $userName
     * @param ChatId $chatId
     * @param int|null $id
     */
    public function __construct(
        private UserName $userName,
        private ChatId $chatId,
        private ?int  $id = null
    ) {
    }

    /**
     * @return UserName
     */
    public function getUserName(): UserName
    {
        return $this->userName;
    }

    /**
     * @return ChatId
     */
    public function getChatId(): ChatId
    {
        return $this->chatId;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return void
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }
}
