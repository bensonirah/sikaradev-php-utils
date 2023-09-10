<?php

namespace SikaradevPhpUtils\Parseur\Website;

abstract class UrlProcessorDecorator implements UrlProcessorInterface
{
    protected UrlProcessorInterface $processor;
    protected string $scannerKey;

    /**
     * @param UrlProcessorInterface $processor
     */
    public function __construct(UrlProcessorInterface $processor)
    {
        $this->processor = $processor;
        $this->scannerKey = $processor->scannerKey();
    }

    final public function scannerKey(): string
    {
        return $this->scannerKey;
    }
}