<?php

namespace SikaradevPhpUtils\Parseur\Handlers;

final class FieldifyTextHandler
{

    private const FIELDIFY_RULE_SETS = [
        '{(prénom et nom)}' => '|$1',
        '{(Téléphone)}' => '|$1 :',
        '{(e-mail)}' => '|$1 :',
        '{(Marque)}' => '|$1 :',
        '{(Modèle)}' => '|$1',
        '{(Immatriculation)}' => '|$1'
    ];

    public function __invoke(string $text): string
    {
        return preg_replace(array_keys(self::FIELDIFY_RULE_SETS), array_values(self::FIELDIFY_RULE_SETS), $text);
    }
}