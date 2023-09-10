<?php

namespace SikaradevPhpUtils\Parseur\Website;

interface UrlProcessorInterface
{
    public function scan(string $url): array;

    public function scannerKey(): string;
}