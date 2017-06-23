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

namespace Vainyl\Mongo\Extension;

use Vainyl\Core\Extension\AbstractFrameworkExtension;

/**
 * Class MongoExtension
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class MongoExtension extends AbstractFrameworkExtension
{
    /**
     * @inheritDoc
     */
    public function getCompilerPasses(): array
    {
        return [];
    }
}
