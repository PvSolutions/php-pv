<?php
	
	if(! defined('SCRIPT_NOYAU_BASIC2'))
	{
		define('SCRIPT_NOYAU_BASIC2', 1) ;
		
		class ScriptBaseBasic2 extends PvScriptWebSimple
		{
			public function CreeFournBDPrinc()
			{
				return $this->ApplicationParent->CreeFournBDPrinc() ;
			}
			public function BDPrinc()
			{
				return $this->ApplicationParent->BDPrinc() ;
			}
			public function CreeBDPrinc()
			{
				return $this->ApplicationParent->CreeBDPrinc() ;
			}
			public function CreeTablPrinc()
			{
				return new TablDonneesBaseBasic2() ;
			}
			public function CreeFormPrinc()
			{
				return new FormDonneesBaseBasic2() ;
			}
			public function CreeGrillePrinc()
			{
				return new GrilleDonneesBaseBasic2() ;
			}
		}
		
		class ScriptListBaseBasic2 extends ScriptBaseBasic2
		{
			protected $TablPrinc ;
			protected $InscrireDefColActsTablPrinc = 0 ;
			protected $InscrireFournBDPrinc = 1 ;
			protected $ReqSelectTablPrinc = "" ;
			protected $DefColActsTablPrinc ;
			protected function InitTablPrinc()
			{
			}
			protected function ChargeTablPrinc()
			{
			}
			protected function ChargeTablPrincAuto()
			{
				if($this->InscrireFournBDPrinc)
				{
					$this->TablPrinc->FournisseurDonnees = $this->CreeFournBDPrinc() ;
					$this->TablPrinc->FournisseurDonnees->RequeteSelection = $this->ReqSelectTablPrinc ;
				}
			}
			protected function InitDefColActsTablPrinc()
			{
				$this->DefColActsTablPrinc = $this->TablPrinc->InsereDefColActions("Actions") ;
			}
			protected function ChargeDefColActsTablPrinc()
			{
			}
			public function DetermineEnvironnement()
			{
				parent::DetermineEnvironnement() ;
				$this->DetermineTablPrinc() ;
			}
			protected function DetermineTablPrinc()
			{
				$this->TablPrinc = $this->CreeTablPrinc() ;
				$this->InitTablPrinc() ;
				$this->TablPrinc->AdopteScript("tablPrinc", $this) ;
				$this->TablPrinc->ChargeConfig() ;
				$this->ChargeTablPrincAuto() ;
				$this->ChargeTablPrinc() ;
				if($this->InscrireDefColActsTablPrinc == 1)
				{
					$this->InitDefColActsTablPrinc() ;
					$this->ChargeDefColActsTablPrinc() ;
				}
			}
			public function RenduSpecifique()
			{
				$ctn = '' ;
				$ctn .= $this->TablPrinc->RenduDispositif() ;
				return $ctn ;
			}
		}
		
		class ScriptEditBaseBasic2 extends ScriptBaseBasic2
		{
			protected $FormPrinc ;
			protected $PourAjout = 1 ;
			protected $FormPrincEditable = 1 ;
			protected $InscrireCmdExecFormPrinc = 1 ;
			protected $NomClasseCmdExecFormPrinc = "PvCommandeAjoutElement" ;
			protected $LibelleCmdExecFormPrinc ;
			protected $InscrireCmdAnnulFormPrinc = 1 ;
			protected $NomClasseCmdAnnulFormPrinc = "PvCommandeExecuterBase" ;
			protected $LibelleCmdAnnulFormPrinc ;
			protected $UrlRedirectAnnulFormPrinc = "" ;
			protected $InscrireFournBDPrinc = 1 ;
			protected $TablEditFormPrinc = "" ;
			protected $ReqSelectFormPrinc = "" ;
			protected function InitFormPrinc()
			{
				$this->FormPrinc->InclureElementEnCours = ($this->PourAjout) ? 0 : 1 ;
				$this->FormPrinc->InclureTotalElements = ($this->PourAjout) ? 0 : 1 ;
				$this->FormPrinc->Editable = $this->FormPrincEditable ;
				$this->FormPrinc->InscrireCommandeAnnuler = $this->InscrireCmdAnnulFormPrinc ;
				$this->FormPrinc->NomClasseCommandeAnnuler = $this->NomClasseCmdAnnulFormPrinc ;
				if($this->LibelleCmdAnnulFormPrinc != '')
				{
					$this->FormPrinc->LibelleCommandeAnnuler = $this->LibelleCmdAnnulFormPrinc ;
				}
				$this->FormPrinc->InscrireCommandeExecuter = $this->InscrireCmdExecFormPrinc ;
				$this->FormPrinc->NomClasseCommandeExecuter = $this->NomClasseCmdExecFormPrinc ;
				if($this->LibelleCmdExecFormPrinc != '')
				{
					$this->FormPrinc->LibelleCommandeExecuter = $this->LibelleCmdExecFormPrinc ;
				}
			}
			protected function ChargeFormPrinc()
			{
			}
			protected function ChargeFormPrincAuto()
			{
				if($this->UrlRedirectAnnulFormPrinc != '' && $this->InscrireCmdAnnulFormPrinc)
				{
					$this->FormPrinc->RedirigeAnnulerVersUrl($this->UrlRedirectAnnulFormPrinc) ;
				}
				if($this->InscrireFournBDPrinc)
				{
					$this->FormPrinc->FournisseurDonnees = $this->CreeFournBDPrinc() ;
					$this->FormPrinc->FournisseurDonnees->RequeteSelection = $this->ReqSelectFormPrinc ;
					$this->FormPrinc->FournisseurDonnees->TableEdition = $this->TablEditFormPrinc ;
				}
			}
			public function DetermineEnvironnement()
			{
				parent::DetermineEnvironnement() ;
				$this->DetermineFormPrinc() ;
			}
			protected function DetermineFormPrinc()
			{
				$this->FormPrinc = $this->CreeFormPrinc() ;
				$this->InitFormPrinc() ;
				$this->FormPrinc->AdopteScript("formPrinc", $this) ;
				$this->FormPrinc->ChargeConfig() ;
				$this->ChargeFormPrincAuto() ;
				$this->ChargeFormPrinc() ;
			}
			public function RenduSpecifique()
			{
				$ctn = '' ;
				$ctn .= $this->FormPrinc->RenduDispositif() ;
				return $ctn ;
			}
		}
				
	}
	
?>