<?php

declare(strict_types=1);

namespace Viking311\Costs\Infrastructure\Repository;

use PDO;
use Viking311\Costs\Domain\Entity\User;
use Viking311\Costs\Domain\Repository\UserRepositoryInterface;
use Viking311\Costs\Domain\ValueObject\ChatId;
use Viking311\Costs\Domain\ValueObject\UserName;

class UserRepository implements UserRepositoryInterface
{
    const string TABLE_NAME = "users";

    public function __construct(
        private PDO $pdo
    ) {
    }


    public function getById(int $id): ?User
    {
        return null;
    }

    public function getByUserNameAndChatId(string $userName, int $chatId): ?User
    {
        $sth = $this->pdo->prepare('SELECT * FROM ' . self::TABLE_NAME . ' WHERE user_name=:userName AND chat_id=:chatId');
        $sth->execute(
            [
                ':userName' => $userName,
                ':chatId' => $chatId
            ]
        );

        $res = $sth->fetch(PDO::FETCH_ASSOC);
        if (!empty($res)) {
            return new User(
                new UserName($res['user_name']),
                new ChatId($res['chat_id']),
                $res['id']
            );
        }

        return null;
    }

    public function save(User $user): void
    {
        if (is_null($user->getId())) {
            $this->insert($user);
            return;
        }

        $this->update($user);
    }

    private function insert(User $user): void
    {
        $sth = $this->pdo->prepare('INSERT INTO ' . self::TABLE_NAME .'(user_name, chat_id) VALUES (:userName, :chatId)');

        $res = $sth->execute([
            ':userName' => $user->getUserName()->getValue(),
            ':chatId' => $user->getChatId()->getValue()
        ]);

        $user->setId(
            (int) $this->pdo->lastInsertId(self::TABLE_NAME . '_id_seq')
        );
    }

    private function update(User $user): void
    {
        $sth = $this->pdo->prepare('UPDATE ' . self::TABLE_NAME . " SET user_name=:userName, chat_id=:chatId WHERE id=:id");

        $res = $sth->execute([
            ':userName' => $user->getUserName()->getValue(),
            ':chat_id' => $user->getChatId()->getValue(),
            ':id' => $user->getId()
        ]);
    }
}
