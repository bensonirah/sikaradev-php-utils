<?php

namespace SikaradevPhpUtils\Parseur\Indexer;

use SikaradevPhpUtils\Collections\Collection;
use SikaradevPhpUtils\Parseur\Website\UrlProcessor;
use Symfony\Component\DomCrawler\Crawler;

final class WithMetaDataIndexer extends IndexerDecorator
{

    public function visualize(Crawler $crawler): array
    {
        return Collection::of($this->indexer->visualize($crawler))
            ->map(
                fn(ProductResponse $productResponse) => $productResponse->withMetaData(
                    KiboMetaDataView::fromArray(UrlProcessor::metaTag($productResponse->permalink))
                )
            )->get();
    }
}