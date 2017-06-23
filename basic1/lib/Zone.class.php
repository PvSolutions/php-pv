<?php
	
	if(! defined('ZONE_BASIC1'))
	{
		if(! defined('DOCUMENT_WEB_BASE_BASIC1'))
		{
			include dirname(__FILE__)."/DocumentWeb.class.php" ;
		}
		if(! defined('COMPOSANT_IU_BASE_BASIC1'))
		{
			include dirname(__FILE__)."/ComposantIU.class.php" ;
		}
		if(! defined('SCRIPT_BASE_BASIC1'))
		{
			include dirname(__FILE__)."/Script.class.php" ;
		}
		define('ZONE_BASIC1', 1) ;
		
		class ZonePrincBasic1 extends PvZoneWebSimple
		{
			public $CheminFichierRelatif = CHEMIN_FIC_REL_ZONE_PRINC_BASIC1 ;
			protected function ChargeScripts()
			{
				$this->InsereScriptParDefaut(new ScriptAccueilBasic1()) ;
			}
		}
	}
	
?>