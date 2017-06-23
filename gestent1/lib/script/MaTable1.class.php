<?php
	
	if(! defined('SCRIPT_MATABLE1_GESTENT1'))
	{
		define('SCRIPT_MATABLE1_GESTENT1', 1) ;
		
		class EntMaTable1GestEnt1 extends EntDonneesBaseGestEnt1
		{
			public $SuffixeScript = "ma_table1" ;
			protected function CreeScriptAjout()
			{
				return new ScriptAjoutMaTable1GestEnt1() ;
			}
			protected function CreeScriptModif()
			{
				return new ScriptModifMaTable1GestEnt1() ;
			}
			protected function CreeScriptSuppr()
			{
				return new ScriptSupprMaTable1GestEnt1() ;
			}
			protected function CreeScriptList()
			{
				return new ScriptListMaTable1GestEnt1() ;
			}
		}
		
		class ScriptListMaTable1GestEnt1 extends ScriptListEntDonneesGestEnt1
		{
			public $Titre = "Liste de matable1" ;
			protected $DefColId ;
			protected $DefColChamp1 ;
			protected $DefColChamp3 ;
			protected $ReqSelectTablPrinc = "matable1" ;
			protected function ChargeTablPrinc()
			{
				$this->DefColId = $this->TablPrinc->InsereDefColCachee("id") ;
				$this->DefColChamp1 = $this->TablPrinc->InsereDefCol("champ1", "Champ 1") ;
				$this->DefColChamp3 = $this->TablPrinc->InsereDefCol("champ3", "Champ 3") ;
			}
			protected function ChargeDefColActsPrinc()
			{
				$this->CmdAjout = $this->TablPrinc->InsereCmdRedirectUrl('ajout', '?appelleScript=ajout_ma_table1', 'Ajout') ;
				$this->LienModif = $this->TablPrinc->InsereLienAction($this->DefColActsPrinc, '?appelleScript=modif_ma_table1&id=${id}', 'Modifier') ;
				$this->LienSuppr = $this->TablPrinc->InsereLienAction($this->DefColActsPrinc, '?appelleScript=suppr_ma_table1&id=${id}', 'Supprimer') ;
			}
		}
		
		class ScriptEditMaTable1GestEnt1 extends ScriptEditEntDonneesGestEnt1
		{
			protected $ReqSelectFormPrinc = "matable1" ;
			protected $TablEditFormPrinc = "matable1" ;
			protected $UrlRedirectAnnulFormPrinc = "?appelleScript=list_ma_table1" ;
			protected $TitreLienList = "Ma table 1" ;
			protected function ChargeSommairePrinc()
			{
				$this->FltId = $this->SommairePrinc->InsereFltLgSelectHttpGet("id") ;
				$this->FltChamp1 = $this->SommairePrinc->InsereFltEditHttpPost("champ1", "champ1") ;
			}
			protected function ChargeFormPrinc()
			{
				$this->FltId = $this->FormPrinc->InsereFltLgSelectHttpGet("id", "id = <self>") ;
				$this->FltChamp1 = $this->FormPrinc->InsereFltEditHttpPost("champ1", "champ1") ;
				$this->FltChamp2 = $this->FormPrinc->InsereFltEditHttpPost("champ2", "champ2") ;
				$this->FltChamp3 = $this->FormPrinc->InsereFltEditHttpPost("champ3", "champ3") ;
			}
		}
		class ScriptAjoutMaTable1GestEnt1 extends ScriptEditMaTable1GestEnt1
		{
			protected $PourAjout = 1 ;
			public $Titre = "Ajout matable1" ;
			protected $NomClasseCmdExecFormPrinc = "PvCommandeAjoutElement" ;
		}
		class ScriptModifMaTable1GestEnt1 extends ScriptEditMaTable1GestEnt1
		{
			protected $PourAjout = 0 ;
			public $Titre = "Modification matable1" ;
			protected $NomClasseCmdExecFormPrinc = "PvCommandeModifElement" ;
		}
		class ScriptSupprMaTable1GestEnt1 extends ScriptModifMaTable1GestEnt1
		{
			protected $FormPrincEditable = 0 ;
			public $Titre = "Suppression matable1" ;
			protected $NomClasseCmdExecFormPrinc = "PvCommandeSupprElement" ;
		}
	}
	
?>