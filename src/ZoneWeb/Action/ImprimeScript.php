<?php

namespace Pv\ZoneWeb\Action ;

#[\AllowDynamicProperties]
class ImprimeScript extends \Pv\ZoneWeb\Action\Action
{
	public function Execute()
	{
		$this->ZoneParent->DemarreRenduImpression() ;
		echo $this->ZoneParent->RenduDocument() ;
		exit ;
	}
}