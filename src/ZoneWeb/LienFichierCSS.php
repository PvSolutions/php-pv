<?php

namespace Pv\ZoneWeb ;

#[\AllowDynamicProperties]
class LienFichierCSS extends \Pv\ZoneWeb\ComposantRendu\ComposantRendu
{
	public $TypeComposant = "LienFichierCSS" ;
	public $Href = "" ;
	public $Media = "" ;
	protected function RenduDispositifBrut()
	{
		$ctn = '<link rel="stylesheet" type="text/css" href="'.$this->Href.'"'.(($this->Media != '') ? ' media="'.$this->Media.'"' : '').' />' ;
		return $ctn ;
	}
}