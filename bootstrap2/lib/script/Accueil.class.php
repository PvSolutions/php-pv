<?php
	
	if(! defined("SCRIPT_ACCUEIL_BOOTSTRAP2"))
	{
		define("SCRIPT_ACCUEIL_BOOTSTRAP2", 1) ;
		
		class ScriptAccueilBootstrap2 extends ScriptBaseBootstrap2
		{
			public $NecessiteMembreConnecte = 0 ;
			public function RenduSpecifique()
			{
				return "Site Bootstrap V2" ;
			}
		}
	}
	
?>