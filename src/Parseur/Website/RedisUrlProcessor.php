<?php

namespace SikaradevPhpUtils\Parseur\Website;

final class RedisUrlProcessor extends UrlProcessorDecorator
{
    private \Redis $redis;

    /**
     * @param UrlProcessorInterface $processor
     * @param \Redis $redis
     */
    public function __construct(UrlProcessorInterface $processor, \Redis $redis)
    {
        parent::__construct($processor);
        $this->redis = $redis;
    }

    /**
     * @throws \RedisException
     */
    public function scan(string $url): array
    {
        if (!$this->redis->exists($url)) {
            $result = $this->processor->scan($url);
            $this->redis->set(
                $this->keyOf($url),
                json_encode($result)
            );
            return $result;
        }
        return json_decode(
            $this->redis->get($this->keyOf($url)),
            true
        );
    }

    private function keyOf(string $url): string
    {
        return join('|', [$this->scannerKey(), $url]);
    }

}