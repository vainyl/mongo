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
declare(strict_types = 1);


namespace Vainyl\Mongo\Factory;

use Vainyl\Core\Storage\StorageInterface;
use Vainyl\Mongo\PhongoDatabase;

/**
 * Class PhongoDatabaseFactory
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class PhongoDatabaseFactory
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
     * @param string $name
     * @param array  $configData
     *
     * @return PhongoDatabase
     */
    public function createDatabase(string $name, array $configData): PhongoDatabase
    {
        return new PhongoDatabase($name, $this->connectionStorage[$configData['connection']]);
    }
}