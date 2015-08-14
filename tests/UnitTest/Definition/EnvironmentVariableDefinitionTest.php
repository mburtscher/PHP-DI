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
use DI\Definition\EnvironmentVariableDefinition;
use DI\Scope;

/**
 * @covers \DI\Definition\EnvironmentVariableDefinition
 */
class EnvironmentVariableDefinitionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function has_environment_variable()
    {
        $definition = new EnvironmentVariableDefinition('foo');
        $this->assertEquals('foo', $definition->getVariableName());
    }

    /**
     * @test
     */
    public function has_name()
    {
        $definition = new EnvironmentVariableDefinition('foo');
        $definition->setName('bar');

        $this->assertEquals('bar', $definition->getName());
    }

    /**
     * @test
     */
    public function is_mandatory_by_default()
    {
        $definition = new EnvironmentVariableDefinition('foo');
        $this->assertFalse($definition->isOptional());
    }

    /**
     * @test
     */
    public function can_be_optional()
    {
        $definition = new EnvironmentVariableDefinition('foo', true, 'default');

        $this->assertTrue($definition->isOptional());
        $this->assertEquals('default', $definition->getDefaultValue());
    }

    /**
     * @test
     */
    public function has_singleton_scope()
    {
        $definition = new EnvironmentVariableDefinition('foo', 'bar');

        $this->assertEquals(Scope::SINGLETON, $definition->getScope());
    }

    /**
     * @test
     */
    public function is_cacheable()
    {
        $this->assertTrue(new EnvironmentVariableDefinition('foo') instanceof CacheableDefinition);
    }
}
