<?php

namespace SikaradevPhpUtils\Helper\Collections;

use PHPUnit\Framework\TestCase;

class CollectionTest extends TestCase
{
    protected Collection $collection;

    protected function setUp(): void
    {
        parent::setUp();
        $this->collection = Collection::of(['index.php', 'data/country.json']);
    }

    public function testOf()
    {
        $this->assertInstanceOf(Collection::class, Collection::of([]));
    }

    public function testFilter()
    {
        $response = $this->collection->filter(fn(int $k, string $v) => $k == 1);
        $this->assertIsArray($response);
        $this->assertCount(1, $response);
        $this->assertEquals(['data/country.json'], $response);
    }

    public function test_it_should_return_empty_array()
    {
        $response = Collection::of([])
            ->filter(fn(int $k, string $v) => $k == 1);
        $this->assertIsArray($response);
        $this->assertEmpty($response);
    }
}
