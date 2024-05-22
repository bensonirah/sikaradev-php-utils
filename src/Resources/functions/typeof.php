<?php

if (!function_exists('typeof')) {
    function typeof(mixed $var): string
    {
        return gettype($var);
    }
}