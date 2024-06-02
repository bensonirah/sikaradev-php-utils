<?php

namespace SikaradevPhpUtils\Console;

use SikaradevPhpUtils\Collections\Collection;

final class Console
{
    public function __construct()
    {
    }

    public static function last(): Collection
    {
        $firstPattern = "/(\w+)\s\w+\s+(\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}\+\d{2}:\d{2}) - (\w+)\s+\(\d{1,2}:\d{2}\)/";

        $command = shell_exec('last $(whoami) -w --time-format iso -R | grep tty2');

        $content = preg_replace('/\n/', '|', $command);
        $items = explode('|', $content);
        return Collection::of($items)
            ->filter(fn(int $index, string $value) => $value != '')
            ->map(fn(string $item) => preg_replace('/\s{2,}/', ' ', $item))
            ->map(function ($item) {
                if (preg_match(
                    "/(?<username>\w+)\s\w+\s+(?<loginTime>\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}\+\d{2}:\d{2}) - (?<logoutEvent>\w+)\s+\((?<sessionDuration>\d{2}:\d{2})\)/",
                    $item,
                    $match
                )) {
                    return [
                        "username" => $match['username'],
                        "loginTime" => $match['loginTime'],
                        "logoutEvent" => $match['logoutEvent'],
                        "sessionDuration" => $match['sessionDuration'],
                    ];
                }

                if (preg_match(
                    "/(?<username>\w+)\s\w+\s+(?<loginTime>\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}\+\d{2}:\d{2}) - (?<logoutEvent>\w+)\s+\((?<sessionDuration>\d+\+\d{2}:\d{2})\)/",
                    $item,
                    $match
                )) {
                    return [
                        "username" => $match['username'],
                        "loginTime" => $match['loginTime'],
                        "logoutEvent" => $match['logoutEvent'],
                        "sessionDuration" => $match['sessionDuration'],
                    ];
                }
                return $item;
            });
    }
}