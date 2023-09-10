<?php

namespace SikaradevPhpUtils\Parseur\Website;

use Symfony\Component\DomCrawler\Crawler;

interface ScannerInterface
{
    public function scan(Crawler $htmlNode): array;
}