<?php

namespace Pv\FournisseurDonnees ;


#[\AllowDynamicProperties]
class ExpressionFiltre
{
	public $Texte = "" ;
	public $Parametres = array() ;
	public function EstVide()
	{
		return ($this->Texte == "") ? 1 : 0 ;
	}
}
