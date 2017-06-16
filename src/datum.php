<?php namespace estvoyage\roman;

interface datum
{
	function recipientOfDatumWithValueIs(string $value, datum\recipient $recipient) :void;
}
