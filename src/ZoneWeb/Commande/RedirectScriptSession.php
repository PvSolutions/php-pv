<?php

namespace Pv\ZoneWeb\Commande ;

#[\AllowDynamicProperties]
class RedirectScriptSession extends \Pv\ZoneWeb\Commande\Commande
{
	public $UrlDefaut = '' ;
	protected function ExecuteInstructions()
	{
		return $this->ZoneParent->RenduRedirectScriptSession($this->UrlDefaut) ;
	}
}