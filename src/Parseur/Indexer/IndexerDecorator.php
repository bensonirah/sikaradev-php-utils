<?php

namespace SikaradevPhpUtils\Parseur\Indexer;

abstract class IndexerDecorator implements IndexerInterface
{
    public function __construct(protected IndexerInterface $indexer)
    {
    }
}