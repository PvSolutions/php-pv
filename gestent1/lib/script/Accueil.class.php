<?php
	
	if(! defined('SCRIPT_ACCUEIL_GESTENT1'))
	{
		define('SCRIPT_ACCUEIL_GESTENT1', 1) ;
		
		class ScriptAccueilGestEnt1 extends ScriptBaseGestEnt1
		{
			public $Titre = "Accueil" ;
			public function RenduSpecifique()
			{
				$ctn = '' ;
				$ctn .= '<p>Bienvenue sur la page d\'accueil</p>' ;
				return $ctn ;
			}
		}
	}
	
?>