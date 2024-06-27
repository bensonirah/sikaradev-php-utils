<?php

namespace SikaradevPhpUtils\Parseur\Website;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use SikaradevPhpUtils\Parseur\Website\Exception\ScannerNotFoundException;
use Symfony\Component\DomCrawler\Crawler;

/**
 * @method static metaTag(string $url)
 * @method static image(string $url)
 * @method static linkTag(string $url)
 */
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

    /**
     * @throws ScannerNotFoundException
     * @throws GuzzleException
     */
    public static function __callStatic(string $name, array $arguments)
    {
        $indexerInstanceClass = match ($name) {
            'metaTag' => MetaTagScanner::class,
            'image' => ImageScanner::class,
            'linkTag' => LinkTagScanner::class,
            default => throw new ScannerNotFoundException()
        };

        $instance = new self(new $indexerInstanceClass());
        return $instance->scan(...$arguments);
    }
}
