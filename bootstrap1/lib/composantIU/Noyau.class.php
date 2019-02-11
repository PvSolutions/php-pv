<?php
	
	if(! defined('COMPOSANT_IU_NOYAU_BOOTSTRAP1'))
	{
		define('COMPOSANT_IU_NOYAU_BOOTSTRAP1', 1) ;
		
		class ComposantIUBaseBootstrap1 extends PvComposantIUBase
		{
		}
		
		class TablDonneesBaseBootstrap1 extends PvTableauDonneesBootstrap
		{
		}
		class FormDonneesBaseBootstrap1 extends PvFormulaireDonneesBootstrap
		{
		}
		class GrilleDonneesBaseBootstrap1 extends PvGrilleDonneesBootstrap
		{
		}
		
		class CmdAnnulBaseBootstrap1 extends PvCommandeAnnulerBase
		{
		}
		class CmdExecBaseBootstrap1 extends PvCommandeExecuterBase
		{
		}
	}
	
?>