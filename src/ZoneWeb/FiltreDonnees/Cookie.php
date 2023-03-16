<?php

namespace Pv\ZoneWeb\FiltreDonnees ;

#[\AllowDynamicProperties]
class Cookie extends \Pv\ZoneWeb\FiltreDonnees\FiltreDonnees
{
	public $Role = "cookie" ;
	public $TypeLiaisonParametre = "cookie" ;
	public function ObtientValeurParametre()
	{
		return (isset($_COOKIE[$this->NomParametreLie])) ? $_COOKIE[$this->NomParametreLie] : $this->ValeurVide ;
	}
}