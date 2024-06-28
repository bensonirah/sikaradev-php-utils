<?php

namespace SikaradevPhpUtils\Parseur\Indexer;

interface MetaDataViewInterface
{
	public function render(): array;

	public function content(): string;
}