<?php
	
	if(! defined('SCRIPT_NOYAU_BOOTSTRAP3'))
	{
		define('SCRIPT_NOYAU_BOOTSTRAP3', 1) ;
		
		class ScriptBaseBootstrap3 extends PvScriptWebSimple
		{
			public $NomDocumentWeb = "connecte" ;
			public $NecessiteMembreConnecte = 1 ;
			public $ContenuJsFermeDlg = "" ;
			protected function ContenuLiensPrinc()
			{
				$ctn = '' ;
				return $ctn ;
			}
			protected function RenduLiensPrinc()
			{
				$ctn = '' ;
				$ctnLiensPrinc = $this->ContenuLiensPrinc() ;
				if($ctnLiensPrinc != '')
				{
					$ctn .= '<div class="panel panel-default">
<div class="panel-heading">'.$ctnLiensPrinc.'</div>
</div>'.PHP_EOL ;
				}
				return $ctn ;
			}
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
				return new TablDonneesBaseBootstrap3() ;
			}
			public function CreeFormPrinc()
			{
				return new FormDonneesBaseBootstrap3() ;
			}
			public function CreeGrillePrinc()
			{
				return new GrilleDonneesBaseBootstrap3() ;
			}
			public function EstAccessible()
			{
				if($this->NomDocumentWeb == "connecte" && $this->ContenuJsFermeDlg == '')
				{
					$this->ContenuJsFermeDlg = "window.location.href = window.location.href" ;
				}
				return parent::EstAccessible() ;
			}
		}
		
		class ScriptListBaseBootstrap3 extends ScriptBaseBootstrap3
		{
			public $TablPrinc ;
			protected $InscrireDefColActsTablPrinc = 0 ;
			protected $InscrireFournBDPrinc = 1 ;
			protected $ReqSelectTablPrinc = "" ;
			protected $DefColActsTablPrinc ;
			protected $InscrireLiensEdit = 0 ;
			protected $InscrireLienAjout = 0 ;
			protected $UrlLienAjout = "" ;
			protected $UrlLienDetail = "" ;
			protected $UrlLienModif = "" ;
			protected $UrlLienSuppr = "" ;
			protected function InitTablPrinc()
			{
			}
			protected function ChargeTablPrinc()
			{
			}
			protected function ChargeTablPrincAuto()
			{
				$this->DessinateurFiltresSelection = new DessinFiltresPrincBootstrap3() ;
				if($this->InscrireFournBDPrinc)
				{
					$this->TablPrinc->FournisseurDonnees = $this->CreeFournBDPrinc() ;
					$this->TablPrinc->FournisseurDonnees->RequeteSelection = $this->ReqSelectTablPrinc ;
				}
			}
			protected function ContenuLiensPrinc()
			{
				$ctn = '' ;
				if($this->UrlLienAjout != '')
				{
					$ctn .= '<a class="btn btn-default" href="'.htmlspecialchars($this->UrlLienAjout).'">'.$this->ZoneParent->LibelleLienAjout.'</a>' ;
				}
				return $ctn ;
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
				$this->TablPrinc->SourceValeursSuppl = new SrcValsSupplLgnDonneesBootstrap3() ;
				$this->ChargeTablPrincAuto() ;
				$this->ChargeTablPrinc() ;
				if($this->InscrireDefColActsTablPrinc == 1)
				{
					$this->InitDefColActsTablPrinc() ;
					if($this->UrlLienDetail != '')
					{
						$this->LienModif = $this->TablPrinc->InsereLienAction($this->DefColActsTablPrinc, $this->UrlLienDetail, $this->ZoneParent->LibelleLienDetail) ;
					}
					if($this->UrlLienModif != '')
					{
						$this->LienModif = $this->TablPrinc->InsereLienAction($this->DefColActsTablPrinc, $this->UrlLienModif, $this->ZoneParent->LibelleLienModif) ;
					}
					$this->ChargeDefColActsTablPrinc() ;
					if($this->UrlLienSuppr != '')
					{
						$this->LienSuppr = $this->TablPrinc->InsereLienAction($this->DefColActsTablPrinc, $this->UrlLienSuppr, $this->ZoneParent->LibelleLienSuppr) ;
					}
				}
			}
			public function DessineFiltresPrinc(& $dessinateur)
			{
				return '' ;
			}
			public function AppliqueValsSupplTablPrinc(& $srcVals, & $composant, & $ligne)
			{
			}
			public function RenduSpecifique()
			{
				$ctn = '' ;
				$ctn .= parent::RenduSpecifique() ;
				$ctn .= $this->RenduLiensPrinc().PHP_EOL ;
				$ctn .= $this->TablPrinc->RenduDispositif() ;
				return $ctn ;
			}
		}
		class SrcValsSupplLgnDonneesBootstrap3 extends PvSrcValsSupplLgnDonnees
		{
			public function Applique(& $composant, $ligneDonnees)
			{
				$ligneDonnees = parent::Applique($composant, $ligneDonnees) ;
				$lignePrinc = $composant->ScriptParent->AppliqueValsSupplTablPrinc($this, $composant, $ligneDonnees) ;
				if(! is_array($lignePrinc))
				{
					return $ligneDonnees ;
				}
				return array_merge($ligneDonnees, $lignePrinc) ;
			}
		}
		
		class ScriptEditBaseBootstrap3 extends ScriptBaseBootstrap3
		{
			public $FormPrinc ;
			protected $PourAjout = 1 ;
			protected $FormPrincEditable = 1 ;
			protected $InscrireCmdAnnulFormPrinc = 1 ;
			protected $NomClasseCmdAnnulFormPrinc = "CmdAnnulEditBaseBootstrap3" ;
			protected $LibelleCmdAnnulFormPrinc ;
			protected $InscrireCmdExecFormPrinc = 1 ;
			protected $NomClasseCmdExecFormPrinc = "CmdExecEditBaseBootstrap3" ;
			protected $LibelleCmdExecFormPrinc = "Valider" ;
			protected $UrlRedirectAnnulFormPrinc = "" ;
			protected $ScriptSessionAnnulFormPrinc = 0 ;
			protected $InscrireFournBDPrinc = 1 ;
			public $ModeEditionElemCmdExec = 0 ;
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
				if($this->UrlRedirectAnnulFormPrinc != '' && $this->ScriptSessionAnnulFormPrinc == 0 && $this->InscrireCmdAnnulFormPrinc)
				{
					$this->FormPrinc->RedirigeAnnulerVersUrl($this->UrlRedirectAnnulFormPrinc) ;
				}
				if($this->InscrireFournBDPrinc)
				{
					$this->FormPrinc->FournisseurDonnees = $this->CreeFournBDPrinc() ;
					$this->FormPrinc->FournisseurDonnees->RequeteSelection = $this->ReqSelectFormPrinc ;
					$this->FormPrinc->FournisseurDonnees->TableEdition = $this->TablEditFormPrinc ;
				}
				if($this->InscrireCmdAnnulFormPrinc && $this->NomDocumentWeb == "iframe_dlg")
				{
					$this->FormPrinc->CommandeAnnuler->ContenuJsSurClick = 'window.top.IframeDlg.close()' ;
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
				if($this->ModeEditionElemCmdExec == 3 && $this->UrlRedirectAnnulFormPrinc != '')
				{
					$this->FormPrinc->CommandeExecuter->InscrireLienAnnuler = 1 ;
					$this->FormPrinc->CommandeExecuter->UrlLienAnnuler = $this->UrlRedirectAnnulFormPrinc ;
				}
				$this->FormPrinc->DessinateurFiltresEdition = new DessinFiltresPrincBootstrap3() ;
				$this->ChargeFormPrincAuto() ;
				$this->ChargeFormPrinc() ;
				$this->FormPrinc->CommandeExecuter->InsereNouvCritere(new CritExecEditBaseBootstrap3()) ;
			}
			public function DessineFiltresPrinc(& $dessinateur)
			{
				return '' ;
			}
			public function AppliqueCmdExecFormPrincAuto(& $cmd)
			{
				$succes = true ;
				switch($this->ModeEditionElemCmdExec)
				{
					case 1 :
					{
						$succes = $this->FormPrinc->FournisseurDonnees->AjoutElement($this->FormPrinc->FiltresEdition) ;
					}
					break ;
					case 2 :
					{
						$succes = $this->FormPrinc->FournisseurDonnees->ModifElement($this->FormPrinc->FiltresLigneSelection, $this->FormPrinc->FiltresEdition) ;
					}
					break ;
					case 3 :
					{
						$succes = $this->FormPrinc->FournisseurDonnees->SupprElement($this->FormPrinc->FiltresLigneSelection) ;
						if($succes)
						{
							$this->FormPrinc->CacherFormulaireFiltres = 1 ;
						}
					}
					break ;
				}
				if(! $succes && $this->FormPrinc->FournisseurDonnees->BaseDonnees->ConnectionException != "")
				{
					$cmd->RenseigneErreur("Erreur SQL : ".htmlentities($this->FormPrinc->FournisseurDonnees->BaseDonnees->ConnectionException)) ;
				}
				elseif(! $succes)
				{
					$cmd->RenseigneErreur("Une erreur est survenue lors de l'exécution de la commande") ;
				}
				else
				{
					$cmd->ConfirmeSucces() ;
				}
			}
			public function AppliqueCmdAnnulFormPrincAuto(& $cmd)
			{
				if($this->ScriptSessionAnnulFormPrinc == 1)
				{
					$this->ZoneParent->RenduRedirectScriptSession($this->UrlRedirectAnnulFormPrinc) ;
				}
			}
			public function AppliqueCmdExecFormPrinc(& $cmd)
			{
			}
			public function AppliqueCmdAnnulFormPrinc(& $cmd)
			{
			}
			public function ValideCritrExecFormPrinc(& $critr)
			{
			}
			public function RenduSpecifique()
			{
				$ctn = '' ;
				$ctn .= parent::RenduSpecifique() ;
				$ctn .= $this->RenduLiensPrinc().PHP_EOL ;
				$ctn .= $this->FormPrinc->RenduDispositif() ;
				return $ctn ;
			}
		}
		
		class DessinFiltresPrincBootstrap3 extends PvDessinFiltresDonneesBootstrap
		{
			public function Execute(& $script, & $composant, $parametres)
			{
				$ctn = $script->DessineFiltresPrinc($this) ;
				if($ctn != '')
				{
					return $ctn ;
				}
				return parent::Execute($script, $composant, $parametres) ;
			}
			public function RenduFiltre(& $filtre, & $composant)
			{
				return parent::RenduFiltre($filtre, $composant) ;
			}
			public function RenduLibelleFiltre(& $filtre)
			{
				return parent::RenduLibelleFiltre($filtre) ;
			}
		}
		class CmdAnnulEditBaseBootstrap3 extends PvCommandeExecuterBase
		{
			protected function ExecuteInstructions()
			{
				$this->ScriptParent->AppliqueCmdAnnulFormPrincAuto($this) ;
				$this->ScriptParent->AppliqueCmdAnnulFormPrinc($this) ;
			}
		}
		
		class CmdExecEditBaseBootstrap3 extends PvCommandeAnnulerBase
		{
			protected function ExecuteInstructions()
			{
				parent::ExecuteInstructions() ;
				$this->ScriptParent->AppliqueCmdExecFormPrincAuto($this) ;
				$this->ScriptParent->AppliqueCmdExecFormPrinc($this) ;
				if($this->StatutExecution == 1)
				{
					if($this->ScriptParent->ModeEditionElemCmdExec == 3)
					{
						$this->CacherFormulaireFiltresSiSucces = 1 ;
					}
					elseif($this->ScriptParent->ModeEditionElemCmdExec == 1)
					{
						$this->FormulaireDonneesParent->AnnuleLiaisonParametres() ;
					}
				}
			}
		}
		class CritExecEditBaseBootstrap3 extends PvCritereBase
		{
			public function EstRespecte()
			{
				$this->ScriptParent->ValideCritrExecFormPrinc($this) ;
				return $this->MessageErreur == '' ;
			}
		}
		
		class ScriptConsultBaseBootstrap3 extends ScriptBaseBootstrap3
		{
			public $LgnPrinc ;
			public function EstAccessible()
			{
				$ok = parent::EstAccessible() ;
				if(! $ok)
				{
					return $ok ;
				}
				$this->DetermineLgnPrinc() ;
				return $this->LgnPrincTrouvee() ;
			}
			public function DetermineEnvironnement()
			{
				parent::DetermineEnvironnement() ;
				$this->DetermineDocumentPrinc() ;
			}
			protected function DetermineDocumentPrinc()
			{
			}
			protected function DetermineLgnPrinc()
			{
				$req = $this->ReqSqlPrinc() ;
				$params = $this->ParamsSqlPrinc() ;
				$bd = $this->CreeBDPrinc() ;
				$this->LgnPrinc = $bd->FetchSqlRow($req, $params) ;
			}
			public function LgnPrincTrouvee()
			{
				return is_array($this->LgnPrinc) && count($this->LgnPrinc) > 0 ;
			}
			protected function ReqSqlPrinc()
			{
				return "" ;
			}
			protected function ParamsSqlPrinc()
			{
				return array() ;
			}
		}
	}
	
?>