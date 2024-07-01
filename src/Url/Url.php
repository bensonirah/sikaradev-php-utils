<?php

namespace SikaradevPhpUtils\Url;

final class Url
{
	private string $scheme;
	private string $host;
	private string $path;

	private function __construct(private readonly string $url)
	{
		if (count(array_values(parse_url($url))) > 2) {
			[$this->scheme, $this->host, $this->path] = array_values(parse_url($url));
		}
		else {
			[$this->scheme, $this->host] = array_values(parse_url($url));
			$this->path = '';
		}
	}

	public static function fromLink(string $url): self
	{
		return new self($url);
	}

	public function scheme(): string
	{
		return $this->scheme;
	}

	public function host(): string
	{
		return $this->host;
	}

	public function path(): string
	{
		return $this->path;
	}

	public function baseUrl(): string
	{
		return $this->scheme() . '://' . $this->host();
	}

	public function __toString(): string
	{
		return $this->url;
	}
}