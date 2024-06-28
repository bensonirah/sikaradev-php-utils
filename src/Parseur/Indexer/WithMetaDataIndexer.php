<?php

namespace SikaradevPhpUtils\Parseur\Indexer;

use SikaradevPhpUtils\Parseur\Website\UrlProcessor;
use Symfony\Component\DomCrawler\Crawler;

final class WithMetaDataIndexer extends IndexerDecorator
{

	public function visualize(Crawler $crawler): array
	{
		return array_map(
			fn(ProductResponse $productResponse) => $productResponse->withMetaData(
				KiboMetaDataView::fromArray(UrlProcessor::metaTag($productResponse->permalink))
			),
			$this->indexer->visualize($crawler)
		);
	}
}