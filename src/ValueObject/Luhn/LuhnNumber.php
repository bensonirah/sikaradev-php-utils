<?php

namespace SikaradevPhpUtils\ValueObject\Luhn;

final class LuhnNumber
{
	private string $number;

	/**
	 * @throws \SikaradevPhpUtils\ValueObject\Luhn\InvalidLuhnNumberException
	 */
	public function __construct(string $serialNumber)
	{
		$digits = $this->normalize($serialNumber);
		$this->validate($digits);
		$this->number = $serialNumber;
	}

	/**
	 *  Normalize the input number to follow the serie of Luhn number
	 *
	 * @param string $serialNumber
	 *
	 * @return array
	 */
	private function normalize(string $serialNumber): array
	{
		$digits = str_split($serialNumber);
		$index  = 0;
		for ($i = count($digits) - 1; $i > 0; $i--) {
			if ($index % 2 != 0) {
				$times2     = intval($digits[$i]) * 2;
				$digits[$i] = $times2 > 9 ? $times2 - 9 : $times2;
			}
			$index++;
		}
		return $digits;
	}

	/**
	 *  Validate if the serie of digit follow the luhn specification
	 * @throws \SikaradevPhpUtils\ValueObject\Luhn\InvalidLuhnNumberException
	 */
	private function validate(array $digits): void
	{
		$digits = array_map(fn(string $digit) => intval($digit), $digits);
		$result = array_reduce($digits, fn(int $k, int $v) => $k + $v, 0);
		if ($result % 10 != 0) {
			throw new InvalidLuhnNumberException(sprintf('The number %s is not valid luhn number', $result));
		}
	}

	public function __toString(): string
	{
		return $this->number;
	}
}
