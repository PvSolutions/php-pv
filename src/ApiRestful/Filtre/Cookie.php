<?php

namespace Pv\ApiRestful\Filtre ;

#[\AllowDynamicProperties]
class Cookie extends Filtre
{
	public $Role = "cookie" ;
	public $TypeLiaisonParametre = "cookie" ;
	public function ObtientValeurParametre()
	{
		return (isset($_COOKIE[$this->NomParametreLie])) ? $_COOKIE[$this->NomParametreLie] : $this->ValeurVide ;
	}
}