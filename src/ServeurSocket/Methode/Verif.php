<?php

namespace Pv\ServeurSocket\Methode ;

#[\AllowDynamicProperties]
class Verif extends \Pv\ServeurSocket\Methode\MethodeSocket
{
	protected function ExecuteInstructions()
	{
		$this->ConfirmeSucces('Tests effectues avec succes') ;
	}
}