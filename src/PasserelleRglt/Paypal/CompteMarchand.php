<?php

namespace Pv\PasserelleRglt\Paypal ;

class CompteMarchand extends \Pv\PasserelleRglt\CompteMarchand
{
	public $ClientId ;
	public $Secret ;
	public $Monnaie = "XOF" ;
	public $TauxChange = 665 ;
}
