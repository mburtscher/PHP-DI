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
use DI\Definition\StringDefinition;
use DI\Scope;

/**
 * @covers \DI\Definition\StringDefinition
 */
class StringDefinitionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function has_expression()
    {
        $definition = new StringDefinition('foo');

        $this->assertEquals('foo', $definition->getExpression());
    }

    /**
     * @test
     */
    public function has_name()
    {
        $definition = new StringDefinition('aaa');
        $definition->setName('foo');

        $this->assertEquals('foo', $definition->getName());
    }

    /**
     * @test
     */
    public function has_singleton_scope()
    {
        $definition = new StringDefinition('foo');

        $this->assertEquals(Scope::SINGLETON, $definition->getScope());
    }

    /**
     * @test
     */
    public function is_not_cacheable()
    {
        $this->assertFalse(new StringDefinition('foo') instanceof CacheableDefinition);
    }
}
