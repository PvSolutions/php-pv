<?php

namespace Pv\ZoneWeb\FormulaireDonnees ;

#[\AllowDynamicProperties]
class AjoutDonnees extends \Pv\ZoneWeb\FormulaireDonnees\FormulaireDonnees
{
	public $NomClasseCommandeExecuter = "\Pv\ZoneWeb\Commande\AjoutElement" ;
	public $InclureElementEnCours = 0 ;
	public $InclureTotalElements = 0 ;
}