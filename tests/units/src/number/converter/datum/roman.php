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

	function testNumberValueIs()
	{
		$this
			->given(
				$template = new mockOfDatum,
				$recipient = new mockOfDatum\recipient
			)
			->if(
				$this->newTestedInstance($template, $recipient)->numberValueIs(0)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($template, $recipient))
				->mock($recipient)
					->receive('datumIs')
						->never

			->given(
				$i = new mockOfDatum,
				$this->calling($template)->recipientOfDatumWithValueIs = function($value, $recipient) use ($i) {
					if ($value == 'I')
					{
						$recipient->datumIs($i);
					}
				}
			)
			->if(
				$this->newTestedInstance($template, $recipient)->numberValueIs(1)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($template, $recipient))
				->mock($recipient)
					->receive('datumIs')
						->withArguments($i)
							->once

			->given(
				$v = new mockOfDatum,
				$this->calling($template)->recipientOfDatumWithValueIs = function($value, $recipient) use ($v) {
					if ($value == 'V')
					{
						$recipient->datumIs($v);
					}
				}
			)
			->if(
				$this->newTestedInstance($template, $recipient)->numberValueIs(5)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($template, $recipient))
				->mock($recipient)
					->receive('datumIs')
						->withArguments($v)
							->once

			->given(
				$x = new mockOfDatum,
				$this->calling($template)->recipientOfDatumWithValueIs = function($value, $recipient) use ($x) {
					if ($value == 'X')
					{
						$recipient->datumIs($x);
					}
				}
			)
			->if(
				$this->newTestedInstance($template, $recipient)->numberValueIs(10)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($template, $recipient))
				->mock($recipient)
					->receive('datumIs')
						->withArguments($x)
							->once
		;
	}
}
