<?php

namespace SikaradevPhpUtils\Parseur\Website;

use Symfony\Component\DomCrawler\Crawler;

class DataScanner implements ScannerInterface
{
    public function scan(Crawler $htmlNode): array
    {
        $r = $htmlNode->filter("#secondary section");
        dump($r->html());
        return [];
    }
}
