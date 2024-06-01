<?php

namespace SikaradevPhpUtils\Console;

use SikaradevPhpUtils\Collections\Collection;

final class ZshConsoleHistory extends AbstractConsoleHistory
{

    protected function path(): string
    {
        return join('/', [getenv('HOME'), '.zsh_history']);
    }

    public function contents(): array
    {
        $console_history = file_get_contents($this->path());
        $console_history = preg_replace('/^:\s+/m', ':1;', $console_history);
        return Collection::of(explode(":1;", $console_history))
            ->filter(fn(int $key, string $entry) => $entry != '')
            ->map(function (string $entry) {
                [$eventTime, $command] = explode(':0;', $entry);
                $dateTime = new \DateTime();
                $dateTime->setTimestamp((int)$eventTime);
                return [
                    'command' => preg_replace('/\n/', '', $command),
                    'executionTime' => (int)$eventTime,
                    'dateTime' => $dateTime->format('Y-m-d H:i:s')
                ];
            })
            ->get();
    }
}