<?php

namespace SikaradevPhpUtils\Parseur\Indexer;

final  class  KiboMetaDataView implements MetaDataViewInterface
{
	public function __construct(
		private readonly string $description,
		private readonly string $keywords,
		private readonly string $title,
		private readonly string $url,
		private readonly string $image
	) {}

	public static function fromArray(array $metaTag): MetaDataViewInterface
	{
		return new self(
			$metaTag['description'],
			$metaTag['keywords'],
			$metaTag['og:title'],
			$metaTag['og:url'],
			$metaTag['og:image'],
		);
	}


	public function render(): array
	{
		return get_object_vars($this);
	}

	public function content(): string
	{
		return 'put your content here';
	}
}