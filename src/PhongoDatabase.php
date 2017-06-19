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
 * Class PhongoDatabase
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class PhongoDatabase extends Database implements DatabaseInterface
{
    private $connection;

    /**
     * MongoDatabase constructor.
     *
     * @param string $name
     * @param PhongoConnection $connection
     */
    public function __construct(string $name, PhongoConnection $connection)
    {
        $this->connection = $connection;
        parent::__construct($connection->establish()->getManager(), $name);
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
    public function __debugInfo()
    {
        return $this->connection->establish()->__debugInfo();
    }

    /**
     * @inheritDoc
     */
    public function __get($collectionName)
    {
        return $this->connection->establish()->__get($collectionName);
    }

    /**
     * @inheritDoc
     */
    public function __toString(): string
    {
        return $this->connection->establish()->__toString();
    }

    /**
     * @inheritDoc
     */
    public function command($command, array $options = [])
    {
        return $this->connection->establish()->command($command, $options);
    }

    /**
     * @inheritDoc
     */
    public function createCollection($collectionName, array $options = [])
    {
        return $this->connection->establish()->createCollection($collectionName, $options);
    }

    /**
     * @inheritDoc
     */
    public function drop(array $options = [])
    {
        return $this->connection->establish()->drop($options);
    }

    /**
     * @inheritDoc
     */
    public function dropCollection($collectionName, array $options = [])
    {
        return $this->connection->establish()->dropCollection($collectionName, $options);
    }

    /**
     * @inheritDoc
     */
    public function getDatabaseName()
    {
        return $this->connection->establish()->getDatabaseName();
    }

    /**
     * @inheritDoc
     */
    public function listCollections(array $options = [])
    {
        return $this->connection->establish()->listCollections($options);
    }

    /**
     * @inheritDoc
     */
    public function selectCollection($collectionName, array $options = [])
    {
        return $this->connection->establish()->selectCollection($collectionName, $options);
    }

    /**
     * @inheritDoc
     */
    public function withOptions(array $options = [])
    {
        return $this->connection->establish()->withOptions($options);
    }

    /**
     * @inheritDoc
     */
    public function selectGridFSBucket(array $options = [])
    {
        return $this->connection->establish()->selectGridFSBucket($options);
    }


    /**
     * @inheritDoc
     */
    public function runQuery($query, array $bindParams, array $bindTypes = []): CursorInterface
    {
        return $this->command($query, $bindParams);
    }
}
