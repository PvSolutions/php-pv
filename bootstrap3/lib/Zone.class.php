<?php
	
	if(! defined('ZONE_BOOTSTRAP3'))
	{
		if(! defined('DOCUMENT_WEB_BASE_BOOTSTRAP3'))
		{
			include dirname(__FILE__)."/DocumentWeb.class.php" ;
		}
		if(! defined('COMPOSANT_IU_BASE_BOOTSTRAP3'))
		{
			include dirname(__FILE__)."/ComposantIU.class.php" ;
		}
		if(! defined('SCRIPT_BASE_BOOTSTRAP3'))
		{
			include dirname(__FILE__)."/Script.class.php" ;
		}
		define('ZONE_BOOTSTRAP3', 1) ;
		
		class ZonePrincBootstrap3 extends PvZoneBaseBootstrap
		{
			public $EncodageDocument = "utf-8" ;
			public $CheminFichierRelatif = CHEMIN_FIC_REL_ZONE_PRINC_BOOTSTRAP3 ;
			public $InclureNormalize = 1 ;
			public $InclureFontAwesome = 1 ;
			public $UtiliserDocumentWeb = 1 ;
			public $NomClasseMembership = 'MembershipBootstrap3' ;
			public $LibelleLienAjout = "Ajouter" ;
			public $LibelleLienModif = "Modifier" ;
			public $LibelleLienDesact = "Desactiver" ;
			public $LibelleLienSuppr = "Supprimer" ;
			public $CheminCSSBootstrap = 'css/bootstrap.min.css' ;
			public $Titre = '<span class="fa fa-2x fa-home"></span> Mon Projet Bootstrap 3' ;
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
				$this->DocumentsWeb["defaut"] = new DocWebDefautBootstrap3() ;
				$this->DocumentsWeb["iframe_dlg"] = new DocWebIframeDlgBootstrap3() ;
				$this->DocumentsWeb["vide"] = new DocWebCadreVideBootstrap3() ;
			}
			protected function ChargeScripts()
			{
				$this->InsereScriptParDefaut(new ScriptAccueilBootstrap3()) ;
			}
		}
	}
	
?>