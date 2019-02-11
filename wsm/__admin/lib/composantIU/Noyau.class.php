<?php
	
	if(! defined('COMPOSANT_IU_NOYAU_WSM2'))
	{
		define('COMPOSANT_IU_NOYAU_WSM2', 1) ;
		
		class ComposantIUBaseWsm2 extends PvComposantIUBase
		{
		}
		
		class TablDonneesBaseAdminWsm2 extends PvTableauDonneesBootstrap
		{
		}
		class FormDonneesBaseAdminWsm2 extends PvFormulaireDonneesBootstrap
		{
		}
		class GrilleDonneesBaseAdminWsm2 extends PvGrilleDonneesBootstrap
		{
		}
		
		class TablDonneesBaseWsm2 extends PvTableauDonneesHtml
		{
		}
		class FormDonneesBaseWsm2 extends PvFormulaireDonneesHtml
		{
		}
		class GrilleDonneesBaseWsm2 extends PvGrilleDonneesHtml
		{
		}
		
		class CmdAnnulBaseWsm2 extends PvCommandeAnnulerBase
		{
		}
		class CmdExecBaseWsm2 extends PvCommandeExecuterBase
		{
		}
	}
	
?>