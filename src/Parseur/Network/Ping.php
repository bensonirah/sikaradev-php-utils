<?php

namespace SikaradevPhpUtils\Parseur\Network;

use GuzzleHttp\Client;

final class Ping
{
	private Client $client;

	public function __construct()
	{
		$this->client = new Client();
	}

	/**
	 * @throws \GuzzleHttp\Exception\GuzzleException
	 */
	public function health(string $url): bool
	{
		return $this->client->get($url)->getStatusCode() === 200;
	}
}
