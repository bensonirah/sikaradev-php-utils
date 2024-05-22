<?php

namespace SikaradevPhpUtils\Parseur\Website;

use Symfony\Component\DomCrawler\Crawler;

final class ImageScanner implements ScannerInterface
{

    public function scan(Crawler $htmlNode): array
    {
        $r = $htmlNode->filter('[data-background]')
            ->each(fn(Crawler $n) => $n->attr('data-background'));
        $items = $htmlNode->filter('img')
            ->each(fn(Crawler $node, int $id) => $node->attr('src'));
        return array_merge($items, $r);
    }
}