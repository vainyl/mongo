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

use MongoDB\Client as MongoClient;
use Vainyl\Connection\AbstractConnection;

/**
 * Class PhongoConnection
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class PhongoConnection extends AbstractConnection
{
    private $hosts;

    private $user;

    private $password;

    private $uriOptions;

    private $driverOptions;

    /**
     * PhongoConnection constructor.
     *
     * @param string $name
     * @param string $user
     * @param string $password
     * @param array  $uriOptions
     * @param array  $driverOptions
     */
    public function __construct(
        string $name,
        array $hosts,
        string $user,
        string $password,
        string $database,
        array $uriOptions = [],
        array $driverOptions = []
    ) {
        $this->hosts = $hosts;
        $this->user = $user;
        $this->password = $password;
        $this->uriOptions = $uriOptions;
        $this->driverOptions = $driverOptions;
        parent::__construct($name);
    }

    /**
     * @return string
     */
    protected function getConnectionString(): string
    {
        $connectionStrings = [];
        foreach ($this->hosts as $host) {
            $port = 27017;
            if (false !== array_key_exists('port', $host)) {
                $port = $host['port'];
            }
            $connectionStrings[] = sprintf('%s:%d', $host['host'], $port);
        }

        return implode(',', $connectionStrings);
    }

    /**
     * @inheritDoc
     */
    public function doEstablish()
    {
        $dsn = sprintf('mongodb://%s:%s@%s/', $this->user, $this->password, $this->getConnectionString());

        return new MongoClient($dsn, $this->uriOptions, $this->driverOptions);
    }
}
