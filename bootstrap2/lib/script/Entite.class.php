<?php
	
	if(! defined('SCRIPT_ENTITES_BOOTSTRAP2'))
	{
		define('SCRIPT_ENTITES_BOOTSTRAP2', 1) ;
		
		class ScriptListeEntitesBootstrap2 extends ScriptListBaseBootstrap2
		{
			public $Privileges = array("gestion_reference") ;
			public $NecessiteMembreConnecte = 1 ;
			public $Titre = "Entites" ;
			public $TitreDocument = "Entites" ;
			public $ReqSelectTablPrinc = "entite" ;
			public $InscrireDefColActsTablPrinc = 1 ;
			public $UrlLienAjout = "javascript:IframeDlg.open('?appelleScript=ajoutEntite')" ;
			public $UrlLienModif = "javascript:IframeDlg.open('?appelleScript=modifEntite&id=\${id}')" ;
			protected function ChargeTablPrinc()
			{
				$this->FltTitre = $this->TablPrinc->InsereFltSelectHttpGet("Terme", "instr(upper(NOM), upper(<self>)) > 0") ;
				$this->FltTitre->Libelle = "Nom" ;
				$this->TablPrinc->ToujoursAfficher = 1 ;
				$this->DefColId = $this->TablPrinc->InsereDefColCachee("ID") ;
				$this->DefColTitre = $this->TablPrinc->InsereDefCol("NOM", "Nom") ;
			}
		}
		
		class ScriptEditEntiteBootstrap2 extends ScriptEditBaseBootstrap2
		{
			public $NomDocumentWeb = "iframe_dlg" ;
			public $NecessiteMembreConnecte = 1 ;
			public $Privileges = array() ;
			protected $ReqSelectFormPrinc = "entite" ;
			protected $TablEditFormPrinc = "entite" ;
			protected function ChargeFormPrinc()
			{
				$this->FltId = $this->FormPrinc->InsereFltLgSelectHttpGet("id", "id = <self>") ;
				$this->FltNom = $this->FormPrinc->InsereFltEditHttpPost("nom", "NOM") ;
				$this->FltNom->Libelle = "Nom" ;
				$this->FltType = $this->FormPrinc->InsereFltEditHttpPost("id_type", "ID_TYPE") ;
				$this->FltType->Libelle = "Type" ;
				/*
				$this->CompType = $this->FltType->DeclareComposant("PvZoneSelectHtml") ;
				$this->CompType->FournisseurDonnees = $this->CreeFournBDPrinc() ;
				$this->CompType->FournisseurDonnees->RequeteSelection = "TYPE_LOCALITE" ;
				$this->CompType->NomColonneValeur = "ID" ;
				$this->CompType->NomColonneLibelle = "NOM" ;
				*/
			}
		}
		class ScriptAjoutEntiteBootstrap2 extends ScriptEditEntiteBootstrap2
		{
			public $Titre = "Ajouter une entite" ;
			public $TitreDocument = "Ajouter une entite" ;
			public $PourAjout = 1 ;
			public $ModeEditionElemCmdExec = 1 ;
		}
		class ScriptModifEntiteBootstrap2 extends ScriptEditEntiteBootstrap2
		{
			public $PourAjout = 0 ;
			public $Titre = "Modifier une entite" ;
			public $TitreDocument = "Modifier une entite" ;
			public $ModeEditionElemCmdExec = 2 ;
		}
		class ScriptSupprEntiteBootstrap2 extends ScriptEditEntiteBootstrap2
		{
			public $PourAjout = 0 ;
			public $FormPrincEditable = 0 ;
			public $Titre = "Supprimer une entite" ;
			public $TitreDocument = "Supprimer une entite" ;
			public $ModeEditionElemCmdExec = 3 ;
		}
	}

?>