<?php
	
	if(! defined('SCRIPT_MONSITE'))
	{
		define('SCRIPT_MONSITE', 1) ;
		
		class ScriptAccueilMonSite extends ScriptAccueilBaseSws
		{
			public $CompArtEvidence ;
			public $CompSlider ;
			public $CompEnumPages ;
			public $CompGrdMenus ;
			public $TitreDocument = 'Mon Site Web avec SwS' ;
			public $Titre = 'Mon Site Web avec SwS' ;
			public $MotsCleMeta = 'Mon Site Web avec SwS' ;
			public $DescriptionMeta = 'Mon Site Web avec SWS' ;
			public function ChargeConfig()
			{
				parent::ChargeConfig() ;
			}
			protected function RenduDispositifBrut()
			{
				$ctn = '' ;
				$ctn .= 'PAGE D\'ACCUEIL' ;
				return $ctn ;
			}
		}
		
		class ScriptInteretEntiteMonSite extends ScriptInteretEntiteTableSws
		{
			public $EmailRecept = "lebdenat@yahoo.fr, infos@oneservices-ci.com" ;
			public $EnregBDSupport = 0 ;
		}
		
	}
	
?>