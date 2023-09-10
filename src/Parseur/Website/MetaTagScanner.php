<?php

namespace SikaradevPhpUtils\Parseur\Website;

use SikaradevPhpUtils\Collections\Collection;
use Symfony\Component\DomCrawler\Crawler;

final class MetaTagScanner implements ScannerInterface
{

    public function scan(Crawler $htmlNode): array
    {
        $response = $htmlNode->filter('meta')
            ->each(fn(Crawler $node, int $id) => $this->metaCollectors($node));

        return Collection::of($response)
            ->filter(fn(int $k, array $values) => !empty(array_keys($values)[0]) && !empty(array_values($values)[0]))
            ->reduce(fn(array $acc, array $current) => array_merge($acc, $current), [])
            ->get();
    }

    private function metaCollectors(Crawler $node): array
    {
        if (!empty($node->attr('name'))) {
            return [
                $node->attr('name') => $node->attr('content'),
            ];
        }
        return [$node->attr('property') => $node->attr('content')];
    }
}