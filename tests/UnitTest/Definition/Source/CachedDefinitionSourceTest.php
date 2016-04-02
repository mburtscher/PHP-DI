<?php

namespace DI\Test\UnitTest\Definition\Source;

use Cache\Adapter\Common\CacheItem;
use DI\Definition\ObjectDefinition;
use DI\Definition\Source\CachedDefinitionSource;
use DI\Definition\Source\DefinitionArray;
use EasyMock\EasyMock;
use Psr\Cache\CacheItemInterface;
use Psr\Cache\CacheItemPoolInterface;

/**
 * @covers \DI\Definition\Source\CachedDefinitionSource
 */
class CachedDefinitionSourceTest extends \PHPUnit_Framework_TestCase
{
    use EasyMock;

    /**
     * @test
     */
    public function should_get_from_cache()
    {
        /** @var CacheItemPoolInterface $cache */
        $cache = $this->easySpy(CacheItemPoolInterface::class, [
            'getItem' => $this->easyMock(CacheItemInterface::class, [
                'get' => 'foo',
                'getKey' => 'foo',
                'isHit' => true,
            ]),
        ]);

        $source = new CachedDefinitionSource(new DefinitionArray(), $cache);

        $this->assertEquals('foo', $source->getDefinition('foo'));
    }

    /**
     * @test
     */
    public function should_save_to_cache_and_return()
    {
        /** @var CacheItemPoolInterface $cache */
        $cache = $this->easySpy(CacheItemPoolInterface::class, [
            'getItem' => new CacheItem('foo'),
        ]);

        $cachedSource = new DefinitionArray([
            'foo' => \DI\object(),
        ]);

        $source = new CachedDefinitionSource($cachedSource, $cache);

        $expectedDefinition = new ObjectDefinition('foo');
        $cache->expects($this->once())
            ->method('save')
            ->with($this->isInstanceOf(CacheItemInterface::class));

        $this->assertEquals($expectedDefinition, $source->getDefinition('foo'));
    }

    /**
     * @test
     */
    public function should_save_null_to_cache_and_return_null()
    {
        /** @var CacheItemPoolInterface $cache */
        $cache = $this->easySpy('Psr\Cache\CacheItemPoolInterface', [
            'getItem' => new CacheItem('foo'),
        ]);

        $source = new CachedDefinitionSource(new DefinitionArray(), $cache);

        $cache->expects($this->once())
            ->method('save')
            ->with($this->isInstanceOf(CacheItemInterface::class));
        $this->assertNull($source->getDefinition('foo'));
    }
}
