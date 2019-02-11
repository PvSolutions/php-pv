<?php
	
	if(! defined('COMPOSANT_IU_NOYAU_BASIC3'))
	{
		define('COMPOSANT_IU_NOYAU_BASIC3', 1) ;
		
		class ComposantIUBaseBasic3 extends PvComposantIUBase
		{
		}
		
		class TablDonneesBaseBasic3 extends PvTableauDonneesHtml
		{
		}
		class FormDonneesBaseBasic3 extends PvFormulaireDonneesHtml
		{
		}
		class GrilleDonneesBaseBasic3 extends PvGrilleDonneesHtml
		{
		}
		
		class CmdAnnulBaseBasic3 extends PvCommandeAnnulerBase
		{
		}
		class CmdExecBaseBasic3 extends PvCommandeExecuterBase
		{
		}
	}
	
?>