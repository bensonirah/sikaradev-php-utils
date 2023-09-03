<?php

namespace SikaradevPhpUtils\Document;

class TextDocument implements DocumentVisitable
{
    private string $text;

    /**
     * @param string $text
     */
    public function __construct(string $text)
    {
        $this->text = $text;
    }

    public function text(): string
    {
        return $this->text;
    }

    public function accept(DocumentVisitor $visitor): string
    {
        return $visitor->visitText($this);
    }
}