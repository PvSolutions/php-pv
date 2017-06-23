<?php
	
	if(! defined('APPLICATION_GESTENT1'))
	{
		if(! defined('CONSTS_GESTENT1'))
		{
			include dirname(__FILE__)."/Consts.php" ;
		}
		if(! defined('PV_BASE'))
		{
			include dirname(__FILE__).CHEMIN_PVIEW."/Pv/Base.class.php" ;
		}
		if(! defined('BD_GESTENT1'))
		{
			include dirname(__FILE__)."/BD.class.php" ;
		}
		if(! defined('ZONE_GESTENT1'))
		{
			include dirname(__FILE__)."/Zone.class.php" ;
		}
		
		class ApplicationGestEnt1 extends PvApplication
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
				$this->BDPrinc = $this->InsereBaseDonnees("bdPrinc", new BDPrincGestEnt1()) ;
			}
			protected function ChargeIHMs()
			{
				$this->ZonePrinc = $this->InsereIHM("zonePrinc", new ZonePrincGestEnt1()) ;
			}
		}
	}
	
?>