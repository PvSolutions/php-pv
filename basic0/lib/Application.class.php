<?php
	
	if(! defined('APPLICATION_BASIC0'))
	{
		if(! defined('CONSTS_BASIC0'))
		{
			include dirname(__FILE__)."/Consts.php" ;
		}
		if(! defined('PV_BASE'))
		{
			include dirname(__FILE__).CHEMIN_PVIEW_BASIC0."/Pv/Base.class.php" ;
		}
		if(! defined('BD_BASIC0'))
		{
			include dirname(__FILE__)."/BD.class.php" ;
		}
		if(! defined('MEMBERSHIP_BASIC0'))
		{
			include dirname(__FILE__)."/Membership.class.php" ;
		}
		if(! defined('ZONE_BASIC0'))
		{
			include dirname(__FILE__)."/Zone.class.php" ;
		}
		
		class ApplicationBasic0 extends PvApplication
		{
			public $ZonePrinc ;
			public $BDPrinc ;
			public function CreeFournBDPrinc()
			{
				$fourn = new PvFournisseurDonneesSql() ;
				$fourn->BaseDonnees = $this->BDPrinc ;
				return $fourn ;
			}
			protected function ChargeBasesDonnees()
			{
				$this->BDPrinc = $this->InsereBaseDonnees("bdPrinc", new BDPrincBasic0()) ;
			}
			protected function ChargeIHMs()
			{
				$this->ZonePrinc = $this->InsereIHM("zonePrinc", new ZonePrincBasic0()) ;
			}
		}
	}
	
?>