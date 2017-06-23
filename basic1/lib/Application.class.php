<?php
	
	if(! defined('APPLICATION_BASIC1'))
	{
		if(! defined('CONSTS_BASIC1'))
		{
			include dirname(__FILE__)."/Consts.php" ;
		}
		if(! defined('PV_BASE'))
		{
			include dirname(__FILE__).CHEMIN_PVIEW_BASIC1."/Pv/Base.class.php" ;
		}
		if(! defined('BD_BASIC1'))
		{
			include dirname(__FILE__)."/BD.class.php" ;
		}
		if(! defined('MEMBERSHIP_BASIC1'))
		{
			include dirname(__FILE__)."/Membership.class.php" ;
		}
		if(! defined('ZONE_BASIC1'))
		{
			include dirname(__FILE__)."/Zone.class.php" ;
		}
		
		class ApplicationBasic1 extends PvApplication
		{
			public $ZonePrinc ;
			public $BDPrinc ;
			public function CreeBDPrinc()
			{
				return new BDPrincBasic1() ;
			}
			public function CreeFournBDPrinc()
			{
				$fourn = new PvFournisseurDonneesSql() ;
				$fourn->BaseDonnees = $this->BDPrinc ;
				return $fourn ;
			}
			protected function ChargeBasesDonnees()
			{
				$this->BDPrinc = $this->InsereBaseDonnees("bdPrinc", $this->CreeBDPrinc()) ;
			}
			protected function ChargeIHMs()
			{
				$this->ZonePrinc = $this->InsereIHM("zonePrinc", new ZonePrincBasic1()) ;
			}
		}
	}
	
?>