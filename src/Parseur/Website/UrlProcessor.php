<?php

namespace SikaradevPhpUtils\Parseur\Website;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Symfony\Component\DomCrawler\Crawler;

final class UrlProcessor implements UrlProcessorInterface
{
    private Client $httpClient;
    private ScannerInterface $scanner;
    private string $scannerKey;

    /**
     * @param ScannerInterface $scanner
     */
    public function __construct(ScannerInterface $scanner)
    {
        $this->httpClient = new Client();
        $this->scanner = $scanner;
        $this->scannerKey = get_class($scanner);
    }

    /**
     * @throws GuzzleException
     */
    public function scan(string $url): array
    {
        $htmlContent = $this->httpClient->get($url)
            ->getBody()
            ->getContents();
        $crawler = new Crawler($htmlContent);
        return $this->scanner->scan($crawler);
    }

    public function scannerKey(): string
    {
        return $this->scannerKey;
    }
}
