<?php

namespace SikaradevPhpUtils\Document;

use Symfony\Component\DomCrawler\Crawler;

/**
 *  This class is responsible for scanning html or a text and produce a text
 */
class TextVisitor implements DocumentVisitor
{

    public function visitHtml(HtmlDocument $htmlDocument): string
    {
        return (new Crawler($htmlDocument->html()))
            ->filter('body')
            ->text();
    }

    public function visitText(TextDocument $textDocument): string
    {
        return preg_replace('/\s+/u', ' ', $textDocument->text());
    }
}