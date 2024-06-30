<?php

namespace SikaradevPhpUtils\File;

interface DataPayload
{

    /**
     * @return array The file header
     */
    public function header(): array;

    /**
     * @param \Closure $func A function iterator through a row of a csv data
     */
    public function items(\Closure $func): void;
}