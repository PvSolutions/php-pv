<?php

namespace Pv\ApiRestful\Auth ;

#[\AllowDynamicProperties]
class Basique extends Auth
{
	protected function CleIdMembre()
	{
		return get_class($this).'|Dm3rw6~' ;
	}
	protected function VideSessionsInactives(& $api)
	{
		$bd = $api->BDMembership() ;
		$membership = & $api->Membership ;
		return true ;
	}
	public function IdentifieMembre(& $api, $login, $motPasse)
	{
		$bd = $api->BDMembership() ;
		$membership = & $api->Membership ;
		return $idMembre ;
	}
	public function CreeSession(& $api, $idMembre, $device, $sauvegarder=0)
	{
		return "" ;
	}
	public function SupprimeSession(& $api)
	{
		return true ;
	}
	public function ChargeSession(& $api)
	{
		if($api->Requete->EnteteAuthType == 'basic')
		{
			$idMembre = null ;
			$bd = $api->BDMembership() ;
			$membership = & $api->Membership ;
			if($api->Requete->EnteteAuthCredentials !== null)
			{
				$contenuIdsAuth = base64_decode($api->Requete->EnteteAuthCredentials) ;
				if($contenuIdsAuth !== null && $contenuIdsAuth !== false)
				{
					$attrsIdsAuth = explode(":", $contenuIdsAuth, 2) ;
					$idMembre = $membership->ValidateConnection($attrsIdsAuth[0], (isset($attrsIdsAuth[1])) ? $attrsIdsAuth[1] : "") ;
				}
			}
			if($idMembre !== null)
			{
				if($idMembre == 0 && $api->Membership->GuestMemberId > 0)
				{
					$idMembre = $api->Membership->GuestMemberId ;
				}
				if($idMembre > 0)
				{
					$api->Membership->LoadMember($idMembre) ;
				}
			}
			else
			{
				$api->Reponse->ConfirmeErreurInterne() ;
			}
		}
	}
}
