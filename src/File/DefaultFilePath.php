<?php

namespace SikaradevPhpUtils\File;

final readonly class DefaultFilePath implements FilePath
{

    public function __construct(
        private string $fileDirectory,
        private string $fileNamePrefix
    ) {
    }

    public function __toString(): string
    {
        $now = new \DateTime('now');
        return implode(
            DIRECTORY_SEPARATOR,
            [$this->fileDirectory, $this->fileNamePrefix . $now->format('dmY_His') . '.csv']
        );
    }
}