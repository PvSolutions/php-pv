<?php
	
	if(! defined('COMPOSANT_IU_NOYAU_BASIC2'))
	{
		define('COMPOSANT_IU_NOYAU_BASIC2', 1) ;
		
		class ComposantIUBaseBasic2 extends PvComposantIUBase
		{
		}
		
		class TablDonneesBaseBasic2 extends PvTableauDonneesHtml
		{
		}
		class FormDonneesBaseBasic2 extends PvFormulaireDonneesHtml
		{
		}
		class GrilleDonneesBaseBasic2 extends PvGrilleDonneesHtml
		{
		}
		
		class CmdAnnulBaseBasic2 extends PvCommandeAnnulerBase
		{
		}
		class CmdExecBaseBasic2 extends PvCommandeExecuterBase
		{
		}
	}
	
?>