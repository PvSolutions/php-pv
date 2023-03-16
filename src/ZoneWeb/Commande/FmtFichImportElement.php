<?php

namespace Pv\ZoneWeb\Commande ;

#[\AllowDynamicProperties]
class FmtFichImportElement
{
	public $Extensions = array() ;
	public function Ouvre($cheminFichier)
	{
		return false ;
	}
	public function LitEntete()
	{
		return array() ;
	}
	public function LitLigne()
	{
		return array() ;
	}
	public function Ferme()
	{
	}
}