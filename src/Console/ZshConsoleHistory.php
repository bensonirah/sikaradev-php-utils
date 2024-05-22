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
        return Collection::of(explode("\n", $console_history))
            ->filter(fn(int $key, string $entry) => $entry != '')
            ->map(function (string $entry) {
                [$eventTime, $command] = explode(';', $entry);
                $eventTime = preg_replace('/^:\s+/', '', $eventTime);
                [$runAt, $executionTime] = explode(':', $eventTime);
                $dateTime = new \DateTime();
                $dateTime->setTimestamp((int)$runAt);
                return [
                    'command' => $command,
                    'executionTime' => (int)$executionTime,
                    'dateTime' => $dateTime->format('Y-m-d H:i:s')
                ];
            })
            ->get();
    }
}