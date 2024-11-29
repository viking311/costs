<?php

declare(strict_types=1);

namespace Viking311\Costs\Infrastructure\Repository;

use DateMalformedStringException;
use DateTimeImmutable;
use PDO;
use Viking311\Costs\Domain\Entity\Cost;
use Viking311\Costs\Domain\Repository\CostRepositoryInterface;
use Viking311\Costs\Domain\Repository\RepositoryException;
use Viking311\Costs\Domain\ValueObject\Amount;
use Viking311\Costs\Domain\ValueObject\Comment;
use Viking311\Costs\Domain\ValueObject\CostDate;

class CostRepository implements CostRepositoryInterface
{
    /** @var string  */
    const string TABLE_NAME = "costs";

    /**
     * @param PDO $pdo
     */
    public function __construct(
        private readonly PDO $pdo
    ) {
    }

    /**
     * @param int $userId
     * @param $sort
     * @param int $limit
     * @return array|Cost[]
     * @throws DateMalformedStringException
     * @throws RepositoryException
     */
    public function getCostsByUserId(int $userId, $sort = 'ASC', int $limit = 0): array
    {
        $sql = 'SELECT * FROM ' . self::TABLE_NAME . ' WHERE user_id=:userId ORDER BY cost_date ' . $sort;
        if ($limit > 0) {
            $sql .= ' LIMIT ' . $limit;
        }

        $sth = $this->pdo->prepare($sql);
        $res =  $sth->execute([
            ':userId' => $userId,
        ]);

        if (!$res) {
            throw new RepositoryException($sth->errorCode() . ': ' . implode("\n", $sth->errorInfo()));
        }

        $resultSet = $sth->fetchAll(PDO::FETCH_ASSOC);

        $result = [];

        foreach ($resultSet as $rawItem) {
            $costDate = new DateTimeImmutable($rawItem['cost_date']);

            $result[] = new Cost(
                (int)$rawItem['userId'],
                new CostDate($costDate),
                new Amount((float)$rawItem['amount']),
                new Comment($rawItem['comment']),
                (int)$rawItem['id']
            );
        }

        return $result;
    }

    /**
     * @param Cost $cost
     * @return void
     * @throws RepositoryException
     */
    public function save(Cost $cost): void
    {
        if (is_null($cost->getId())) {
            $this->insert($cost);
        } else {
            $this->update($cost);
        }
    }

    /**
     * @param Cost $cost
     * @return void
     * @throws RepositoryException
     */
    private function insert(Cost $cost): void
    {
        $sth = $this->pdo->prepare('INSERT INTO ' . self::TABLE_NAME . ' (cost_date, amount, comment, user_id) VALUES(:costDate, :amount, :comment, :userId)');

        $res = $sth->execute([
            ':costDate' => $cost->getCostDate()->getValue()->format('Y-m-d H:i'),
            ':amount' => $cost->getAmount()->getValue(),
            ':comment' => $cost->getComment()->getValue(),
            ':userId' => $cost->getUserId()
        ]);

        if (!$res) {
            throw new RepositoryException($sth->errorCode() . ': ' . implode("\n", $sth->errorInfo()));
        }

        $cost->setId(
            (int) $this->pdo->lastInsertId(self::TABLE_NAME . '_id_seq')
        );
    }

    /**
     * @param Cost $cost
     * @return void
     * @throws RepositoryException
     */
    public function update(Cost $cost): void
    {
        $sth = $this->pdo->prepare('UPDATE ' .self::TABLE_NAME . ' SET cost_date=:costDate, amount=:amount, comment=:comment WHERE id=:id');
        $res = $sth->execute([
            ':costDate' => $cost->getCostDate()->getValue()->format('Y-m-d H:i'),
            ':amount' => $cost->getAmount()->getValue(),
            ':comment' => $cost->getComment()->getValue(),
            ':id' => $cost->getId()
        ]);

        if (!$res) {
            throw new RepositoryException($sth->errorCode() . ': ' . implode("\n", $sth->errorInfo()));
        }

    }
}
