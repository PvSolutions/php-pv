<?php
	
	if(! defined("SCRIPT_ACCUEIL_BOOTSTRAP3"))
	{
		define("SCRIPT_ACCUEIL_BOOTSTRAP3", 1) ;
		
		class ScriptAccueilBootstrap3 extends ScriptBaseBootstrap3
		{
			public $NecessiteMembreConnecte = 0 ;
			public function RenduSpecifique()
			{
				return "Solution Bootstrap V3, sans Entete &amp; Pied de page spécifique" ;
			}
		}
	}
	
?>