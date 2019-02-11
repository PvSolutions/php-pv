<?php
	
	if(! defined("SCRIPT_ACCUEIL_BASIC3"))
	{
		define("SCRIPT_ACCUEIL_BASIC3", 1) ;
		
		class ScriptAccueilBasic3 extends ScriptBaseBasic3
		{
			public $NecessiteMembreConnecte = 0 ;
			public function RenduSpecifique()
			{
				return "Site basique PView 3" ;
			}
		}
	}
	
?>