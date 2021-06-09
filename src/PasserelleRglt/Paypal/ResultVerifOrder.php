<?php

namespace Pv\PasserelleRglt\Paypal ;

class ResultVerifOrder
{
	public $ValeurAccessToken ;
	public $CtnReqAuth ;
	public $CtnRepAuth ;
	public $CtnReqCheckOrder ;
	public $CtnRepCheckOrder ;
	public $CodeErreur = "non_defini" ;
	public function EstSucces()
	{
		return $this->CodeErreur == "" ;
	}
}
