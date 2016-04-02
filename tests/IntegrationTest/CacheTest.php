<?php

namespace DI\Test\IntegrationTest;

use Cache\Adapter\Common\CacheItem;
use DI\Cache\ArrayCache;
use DI\ContainerBuilder;
use EasyMock\EasyMock;
use Psr\Cache\CacheItemPoolInterface;

/**
 * Test caching.
 *
 * @coversNothing
 */
class CacheTest extends \PHPUnit_Framework_TestCase
{
    use EasyMock;

    /**
     * @test
     */
    public function cached_definitions_should_be_overridables()
    {
        $cache = $this->easyMock(CacheItemPoolInterface::class, [
            'getItem' => new CacheItem('foo'),
        ]);

        $builder = new ContainerBuilder();
        $builder->setDefinitionCache($cache);
        $builder->addDefinitions([
            'foo' => 'bar',
        ]);

        $container = $builder->build();

        $this->assertEquals('bar', $container->get('foo'));

        $container->set('foo', 'hello');

        $this->assertEquals('hello', $container->get('foo'));
    }
}
