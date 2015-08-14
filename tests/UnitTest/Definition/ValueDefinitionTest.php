<?php
/**
 * PHP-DI
 *
 * @link      http://php-di.org/
 * @copyright Matthieu Napoli (http://mnapoli.fr/)
 * @license   http://www.opensource.org/licenses/mit-license.php MIT (see the LICENSE file)
 */

namespace DI\Test\UnitTest\Definition;

use DI\Definition\CacheableDefinition;
use DI\Definition\ValueDefinition;
use DI\Scope;

/**
 * @covers \DI\Definition\ValueDefinition
 */
class ValueDefinitionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function has_value()
    {
        $definition = new ValueDefinition(1);

        $this->assertEquals(1, $definition->getValue());
    }

    /**
     * @test
     */
    public function has_name()
    {
        $definition = new ValueDefinition(1);
        $definition->setName('foo');

        $this->assertEquals('foo', $definition->getName());
    }

    /**
     * @test
     */
    public function has_singleton_scope()
    {
        $definition = new ValueDefinition(1);

        $this->assertEquals(Scope::SINGLETON, $definition->getScope());
    }

    /**
     * @test
     */
    public function is_not_cacheable()
    {
        $this->assertFalse(new ValueDefinition('foo') instanceof CacheableDefinition);
    }
}
