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

namespace Vainyl\Mongo;

use Vainyl\Connection\AbstractConnection;
use MongoDB\Client as MongoClient;

/**
 * Class PhongoConnection
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class PhongoConnection extends AbstractConnection
{

    /**
     * @param array $config
     *
     * @return string
     */
    protected function getPassword(array $config) : string
    {
        if (false === array_key_exists('password', $config)) {
            return '';
        }

        $password = $config['password'];

        if (false === array_key_exists('algo', $config)) {
            return $password;
        }

        return hash($config['algo'], $password);
    }

    /**
     * @param array $config
     *
     * @return array
     */
    protected function getCredentials(array $config) : array
    {
        $hostsConfig = $config['hosts'];
        $connectionStrings = [];
        foreach ($hostsConfig as $hostConfig) {
            $port = 27017;
            if (false !== array_key_exists('port', $hostConfig)) {
                $port = $hostConfig['port'];
            }
            $connectionStrings[] = sprintf('%s:%d', $hostConfig['host'], $port);
        }
        $connectionString = implode(',', $connectionStrings);

        $options = [];
        if (false !== array_key_exists('options', $config)) {
            $options = $config['options'];
        }

        $driverOptions = [];
        if (false !== array_key_exists('driverOptions', $config)) {
            $options = $config['driverOptions'];
        }

        return [
            $config['username'],
            $config['password'],
            $connectionString,
            $config['dbname'],
            $options,
            $driverOptions,
        ];
    }

    /**
     * @inheritDoc
     */
    public function establish()
    {
        list ($username, $password, $connectionString, $database, $options, $driverOptions)
            = $this->getCredentials($this->getConfigData());
        $dsn = sprintf('mongodb://%s:%s@%s/', $username, $password, $connectionString);

        return (new MongoClient($dsn, $options, $driverOptions))->selectDatabase($database);
    }
}
