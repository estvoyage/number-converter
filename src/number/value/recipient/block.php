<?php namespace estvoyage\roman\number\value\recipient;

use estvoyage\roman\number;

class block
	implements
		number\value\recipient
{
	private
		$callable
	;

	function __construct(callable $callable)
	{
		$this->callable = $callable;
	}

	function numberValueIs(int $value) :void
	{
		call_user_func_array($this->callable, [ $value ]);
	}
}
