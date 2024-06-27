<?php

namespace SikaradevPhpUtils\Parseur\Indexer;

final class ProductResponse
{
    public array $metaData;

    public function __construct(
        public int $productId,
        public string $productName,
        public string $permalink,
        public string $productImage,
        public string $productPrice
    ) {
        $this->metaData = [];
    }

    public function withMetaData(array $metaData): self
    {
        $this->metaData = $metaData;
        return $this;
    }
}