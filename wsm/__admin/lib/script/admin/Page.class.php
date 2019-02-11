<?php
	
	if(! defined('SCRIPT_ADMIN_PAGE_WSM2'))
	{
		define('SCRIPT_ADMIN_PAGE_WSM2', 1) ;
		
		class ScriptAspectPageAdminWsm2 extends ScriptConsultBaseAdminWsm2
		{
			public $ValeurParamIdPage ;
			public $LgnsChemin ;
			public $ModelePageWsm ;
			protected $EstPageRacine = 0 ;
			protected function DetermineLgnPrinc()
			{
				$this->ValeurParamIdPage = _GET_def("idPage") ;
				if(empty($this->ValeurParamIdPage))
				{
					$this->EstPageRacine = 1 ;
					$this->ValeurParamIdPage = 0 ;
				}
				if($this->EstPageRacine == 0)
				{
					parent::DetermineLgnPrinc() ;
				}
				else
				{
					$this->AppliqueLgnRacine() ;
				}
				if($this->LgnPrincTrouvee())
				{
					$this->DetermineModelePage() ;
				}
			}
			protected function AppliqueLgnRacine()
			{
				$siteWsm = & $this->ApplicationParent->SiteWsm ;
				$this->LgnPrinc = array() ;
				foreach($siteWsm->ModelePageRacine->DefsColDefaut as $nom => $defCol)
				{
					$this->LgnPrinc[$nom] = $defCol->ValeurParDefaut ;
				}
				$this->LgnPrinc["template_name_page"] = $siteWsm->ModelePageRacine->NomElementSite ;
			}
			protected function DetermineModelePage()
			{
				$this->NomModelePageWsm = $this->LgnPrinc["template_name_page"] ;
				$siteWsm = & $this->ApplicationParent->SiteWsm ;
				if(! isset($siteWsm->ModelesPage[$this->NomModelePageWsm]))
				{
					$this->ModelePageWsm = $siteWsm->ModelePageDefaut ;
				}
				else
				{
					$this->ModelePageWsm = $siteWsm->ModelesPage[$this->NomModelePageWsm] ;
				}
			}
			public function RenduChemin()
			{
				$ctn = '' ;
				$ctn .= '<ol class="breadcrumb">
<li><a href="?appelleScript=parcourtPageRacine">Page Racine</a></li>' ;
				if($this->EstPageRacine == 1)
				{
					$ctn .= '</ol>' ;
					return $ctn ;
				}
				$siteWsm = & $this->ApplicationParent->SiteWsm ;
				$bd = $this->ApplicationParent->CreeBDPrinc() ;
				$idsChemin = explode(', ', $this->LgnPrinc["path_page"]) ;
				$condChemin = '' ;
				$paramsChemin = array() ;
				for($i=1; $i < count($idsChemin); $i++)
				{
					if($condChemin != '')
					{
						$condChemin .= ', ' ;
					}
					$condChemin .= ':id_page_'.$i ;
					$paramsChemin['id_page_'.$i] = $idsChemin[$i] ;
				}
				$this->LgnsChemin = $bd->FetchSqlRows('select * from '.$siteWsm->NomTablePage.' where id_page in ('.$condChemin.') order by path_page asc', $paramsChemin) ;
				foreach($this->LgnsChemin as $i => $lgnPage)
				{
					$ctn .= '<li><a href="?appelleScript=parcourtPage&idPage='.urlencode($lgnPage["id_page"]).'">'.htmlentities($lgnPage["title_page"]).'</a></li>'.PHP_EOL ;
				}
				$ctn .= '</ol>' ;
				return $ctn ;
			}
			protected function ReqSqlPrinc()
			{
				return "select * from page where id_page=:idPage" ;
			}
			protected function ParamsSqlPrinc()
			{
				return array("idPage" => $this->ValeurParamIdPage) ;
			}
		}
		
		class ScriptParcourtPageAdminWsm2 extends ScriptAspectPageAdminWsm2
		{
			protected function DetermineDocumentPrinc()
			{
				$this->TitreDocument = $this->LgnPrinc["title_page"]." - Exploration" ;
				$this->Titre = $this->LgnPrinc["title_page"] ;
			}
			public function DetermineEnvironnement()
			{
				parent::DetermineEnvironnement() ;
				$this->ModelePageWsm->DetermineScriptParcourtAdmin($this) ;
			}
			public function RenduSpecifique()
			{
				$ctn = '' ;
				$ctn .= $this->ModelePageWsm->RenduScriptParcourtAdmin($this) ;
				return $ctn ;
			}
		}
		
		class ScriptParcourtPageRacineAdmWsm2 extends ScriptParcourtPageAdminWsm2
		{
			protected $EstPageRacine = 1 ;
		}
		
		class ScriptListRelsPageAdminWsm2 extends ScriptAspectPageAdminWsm2
		{
			protected function DetermineDocumentPrinc()
			{
				$this->TitreDocument = $this->LgnPrinc["title_page"]." - Exploration" ;
				$this->Titre = $this->LgnPrinc["title_page"] ;
			}
			public function DetermineEnvironnement()
			{
				parent::DetermineEnvironnement() ;
				$this->ModelePageWsm->DetermineScriptListRelsAdmin($this) ;
			}
			public function RenduSpecifique()
			{
				$ctn = '' ;
				$ctn .= $this->ModelePageWsm->RenduScriptListRelsAdmin($this) ;
				return $ctn ;
			}
		}
	}
	
?>