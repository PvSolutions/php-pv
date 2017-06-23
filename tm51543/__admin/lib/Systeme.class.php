<?php
	
	if(! defined('SYSTEME_TM51543'))
	{
		if(! defined('SYSTEME_SWS'))
		{
			include dirname(__FILE__)."/".CHEMIN_PVIEW."/Sws/Systeme.class.php" ;
		}
		if(! defined('SCRIPT_TM51543'))
		{
			include dirname(__FILE__)."/Script.class.php" ;
		}
		if(! defined('MODULE_PREST_SVC_TM51543'))
		{
			include dirname(__FILE__)."/ModulePage/PrestSvc.class.php" ;
		}
		define('SYSTEME_TM51543', 1) ;
		
		class SystemeSwsTM51543 extends SystemeDefautSws
		{
			public $PrivilegesEdit = array("edition_module_possible") ;
			public $ModulePrestSvc ;
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
				return new ModuleArticleTM51543() ;
			}
			protected function CreeModuleSlider()
			{
				$slider = parent::CreeModuleSlider() ;
				// $slider->CheminTelechargImage = "images" ;
				return $slider ;
			}
			protected function CreeModulePageRacine()
			{
				return new ModuleRacineTM51543() ;
			}
			protected function ChargeModulesPage()
			{
				parent::ChargeModulesPage() ;
				$this->ModulePrestSvc = new ModulePrestSvcTM51543() ;
				$this->InscritModulePage("tm51543_prest_svc", $this->ModulePrestSvc) ;
			}
		}
		class ModuleRacineTM51543 extends ModulePageRacineSws
		{
			protected function CreeActionFluxRSS()
			{
				return new ActionFluxRSSTM51543() ;
			}
			protected function CreeScriptAccueil()
			{
				return new ScriptAccueilTM51543() ;
			}
		}
		
		class ActionFluxRSSTM51543 extends ActionFluxRSSRacineSws
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