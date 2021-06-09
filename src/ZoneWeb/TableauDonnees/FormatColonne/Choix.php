<?php

namespace Pv\ZoneWeb\TableauDonnees\FormatColonne ;

class Choix extends \Pv\ZoneWeb\TableauDonnees\FormatColonne\FormatColonne
{
	public $ValeursChoix = array() ;
	public $ValeurNonTrouvee = "&nbsp;" ;
	public function Encode(& $composant, $colonne, $ligne)
	{
		$valeurEntree = $ligne[$colonne->NomDonnees] ;
		if(isset($this->ValeursChoix[$valeurEntree]))
		{
			$valeur = $this->ValeursChoix[$valeurEntree] ;
		}
		else
		{
			$valeur = $this->ValeurNonTrouvee ;
		}
		return $valeur ;
	}
	public function InstrsJsEncode(& $composant, $colonne)
	{
		$ctn = '' ;
		if($colonne->NomDonnees == '')
		{
			return '' ;
		}
		$nomDonnees = svc_json_encode($colonne->NomDonnees) ;
		$ctn .= 'var valEntree, val = "" ;
var valsChoix'.$this->IDInstanceCalc.' = svc_json_encode('.$this->ValeursChoix.') ;
if(donnees['.$nomDonnees.'] !== undefined) {
valEntree = donnees['.$nomDonnees.'] ;
}
if(valsChoix'.$this->IDInstanceCalc.'[valEntree] !== undefined) {
val = valsChoix'.$this->IDInstanceCalc.'[valEntree] ;
} else {
val = '.svc_json_encode($this->ValeurNonTrouvee).' ;
}
noeudCellule.innerHTML = val ;' ;
		return $ctn ;
	}
}