<?php namespace estvoyage\roman\number\converter\datum;

use estvoyage\roman\{ number, datum };

class roman
	implements
		number\value\recipient
{
	private
		$template,
		$recipient
	;

	function __construct(datum $template, datum\recipient $recipient)
	{
		$this->template = $template;
		$this->recipient = $recipient;
	}

	function numberValueIs(int $value) :void
	{
		$datumValue = null;

		switch ($value)
		{
			case 1:
				$datumValue = 'I';
				break;

			case 5:
				$datumValue = 'V';
				break;

			case 10:
				$datumValue = 'X';
				break;
		}

		if ($datumValue)
		{
			$this->template
				->recipientOfDatumWithValueIs(
					$datumValue,
					$this->recipient
				)
			;
		}
	}
}
