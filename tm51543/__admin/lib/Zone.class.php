<?php
	
	if(! defined('ZONE_TM51543'))
	{
		define('ZONE_TM51543', 1) ;
		
		class ZoneBaseTM51543 extends ZoneBaseSws
		{
			public $NomClasseMembership = "MembershipTM51543" ;
			public $PrivilegesPassePartout = array("super_admin") ;
		}
		class ZonePublTM51543 extends ZoneBaseTM51543
		{
			public $CompHeader ;
			public $CompFooter ;
			public $InclureJQuery = 1 ;
			public $InclureScriptsMembership = 1 ;
			public $AutoriserInscription = 1 ;
			public $AutoriserModifPrefs = 1 ;
			public $EncodageDocument = "utf-8" ;
			public $TitreLogo = "TM51543" ;
			public $SloganLogo = "Creative Ideas" ;
			public function ChargeConfig()
			{
				parent::ChargeConfig() ;
				$this->InscritLienCSS('css/reset.css') ;
				$this->InscritLienCSS('css/style.css') ;
				$this->InscritLienCSS('css/layout.css') ;
				$this->InscritLienJs('js/cufon-yui.js') ;
				$this->InscritLienJs('js/cufon-replace.js') ;
				$this->InscritLienJs('js/NewsGoth_400.font.js') ;
				$this->InscritLienJs('js/Vegur_300.font.js') ;
				$this->InscritLienJs('js/FF-cash.js') ;
				$this->InscritLienJs('js/jquery.easing.1.3.js') ;
				$this->InscritLienJs('js/tms-0.3.js') ;
				$this->InscritLienJs('js/tms_presets.js') ;
				$this->InscritContenuJs('jQuery(function() { 
				jQuery(".close").bind("click", function(){
		jQuery(this).parent().show().fadeOut(500);
	});
	Cufon.now() ;
});') ;
				$this->AutresElemsHead .= '<meta name="viewport" content="width=device-width">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">' ;
				$this->ApplicationParent->SystemeSws->RemplitZonePubl($this) ;
				$this->CompHeader = new CompHeaderTM51543() ;
				$this->CompHeader->AdopteZone("list2", $this) ;
				$this->CompHeader->ChargeConfig() ;
				$this->CompFooter = new CompFooterTM51543() ;
				$this->CompFooter->AdopteZone("list2", $this) ;
				$this->CompFooter->ChargeConfig() ;
				// print_r(array_keys($this->Scripts)) ;
			}
			protected function RenduEnteteCorpsDocument()
			{
				// ReferentielSws::$SystemeEnCours->ModuleCompteurHits->SauveVisiteActuelle($this) ;
				$ctn = '' ;
				$ctn .= '<body id="page1">'.PHP_EOL ;
				$ctn .= '<header>'.PHP_EOL ;
				$ctn .= $this->CompHeader->RenduDispositif().PHP_EOL ;
				$ctn .= '</header>'.PHP_EOL ;
				$ctn .= '<section id="content">
<div class="main">' ;
				return $ctn ;
			}
			protected function RenduPiedCorpsDocument()
			{
				$ctn = '' ;
				$ctn .= '</div>
</section>'.PHP_EOL ;
				$ctn .= '<footer>'.PHP_EOL ;
				$ctn .= $this->CompFooter->RenduDispositif().PHP_EOL ;
				$ctn .= '</footer>'.PHP_EOL ;
				$ctn .= '</body>' ;
				return $ctn ;
			}
		}
		class ZoneAdminTM51543 extends ZoneAdminSws
		{
			public $NomClasseMembership = "MembershipTM51543" ;
			public $EncodageDocument = "utf-8" ;
			public $TitreLogo = "SWS" ;
		}
	}
	
?>