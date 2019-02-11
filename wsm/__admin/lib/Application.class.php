<?php
	
	if(! defined('APPLICATION_WSM2'))
	{
		if(! defined('CONSTS_WSM2'))
		{
			include dirname(__FILE__)."/../consts/Consts.php" ;
		}
		if(! defined('PV_BASE'))
		{
			include dirname(__FILE__).CHEMIN_PVIEW_WSM2."/Pv/Base.class.php" ;
		}
		if(! defined('PV_BOOTSTRAP'))
		{
			include dirname(__FILE__).CHEMIN_PVIEW_WSM2."/Pv/IHM/Bootstrap.class.php" ;
		}
		if(! defined('BD_WSM2'))
		{
			include dirname(__FILE__)."/BD.class.php" ;
		}
		if(! defined('MEMBERSHIP_WSM2'))
		{
			include dirname(__FILE__)."/Membership.class.php" ;
		}
		if(! defined('COMPOSANT_APP_BASE_WSM2'))
		{
			include dirname(__FILE__)."/ComposantApp.class.php" ;
		}
		if(! defined('ZONE_PUBL_WSM2'))
		{
			include dirname(__FILE__)."/ZonePubl.class.php" ;
		}
		if(! defined('ZONE_ADMIN_WSM2'))
		{
			include dirname(__FILE__)."/ZoneAdmin.class.php" ;
		}
		
		class ApplicationWsm2 extends PvApplication
		{
			public $ZonePubl ;
			public $ZoneAdmin ;
			public $SiteWsm ;
			public function BDPrinc()
			{
				return $this->CreeBDPrinc() ;
			}
			public function CreeBDPrinc()
			{
				return new BDPrincWsm2() ;
			}
			public function CreeFournBDPrinc()
			{
				$fourn = new PvFournisseurDonneesSql() ;
				$fourn->BaseDonnees = $this->CreeBDPrinc() ;
				return $fourn ;
			}
			public function ChargeConfig()
			{
				parent::ChargeConfig() ;
				$this->ChargeSiteWsm() ;
			}
			protected function ChargeSiteWsm()
			{
				$this->SiteWsm = new SiteWebWsm2() ;
				$this->SiteWsm->AdopteApplication("siteWeb", $this) ;
				$this->SiteWsm->ChargeConfig() ;
			}
			protected function ChargeIHMs()
			{
				$this->ZonePubl = $this->InsereIHM("zonePubl", new ZonePublWsm2()) ;
				$this->ZoneAdmin = $this->InsereIHM("zoneAdmin", new ZoneAdminWsm2()) ;
			}
		}
	}
	
?>