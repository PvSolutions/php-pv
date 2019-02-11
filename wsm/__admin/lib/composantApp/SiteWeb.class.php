<?php
	
	if(! defined("SITE_WEB_WSM2"))
	{
		if(! defined('MODELE_PAGE_BASE_WSM2'))
		{
			include dirname(__FILE__)."/ModelePageWeb.class.php" ;
		}
		define("SITE_WEB_WSM2", 1) ;
		
		class SiteWebWsm2 extends ComposantAppBaseWsm2
		{
			public $ModelesRelPage = array() ;
			public $ModelesPage = array() ;
			public $ModelePageDefaut ;
			public $IdPageRacine = 0 ;
			public $NomTablePage = "page" ;
			public $NomTableRelPage = "rel_page" ;
			public $NomTableVisitePage = "visit_page" ;
			public $NomTableAdminPage = "admin_page" ;
			protected function InitConfig()
			{
				parent::InitConfig() ;
				$this->InitModelesPage() ;
			}
			public function CreeTablPrinc(& $script)
			{
				return $script->CreeTablPrinc() ;
			}
			public function CreeFormPrinc(& $script)
			{
				return $script->CreeFormPrinc() ;
			}
			public function CreeGrillePrinc(& $script)
			{
				return $script->CreeGrillePrinc() ;
			}
			public function CreeBDPrinc()
			{
				return new $this->ApplicationParent->CreeBDPrinc() ;
			}
			protected function CreeModelePageDefaut()
			{
				return new PvModelePageDefautWsm2() ;
			}
			protected function InitModelesPage()
			{
				$this->ModelePageRacine = $this->InsereModelePage(new ModelePageRacineWsm2()) ;
				$this->ModelePageDefaut = $this->InsereModelePage(new ModelePageDefautWsm2()) ;
			}
			public function & InsereModelePage($modelePage)
			{
				$this->ModelesPage[$modelePage->NomElementSite] = & $modelePage ;
				$modelePage->AdopteSite($this) ;
				return $modelePage ;
			}
			public function EncodeHtmlChemin($cheminTitre)
			{
				$titres = explode(' &gt; ', $cheminTitre) ;
				return join(' &gt; ', array_map('htmlentities', $titres)) ;
			}
		}
		
	}
	
?>