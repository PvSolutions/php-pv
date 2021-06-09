<?php

namespace Pv\ApiRestful\RouteMembership ;

class ModifPrefs extends \Pv\ApiRestful\Route\Filtrable
{
	public $AutoriserAjout = 0 ;
	public $AutoriserModif = 1 ;
	public $AutoriserSuppr = 0 ;
	public $AutoriserDesact = 0 ;
	protected function PrepareExecution()
	{
		parent::PrepareExecution() ;
		$api = & $this->ApiParent ;
		$mb = & $this->ApiParent->Membership ;
		$bd = & $mb->Database ;
		$this->FltIdMembre = $this->InsereFltSelectFixe("id_connecte", $api->IdMembreConnecte(), $bd->EscapeVariableName($mb->IdMemberColumn)." = <self>") ;
		$this->FltLogin = $this->InsereFltEditHttpCorps("login", $mb->LoginMemberColumn) ;
		if($mb->LoginWithEmail == false)
		{
			$this->FltEmail = $this->InsereFltEditHttpCorps("email", $mb->EmailMemberColumn) ;
		}
		$this->FltNom = $this->InsereFltEditHttpCorps("nom", $mb->LastNameMemberColumn) ;
		$this->FltPrenom = $this->InsereFltEditHttpCorps("prenom", $mb->FirstNameMemberColumn) ;
		$this->FltAdresse = $this->InsereFltEditHttpCorps("adresse", $mb->AddressMemberColumn) ;
		$this->FltContact = $this->InsereFltEditHttpCorps("contact", $mb->ContactMemberColumn) ;
	}
}