<?php namespace estvoyage\roman\number\converter;

use estvoyage\roman;

interface datum
{
	function recipientOfDatumBuildFromValueByTemplateIs(string $value, roman\datum $datum, roman\datum\recipient $recipient) :void;
}
