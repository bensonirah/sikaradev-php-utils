<?php

namespace SikaradevPhpUtils\Parseur\Handlers;

final class CleanTextHandler
{

    private const CLEAN_TEXT_RULE_SETS = [
        '/Politique.*/' => '',
        '/^Vos info.*nom/' => 'prénom et nom',
        '/Nature de.*véhicule/' => '',
        '/Votre N° de/' => '',
        '/Votre/' => '',
        '/\s+/' => ' '
    ];

    public function __invoke(string $text): string
    {
        return trim(preg_replace(array_keys(self::CLEAN_TEXT_RULE_SETS), array_values(self::CLEAN_TEXT_RULE_SETS), $text));
    }
}