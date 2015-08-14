<?php
/**
 * PHP-DI
 *
 * @link      http://php-di.org/
 * @copyright Matthieu Napoli (http://mnapoli.fr/)
 * @license   http://www.opensource.org/licenses/mit-license.php MIT (see the LICENSE file)
 */

namespace DI\Test\UnitTest\Definition;

use DI\Definition\AliasDefinition;
use DI\Definition\CacheableDefinition;
use DI\Scope;

/**
 * @covers \DI\Definition\AliasDefinition
 */
class AliasDefinitionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function has_a_target_entry_name()
    {
        $definition = new AliasDefinition('foo');

        $this->assertEquals('foo', $definition->getTargetEntryName());
    }

    /**
     * @test
     */
    public function has_a_name()
    {
        $definition = new AliasDefinition('foo');
        $definition->setName('bar');

        $this->assertEquals('bar', $definition->getName());
    }

    /**
     * @test
     */
    public function should_have_prototype_scope()
    {
        $definition = new AliasDefinition('foo');

        $this->assertEquals(Scope::PROTOTYPE, $definition->getScope());
    }

    /**
     * @test
     */
    public function should_be_cacheable()
    {
        $this->assertTrue(new AliasDefinition('foo') instanceof CacheableDefinition);
    }
}
