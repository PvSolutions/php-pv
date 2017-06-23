<?php
	
	if(! defined('APP_TM51543'))
	{		
		if(! defined('CONSTS_TM51543'))
		{
			include dirname(__FILE__)."/Consts.php" ;
		}
		if(! defined('SYSTEME_TM51543'))
		{
			include dirname(__FILE__)."/Systeme.class.php" ;
		}
		if(! defined('MEMBERSHIP_TM51543'))
		{
			include dirname(__FILE__)."/Membership.class.php" ;
		}
		if(! defined('COMPOSANT_TM51543'))
		{
			include dirname(__FILE__)."/Composant.class.php" ;
		}
		if(! defined('ZONE_TM51543'))
		{
			include dirname(__FILE__)."/Zone.class.php" ;
		}
		define('APP_TM51543', 1) ;
		
		class ApplicationTM51543 extends PvApplication
		{
			public $BDPrinc ;
			public $ZonePubl ;
			public $ZoneAdmin ;
			public $ChemFicRelZonePubl = CHEMIN_FIC_REL_PUBL_TM51543 ;
			public $ChemFicRelZoneAdmin = CHEMIN_FIC_REL_ADMIN_TM51543 ;
			public $SystemeSws ;
			public function ChargeConfig()
			{
				parent::ChargeConfig() ;
				$this->ChargeSystemeSws() ;
			}
			protected function ChargeSystemeSws()
			{
				$this->SystemeSws = new SystemeSwsTM51543() ;
				$this->SystemeSws->BDSupport = new BDTM51543() ;
				$this->SystemeSws->Execute() ;
			}
			protected function ChargeBasesDonnees()
			{
				parent::ChargeBasesDonnees() ;
				$this->BDPrinc = new BDTM51543() ;
				$this->InscritBaseDonnees("princ", $this->BDPrinc) ;
			}
			public function ChargeIHMs()
			{
				parent::ChargeIHMs() ;
				$this->ZonePubl = new ZonePublTM51543() ;
				$this->ZonePubl->AutoriserInscription = 1 ;
				$this->ZonePubl->CheminFichierRelatif = $this->ChemFicRelZonePubl ;
				$this->InscritIHM("publ", $this->ZonePubl) ;
				$this->ZoneAdmin = new ZoneAdminTM51543() ;
				$this->ZoneAdmin->CheminFichierRelatif = $this->ChemFicRelZoneAdmin ;
				$this->InscritIHM("admin", $this->ZoneAdmin) ;
			}
		}
		
	}
	
?>