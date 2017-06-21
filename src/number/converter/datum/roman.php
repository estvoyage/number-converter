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
		if ($value > 0)
		{
			$datumValue = '';

			// Currently, this class has two responsibilities:
			// 1. break-up the decimal number ;
			// 2. find the romanian representation according to break-up.
			// So, this class does not respect the SRP, because:
			// 1. If a new romanian representation is added (for example `DD` for 666), the class must be updated accordingly ;
			// 2. If the algorithm to break-up the decimal number is updated (for example, `0` has now a romanian representation), the class must be updated accordingly.
			// Conclusion: the romanian representation must be provided by a depedency!
			$mapping = [
				1000 => 'M',
				900 => 'CM',
				500 => 'D',
				400 => 'CD',
				100 => 'C',
				90 => 'XC',
				50 => 'L',
				40 => 'XL',
				10 => 'X',
				9 => 'IX',
				5 => 'V',
				4 => 'IV',
				1 => 'I',
			];

			$roman = reset($mapping);
			$limit = key($mapping);

			while ($value > 0)
			{
				if ($value < $limit)
				{
					$roman = next($mapping);
					$limit = key($mapping);
				}
				else
				{
					$datumValue .= $roman;
					$value -= $limit;
				}
			}

			$this->template
				->recipientOfDatumWithValueIs(
					$datumValue,
					$this->recipient
				)
			;
		}
	}
}
