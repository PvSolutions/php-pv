<?php

namespace Pv\ZoneWeb\Action ;

#[\AllowDynamicProperties]
class ResultatRest extends \Pv\ZoneWeb\Action\Action
{
	protected $Data = 1 ;
	protected $MessageErreur = "" ;
	protected $CodeHttp = 200 ;
	public $AfficherException = 0 ;
	public function EstSucces()
	{
		return ($this->CodeHttp >= 200 && $this->CodeHttp < 400) ;
	}
	public function EstEchec()
	{
		return ! $this->EstSucces() ;
	}
	public function ConfirmeSucces($data)
	{
		$this->MessageErreur = "" ;
		$this->CodeHttp = 200 ;
		$this->Data = $data ;
	}
	public function RenseigneErreur($msgErreur, $codeHttp=400)
	{
		$this->MessageErreur = $msgErreur ;
		$this->CodeHttp = $codeHttp ;
		$this->Data = null ;
	}
	public function RenseigneInvalide($msgErreur)
	{
		$this->RenseigneErreur($msgErreur, 400) ;
	}
	public function RenseigneException($msgErreur)
	{
		$this->RenseigneErreur($msgErreur, 500) ;
	}
	public function Execute()
	{
		$this->ConstruitResultat() ;
		if($this->CodeHttp > 0)
		{
			http_response_code($this->CodeHttp) ;
		}
		Header('Content-Type:application/json'."\r\n") ;
		$retour = new \StdClass() ;
		$retour->status = $this->CodeHttp ;
		if($this->EstEchec())
		{
			$retour->success = false ;
			$retour->data = null ;
			$retour->message = $this->MessageErreur ;
		}
		else
		{
			$retour->success = true ;
			$retour->data = $this->Data ;
			$retour->message = null ;
		}
		if($this->AfficherException == 1)
		{
			echo json_encode($retour) ;
		}
		else
		{
			echo @json_encode($retour) ;
		}
		$this->ZoneParent->AnnulerRendu = true ;
		exit ;
	}
	protected function ConstruitResultat()
	{
	}
}