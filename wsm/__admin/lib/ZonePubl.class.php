<?php
	
	if(! defined('ZONE_PUBL_WSM2'))
	{
		if(! defined('DOCUMENT_WEB_BASE_WSM2'))
		{
			include dirname(__FILE__)."/DocumentWeb.class.php" ;
		}
		if(! defined('COMPOSANT_IU_BASE_WSM2'))
		{
			include dirname(__FILE__)."/ComposantIU.class.php" ;
		}
		if(! defined('SCRIPT_BASE_WSM2'))
		{
			include dirname(__FILE__)."/Script.class.php" ;
		}
		define('ZONE_PUBL_WSM2', 1) ;
		
		class ZonePublWsm2 extends PvZoneWebSimple
		{
			public $NomParamScriptAppele = "action" ;
			public $EncodageDocument = "utf-8" ;
			public $CheminFichierRelatif = CHEMIN_FIC_REL_ZONE_PUBL_WSM2 ;
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
				$this->InsereScriptParDefaut(new ScriptAccueilPublWsm2()) ;
			}
		}
		
		class DocWebPublBaseWsm2 extends DocWebBaseWsm2
		{
		}
		
		class DocWebPublNonConnecteWsm2 extends DocWebPublBaseWsm2
		{
		}
		
		class DocWebPublConnecteWsm2 extends DocWebPublBaseWsm2
		{
		}
	}
	
?>