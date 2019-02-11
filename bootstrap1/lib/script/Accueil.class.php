<?php
	
	if(! defined("SCRIPT_ACCUEIL_BOOTSTRAP1"))
	{
		define("SCRIPT_ACCUEIL_BOOTSTRAP1", 1) ;
		
		class ScriptAccueilBootstrap1 extends ScriptBaseBootstrap1
		{
			public $NecessiteMembreConnecte = 0 ;
			public function RenduSpecifique()
			{
				return "Site Bootstrap V1" ;
			}
		}
	}
	
?>