<?php

namespace Pv\ZoneConsole\Script ;

#[\AllowDynamicProperties]
class Script extends \Pv\IHM\Zone\Script
{
	public function RenduDispositif()
	{
		return $this->RenduDispositifBrut() ;
	}
	protected function RenduDispositifBrut()
	{
		$ctn = '' ;
		return $ctn ;
	}
}