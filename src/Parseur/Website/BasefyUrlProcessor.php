<?php

namespace SikaradevPhpUtils\Parseur\Website;

use SikaradevPhpUtils\Collections\Collection;
use SikaradevPhpUtils\Url\Url;

final class BasefyUrlProcessor extends UrlProcessorDecorator
{
	public function scan(string $url): array
	{
		$items = $this->processor->scan($url);
		return Collection::of($items)
			->filter(fn(int $k, string $v) => !str_starts_with($v, '#') && !str_starts_with($v, 'java'))
			->map(fn(string $item) => !preg_match('/^\//', $item) ? $item : Url::fromLink($url)->baseUrl() . $item)
			->get();
	}
}