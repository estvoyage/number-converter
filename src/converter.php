<?php namespace estvoyage\roman;

interface converter
{
	function recipientOfNumberAsDatumIs(number $number, datum\recipient $recipient) :void;
}
