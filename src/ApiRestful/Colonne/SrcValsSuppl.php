<?php

namespace Pv\ApiRestful\Colonne ;

#[\AllowDynamicProperties]
class SrcValsSuppl
{
	public $LignesDonneesBrutes ;
	public function Applique(& $composant, $ligneDonnees)
	{
		return $ligneDonnees ;
	}
}