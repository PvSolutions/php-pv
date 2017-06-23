<?php
	
	if(! defined('SYSTEME_MONSITE'))
	{
		if(! defined('SYSTEME_SWS'))
		{
			include dirname(__FILE__)."/".CHEMIN_PVIEW."/Sws/Systeme.class.php" ;
		}
		if(! defined('SCRIPT_MONSITE'))
		{
			include dirname(__FILE__)."/Script.class.php" ;
		}
		if(! defined('MODULE_GLOBAL_MONSITE'))
		{
			include dirname(__FILE__)."/ModulePage/Global.class.php" ;
		}
		define('SYSTEME_MONSITE', 1) ;
		
		class SystemeSwsMonSite extends SystemeDefautSws
		{
			public $PrivilegesEdit = array("edition_module_possible") ;
			public $ModuleGlobalMonSite ;
			public function ObtientUrlZoneAdmin(& $zone)
			{
				return $zone->ApplicationParent->ZoneAdmin->ObtientUrl() ;
			}
			public function ObtientUrlZonePubl(& $zone)
			{
				return $zone->ApplicationParent->ZonePubl->ObtientUrl() ;
			}
			protected function CreeModuleArticle()
			{
				return new ModuleArticleMonSite() ;
			}
			protected function CreeModulePageRacine()
			{
				return new ModuleRacineMonSite() ;
			}
			protected function ChargeModulesPage()
			{
				parent::ChargeModulesPage() ;
				$this->ModuleGlobalMonSite = new ModuleGlobalMonSite() ;
				$this->InscritModulePage("", $this->ModuleGlobalMonSite) ;
			}
			protected function ChargeImplemsPage()
			{
				parent::ChargeImplemsPage() ;
			}
		}
		class ModuleRacineMonSite extends ModulePageRacineSws
		{
			protected function CreeActionFluxRSS()
			{
				return new ActionFluxRSSMonSite() ;
			}
			protected function CreeScriptAccueil()
			{
				return new ScriptAccueilMonSite() ;
			}
		}
		
		class ActionFluxRSSMonSite extends ActionFluxRSSRacineSws
		{
			public $Titre = "One Services Cote d'Ivoire" ;
			public $Encodage = "iso-8859-1" ;
			protected function PrepareDoc()
			{
				$modulePage = $this->ObtientModulePage() ;
				$systeme = & $modulePage->SystemeParent ;
				$bd = $modulePage->ObtientBDSupport() ;
				/*
				$sql = "select titre, description, addtime(date_publication, heure_publication) date_publication, concat('".$this->ZoneParent->ObtientUrl()."?appelleScript=consult_article&id=', id) url
from article
union
select titre, lieux_visites description, addtime(date_publication, heure_publication) date_publication, concat('".$this->ZoneParent->ObtientUrl()."?appelleScript=consult_circuit_tour_oneserv&id=', id) url
from oneserv_circuit_tour
union
select titre, concat(hebergement, ' ', plus) description, addtime(date_publication, heure_publication) date_publication, concat('".$this->ZoneParent->ObtientUrl()."?appelleScript=consult_circuit_tour_oneserv&id=', id) url
from oneserv_circuit_corp
union
select titre, itineraire description, addtime(date_publication, heure_publication) date_publication, concat('".$this->ZoneParent->ObtientUrl()."?appelleScript=consult_circuit_tour_oneserv&id=', id) url
from oneserv_attraction
union
select titre, commodites description, addtime(date_publication, heure_publication) date_publication, concat('".$this->ZoneParent->ObtientUrl()."?appelleScript=consult_circuit_tour_oneserv&id=', id) url
from oneserv_hebergement
order by date_publication desc limit 0, 25" ;
				*/
				$sql = '' ;
				$lgns = $bd->FetchSqlRows($sql) ;
				// print_r($bd) ;
				foreach($lgns as $i => $lgn)
				{
					$this->InscritElemLienLgn($lgn) ;
				}
			}
		}
	}
	
?>