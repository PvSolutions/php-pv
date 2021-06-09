<?php

namespace Pv\ZoneBootstrap\FiltreDonnees\Composant ;

class ZoneBoiteOptionsRadio extends \Pv\ZoneWeb\FiltreDonnees\Composant\ZoneBoiteOptionsRadio
{
	protected function RenduListeElements()
	{
		$this->CorrigeIDsElementHtml() ;
		$ctn = '' ;
		$ctn .= $this->RenduFoncJs() ;
		$ctn .= $this->RenduLiens() ;
		$ctn .= '<table' ;
		$ctn .= ' name="Conteneur_'.$this->NomElementHtml.'"' ;
		$ctn .= ' id="Conteneur_'.$this->IDInstanceCalc.'"' ;
		$ctn .= $this->RenduAttrsSupplHtml() ;
		$ctn .= '>'.PHP_EOL ;
		$totalLignes = 0 ;
		$indexLigne = 0 ;
		$pourcentageColonne = intval(100 / $this->MaxColonnesParLigne) ;
		$this->OuvreRequeteSupport() ;
		while($ligne = $this->LitRequeteSupport())
		{
			if($indexLigne % $this->MaxColonnesParLigne == 0)
			{
				$ctn .= '<tr>'.PHP_EOL ;
			}
			$ctn .= '<td' ;
			$ctn .= ' width="'.$pourcentageColonne.'%"' ;
			$ctn .= ' valign="top"' ;
			$ctn .= '>'.PHP_EOL ;
			$valeur = $this->ExtraitValeur($ligne, $this->NomColonneValeur) ;
			$libelle = $this->ExtraitValeur($ligne, $this->NomColonneLibelle) ;
			$ctn .= $this->RenduElement($valeur, $libelle, $ligne, $this->RequeteSupport->Position).PHP_EOL ;
			$ctn .= '</td>'.PHP_EOL ;
			if($indexLigne % $this->MaxColonnesParLigne == $this->MaxColonnesParLigne - 1)
			{
				$ctn .= '</tr>'.PHP_EOL ;
			}
			$indexLigne++ ;
		}
		if($indexLigne % $this->MaxColonnesParLigne != 0)
		{
			$colonnesFusionnees = $this->MaxColonnesParLigne - ($indexLigne % $this->MaxColonnesParLigne) ;
			$ctn .= '<td colspan="'.$colonnesFusionnees.'"></td>'.PHP_EOL ;
			$ctn .= '</tr>'.PHP_EOL ;
		}
		$this->FermeRequeteSupport() ;
		$ctn .= '</table>' ;
		// $ctn .= '<input type="hidden" name="'.$this->NomElementHtml.'" id="'.$this->IDInstanceCalc.'" value="'.htmlentities($this->Valeur).'" />' ;
		// print_r($this->FournisseurDonnees->BaseDonnees) ;
		return $ctn ;
	}
}