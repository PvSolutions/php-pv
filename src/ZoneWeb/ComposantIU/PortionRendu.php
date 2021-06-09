<?php

namespace Pv\ZoneWeb\ComposantIU ;

class PortionRendu extends \Pv\ZoneWeb\ComposantIU\ComposantIU
{
	public $Contenu = '' ;
	protected function RenduDispositifBrut()
	{
		return $this->Contenu ;
	}
}