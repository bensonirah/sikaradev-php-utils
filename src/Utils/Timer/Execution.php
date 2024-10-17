<?php

namespace SikaradevPhpUtils\Utils\Timer;

class Execution
{
// Execution::time(fn() => range(10, 9999))->then(fn(float $time) => dump($time))
//
	private function __construct(private mixed $result, private float $time) {}

	public static function time(callable $fn): Execution
	{
		$start  = microtime(true);
		$result = $fn();
		$end    = microtime(true);
		$time   = $end - $start;
		return new self($result, $time);
	}
	public static function memory(callable $fn): Execution
	{
		$start  = memory_get_usage();
		$result = $fn();
		$end    = memory_get_usage();
		$memory = $end - $start;
		return new self($result, number_format($memory / 1024, 2));
	}
	/**
	 * @param callable<mixed,float> $fn
	 *
	 * @return void
	 */
	public function then(callable $fn): void
	{
		$fn($this->result, $this->time);
	}
}
