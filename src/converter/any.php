<?php namespace estvoyage\roman\converter;

use estvoyage\roman\{ converter, number, datum };

class any
	implements
		converter
{
	private
		$template,
		$converter
	;

	function __construct(datum $template, number\converter\datum $converter)
	{
		$this->template = $template;
		$this->converter = $converter;
	}

	function recipientOfNumberAsDatumIs(number $number, datum\recipient $recipient) :void
	{
		$number
			->recipientOfNumberValueIs(
				new number\value\recipient\block(
					function($value) use ($recipient)
					{
						$this->converter->recipientOfDatumBuildFromValueByTemplateIs($value, $this->template, $recipient);
					}
				)

//				new class($this->converter, $this->template, $recipient)
//					implements
//						number\value\recipient
//				{
//					private
//						$converter,
//						$template,
//						$recipient
//					;
//
//					function __construct($converter, $template, $recipient)
//					{
//						$this->converter = $converter;
//						$this->template = $template;
//						$this->recipient = $recipient;
//					}
//
//					function numberValueIs(int $value) :void
//					{
//						$this->converter->recipientOfDatumBuildFromValueByTemplateIs($value, $this->template, $this->recipient);
//					}
//				}
			)
		;
	}
}
