<?php
	
	if(! defined('ZONE_BASIC3'))
	{
		if(! defined('DOCUMENT_WEB_BASE_BASIC3'))
		{
			include dirname(__FILE__)."/DocumentWeb.class.php" ;
		}
		if(! defined('COMPOSANT_IU_BASE_BASIC3'))
		{
			include dirname(__FILE__)."/ComposantIU.class.php" ;
		}
		if(! defined('SCRIPT_BASE_BASIC3'))
		{
			include dirname(__FILE__)."/Script.class.php" ;
		}
		define('ZONE_BASIC3', 1) ;
		
		class ZonePrincBasic3 extends PvZoneWebSimple
		{
			public $EncodageDocument = "utf-8" ;
			public $CheminFichierRelatif = CHEMIN_FIC_REL_ZONE_PRINC_BASIC3 ;
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
				$this->InsereScriptParDefaut(new ScriptAccueilBasic3()) ;
			}
		}
	}
	
?>