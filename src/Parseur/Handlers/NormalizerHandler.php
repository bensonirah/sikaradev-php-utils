<?php

namespace SikaradevPhpUtils\Parseur\Handlers;

final class NormalizerHandler
{


    private const NORMALIZER_RUL_SET = [
        '{prénom et nom : ([A-Za-z0-9À-ÖØ-öø-ÿ’]+)\s([A-Za-z0-9À-ÖØ-öø-ÿ’\s]+)}' => 'prénom : $1 |nom : $2'
    ];

    public function __invoke(string $text): string
    {
        return preg_replace(
            array_keys(self::NORMALIZER_RUL_SET), array_values(self::NORMALIZER_RUL_SET), $text
        );
    }
}