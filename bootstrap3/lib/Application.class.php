<?php
	
	if(! defined('APPLICATION_BOOTSTRAP3'))
	{
		if(! defined('CONSTS_BOOTSTRAP3'))
		{
			include dirname(__FILE__)."/../consts/Consts.php" ;
		}
		if(! defined('PV_BASE'))
		{
			include dirname(__FILE__).CHEMIN_PVIEW_BOOTSTRAP3."/Pv/Base.class.php" ;
		}
		if(! defined('PV_BOOTSTRAP'))
		{
			include dirname(__FILE__).CHEMIN_PVIEW_BOOTSTRAP3."/Pv/IHM/Bootstrap.class.php" ;
		}
		if(! defined('BD_BOOTSTRAP3'))
		{
			include dirname(__FILE__)."/BD.class.php" ;
		}
		if(! defined('MEMBERSHIP_BOOTSTRAP3'))
		{
			include dirname(__FILE__)."/Membership.class.php" ;
		}
		if(! defined('COMPOSANT_APP_BASE_BOOTSTRAP3'))
		{
			include dirname(__FILE__)."/ComposantApp.class.php" ;
		}
		if(! defined('ZONE_BOOTSTRAP3'))
		{
			include dirname(__FILE__)."/Zone.class.php" ;
		}
		
		class ApplicationBootstrap3 extends PvApplication
		{
			public $ZonePrinc ;
			public function BDPrinc()
			{
				return $this->CreeBDPrinc() ;
			}
			public function CreeBDPrinc()
			{
				return new BDPrincBootstrap3() ;
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
				$this->ZonePrinc = $this->InsereIHM("zonePrinc", new ZonePrincBootstrap3()) ;
			}
		}
	}
	
?>