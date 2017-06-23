<?php
	
	if(! defined('SCRIPT_NOYAU_GESTENT1'))
	{
		define('SCRIPT_NOYAU_GESTENT1', 1) ;
		
		class FormDonneesBaseGestEnt1 extends PvFormulaireDonneesHtml
		{
		}
		class TablDonneesBaseGestEnt1 extends PvTableauDonneesHtml
		{
		}
		class FilArianeDonneesGestEnt1 extends PvFilArianeDonneesHtml
		{
		}
		
		class ScriptBaseGestEnt1 extends PvScriptWebSimple
		{
			public function BDPrinc()
			{
				return $this->ApplicationParent->ObtientBDPrinc() ;
			}
			public function ObtientBDPrinc()
			{
				return $this->ApplicationParent->ObtientBDPrinc() ;
			}
			public function CreeFournBDPrinc()
			{
				return $this->ApplicationParent->CreeFournBDPrinc() ;
			}
			protected function CreeTablPrinc()
			{
				return new TablDonneesBaseGestEnt1() ;
			}
			protected function CreeFormPrinc()
			{
				return new FormDonneesBaseGestEnt1() ;
			}
		}
		
		class EntDonneesBaseGestEnt1
		{
			public $SuffixeScript = "base" ;
			protected $ScriptAjout ;
			protected $ScriptModif ;
			protected $ScriptSuppr ;
			protected $ScriptList ;
			public function InstalleScripts(& $zone)
			{
				$this->PrepareInstallation() ;
				$this->InstalleScriptsAuto($zone) ;
				$this->InstalleScriptsSpec($zone) ;
			}
			protected function PrepareInstallation()
			{
			}
			protected function CreeScriptAjout()
			{
				return ScriptEditEntDonneesGestEnt1() ;
			}
			protected function CreeScriptModif()
			{
				return ScriptEditEntDonneesGestEnt1() ;
			}
			protected function CreeScriptSuppr()
			{
				return ScriptEditEntDonneesGestEnt1() ;
			}
			protected function CreeScriptList()
			{
				return ScriptListEntDonneesGestEnt1() ;
			}
			protected function InstalleScriptsAuto(& $zone)
			{
				$this->ScriptAjout = $this->InstalleScript("ajout", $this->CreeScriptAjout(), $zone) ;
				$this->ScriptModif = $this->InstalleScript("modif", $this->CreeScriptModif(), $zone) ;
				$this->ScriptSuppr = $this->InstalleScript("suppr", $this->CreeScriptSuppr(), $zone) ;
				$this->ScriptList = $this->InstalleScript("list", $this->CreeScriptList(), $zone) ;
			}
			protected function InstalleScriptsSpec(& $zone)
			{
			}
			protected function InstalleScript($nomScript, $script, & $zone)
			{
				$zone->InsereScript($nomScript."_".$this->SuffixeScript, $script) ;
				$script->NomEntDonnees = $this->SuffixeScript ;
			}
		}
		
		class ScriptDonneesGestEnt1 extends ScriptBaseGestEnt1
		{
			public $NomEntDonnees ;
			public function & EntDonnees()
			{
				return $this->ZoneParent->EntDonnees[$this->NomEntDonnees] ;
			}
		}
		
		class ScriptListEntDonneesGestEnt1 extends ScriptDonneesGestEnt1
		{
			public $EstScriptSession = 1 ;
			protected $TablPrinc ;
			protected $InscrireFournBDPrinc = 1 ;
			protected $InscrireDefColActsPrinc = 1 ;
			protected $ReqSelectTablPrinc = "" ;
			protected $DefColActsPrinc ;
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
			protected function ChargeDefColActsPrinc()
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
				if($this->InscrireDefColActsPrinc)
				{
					$this->DefColActsPrinc = $this->TablPrinc->InsereDefColActions("Actions") ;
					$this->ChargeDefColActsPrinc() ;
				}
			}
			public function RenduSpecifique()
			{
				$ctn = '' ;
				$ctn .= $this->TablPrinc->RenduDispositif() ;
				return $ctn ;
			}
		}
		class ScriptEditBaseGestEnt1 extends ScriptDonneesGestEnt1
		{
			protected $FormPrinc ;
			protected $PourAjout = 1 ;
			protected $FormPrincEditable = 1 ;
			protected $MaxFltsParLigneFormPrinc = 1 ;
			protected $InscrireCmdExecFormPrinc = 1 ;
			protected $NomClasseCmdExecFormPrinc = "PvCommandeAjoutElement" ;
			protected $InscrireCmdAnnulFormPrinc = 1 ;
			protected $NomClasseCmdAnnulFormPrinc = "PvCommandeAnnulerBase" ;
			protected $UrlRedirectAnnulFormPrinc = "" ;
			protected $InscrireFournBDPrinc = 1 ;
			protected $TablEditFormPrinc = "" ;
			protected $ReqSelectFormPrinc = "" ;
			protected function DetermineFormPrinc()
			{
				$this->FormPrinc = $this->CreeFormPrinc() ;
				$this->InitFormPrinc() ;
				$this->FormPrinc->AdopteScript("formPrinc", $this) ;
				$this->FormPrinc->ChargeConfig() ;
				$this->ChargeFormPrincAuto() ;
				$this->ChargeFormPrinc() ;
			}
			protected function InitFormPrinc()
			{
				$this->FormPrinc->InclureElementEnCours = ($this->PourAjout) ? 0 : 1 ;
				$this->FormPrinc->InclureTotalElements = ($this->PourAjout) ? 0 : 1 ;
				$this->FormPrinc->Editable = $this->FormPrincEditable ;
				$this->FormPrinc->InscrireCommandeAnnuler = $this->InscrireCmdAnnulFormPrinc ;
				$this->FormPrinc->NomClasseCommandeAnnuler = $this->NomClasseCmdAnnulFormPrinc ;
				$this->FormPrinc->InscrireCommandeExecuter = $this->InscrireCmdExecFormPrinc ;
				$this->FormPrinc->NomClasseCommandeExecuter = $this->NomClasseCmdExecFormPrinc ;
				$this->FormPrinc->MaxFiltresEditionParLigne = $this->MaxFltsParLigneFormPrinc ;
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
			public function RenduSpecifique()
			{
				$ctn = '' ;
				$ctn .= $this->FormPrinc->RenduDispositif() ;
				return $ctn ;
			}
		}
		class ScriptEditEntDonneesGestEnt1 extends ScriptEditBaseGestEnt1
		{
			protected $SommairePrinc ;
			protected $FilArianePrinc ;
			protected $InclureLienList = 1 ;
			protected $TitreLienList = "Liste" ;
			public function DetermineEnvironnement()
			{
				parent::DetermineEnvironnement() ;
				if($this->PourAjout == 0)
				{
					$this->DetermineSommairePrinc() ;
					$this->DetermineFilArianePrinc() ;
				}
			}
			protected function DetermineFilArianePrinc()
			{
				$this->FilArianePrinc = $this->CreeFilArianePrinc() ;
				$this->InitFilArianePrinc() ;
				$this->FilArianePrinc->AdopteScript("FilArianePrinc", $this) ;
				$this->FilArianePrinc->ChargeConfig() ;
				$this->ChargeFilArianePrinc() ;
				$this->ChargeFilArianePrincAuto() ;
			}
			protected function CreeFilArianePrinc()
			{
				return new FilArianeDonneesGestEnt1() ;
			}
			protected function InitFilArianePrinc()
			{
			}
			protected function ChargeFilArianePrinc()
			{
			}
			protected function ChargeFilArianePrincAuto()
			{
				if($this->InclureLienList == 1)
				{
					$this->DefLienList = $this->FilArianePrinc->InsereDefLienFixe($this->UrlRedirectAnnulFormPrinc, $this->TitreLienList) ;
					$this->DefLienList->Recursif = 0 ;
				}
			}
			protected function DetermineSommairePrinc()
			{
				$this->SommairePrinc = $this->CreeSommairePrinc() ;
				$this->InitSommairePrinc() ;
				$this->SommairePrinc->AdopteScript("sommairePrinc", $this) ;
				$this->SommairePrinc->ChargeConfig() ;
				$this->ChargeSommairePrincAuto() ;
				$this->ChargeSommairePrinc() ;
			}
			protected function CreeSommairePrinc()
			{
				return new FormDonneesBaseGestEnt1() ;
			}
			protected function InitSommairePrinc()
			{
				$this->SommairePrinc->InclureElementEnCours = 1 ;
				$this->SommairePrinc->InclureTotalElements = 1 ;
				$this->SommairePrinc->Editable = 0 ;
				$this->SommairePrinc->NomClasseCommandeAnnuler = "PvCommandeAnnulerBase" ;
				$this->SommairePrinc->InscrireCommandeExecuter = 0 ;
			}
			protected function ChargeSommairePrinc()
			{
			}
			protected function ChargeSommairePrincAuto()
			{
				if($this->UrlRedirectAnnulFormPrinc != '' && $this->InscrireCmdAnnulFormPrinc)
				{
					$this->SommairePrinc->RedirigeAnnulerVersUrl($this->UrlRedirectAnnulFormPrinc) ;
				}
				if($this->InscrireFournBDPrinc)
				{
					$this->SommairePrinc->FournisseurDonnees = $this->CreeFournBDPrinc() ;
					$this->SommairePrinc->FournisseurDonnees->RequeteSelection = $this->ReqSelectFormPrinc ;
					$this->SommairePrinc->FournisseurDonnees->TablEdition = $this->TablEditFormPrinc ;
				}
			}
			protected function RenduDispositifBrut()
			{
				$ctn = '' ;
				if($this->PourAjout == 0)
				{
					$ctn .= $this->FilArianePrinc->RenduDispositif().PHP_EOL ;
					$ctn .= $this->RenduTitre() ;
					$ctn .= $this->SommairePrinc->RenduDispositif().PHP_EOL ;
					if($this->SommairePrinc->ElementEnCoursTrouve)
					{
						$ctn .= '<hr />'.PHP_EOL ;
						$ctn .= $this->FormPrinc->RenduDispositif().PHP_EOL ;
					}
				}
				else
				{
					$ctn .= $this->RenduTitre() ;
					$ctn .= $this->FormPrinc->RenduDispositif().PHP_EOL ;
				}
				return $ctn ;
			}
		}
	}
	
?>