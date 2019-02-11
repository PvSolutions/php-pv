<?php
	
	if(! defined('COMPOSANT_APP_NOYAU_BOOTSTRAP3'))
	{
		define('COMPOSANT_APP_NOYAU_BOOTSTRAP3', 1) ;
		
		class ComposantAppBaseBootstrap3 extends PvElementApplication
		{
			public function CreeBDPrinc()
			{
				return $this->ApplicationParent->CreeBDPrinc() ;
			}
			protected function CreeFournBDPrinc()
			{
				return $this->ApplicationParent->CreeFournBDPrinc() ;
			}
		}
		
		class ParamActionAppBootstrap3
		{
			public $Args = array() ;
			public function __construct($args=array())
			{
				$this->InitParams($args) ;
			}
			protected function InitParams($args)
			{
				$this->Args = $args ;
			}
			public function Arg($nom, $valeurDefaut=null)
			{
				return (isset($this->Args[$nom])) ? $this->Args[$nom] : $valeurDefaut ;
			}
			public function ArgObj($nom, $valeurDefaut=null)
			{
				return (isset($this->Args->$nom)) ? $this->Args->$nom : $valeurDefaut ;
			}
		}
		
		class ResultActionAppBootstrap3
		{
			public $Valeur = '' ;
			public $CodeErreur = -1000 ;
			public $MsgErreur = 'Resultat non encore defini' ;
			public function ConfirmeSucces($valeur='')
			{
				$this->Valeur = $valeur ;
				$this->CodeErreur = 0 ;
				$this->MsgErreur = '' ;
			}
			public function RenseigneErreur($valeur='', $codeErreur=1, $msgErreur='')
			{
				$this->Valeur = $valeur ;
				$this->MsgErreur = $msgErreur ;
				$this->CodeErreur = $codeErreur ;
			}
			public function EstIndefini()
			{
				return $this->CodeErreur == -1000 ;
			}
			public function EstSucces()
			{
				return $this->CodeErreur == 0 ;
			}
			public function ErreurTrouvee()
			{
				return $this->CodeErreur != 0 ;
			}
		}
		
		class ActionAppBaseBootstrap3 extends ComposantAppBaseBootstrap3
		{
			protected $_Result ;
			protected $_Param ;
			public $Titre ;
			public $TitreApercu ;
			public $Description ;
			public function SauveEtat()
			{
			}
			public function RestaureEtat()
			{
			}
			public function & Result()
			{
				return $this->_Result ;
			}
			public function ExecuteSupport($args)
			{
				$this->_Result = new ResultBootstrap3() ;
				$this->_Param = $this->CreeParam($args) ;
				$this->PrepareExecution() ;
				if($this->ErreurDefinie())
				{
					return $this->_Result ;
				}
				$this->ExecuteInstructions() ;
				$this->TermineExecution() ;
				$this->ConfirmeSuccesAuto() ;
				return $this->_Result ;
			}
			public function ArgParam($nom, $valeurDefaut=null)
			{
				return $this->_Param->Arg($nom, $valeurDefaut) ;
			}
			public function ArgParamObj($nom, $valeurDefaut=null)
			{
				return $this->_Param->ArgObj($nom, $valeurDefaut) ;
			}
			protected function ConfirmeSuccesAuto()
			{
				if($this->_Result->EstIndefini() == 1)
				{
					$this->ConfirmeSucces(1) ;
				}
			}
			protected function CreeParam($params)
			{
				return new ParamBaseBootstrap3($params) ;
			}
			protected function ExecuteInstructions()
			{
			}
			public function ConfirmeSucces($val='')
			{
				$this->_Result->ConfirmeSucces($val) ;
			}
			public function RenseigneErreur($val='', $codeErreur='', $msgErreur='')
			{
				$this->_Result->RenseigneErreur($val, $codeErreur, $msgErreur) ;
			}
			public function EstSucces()
			{
				return $this->_Result->EstSucces() ;
			}
			public function EstIndefini()
			{
				return $this->_Result->EstIndefini() ;
			}
			public function ErreurDefinie()
			{
				return (! $this->_Result->EstIndefini() && $this->_Result->ErreurTrouvee()) ;
			}
			public function ErreurTrouvee()
			{
				return $this->_Result->ErreurTrouvee() ;
			}
			public function RemplitFormEdit(& $form)
			{
			}
			public function RemplitTablList(& $tabl)
			{
			}
			public function ValeurResultat()
			{
				return $this->_Result->Valeur ;
			}
		}
	}
	
	
?>