<?php

namespace Pv\ZoneWeb\ChartJs ;

#[\AllowDynamicProperties]
class CfgInit
{
	public $type = "bar" ;
	public $data ;
	public $options ;
	public function __construct()
	{
		$this->data = new \Pv\ZoneWeb\ChartJs\Data() ;
		$this->options = new \StdClass() ;
	}
}