<?php

namespace Pv\InterfPaiement\Skrill ;

#[\AllowDynamicProperties]
class CompteMarchand extends \Pv\InterfPaiement\CompteMarchand
{
	public $EmailBenef ;
	public $Monnaie = "EUR" ;
	public $TauxChange = 665 ;
}