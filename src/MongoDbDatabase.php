<?php
/**
 * Vainyl
 *
 * PHP Version 7
 *
 * @package   Mongo
 * @license   https://opensource.org/licenses/MIT MIT License
 * @link      https://vainyl.com
 */
declare(strict_types=1);

namespace Vainyl\Mongo;

use MongoDB\Database;
use Vainyl\Database\CursorInterface;
use Vainyl\Database\DatabaseInterface;

/**
 * Class MongoDbDatabase
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class MongoDbDatabase extends Database implements DatabaseInterface
{
    private $connection;

    /**
     * MongoDatabase constructor.
     *
     * @param string            $name
     * @param MongoDbConnection $connection
     */
    public function __construct(string $name, MongoDbConnection $connection)
    {
        $this->connection = $connection;
        parent::__construct($connection->establish()->getManager(), $name);
    }

    /**
     * @param MongoDbDatabase $obj
     *
     * @return bool
     */
    public function equals($obj): bool
    {
        return $this->getId() === $obj->getId();
    }

    /**
     * @inheritDoc
     */
    public function getId(): string
    {
        return spl_object_hash($this);
    }

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return $this->getDatabaseName();
    }

    /**
     * @inheritDoc
     */
    public function hash()
    {
        return $this->getId();
    }

    /**
     * @inheritDoc
     */
    public function runQuery($query, array $bindParams = [], array $bindTypes = []): CursorInterface
    {
        return $this->command($query);
    }
}
