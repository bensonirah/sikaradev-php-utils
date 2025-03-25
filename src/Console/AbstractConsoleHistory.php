<?php

namespace SikaradevPhpUtils\Console;

abstract class AbstractConsoleHistory
{
    public function __construct()
    {
        if (!file_exists($this->path())) {
            throw new \InvalidArgumentException(sprintf("No such file %s exist", $this->path()));
        }
    }

    abstract  protected  function path(): string;

    abstract  public function contents(): array;

    public function __toString(): string
    {
        return file_get_contents($this->path());
    }
}