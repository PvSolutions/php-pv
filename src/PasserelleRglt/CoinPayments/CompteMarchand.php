<?php

namespace Pv\PasserelleRglt\CoinPayments ;

class CompteMarchand extends \Pv\PasserelleRglt\CompteMarchand
{
	public $Merchant ;
	public $IPNSecret ;
	public $Monnaie = "EUR" ;
	public $TauxChange = 665 ;
}