<?php
declare(strict_types=1);

namespace SikaradevPhpUtils\Collections;

class Collection
{
    private array $list;
    private int $lenght;

    /**
     * @param array $list
     */
    public function __construct(array $list)
    {
        $this->list = $list;
        $this->lenght = count($list);
    }

    public static function of(array $list): self
    {
        return new static($list);
    }

    public function filter(callable $predicate): self
    {
        $filteredItems = [];
        foreach ($this->list as $key => $value) {
            if ($predicate($key, $value)) {
                $filteredItems[] = $value;
            }
        }
        $this->list = $filteredItems;

        return $this;
    }

    public function map(callable $fn): self
    {
        $this->list = array_map($fn, $this->list);
        return $this;
    }

    /**
     * @param callable $fn
     * @param mixed $initial
     * @return $this
     */
    public function reduce(callable $fn, $initial = null): self
    {
        $this->list = array_reduce($this->list, $fn, $initial);
        return $this;
    }

    public function get(): array
    {
        return $this->list;
    }

    public function count(): int
    {
        return count($this->list);
    }

    /**
     * @param int $offset
     * @return $this
     */
    public function skip(int $offset): self
    {
        $this->list = array_slice($this->list, $offset);
        return $this;
    }

    public function take(int $length): self
    {
        $this->list = array_slice($this->list, 0, $length);
        return $this;
    }

    public function asGenerator(): \Generator
    {
        foreach ($this->list as $item) {
            yield $item;
        }
    }

    /**
     * @return array
     */
    public function draw(): array
    {
        $index = mt_rand(0, $this->lenght - 1);
        return ['index' => $index, 'item' => $this->list[$index]];
    }
}