<?php
	
	if(! defined('ZONE_BOOTSTRAP1'))
	{
		if(! defined('DOCUMENT_WEB_BASE_BOOTSTRAP1'))
		{
			include dirname(__FILE__)."/DocumentWeb.class.php" ;
		}
		if(! defined('COMPOSANT_IU_BASE_BOOTSTRAP1'))
		{
			include dirname(__FILE__)."/ComposantIU.class.php" ;
		}
		if(! defined('SCRIPT_BASE_BOOTSTRAP1'))
		{
			include dirname(__FILE__)."/Script.class.php" ;
		}
		define('ZONE_BOOTSTRAP1', 1) ;
		
		class ZonePrincBootstrap1 extends PvZoneBaseBootstrap
		{
			public $EncodageDocument = "utf-8" ;
			public $CheminFichierRelatif = CHEMIN_FIC_REL_ZONE_PRINC_BOOTSTRAP1 ;
			public $InclureNormalize = 1 ;
			public $InclureFontAwesome = 1 ;
			public $UtiliserDocumentWeb = 1 ;
			public $NomClasseMembership = 'MembershipBootstrap1' ;
			public $CheminCSSBootstrap = 'css/bootstrap.min.css' ;
			public function BDPrinc()
			{
				return $this->ApplicationParent->BDPrinc() ;
			}
			public function CreeBDPrinc()
			{
				return $this->ApplicationParent->CreeBDPrinc() ;
			}
			protected function ChargeDocumentsWeb()
			{
				$this->DocumentsWeb["defaut"] = new DocWebDefautBootstrap1() ;
			}
			protected function ChargeScripts()
			{
				$this->InsereScriptParDefaut(new ScriptAccueilBootstrap1()) ;
			}
		}
	}
	
?>