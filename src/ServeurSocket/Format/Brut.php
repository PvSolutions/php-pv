<?php

namespace Pv\ServeurSocket\Format ;

#[\AllowDynamicProperties]
class Brut extends \Pv\ServeurSocket\Format\FormatSocket
{
	public function Decode($contenu)
	{
		return $contenu ;
	}
	public function Encode($contenu)
	{
		return $contenu ;
	}
}