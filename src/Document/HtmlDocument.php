<?php
declare(strict_types=1);

namespace SikaradevPhpUtils\Document;

class HtmlDocument implements DocumentVisitable
{
    private string $path;

    /**
     * @param string $path
     */
    public function __construct(string $path)
    {
        if (!file_exists($path)) {
            throw new \InvalidArgumentException(sprintf("Unable to locate file %s", $path));
        }
        if (pathinfo($path, PATHINFO_EXTENSION) != 'html') {
            throw new \InvalidArgumentException(sprintf("The file %s you provided is in invalid format, html format required", $path));
        }
        $this->path = $path;
    }

    public function path(): string
    {
        return $this->path;
    }

    public function html(): string
    {
        return file_get_contents($this->path);
    }

    public function accept(DocumentVisitor $visitor): string
    {
        return $visitor->visitHtml($this);
    }

    public function __toString(): string
    {
        return $this->html();
    }

}