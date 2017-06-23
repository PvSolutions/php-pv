<?php
	
	if(! defined('ZONE_GESTENT1'))
	{
		if(! defined('SCRIPT_BASE_GESTENT1'))
		{
			include dirname(__FILE__)."/Script.class.php" ;
		}
		define('ZONE_GESTENT1', 1) ;
		
		class ZonePrincGestEnt1 extends PvZoneWebSimple
		{
			public $CheminFichierRelatif = CHEMIN_FIC_REL_ZONE_PRINC_GESTENT1 ;
			public $EntDonnees = array() ;
			protected function InitConfig()
			{
				parent::InitConfig() ;
				$this->InitEntDonnees() ;
			}
			protected function InitEntDonnees()
			{
				$this->EntMaTable1 = $this->InsereEntDonnees(new EntMaTable1GestEnt1()) ;
			}
			protected function ChargeScripts()
			{
				$this->InsereScriptParDefaut(new ScriptAccueilGestEnt1()) ;
				$this->ChargeScriptsEntDonnees() ;
			}
			protected function InsereEntDonnees($entDonnees)
			{
				$this->EntDonnees[$entDonnees->SuffixeScript] = & $entDonnees ;
				return $entDonnees ;
			}
			protected function ChargeScriptsEntDonnees()
			{
				foreach($this->EntDonnees as $nom => $entDonnees)
				{
					$entDonnees->InstalleScripts($this) ;
				}
			}
		}
	}
	
?>