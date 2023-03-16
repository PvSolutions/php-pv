<?php

namespace Pv\ServeurSocket\Methode ;

#[\AllowDynamicProperties]
class Test extends \Pv\ServeurSocket\Methode\MethodeSocket
{
	public $MessageTest = "Test reussi" ;
	public $ValeurTest = "OK" ;
	protected function ExecuteInstructions()
	{
		$this->ConfirmeSucces($this->MessageTest, $this->ValeurTest) ;
	}
}