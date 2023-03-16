<?php

namespace Pv\ZoneWeb\Commande ;

#[\AllowDynamicProperties]
class EnvoiDirectAppelDistant extends \Pv\ZoneWeb\Commande\AppelDistant
{
	protected function ExtraitArgsAppelDistant()
	{
		return $this->FormulaireDonneesParent->ExtraitObjetColonneLiee($this->FormulaireDonneesParent->FiltresEdition) ;
	}
}