<?php
	
	if(! defined('MODULE_PREST_SVC_TM51543'))
	{
		define('MODULE_PREST_SVC_TM51543', 1) ;
		
		class ModulePrestSvcTM51543 extends ModulePageBaseSws
		{
			public $NomRef = "tm51543_prest_svc" ;
			public $TitreMenu = "Prestations" ;
			public $EntitePrestSvc ;
			protected function ChargeEntites()
			{
				$this->EntitePrestSvc = $this->InsereEntite("prest_svc", new EntitePrestSvcTM51543()) ;
			}
		}
		
		class EntitePrestSvcTM51543 extends EntitePageWebSws
		{
			public $TitreMenu = "Services" ;
			public $NomEntite = "prest_svc" ;
			public $NomTable = "tm51543_prest_svc" ;
			public $TitreEnumEntite = "Prestations de service" ;
			public $InclureScriptEnum = 1 ;
			public $TitreAjoutEntite = "Ajout prestation de service" ;
			public $TitreModifEntite = "Modification prestation de service" ;
			public $TitreSupprEntite = "Suppression prestation de service" ;
			public $TitreListageEntite = "Liste des prestations de service" ;
		}
		
		class ModuleArticleTM51543 extends ModuleArticleSws
		{
			protected function CreeEntiteArticle()
			{
				return new EntiteArticleTM51543() ;
			}
		}
		class EntiteArticleTM51543 extends EntiteArticleSws
		{
			public function RenduScriptConsult(& $script)
			{
				if($this->LgnEnCours["id"] == 1)
				{
					$this->BlocContenu->InclureRenduImage = 0 ;
				}
				return parent::RenduScriptConsult($script) ;
			}
		}
	}
	
?>