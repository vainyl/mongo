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

namespace Vainyl\Mongo\Factory;

use Vainyl\Core\AbstractIdentifiable;
use Vainyl\Core\Storage\StorageInterface;
use Vainyl\Database\DatabaseInterface;
use Vainyl\Database\Factory\DatabaseFactoryInterface;
use Vainyl\Mongo\MongoDbDatabase;

/**
 * Class MongoDbDatabaseFactory
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class MongoDbDatabaseFactory extends AbstractIdentifiable implements DatabaseFactoryInterface
{
    private $connectionStorage;

    /**
     * MongoDbDatabaseFactory constructor.
     *
     * @param StorageInterface $connectionStorage
     */
    public function __construct(StorageInterface $connectionStorage)
    {
        $this->connectionStorage = $connectionStorage;
    }

    /**
     * @param string $databaseName
     * @param string $connectionName
     * @param array  $options
     *
     * @return DatabaseInterface
     */
    public function createDatabase(
        string $databaseName,
        string $connectionName,
        array $options = []
    ): DatabaseInterface {
        return new MongoDbDatabase($databaseName, $this->connectionStorage[$connectionName]);
    }
}