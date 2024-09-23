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
     * @param mixed|null $initial
     *
     * @return $this
     */
    public function reduce(callable $fn, mixed $initial = null): self
    {
		$reduced = array_reduce($this->list, $fn, $initial);
		if (is_array($reduced)) {
			$this->list = $reduced;
		}else {
			$this->list = [$reduced];
		}
        return $this;
    }

    public function get(): array
    {
        return $this->list;
    }
	public function join(string $separator=''): string
	{
		return join($separator, $this->list);
	}
    public function count(): int
    {
        return count($this->list);
    }

    /**
     * @param int $offset
     *
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

    public function select(): static
    {
        $selectedColumns = func_get_args();
        if (typeof(array_keys($this->list)[0]) == 'integer' && typeof(array_keys($this->list[0])[0]) == 'string') {
            $this->list = array_map(function (array $row) use ($selectedColumns) {
                $tmp = [];
                foreach ($selectedColumns as $selectedColumn) {
                    $tmp[$selectedColumn] = $row[$selectedColumn];
                }
                return $tmp;
            }, $this->list);
        }

        if (typeof(array_keys($this->list)[0]) == 'string') {
            $tmp = [];
            foreach ($selectedColumns as $selectedColumn) {
                $tmp[$selectedColumn] = $this->list[$selectedColumn];
            }
            $this->list = $tmp;
        }
        return $this;
    }

    public function then(\Closure $func): void
    {
        $func($this->list);
    }

}
