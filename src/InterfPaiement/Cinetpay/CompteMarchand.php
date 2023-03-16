<?php

namespace Pv\InterfPaiement\Cinetpay ;

#[\AllowDynamicProperties]
class CompteMarchand extends \Pv\InterfPaiement\CompteMarchand
{
	public $ApiKey ;
	public $SiteId ;
	public $Version = "V1" ;
	public $Langage = "fr" ;
}
