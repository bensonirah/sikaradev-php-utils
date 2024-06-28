<?php

namespace SikaradevPhpUtils\Parseur\Indexer;

final class ProductResponse
{
	public ?MetaDataViewInterface $metaData;

	public function __construct(
		public int    $productId,
		public string $productName,
		public string $permalink,
		public string $productImage,
		public string $productPrice
	) {
		$this->metaData = null;
	}

	public function withMetaData(MetaDataViewInterface $metaData): self
	{
		$this->metaData = $metaData;
		return $this;
	}
}