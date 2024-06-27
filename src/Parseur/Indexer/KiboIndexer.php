<?php

namespace SikaradevPhpUtils\Parseur\Indexer;

use SikaradevPhpUtils\Parseur\Website\UrlProcessor;
use Symfony\Component\DomCrawler\Crawler;

final class KiboIndexer implements IndexerInterface
{

    /**
     * @param Crawler $crawler
     * @return array
     */
    public function visualize(Crawler $crawler): array
    {
        return $crawler->filter('.products.row > article')
            ->each(function (Crawler $node, $i) {
                $permalink = $node->filter('.product-image-container>a:nth-child(1)')->attr('href');
                return (new ProductResponse(
                    $node->attr('data-id-product'),
                    $node->filter('.product-title a')->text(),
                    $permalink,
                    $node->filter('img')->attr('src'),
                    $node->filter('.price')->text()
                ))->withMetaData(UrlProcessor::metaTag($permalink));
            }
            );
    }
}