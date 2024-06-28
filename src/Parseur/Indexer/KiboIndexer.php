<?php

namespace SikaradevPhpUtils\Parseur\Indexer;

use Symfony\Component\DomCrawler\Crawler;

final class KiboIndexer implements IndexerInterface
{

	/**
	 * @param Crawler $crawler
	 *
	 * @return array
	 */
	public function visualize(Crawler $crawler): array
	{
		return $crawler->filter('.products.row > article')
			->each(fn(Crawler $node, $i) => new ProductResponse(
				$node->attr('data-id-product'),
				$node->filter('.product-title a')->text(),
				$node->filter('.product-image-container>a:nth-child(1)')->attr('href'),
				$node->filter('img')->attr('src'),
				$node->filter('.price')->text()
			)
			);
	}
}