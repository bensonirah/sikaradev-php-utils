<?php
declare(strict_types=1);

namespace SikaradevPhpUtils\Helper\Collections;

class Collection
{
    private array $list;

    /**
     * @param array $list
     */
    public function __construct(array $list)
    {
        $this->list = $list;
    }

    public static function of(array $list): self
    {
        return new static($list);
    }

    public function filter(callable $predicate): array
    {
        $filteredItems = [];
        foreach ($this->list as $key => $value) {
            if ($predicate($key, $value)) {
                $filteredItems[] = $value;
            }
        }
        return $filteredItems;
    }
}