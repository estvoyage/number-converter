<?php namespace estvoyage\roman\tests\units\converter;

require __DIR__ . '/../../runner.php';

use estvoyage\roman\tests\units;
use mock\estvoyage\roman\{ number as mockOfNumber, datum as mockOfDatum };

class any extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\roman\converter')
		;
	}

	function testRecipientOfNumberAsDatumIs()
	{
		$this
			->given(
				$number = new mockOfNumber,
				$recipient = new mockOfDatum\recipient,
				$this->newTestedInstance($template = new mockOfDatum, $converter = new mockOfNumber\converter\datum)
			)
			->if(
				$this->testedInstance->recipientOfNumberAsDatumIs($number, $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($template, $converter))
				->mock($recipient)
					->receive('datumIs')
						->never

			->given(
				$this->calling($number)->recipientOfNumberValueIs = function($recipient) { $recipient->numberValueIs(rand(PHP_INT_MIN, PHP_INT_MAX)); },

				$convertedDatum = new mockOfDatum,
				$this->calling($converter)->recipientOfDatumBuildFromValueByTemplateIs = function($value, $template, $recipient) use ($convertedDatum) {
					$recipient->datumIs($convertedDatum);
				}
			)
			->if(
				$this->testedInstance->recipientOfNumberAsDatumIs($number, $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($template, $converter))
				->mock($recipient)
					->receive('datumIs')
						->withArguments($convertedDatum)
							->once
		;
	}
}
