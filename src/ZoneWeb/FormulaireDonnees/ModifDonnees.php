<?php

namespace Pv\ZoneWeb\FormulaireDonnees ;

#[\AllowDynamicProperties]
class ModifDonnees extends \Pv\ZoneWeb\FormulaireDonnees\FormulaireDonnees
{
	public $NomClasseCommandeExecuter = "\Pv\ZoneWeb\Commande\ModifElement" ;
	public $InclureElementEnCours = 1 ;
	public $InclureTotalElements = 1 ;
}