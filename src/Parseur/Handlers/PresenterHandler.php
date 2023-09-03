<?php

namespace SikaradevPhpUtils\Parseur\Handlers;

use SikaradevPhpUtils\Collections\Collection;

final class PresenterHandler
{
    private string $fieldSeparator;
    private string $dataSeparator;

    /**
     * @param string $fieldSeparator
     * @param string $dataSeparator
     */
    public function __construct(string $fieldSeparator = '|', string $dataSeparator = ':')
    {
        $this->fieldSeparator = $fieldSeparator;
        $this->dataSeparator = $dataSeparator;
    }

    public function __invoke(string $text): array
    {

        return Collection::of(explode($this->fieldSeparator, $text))
            ->filter(fn(int $k, string $v) => !empty($v))
            ->map(function (string $v) {
                [$key, $value] = explode($this->dataSeparator, $v);
                return [trim($key) => trim($value)];
            })
            ->reduce(fn(array $acc, array $current) => array_merge($acc, $current), [])
            ->get();
    }
}