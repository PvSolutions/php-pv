<?php
	
	if(! defined('APPLICATION_BASIC2'))
	{
		if(! defined('CONSTS_BASIC2'))
		{
			include dirname(__FILE__)."/Consts.php" ;
		}
		if(! defined('PV_BASE'))
		{
			include dirname(__FILE__).CHEMIN_PVIEW_BASIC2."/Pv/Base.class.php" ;
		}
		if(! defined('BD_BASIC2'))
		{
			include dirname(__FILE__)."/BD.class.php" ;
		}
		if(! defined('MEMBERSHIP_BASIC2'))
		{
			include dirname(__FILE__)."/Membership.class.php" ;
		}
		if(! defined('COMPOSANT_APP_BASE_BASIC2'))
		{
			include dirname(__FILE__)."/ComposantApp.class.php" ;
		}
		if(! defined('ZONE_BASIC2'))
		{
			include dirname(__FILE__)."/Zone.class.php" ;
		}
		
		class ApplicationBasic2 extends PvApplication
		{
			public $ZonePrinc ;
			public function BDPrinc()
			{
				return $this->CreeBDPrinc() ;
			}
			public function CreeBDPrinc()
			{
				return new BDPrincBasic2() ;
			}
			public function CreeFournBDPrinc()
			{
				$fourn = new PvFournisseurDonneesSql() ;
				$fourn->BaseDonnees = $this->CreeBDPrinc() ;
				return $fourn ;
			}
			protected function ChargeBasesDonnees()
			{
			}
			protected function ChargeIHMs()
			{
				$this->ZonePrinc = $this->InsereIHM("zonePrinc", new ZonePrincBasic2()) ;
			}
		}
	}
	
?>