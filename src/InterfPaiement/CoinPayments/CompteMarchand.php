<?php

namespace Pv\InterfPaiement\CoinPayments ;

#[\AllowDynamicProperties]
class CompteMarchand extends \Pv\InterfPaiement\CompteMarchand
{
	public $Merchant ;
	public $IPNSecret ;
	public $Monnaie = "EUR" ;
	public $TauxChange = 665 ;
}