<?php

namespace SikaradevPhpUtils\Document;

interface DocumentVisitable
{
    public function accept(DocumentVisitor $visitor): string;
}