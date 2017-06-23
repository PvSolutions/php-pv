<?php
	
	if(! defined('ZONE_BASIC0'))
	{
		if(! defined('SCRIPT_BASE_BASIC0'))
		{
			include dirname(__FILE__)."/Script.class.php" ;
		}
		define('ZONE_BASIC0', 1) ;
		
		class ZonePrincBasic0 extends PvZoneWebSimple
		{
			public $CheminFichierRelatif = CHEMIN_FIC_REL_ZONE_PRINC_BASIC0 ;
			protected function ChargeScripts()
			{
				$this->InsereScriptParDefaut(new ScriptAccueilBasic0()) ;
			}
		}
	}
	
?>