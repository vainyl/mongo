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

use Vainyl\Mongo\PhongoConnection;

/**
 * Class PhongoConnectionFactory
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class PhongoConnectionFactory
{
    /**
     * @inheritDoc
     */
    public function getName() : string
    {
        return 'phongo';
    }

    /**
     * @param string $name
     * @param array  $configData
     *
     * @return PhongoConnection
     */
    public function createConnection(string $name, array $configData): PhongoConnection
    {
        return new PhongoConnection($name, $configData);
    }
}
