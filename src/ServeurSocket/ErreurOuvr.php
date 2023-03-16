<?php

namespace Pv\ServeurSocket ;

#[\AllowDynamicProperties]
class ErreurOuvr
{
	public $No ;
	public $Contenu ;
	public function Trouve()
	{
		return $this->No != '' ;
	}
}