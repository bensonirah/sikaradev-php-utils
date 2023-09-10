<?php

namespace SikaradevPhpUtils\Parseur\Website;

use SikaradevPhpUtils\Collections\Collection;
use Symfony\Component\DomCrawler\Crawler;

final class LinkTagScanner implements ScannerInterface
{

    public function scan(Crawler $htmlNode): array
    {
        $items = $htmlNode->filter('a')
            ->each(fn(Crawler $node, int $id) => $node->attr('href'));
        return Collection::of($items)
            ->filter(fn(int $k, string $v) => !in_array($v, ['#', '/']))
            ->get();
    }
}