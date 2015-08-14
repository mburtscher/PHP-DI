<?php
/**
 * PHP-DI
 *
 * @link      http://php-di.org/
 * @copyright Matthieu Napoli (http://mnapoli.fr/)
 * @license   http://www.opensource.org/licenses/mit-license.php MIT (see the LICENSE file)
 */

namespace DI\Test\UnitTest\Definition;

use DI\Definition\ArrayDefinition;
use DI\Definition\CacheableDefinition;
use DI\Scope;

/**
 * @covers \DI\Definition\ArrayDefinition
 */
class ArrayDefinitionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function contains_values()
    {
        $definition = new ArrayDefinition(['foo', 'bar']);

        $this->assertEquals(['foo', 'bar'], $definition->getValues());
    }

    /**
     * @test
     */
    public function has_name()
    {
        $definition = new ArrayDefinition([]);
        $definition->setName('foo');

        $this->assertEquals('foo', $definition->getName());
    }

    /**
     * @test
     */
    public function has_singleton_scope()
    {
        $definition = new ArrayDefinition([]);

        $this->assertEquals(Scope::SINGLETON, $definition->getScope());
    }

    /**
     * @test
     */
    public function is_not_cacheable()
    {
        $this->assertFalse(new ArrayDefinition([]) instanceof CacheableDefinition);
    }
}
