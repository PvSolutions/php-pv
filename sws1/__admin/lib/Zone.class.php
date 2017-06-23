<?php
	
	if(! defined('ZONE_MONSITE'))
	{
		define('ZONE_MONSITE', 1) ;
		
		class ZoneBaseMonSite extends ZoneBaseSws
		{
			public $NomClasseMembership = "MembershipMonSite" ;
			public $PrivilegesPassePartout = array("super_admin") ;
		}
		class ZonePublMonSite extends ZoneBaseMonSite
		{
			public $CompEntete ;
			public $CompPied ;
			public $CompVoletG ;
			public $InclureJQuery = 1 ;
			public $InclureScriptsMembership = 1 ;
			public $AutoriserInscription = 1 ;
			public $AutoriserModifPrefs = 1 ;
			public $EncodageDocument = "utf-8" ;
			public function ChargeConfig()
			{
				parent::ChargeConfig() ;
				$this->InscritLienCSS('css/normalize.css') ;
				$this->InscritLienCSS('css/main.css') ;
				$this->InscritLienCSS('global.css') ;
				$this->InscritLienJs('js/vendor/modernizr-2.6.1.min.js') ;
				$this->InscritLienJs('js/plugins.js') ;
				$this->AutresElemsHead .= '<meta name="viewport" content="width=device-width">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">' ;
				$this->ApplicationParent->SystemeSws->RemplitZonePubl($this) ;
				$this->CompEntete = new CompEnteteCorpsPublMonSite() ;
				$this->CompEntete->AdopteZone("entete", $this) ;
				$this->CompEntete->ChargeConfig() ;
				$this->CompPied = new CompPiedCorpsPublMonSite() ;
				$this->CompPied->AdopteZone("pied", $this) ;
				$this->CompPied->ChargeConfig() ;
				// print_r(array_keys($this->Scripts)) ;
			}
			protected function RenduEnteteCorpsDocument()
			{
				// ReferentielSws::$SystemeEnCours->ModuleCompteurHits->SauveVisiteActuelle($this) ;
				$ctn = '' ;
				$ctn .= '<body>'.PHP_EOL ;
				$ctn .= '<table width="100%" cellspacing="0" cellpadding="2" border="0">
<tr>
<td width="75%" valign="top">' ;
				return $ctn ;
			}
			protected function RenduPiedCorpsDocument()
			{
				$ctn = '' ;
				$ctn .= '</td>
<td width="2%">&nbsp;</td>
<td width="*" valign="top">
MENU DROIT
</td>' ;
				$ctn .= '</body>' ;
				return $ctn ;
			}
		}
		class ZoneAdminMonSite extends ZoneAdminSws
		{
			public $NomClasseMembership = "MembershipMonSite" ;
			public $EncodageDocument = "utf-8" ;
			public $TitreLogo = "SWS" ;
		}
	}
	
?>