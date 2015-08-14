<?php
/**
 * PHP-DI
 *
 * @link      http://php-di.org/
 * @copyright Matthieu Napoli (http://mnapoli.fr/)
 * @license   http://www.opensource.org/licenses/mit-license.php MIT (see the LICENSE file)
 */

namespace DI\Test\UnitTest\Definition\Resolver;

use DI\Definition\FactoryDefinition;
use DI\Definition\Resolver\StringResolver;
use DI\Definition\StringDefinition;
use DI\NotFoundException;
use EasyMock\EasyMock;

/**
 * @covers \DI\Definition\Resolver\StringResolver
 */
class StringResolverTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function resolves_bare_strings()
    {
        $container = EasyMock::mock('Interop\Container\ContainerInterface');
        $resolver = new StringResolver($container);

        $definition = new StringDefinition('foo');

        $this->assertEquals('foo', $resolver->resolve($definition));
    }

    /**
     * @test
     */
    public function resolves_references()
    {
        $container = EasyMock::mock('Interop\Container\ContainerInterface', [
            'get' => 'bar',
        ]);
        $resolver = new StringResolver($container);

        $definition = new StringDefinition('{test}');

        $this->assertEquals('bar', $resolver->resolve($definition));
    }

    /**
     * @test
     */
    public function resolves_multiple_references()
    {
        $container = EasyMock::mock('Interop\Container\ContainerInterface');
        $container->expects($this->exactly(2))
            ->method('get')
            ->withConsecutive(['tmp'], ['logs'])
            ->willReturnOnConsecutiveCalls('/private/tmp', 'myapp-logs');
        $resolver = new StringResolver($container);

        $definition = new StringDefinition('{tmp}/{logs}/app.log');

        $value = $resolver->resolve($definition);

        $this->assertEquals('/private/tmp/myapp-logs/app.log', $value);
    }

    /**
     * @test
     * @expectedException \DI\DependencyException
     * @expectedExceptionMessage Error while parsing string expression '{test}': No entry or class found for 'test'
     */
    public function errors_on_unknown_entry_name()
    {
        $container = EasyMock::mock('Interop\Container\ContainerInterface', [
            'get' => new NotFoundException("No entry or class found for 'test'"),
        ]);
        $resolver = new StringResolver($container);

        $resolver->resolve(new StringDefinition('{test}'));
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage This definition resolver is only compatible with StringDefinition objects, DI\Definition\FactoryDefinition given
     */
    public function errors_with_unsupported_definitions()
    {
        $container = EasyMock::mock('Interop\Container\ContainerInterface');
        $resolver = new StringResolver($container);

        $definition = new FactoryDefinition('foo', function () {
        });

        $resolver->resolve($definition);
    }
}
