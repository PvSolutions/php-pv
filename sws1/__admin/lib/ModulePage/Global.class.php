<?php
	
	if(! defined('MODULE_GLOBAL_MONSITE'))
	{
		define('MODULE_GLOBAL_MONSITE', 1) ;
		
		class ModuleGlobalMonSite extends ModulePageBaseSws
		{
			public $NomRef = "globals_oneserv" ;
			public $TitreMenu = "MonSite" ;
			public $EntiteCircuitTour ;
			public $EntiteAttraction ;
			public $EntiteCircuitCorp ;
			public $EntiteHeberg ;
			public $EntiteTypeAttraction ;
			protected function ChargeEntites()
			{
			}
		}
		
		class EntiteTypeAttractionMonSite extends EntiteTableSws
		{
			public $AccepterTitre = 1 ;
			public $TitreMenu = "Type attraction" ;
			public $NomEntite = "type_attraction_oneserv" ;
			public $NomTable = "oneserv_type_attraction" ;
			public $TitreAjoutEntite = "Ajout type attraction" ;
			public $TitreModifEntite = "Modification type attraction" ;
			public $TitreSupprEntite = "Suppression type attraction" ;
			public $TitreListageEntite = "Liste des types attraction" ;
		}
		
		class ModuleArticleMonSite extends ModuleArticleSws
		{
			protected function CreeEntiteArticle()
			{
				return new EntiteArticleMonSite() ;
			}
		}
		class EntiteArticleMonSite extends EntiteArticleSws
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