<?php
	
	if(! defined('ZONE_BASIC2'))
	{
		if(! defined('DOCUMENT_WEB_BASE_BASIC2'))
		{
			include dirname(__FILE__)."/DocumentWeb.class.php" ;
		}
		if(! defined('COMPOSANT_IU_BASE_BASIC2'))
		{
			include dirname(__FILE__)."/ComposantIU.class.php" ;
		}
		if(! defined('SCRIPT_BASE_BASIC2'))
		{
			include dirname(__FILE__)."/Script.class.php" ;
		}
		define('ZONE_BASIC2', 1) ;
		
		class ZonePrincBasic2 extends PvZoneWebSimple
		{
			public $EncodageDocument = "utf-8" ;
			public $CheminFichierRelatif = CHEMIN_FIC_REL_ZONE_PRINC_BASIC2 ;
			public function BDPrinc()
			{
				return $this->ApplicationParent->BDPrinc() ;
			}
			public function CreeBDPrinc()
			{
				return $this->ApplicationParent->CreeBDPrinc() ;
			}
			protected function ChargeScripts()
			{
				$this->InsereScriptParDefaut(new ScriptAccueilBasic2()) ;
			}
		}
	}
	
?>