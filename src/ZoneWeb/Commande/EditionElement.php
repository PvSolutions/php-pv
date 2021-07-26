<?php

namespace Pv\ZoneWeb\Commande ;

class EditionElement extends \Pv\ZoneWeb\Commande\Executer
{
	public $Mode = 1 ;
	public $AjusterRendu = true ;
	protected function ExecuteInstructions()
	{
		$this->StatutExecution = 0 ;
		if($this->EstNul($this->FormulaireDonneesParent->FournisseurDonnees))
		{
			$this->RenseigneErreur("La base de donnée du formulaire n'est renseignée") ;
			return ;
		}
		$succes = 0 ;
		/*
		 * Debogages
		foreach($this->FormulaireDonneesParent->FiltresEdition as $i => & $fltEdit)
		{
			echo $fltEdit->IDInstanceCalc."@".$fltEdit->NomParametreLie." : ".\Pv\Misc::intro($fltEdit->Lie())."<br>" ;
		}
		* */
		switch($this->Mode)
		{
			case \Pv\ZoneWeb\FormulaireDonnees\ModeEditionElement::Ajout :
			{
				$succes = $this->FormulaireDonneesParent->FournisseurDonnees->AjoutElement($this->FormulaireDonneesParent->FiltresEdition) ;
				if($succes && $this->AjusterRendu)
				{
					$this->FormulaireDonneesParent->AnnuleLiaisonParametres() ;
				}
			}
			break ;
			case \Pv\ZoneWeb\FormulaireDonnees\ModeEditionElement::Modif :
			{
				// print_r($this->FormulaireDonneesParent->FiltresLigneSelection[0]->NomParametreDonnees) ;
				$succes = $this->FormulaireDonneesParent->FournisseurDonnees->ModifElement($this->FormulaireDonneesParent->FiltresLigneSelection, $this->FormulaireDonneesParent->FiltresEdition) ;
			}
			break ;
			case \Pv\ZoneWeb\FormulaireDonnees\ModeEditionElement::Suppr :
			{
				$succes = $this->FormulaireDonneesParent->FournisseurDonnees->SupprElement($this->FormulaireDonneesParent->FiltresLigneSelection) ;
				if($succes && $this->AjusterRendu)
				{
					$this->FormulaireDonneesParent->CacherFormulaireFiltres = true ;
					$this->Visible = false ;
				}
			}
			break ;
			default :
			{
				$this->RenseigneErreur("Le mode d'&eacute;dition de la commande est inconnue") ;
			}
			break ;
		}
		// print_r($this->FormulaireDonneesParent->FournisseurDonnees->BaseDonnees) ;
		if(count($this->FormulaireDonneesParent->FiltresEdition) == 0)
		{
			$this->RenseigneErreur("Aucun filtre d'edition n'a &eacute;t&eacute; d&eacute;fini") ;
		}
		elseif(! $succes && $this->FormulaireDonneesParent->FournisseurDonnees->BaseDonnees->ConnectionException != "")
		{
			//print_r($this->FormulaireDonneesParent->FournisseurDonnees->BaseDonnees) ;
			$this->RenseigneErreur("Erreur SQL : ".$this->FormulaireDonneesParent->FournisseurDonnees->BaseDonnees->ConnectionException) ;
			// $this->FormulaireDonneesParent->AfficheExceptionFournisseurDonnees() ;
		}
		else
		{
			$this->ConfirmeSucces() ;
		}
	}
}