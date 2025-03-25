<?php

namespace SikaradevPhpUtils\Linq;

final class Linq
{
    private array $items;
    private array $selectedColumns;
    private array $aggregateColumns;

    /**
     * @param array $items
     */
    private function __construct(array $items)
    {
        $this->items = $items;
        $this->selectedColumns = [];
        $this->aggregateColumns = [];
    }

    public static function from(array $items): self
    {
        return new Linq($items);
    }

    public function select(string ...$columns): self
    {
        $this->selectedColumns = array_map(fn(string $c) => explode('.', $c)[1], func_get_args());
        return $this;
    }

    public function sum(string ...$columns): self
    {
        $this->aggregateColumns = array_map(fn(string $c) => explode('.', $c)[1], func_get_args());
        return $this;
    }

    public function groupBy(string ...$columns): self
    {
        $aggregate = [];
        $aggregateColumn = array_map(fn(string $ac) => explode('.', $ac)[1], func_get_args());
        foreach ($this->items as $item) {
            foreach ($aggregateColumn as $column) {
                $aggregate[$item[$column]][] = $item;
            }
        }
        foreach ($aggregate as $key => $values) {
            $aggregate[$key] = array_reduce(
                $values, fn(array $acc, array $item) => ([
                'fonctionName' => $item['fonctionName'],
                'fonctionConstante' => $item['fonctionConstante'],
                'nbReponseP1' => $acc['nbReponseP1'] + $item['nbReponseP1'],
                'nbReponseP2' => $acc['nbReponseP2'] + $item['nbReponseP2']
            ]),
                ['nbReponseP1' => 0, 'nbReponseP2' => 0]
            );
        }
        return $this;
    }

    public function get(): array
    {
        return [];
    }
}