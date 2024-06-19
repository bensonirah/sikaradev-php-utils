<?php

namespace SikaradevPhpUtils\Test\Collections;

use PHPUnit\Framework\TestCase;
use SikaradevPhpUtils\Collections\Collection;

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

    /**
     * @group test
     */
    public function testFilter()
    {
        $response = $this->collection
            ->filter(fn(int $k, string $v) => $k == 1)
            ->get();
        $this->assertIsArray($response);
        $this->assertCount(1, $response);
        $this->assertEquals(['data/country.json'], $response);
    }

    public function test_it_should_return_empty_array()
    {
        $response = Collection::of([])
            ->filter(fn(int $k, string $v) => $k == 1)
            ->get();
        $this->assertIsArray($response);
        $this->assertEmpty($response);
    }
}
