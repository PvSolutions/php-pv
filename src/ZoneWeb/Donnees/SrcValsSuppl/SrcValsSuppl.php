<?php

namespace Pv\ZoneWeb\Donnees\SrcValsSuppl ;

class SrcValsSuppl
{
	public $InclureHtml = false ;
	public $SuffixeHtml = "_html" ;
	public $InclureUrl = false ;
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
				\Pv\Misc::array_apply_suffix(array_map('htmlentities', $this->LigneDonneesBrutes), $this->SuffixeHtml)
			) ;
		}
		if($this->InclureUrl)
		{
			$ligneDonnees = array_merge(
				$ligneDonnees,
				\Pv\Misc::array_apply_suffix(
					array_map(
						'urlencode', $this->LigneDonneesBrutes
					), $this->SuffixeUrl
				)
			) ;
		}
		return $ligneDonnees ;
	}
}