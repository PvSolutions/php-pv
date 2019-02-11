<?php
	
	if(! defined('ZONE_BOOTSTRAP2'))
	{
		if(! defined('DOCUMENT_WEB_BASE_BOOTSTRAP2'))
		{
			include dirname(__FILE__)."/DocumentWeb.class.php" ;
		}
		if(! defined('COMPOSANT_IU_BASE_BOOTSTRAP2'))
		{
			include dirname(__FILE__)."/ComposantIU.class.php" ;
		}
		if(! defined('SCRIPT_BASE_BOOTSTRAP2'))
		{
			include dirname(__FILE__)."/Script.class.php" ;
		}
		define('ZONE_BOOTSTRAP2', 1) ;
		
		class ZonePrincBootstrap2 extends PvZoneBaseBootstrap
		{
			public $EncodageDocument = "utf-8" ;
			public $CheminFichierRelatif = CHEMIN_FIC_REL_ZONE_PRINC_BOOTSTRAP2 ;
			public $InclureNormalize = 1 ;
			public $InclureFontAwesome = 1 ;
			public $UtiliserDocumentWeb = 1 ;
			public $NomClasseMembership = 'MembershipBootstrap2' ;
			public $LibelleLienAjout = "Ajouter" ;
			public $LibelleLienModif = "Modifier" ;
			public $LibelleLienDesact = "Desactiver" ;
			public $LibelleLienSuppr = "Supprimer" ;
			public $CheminCSSBootstrap = 'css/bootstrap.min.css' ;
			public $Titre = '<span class="fa fa-2x fa-home"></span> Ma Zone Admin Bootstrap 2' ;
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
				$this->DocumentsWeb["defaut"] = new DocWebDefautBootstrap2() ;
				$this->DocumentsWeb["iframe_dlg"] = new DocWebIframeDlgBootstrap2() ;
				$this->DocumentsWeb["vide"] = new DocWebCadreVideBootstrap2() ;
			}
			protected function ChargeScripts()
			{
				$this->InsereScriptParDefaut(new ScriptAccueilBootstrap2()) ;
			}
		}
	}
	
?>