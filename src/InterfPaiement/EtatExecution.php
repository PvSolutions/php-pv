<?php

namespace Pv\InterfPaiement ;

#[\AllowDynamicProperties]
class EtatExecution
{
	public $Id ;
	public $TimestampCapt ;
	public $MessageErreur ;
	public function __construct()
	{
		$this->MessageErreur = "" ;
		$this->Id = "non_demarre" ;
		$this->TimestampCapt = date("U") ;
	}
}