<?php

namespace Pv\ZoneWeb ;

#[\AllowDynamicProperties]
class LienFichierJs extends \Pv\ZoneWeb\ComposantRendu\ComposantRendu
{
	public $TypeComposant = "FichierJs" ;
	public $Src = "" ;
	public $Type = "text/javascript" ;
	public $Async = 0 ;
	protected function RenduDispositifBrut()
	{
		$ctn = '<script type="'.$this->Type.'" src="'.$this->Src.'"'.(($this->Async == 1) ? ' async' : '').'></script>' ;
		return $ctn ;
	}
}