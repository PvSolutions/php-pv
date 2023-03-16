<?php

namespace Pv\ApiRestful\Filtre ;

#[\AllowDynamicProperties]
class Fixe extends Filtre
{
	public $TypeLiaisonParametre = "hidden" ;
	public $Role = "fixe" ;
	public function NePasInclure()
	{
		return 0 ;
	}
	public function ObtientValeurParametre()
	{
		return $this->ValeurParDefaut ;
	}
}