<?php
	
	if(! defined('DEF_COL_PAGE_WSM2'))
	{
		define('DEF_COL_PAGE_WSM2', 1) ;
		
		class PvDefColBaseWsm
		{
			public $ValeurParDefaut ;
			public $AliasColonneLiee ;
			public $NomColonneLiee ;
			public $NomParametreLie ;
			public $ExprTraduite ;
			public $Titre ;
			public $Visible = 1 ;
			public $Active = 1 ;
			public $Editable = 1 ;
			public $Consultable = 1 ;
			public $Publiable = 1 ;
			public $Administrable = 1 ;
			public $FiltreEdit ;
			public $CompEdit ;
			protected function CreeFiltreEditUpload($form)
			{
				$this->FiltreEdit = $form->InsereFltEditHttpUpload($this->NomParametreLie, $this->CheminDossierDest, $this->ObtientNomColonneLiee()) ;
				$this->FiltreEdit->ExtensionsAcceptees = $this->ExtensionsAcceptees ;
				$this->FiltreEdit->Libelle = $this->Titre ;
			}
			protected function CreeFiltreEditFixe(& $form, $valeurParDefaut)
			{
				$this->FiltreEdit = $form->InsereFltEditFixe($this->NomParametreLie, $valeurParDefaut, $this->ObtientNomColonneLiee()) ;
			}
			protected function CreeFiltreEditPost(& $form)
			{
				$this->FiltreEdit = $form->InsereFltEditHttpPost($this->NomParametreLie, $this->ObtientNomColonneLiee()) ;
				$this->FiltreEdit->Libelle = $this->Titre ;
			}
			public function ObtientNomColonneLiee()
			{
				return ($this->NomColonneLiee == '') ? $this->NomParametreLie : $this->NomColonneLiee ;
			}
			public function CreeFiltreEditAdmin(& $form)
			{
				$this->FiltreEdit = $this->CreeFiltreEditPost($form) ;
				$this->CompEdit = $this->FiltreEdit->ObtientComposant() ;
			}
		}
		
		class PvDefColNomWsm extends PvDefColBaseWsm
		{
		}
		class PvDefColTitreWsm extends PvDefColBaseWsm
		{
		}
		class PvDefColSommaireWsm extends PvDefColBaseWsm
		{
			public function CreeFiltreEditAdmin(& $form)
			{
				$this->FiltreEdit = $this->CreeFiltreEditPost($form) ;
				$this->CompEdit = $this->FiltreEdit->DeclareComposant("PvZoneMultiligneHtml") ;
			}
		}
		class PvDefColTexteWsm extends PvDefColBaseWsm
		{
			public function CreeFiltreEditAdmin(& $form)
			{
				$this->FiltreEdit = $this->CreeFiltreEditPost($form) ;
				$this->CompEdit = $this->FiltreEdit->DeclareComposant("PvCkEditor") ;
			}
		}
		class PvDefColBoolWsm extends PvDefColBaseWsm
		{
			public $ValeurParDefaut = 0 ;
			public function CreeFiltreEditAdmin(& $form)
			{
				$this->FiltreEdit = $this->CreeFiltreEditPost($form) ;
				$this->CompEdit = $this->FiltreEdit->DeclareComposant("PvZoneSelectBoolHtml") ;
			}
		}
		class PvDefColUploadWsm extends PvDefColBaseWsm
		{
			public $CheminDossierDest ;
			public $ExtensionsAcceptees = array() ;
			public function CreeFiltreEditAdmin(& $form)
			{
				$this->CreeFiltreEditUpload($form) ;
				$this->CompEdit = $this->FiltreEdit->DeclareComposant("PvCkEditor") ;
			}
		}
		class PvDefColIdAdminCreaWsm extends PvDefColBaseWsm
		{
			public function CreeFiltreEditAdmin(& $form)
			{
				if($form->InclureElementEnCours == 0)
				{
					$this->CreeFiltreEditFixe($form, $form->ZoneParent->IdMembreConnecte()) ;
				}
			}
		}
		class PvDefColIdAdminModifWsm extends PvDefColBaseWsm
		{
			public function CreeFiltreEditAdmin(& $form)
			{
				$this->CreeFiltreEditFixe($form, $form->ZoneParent->IdMembreConnecte()) ;
			}
		}
		class PvDefColAutoIncWsm extends PvDefColBaseWsm
		{
			public $ValeurParDefaut = 0 ;
			public function CreeFiltreEditAdmin(& $form)
			{
				return $this->CreeFiltreEditPost($form) ;
			}
		}
		class PvDefColPageParentWsm extends PvDefColBaseWsm
		{
			public function CreeFiltreEditAdmin(& $form)
			{
				$this->CreeFiltreEditPost($form) ;
				if($form->InclureElementEnCours == 0)
				{
					$this->ValeurParamIdParent = _GET_def('id_page') ;
				}
				else
				{
				}
				// $this->CompEdit = $this->FiltreEdit->DeclareComposant("PvCkEditor") ;
			}
		}
		class PvDefColDateWsm extends PvDefColBaseWsm
		{
		}
		class PvDefColHeureWsm extends PvDefColBaseWsm
		{
		}
		class PvDefColRechWsm extends PvDefColBaseWsm
		{
			public $NomsColOrigine = array() ;
		}
	}
	
?>