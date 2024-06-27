<?php

namespace SikaradevPhpUtils\Parseur\Indexer;

use GuzzleHttp\Client;
use SikaradevPhpUtils\Collections\Collection;
use Symfony\Component\DomCrawler\Crawler;

final class KiboIndexer implements IndexerInterface
{
	/**
	 * @var \GuzzleHttp\Client
	 */
	private Client $httpClient;

	public function __construct()
	{

		$this->httpClient = new Client();
	}

	/**
	 * @throws \GuzzleHttp\Exception\GuzzleException
	 */
	public function visualize(string $url): void
	{
		$htmlContent = $this->httpClient->get($url)
			->getBody()
			->getContents();
		$crawler     = new Crawler($htmlContent);
		// TODO: Implement visualize() method.
		$items = $crawler->filter('.products.row > article')
			->each(function (Crawler $node, $i)
			{
				return [
					'id'   => $node->attr('data-id-product'),
					'img_src'  => $node->filter('img')->attr('src'),
					'name' => $node->filter('.product-title a')->text(),
					'product' => $node->filter('.price')->text()
				];
			});
		dump($items);
	}
}