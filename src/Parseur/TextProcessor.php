<?php

namespace SikaradevPhpUtils\Parseur;

use League\Pipeline\Pipeline;
use SikaradevPhpUtils\Parseur\Handlers\CleanTextHandler;
use SikaradevPhpUtils\Parseur\Handlers\FieldifyTextHandler;
use SikaradevPhpUtils\Parseur\Handlers\NormalizerHandler;
use SikaradevPhpUtils\Parseur\Handlers\PresenterHandler;

final class TextProcessor
{

    public function process(string $text): array
    {
        $processor = (new Pipeline)->pipe(new CleanTextHandler())
            ->pipe(new FieldifyTextHandler())
            ->pipe(new NormalizerHandler())
            ->pipe(new PresenterHandler());

        return $processor->process($text);
    }
}