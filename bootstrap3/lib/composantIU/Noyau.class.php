<?php
	
	if(! defined('COMPOSANT_IU_NOYAU_BOOTSTRAP3'))
	{
		define('COMPOSANT_IU_NOYAU_BOOTSTRAP3', 1) ;
		
		class ComposantIUBaseBootstrap3 extends PvComposantIUBase
		{
		}
		
		class TablDonneesBaseBootstrap3 extends PvTableauDonneesBootstrap
		{
		}
		class FormDonneesBaseBootstrap3 extends PvFormulaireDonneesBootstrap
		{
		}
		class GrilleDonneesBaseBootstrap3 extends PvGrilleDonneesBootstrap
		{
		}
		
		class CmdAnnulBaseBootstrap3 extends PvCommandeAnnulerBase
		{
		}
		class CmdExecBaseBootstrap3 extends PvCommandeExecuterBase
		{
		}
	}
	
?>