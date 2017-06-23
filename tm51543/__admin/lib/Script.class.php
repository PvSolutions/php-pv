<?php
	
	if(! defined('SCRIPT_TM51543'))
	{
		define('SCRIPT_TM51543', 1) ;
		
		class ScriptAccueilTM51543 extends ScriptAccueilBaseSws
		{
			public $CompArtEvidence ;
			public $CompSlider ;
			public $CompEnumPages ;
			public $CompGrdMenus ;
			public $TitreDocument = 'Template Monster 51543' ;
			public $Titre = 'Template Monster 51543' ;
			public $MotsCleMeta = 'Mon Site Web avec SwS' ;
			public $DescriptionMeta = 'Mon Site Web avec SWS' ;
			public $CompSliderWrapper ;
			public $CompList1 ;
			public $CompWelcomeBloc ;
			public $CompList2 ;
			public function DetermineEnvironnement()
			{
				parent::DetermineEnvironnement() ;
				$this->CompSliderWrapper = new CompSliderWrapperTM51543() ;
				$this->CompSliderWrapper->AdopteZone("sliderWrapper", $this) ;
				$this->CompSliderWrapper->ChargeConfig() ;
				$this->CompList1 = new CompList1TM51543() ;
				$this->CompList1->AdopteZone("list1", $this) ;
				$this->CompList1->ChargeConfig() ;
				$this->CompWelcomeBloc = new CompWelcomeBlocTM51543() ;
				$this->CompWelcomeBloc->AdopteZone("welcomeBloc", $this) ;
				$this->CompWelcomeBloc->ChargeConfig() ;
				$this->CompList2 = new CompList2TM51543() ;
				$this->CompList2->AdopteZone("list2", $this) ;
				$this->CompList2->ChargeConfig() ;
			}
			public function ChargeConfig()
			{
				parent::ChargeConfig() ;
			}
			protected function RenduDispositifBrut()
			{
				$ctn = '' ;
				$ctn .= $this->CompSliderWrapper->RenduDispositif().PHP_EOL ;
				$ctn .= '<div class="border-bot1 img-indent-bot">
<h2>Web design, Graphic design, Illustrations, Identity and <strong>Photographies by Our Design Studio</strong></h2>
</div>' ;
				$ctn .= '<div class="wrapper">' ;
				$ctn .= '<article class="col-1"><div class="indent-left">' ;
				$ctn .= $this->CompList1->RenduDispositif() ;
				$ctn .= '</div></article>' ;
				$ctn .= '<article class="col-2">' ;
				$ctn .= $this->CompWelcomeBloc->RenduDispositif() ;
				$ctn .= '</article>' ;
				$ctn .= '<article class="col-3"><div class="indent-top">' ;
				$ctn .= $this->CompList2->RenduDispositif() ;
				$ctn .= '</div></article>' ;
				$ctn .= '</div>' ;
				return $ctn ;
			}
		}
		
		class ScriptInteretEntiteTM51543 extends ScriptInteretEntiteTableSws
		{
			public $EmailRecept = "lebdenat@yahoo.fr, infos@oneservices-ci.com" ;
			public $EnregBDSupport = 0 ;
		}
		
	}
	
?>