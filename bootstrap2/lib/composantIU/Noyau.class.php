<?php
	
	if(! defined('COMPOSANT_IU_NOYAU_BOOTSTRAP2'))
	{
		define('COMPOSANT_IU_NOYAU_BOOTSTRAP2', 1) ;
		
		class ComposantIUBaseBootstrap2 extends PvComposantIUBase
		{
		}
		
		class TablDonneesBaseBootstrap2 extends PvTableauDonneesBootstrap
		{
		}
		class FormDonneesBaseBootstrap2 extends PvFormulaireDonneesBootstrap
		{
		}
		class GrilleDonneesBaseBootstrap2 extends PvGrilleDonneesBootstrap
		{
		}
		
		class CmdAnnulBaseBootstrap2 extends PvCommandeAnnulerBase
		{
		}
		class CmdExecBaseBootstrap2 extends PvCommandeExecuterBase
		{
		}
	}
	
?>