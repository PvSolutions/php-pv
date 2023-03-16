<?php

namespace Pv\ZoneWeb\TableauDonnees ;

#[\AllowDynamicProperties]
class NavigateurRangees
{
	public function Execute(& $script, & $composant)
	{
		return $this->ExecuteInstructions($script, $composant) ;
	}
	protected function ExecuteInstructions(& $script, & $composant)
	{
		$ctn = '' ;
		return $ctn ;
	}
}