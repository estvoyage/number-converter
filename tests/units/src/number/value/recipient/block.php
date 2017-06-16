<?php namespace estvoyage\roman\tests\units\number\value\recipient;

require __DIR__ . '/../../../../runner.php';

use estvoyage\roman\tests\units;

class block extends units\test
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
				$value = rand(PHP_INT_MIN, PHP_INT_MAX),
				$callable = function($value) use (& $arguments) { $arguments = func_get_args(); }
			)
			->if(
				$this->newTestedInstance($callable)->numberValueIs($value)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($callable))
				->array($arguments)
					->isEqualTo([ $value ])
		;
	}
}
