<?php

namespace Pv\ZoneWeb\ActionCommande ;

#[\AllowDynamicProperties]
class TailleFiltreImageGd
{
	public $NomFiltre ;
	public $LargeurMax ;
	public $HauteurMax ;
	public $Operation = "" ;
	public $Obligatoire = 0 ;
	public $CheminEchec = "images/non_trouve.png" ;
}