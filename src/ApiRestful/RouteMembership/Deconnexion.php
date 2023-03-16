<?php

namespace Pv\ApiRestful\RouteMembership ;

#[\AllowDynamicProperties]
class Deconnexion extends \Pv\ApiRestful\Route\Route
{
	protected function TermineExecution()
	{
		$ok = $this->ApiParent->Auth->SupprimeSession($this->ApiParent) ;
		if($ok)
		{
			$this->ConfirmeSucces("Deconnexion reussie") ;
		}
		else
		{
			$this->RenseigneException() ;
		}
	}
}