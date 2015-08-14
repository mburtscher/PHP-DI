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
use DI\Definition\ArrayDefinitionExtension;
use DI\Definition\CacheableDefinition;
use DI\Definition\ValueDefinition;
use DI\Scope;

/**
 * @covers \DI\Definition\ArrayDefinitionExtension
 */
class ArrayDefinitionExtensionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function has_values()
    {
        $definition = new ArrayDefinitionExtension(['hello']);

        $this->assertEquals(['hello'], $definition->getValues());
    }

    /**
     * @test
     */
    public function has_name()
    {
        $definition = new ArrayDefinitionExtension(['hello']);
        $definition->setName('foo');

        $this->assertEquals('foo', $definition->getName());
    }

    /**
     * @test
     */
    public function has_sub_definition()
    {
        $definition = new ArrayDefinitionExtension(['hello']);
        $definition->setName('foo');

        $this->assertEquals('foo', $definition->getSubDefinitionName());
    }

    /**
     * @test
     */
    public function scope_should_be_singleton()
    {
        $definition = new ArrayDefinitionExtension([]);

        $this->assertEquals(Scope::SINGLETON, $definition->getScope());
    }

    /**
     * @test
     */
    public function is_not_cacheable()
    {
        $definition = new ArrayDefinitionExtension([]);

        $this->assertFalse($definition instanceof CacheableDefinition);
    }

    /**
     * @test
     */
    public function appends_values_after_sub_definition_values()
    {
        $definition = new ArrayDefinitionExtension(['foo']);
        $definition->setSubDefinition(new ArrayDefinition(['bar']));

        $expected = [
            'bar',
            'foo',
        ];

        $this->assertEquals($expected, $definition->getValues());
    }

    /**
     * @test
     * @expectedException \DI\Definition\Exception\DefinitionException
     * @expectedExceptionMessage Definition '' tries to add array entries but the previous definition is not an array
     */
    public function should_error_if_not_extending_an_array()
    {
        $definition = new ArrayDefinitionExtension(['foo']);
        $definition->setSubDefinition(new ValueDefinition('value'));
    }
}
