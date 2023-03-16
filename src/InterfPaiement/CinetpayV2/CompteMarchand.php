<?php

namespace Pv\InterfPaiement\CinetpayV2 ;

#[\AllowDynamicProperties]
class CompteMarchand extends \Pv\InterfPaiement\CompteMarchand
{
	public $ApiKey ;
	public $SiteId ;
	public $Version = "V2" ;
	public $Langage = "fr" ;
}
