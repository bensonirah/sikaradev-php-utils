<?php

namespace SikaradevPhpUtils\File;

use SikaradevPhpUtils\Parseur\Indexer\ProductResponse;

final class DefaultDataPayload implements DataPayload
{
    public function __construct(private array $dataItems)
    {
    }

    public function header(): array
    {
        /**@var ProductResponse $firstItem */
        $firstItem = $this->dataItems[0];
        return array_keys($this->normalizeResponse($firstItem));
    }

    public function items(\Closure $func): void
    {
        /**@var ProductResponse $item */
        foreach ($this->dataItems as $item) {
            $func(array_values($this->normalizeResponse($item)));
        }
    }

    private function normalizeResponse(ProductResponse $firstItem): array
    {
        return [
            'productId' => $firstItem->productId,
            'productName' => $firstItem->productName,
            'productPrice' => $firstItem->productPrice,
            'productImage' => $firstItem->productImage,
            'permaLink' => $firstItem->permalink
        ];
    }
}