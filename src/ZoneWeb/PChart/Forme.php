<?php

namespace Pv\ZoneWeb\PChart ;

#[\AllowDynamicProperties]
class Forme extends \Pv\Objet\Objet
{
	protected function RecupCheminPolice(& $graphe)
	{
		$cheminPolice = CHEM_REP_PCHART."/Fonts/".$graphe->NomFichierPolice ;
		return $cheminPolice ;
	}
	public function Applique(& $graphe)
	{
	}
}