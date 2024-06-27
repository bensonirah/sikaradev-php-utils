<?php

namespace SikaradevPhpUtils\Parseur\Indexer;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Symfony\Component\DomCrawler\Crawler;

final class ProductHunter
{
    private Client $httpClient;

    public function __construct()
    {
        $this->httpClient = new Client();
    }

    /**
     * @param string $url
     * @param IndexerInterface $indexer
     * @return array<ProductResponse>
     * @throws GuzzleException
     */
    public function hunt(string $url, IndexerInterface $indexer): array
    {
        $htmlContent = $this->httpClient->get($url)
            ->getBody()
            ->getContents();
        return $indexer->visualize(new Crawler($htmlContent));
    }
}