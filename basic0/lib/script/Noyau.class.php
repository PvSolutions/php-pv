<?php
	
	if(! defined('SCRIPT_NOYAU_BASIC0'))
	{
		define('SCRIPT_NOYAU_BASIC0', 1) ;
		
		class ScriptBaseBasic0 extends PvScriptWebSimple
		{
		}
		
		class ScriptAccueilBasic0 extends ScriptBaseBasic0
		{
			public function RenduSpecifique()
			{
				return "Site basique PView 0" ;
			}
		}
	}
	
?>