<?php
	
	if(! defined('SCRIPT_NOYAU_BASIC1'))
	{
		define('SCRIPT_NOYAU_BASIC1', 1) ;
		
		class ScriptBaseBasic1 extends PvScriptWebSimple
		{
			public function CreeFournBDPrinc()
			{
				return $this->ApplicationParent->CreeFournBDPrinc() ;
			}
			public function & BDPrinc()
			{
				return $this->ApplicationParent->BDPrinc() ;
			}
			public function CreeBDPrinc()
			{
				return $this->ApplicationParent->CreeBDPrinc() ;
			}
			public function CreeTablPrinc()
			{
				return new TablDonneesBaseBasic1() ;
			}
			public function CreeFormPrinc()
			{
				return new FormDonneesBaseBasic1() ;
			}
		}
		
		class ScriptListBaseBasic1 extends ScriptBaseBasic1
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
		
		class ScriptEditBaseBasic1 extends ScriptBaseBasic1
		{
			protected $FormPrinc ;
			protected $PourAjout = 1 ;
			protected $FormPrincEditable = 1 ;
			protected $InscrireCmdExecFormPrinc = 1 ;
			protected $NomClasseCmdExecFormPrinc = "PvCommandeAjoutElement" ;
			protected $InscrireCmdAnnulFormPrinc = 1 ;
			protected $NomClasseCmdAnnulFormPrinc = "PvCommandeExecuterBase" ;
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
				$this->FormPrinc->InscrireCommandeExecuter = $this->InscrireCmdExecFormPrinc ;
				$this->FormPrinc->NomClasseCommandeExecuter = $this->NomClasseCmdExecFormPrinc ;
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