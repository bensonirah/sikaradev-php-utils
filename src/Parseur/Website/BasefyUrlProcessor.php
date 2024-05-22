<?php

namespace SikaradevPhpUtils\Parseur\Website;

use SikaradevPhpUtils\Collections\Collection;
use SikaradevPhpUtils\Url\Url;

final class BasefyUrlProcessor extends UrlProcessorDecorator
{
    public function __construct(UrlProcessor $processor)
    {
        parent::__construct($processor);
    }

    public function scan(string $url): array
    {
        $items = $this->processor->scan($url);
        return Collection::of($items)
            ->map(fn(string $item) => !preg_match('/^\//', $item) ? $item : Url::fromLink($url)->baseUrl() . $item)
            ->get();
    }
}