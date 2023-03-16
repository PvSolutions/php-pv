<?php

namespace Pv\Common\GD ;

#[\AllowDynamicProperties]
class Control
{
	public $Name ;
	public function __construct($Name="undef")
	{
		$this->Name = $Name ;
		$this->Init() ;
	}
	public function Init()
	{
	}
}