<?php namespace estvoyage\roman\tests\units\number\converter\datum;

require __DIR__ . '/../../../../runner.php';

use estvoyage\roman\tests\units;
use mock\estvoyage\roman\datum as mockOfDatum;

class roman extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\roman\number\value\recipient')
		;
	}

	function testNumberValueIs_withZero()
	{
		$this
			->given(
				$this->newTestedInstance($template = new mockOfDatum, $recipient = new mockOfDatum\recipient)
			)
			->if(
				$this->testedInstance->numberValueIs(0)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($template, $recipient))
				->mock($recipient)
					->receive('datumIs')
						->never
		;
	}

	/**
	 * @dataProvider validNumberValueProvider
	 */
	function testNumberValueIs($numberValue, $romanValue)
	{
		$this
			->given(
				$this->newTestedInstance($template = new mockOfDatum, $recipient = new mockOfDatum\recipient),

				$roman = new mockOfDatum,
				$this->calling($template)->recipientOfDatumWithValueIs = function($value, $recipient) use ($romanValue, $roman) {
					if ($value == $romanValue)
					{
						$recipient->datumIs($roman);
					}
				}
			)
			->if(
				$this->testedInstance->numberValueIs($numberValue)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($template, $recipient))
				->mock($recipient)
					->receive('datumIs')
						->withArguments($roman)
							->once
		;
	}

	protected function validNumberValueProvider()
	{
		return [
			'1' => [ 1, 'I' ],
			'5' => [ 5, 'V' ],
			'10' => [ 10, 'X' ],
			'50' => [ 50, 'L' ],
			'100' => [ 100, 'C' ],
			'500' => [ 500, 'D' ],
			'1000' => [ 1000, 'M' ],
			'2' => [ 2, 'II' ],
			'4' => [ 4, 'IV' ],
			'9' => [ 9, 'IX' ],
			'40' => [ 40, 'XL' ],
			'90' => [ 90, 'XC' ],
			'400' => [ 400, 'CD' ],
			'900' => [ 900, 'CM' ],
			'4888' => [ 4888, 'MMMMDCCCLXXXVIII' ]
		];
	}
}
