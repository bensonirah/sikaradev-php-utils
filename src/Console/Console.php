<?php

namespace SikaradevPhpUtils\Console;

use SikaradevPhpUtils\Collections\Collection;

final class Console
{

    public static function last(): Collection
    {
        $command = shell_exec('last $(whoami) -w --time-format iso -R | grep tty2');

        $content = str_replace('/\n/', '|', $command);
        $items = explode('|', $content);
        return Collection::of($items)
            ->filter(fn(int $index, string $value) => $value != '')
            ->map(fn(string $item) => preg_replace('/\s{2,}/', ' ', $item))
            ->map(function ($item) {
                return match (1) {
                    preg_match(
                        "/(?<username>\w+)\s\w+\s+(?<loginTime>\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}\+\d{2}:\d{2}) - (?<logoutEvent>\w+)\s+\((?<sessionDuration>\d{2}:\d{2})\)/",
                        $item,
                        $match
                    ) => Collection::of($match)->select('username', 'loginTime', 'logoutEvent', 'sessionDuration')
                        ->get(),
                    preg_match(
                        "/(?<username>\w+)\s\w+\s+(?<loginTime>\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}\+\d{2}:\d{2}) - (?<logoutEvent>\w+)\s+\((?<sessionDuration>\d+\+\d{2}:\d{2})\)/",
                        $item,
                        $match
                    )
                    => Collection::of($match)->select('username', 'loginTime', 'logoutEvent', 'sessionDuration')
                        ->get(),
                    preg_match(
                        "/(?<username>\w+)\s\w+\s+(?<loginTime>\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}\+\d{2}:\d{2}) - (?<logoutTime>\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}\+\d{2}:\d{2}) \((?<sessionDuration>\d{2}:\d{2})\)/",
                        $item,
                        $match
                    ) => Collection::of($match)->select('username', 'loginTime', 'sessionDuration')->get(),
                    preg_match(
                        "/(?<username>\w+)\s\w+\s+(?<loginTime>\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}\+\d{2}:\d{2}) (?<logoutEvent>[a-z\s]+)/",
                        $item,
                        $match
                    ) => Collection::of($match)->select('username', 'loginTime', 'logoutEvent')->get(),
                    preg_match(
                        "/(?<username>\w+)\s\w+\s+(?<loginTime>\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}\+\d{2}:\d{2}) - (?<logoutTime>\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}\+\d{2}:\d{2}) \((?<sessionDuration>\d+\+\d{2}:\d{2})\)/",
                        $item,
                        $match
                    ) => Collection::of($match)->select('username', 'loginTime', 'logoutTime', 'sessionDuration')->get(
                    ),
                    default => $item
                };
            });
    }
}