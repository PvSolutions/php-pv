<?php
	
	if(! defined("SCRIPT_ACCUEIL_BASIC1"))
	{
		define("SCRIPT_ACCUEIL_BASIC1", 1) ;
		
		class ScriptAccueilBasic1 extends ScriptBaseBasic1
		{
			public function RenduSpecifique()
			{
				return "Site basique PView 1" ;
			}
		}
	}
	
?>