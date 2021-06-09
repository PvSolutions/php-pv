<?php

namespace Pv\ZoneWeb\Donnees ;

class SrcValsSuppl
{
	public $InclureHtml = 0 ;
	public $SuffixeHtml = "_html" ;
	public $InclureUrl = 0 ;
	public $SuffixeUrl = "_query_string" ;
	public $LignesDonneesBrutes = null ;
	public function Applique(& $composant, $ligneDonnees)
	{
		$this->LigneDonneesBrutes = $ligneDonnees ;
		// print_r($ligneDonneesBrutes) ;
		if($this->InclureHtml)
		{
			$ligneDonnees = array_merge(
				$ligneDonnees,
				array_apply_suffix(array_map('htmlentities', $this->LigneDonneesBrutes), $this->SuffixeHtml)
			) ;
		}
		if($this->InclureUrl)
		{
			$ligneDonnees = array_merge(
				$ligneDonnees,
				array_apply_suffix(
					array_map(
						'urlencode', $this->LigneDonneesBrutes
					), $this->SuffixeUrl
				)
			) ;
		}
		return $ligneDonnees ;
	}
}