<?php
	
	if(! defined('PV_MODELE_SCRIPT_WSM'))
	{
		class PvModeleScriptBaseWsm
		{
			public $ValeurParam = "" ;
			public $InscrireFamillePage = 1 ;
			public $InscrireMetaParFilsPage = 1 ;
			public $TotalFilsParRangee = 8 ;
			public $InscrireRangeeFilsPage = 1 ;
			public $TotalRangeesRelSrcPage = 8 ;
			public $InscrireRangeeRelSrcPage = 1 ;
			public $TotalRangeesRelDestPage = 8 ;
			public $InscrireRangeeRelDestPage = 1 ;
			public $NomParamIndiceFilsPage = "child_page_start" ;
			public $NomParamIndiceRelSrcPage = "rel_page_src_start" ;
			public $NomParamIndiceRelDestPage = "rel_page_dest_start" ;
			public function DetermineScriptSupport(& $script)
			{
			}
			public function RenduScriptSupport(& $script)
			{
			}
		}
		class PvModeleScriptAffichPublWsm extends PvModeleScriptBaseWsm
		{
			public $ValeurParam = "show_page" ;
		}
	}

?>