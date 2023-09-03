<?php

namespace SikaradevPhpUtils\Document;

interface DocumentVisitor
{
    public function visitHtml(HtmlDocument $htmlDocument): string;

    public function visitText(TextDocument $textDocument): string;
}