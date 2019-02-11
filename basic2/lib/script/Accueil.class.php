<?php
	
	if(! defined("SCRIPT_ACCUEIL_BASIC2"))
	{
		define("SCRIPT_ACCUEIL_BASIC2", 1) ;
		
		class ScriptAccueilBasic2 extends ScriptBaseBasic2
		{
			public function RenduSpecifique()
			{
				return "Site basique PView 1" ;
			}
		}
	}
	
?>