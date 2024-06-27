<?php

namespace SikaradevPhpUtils\Parseur\Indexer;

use Symfony\Component\DomCrawler\Crawler;

interface IndexerInterface
{
    /**
     * @param Crawler $crawler
     * @return array<ProductResponse>
     */
    public function visualize(Crawler $crawler): array;
}