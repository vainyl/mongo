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
use Vainyl\Mongo\PhongoDatabase;

/**
 * Class PhongoDatabaseFactory
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class PhongoDatabaseFactory extends AbstractIdentifiable implements DatabaseFactoryInterface
{
    private $connectionStorage;

    /**
     * PdoDatabaseFactory constructor.
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
        return new PhongoDatabase($databaseName, $this->connectionStorage[$connectionName]);
    }
}