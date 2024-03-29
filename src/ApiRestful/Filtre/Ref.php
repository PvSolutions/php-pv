<?php

namespace Pv\ApiRestful\Filtre ;

#[\AllowDynamicProperties]
class Ref extends Filtre
{
	public $Role = "ref" ;
	public $TypeLiaisonParametre = "hidden" ;
	public $Source = null ;
	public function NePasInclure()
	{
		if($this->EstPasNul($this->Source))
		{
			return $this->Source->NePasInclure() ;
		}
		return 1 ;
	}
	public function ObtientValeurParametre()
	{
		if($this->EstPasNul($this->Source))
		{
			return $this->Source->Lie() ;
		}
		return $this->ValeurVide ;
	}

}