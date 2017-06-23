<?php
	
	if(! defined('APP_MONSITE'))
	{		
		if(! defined('CONSTS_MONSITE'))
		{
			include dirname(__FILE__)."/Consts.php" ;
		}
		if(! defined('SYSTEME_MONSITE'))
		{
			include dirname(__FILE__)."/Systeme.class.php" ;
		}
		if(! defined('MEMBERSHIP_MONSITE'))
		{
			include dirname(__FILE__)."/Membership.class.php" ;
		}
		if(! defined('COMPOSANT_MONSITE'))
		{
			include dirname(__FILE__)."/Composant.class.php" ;
		}
		if(! defined('ZONE_MONSITE'))
		{
			include dirname(__FILE__)."/Zone.class.php" ;
		}
		define('APP_MONSITE', 1) ;
		
		class ApplicationMonSite extends PvApplication
		{
			public $BDPrinc ;
			public $ZonePubl ;
			public $ZoneAdmin ;
			public $ChemFicRelZonePubl = CHEMIN_FIC_REL_PUBL_MONSITE ;
			public $ChemFicRelZoneAdmin = CHEMIN_FIC_REL_ADMIN_MONSITE ;
			public $SystemeSws ;
			public function ChargeConfig()
			{
				parent::ChargeConfig() ;
				$this->ChargeSystemeSws() ;
			}
			protected function ChargeSystemeSws()
			{
				$this->SystemeSws = new SystemeSwsMonSite() ;
				$this->SystemeSws->BDSupport = new BDMonSite() ;
				$this->SystemeSws->Execute() ;
			}
			protected function ChargeBasesDonnees()
			{
				parent::ChargeBasesDonnees() ;
				$this->BDPrinc = new BDMonSite() ;
				$this->InscritBaseDonnees("princ", $this->BDPrinc) ;
			}
			public function ChargeIHMs()
			{
				parent::ChargeIHMs() ;
				$this->ZonePubl = new ZonePublMonSite() ;
				$this->ZonePubl->AutoriserInscription = 1 ;
				$this->ZonePubl->CheminFichierRelatif = $this->ChemFicRelZonePubl ;
				$this->InscritIHM("publ", $this->ZonePubl) ;
				$this->ZoneAdmin = new ZoneAdminMonSite() ;
				$this->ZoneAdmin->CheminFichierRelatif = $this->ChemFicRelZoneAdmin ;
				$this->InscritIHM("admin", $this->ZoneAdmin) ;
			}
		}
		
	}
	
?>