<?php
	
	if(! defined('PV_MODELE_ZONE_WSM'))
	{
		define('PV_MODELE_ZONE_WSM', 1) ;
		
		class PvModeleZoneBaseWsm
		{
			public $NomElementSite ;
			public $SiteParent ;
			public $CheminFichierRelatifZone ;
			public $ZoneSupport ;
			public function __construct()
			{
				$this->InitConfig() ;
			}
			protected function InitConfig()
			{
				$this->InitConfig() ;
			}
			public function ChargeConfig()
			{
			}
			public function AdopteSite($nom, & $site)
			{
				$this->NomElementSite = $nom ;
				$this->SiteParent = & $site ;
			}
			public function RemplitApplication($nom, & $app)
			{
				$this->ZoneSupport = $app->InsereIHM($nom, $this->CreeZoneSupport()) ;
				$this->ZoneSupport->CheminFichierRelatif = $this->CheminFichierRelatifZone ;
			}
			public function CreeZoneSupport()
			{
				return new PvZoneWebSimple() ;
			}
		}
		
		class PvModeleZonePublWsm extends PvModeleZoneBaseWsm
		{
		}
		
		class PvModeleZoneAdminWsm extends PvModeleZoneBaseWsm
		{
			// Popup Admin
			public $TitreMenuPopupAdmin ;
			public function RemplitMenuPopupAdmin(& $menu)
			{
			}
			// Onglet
			public $TitreMenuOngletAdmin ;
			public function RemplitMenuOngletAdmin(& $menu)
			{
			}
		}
	}
	
?>