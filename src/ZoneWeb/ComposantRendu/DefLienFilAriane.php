<?php

namespace Pv\ZoneWeb\ComposantRendu ;

#[\AllowDynamicProperties]
class DefLienFilAriane extends \Pv\Objet\Objet
{
	public $RequeteSelection ;
	public $FormatTitre ;
	public $FormatUrl ;
	public $AttrsHtmlExtra ;
	public $NomClasseCSS ;
	public $Recursif = 0 ;
	public $Obligatoire = 1 ;
}