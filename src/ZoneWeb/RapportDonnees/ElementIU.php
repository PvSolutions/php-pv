<?php

namespace Pv\ZoneWeb\RapportDonnees ;

#[\AllowDynamicProperties]
class ElementIU extends \Pv\ZoneWeb\ComposantRendu\ComposantRendu
{
	public $NomElementRapport ;
	public $RapportParent ;
	public function AdopteRapport($nom, & $rapport)
	{
		$this->NomElementRapport = $nom ;
		$this->RapportParent = & $rapport ;
	}
}