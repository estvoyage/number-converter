<?php namespace estvoyage\roman\datum;

use estvoyage\roman\datum;

interface recipient
{
	function datumIs(datum $datum) :void;
}
