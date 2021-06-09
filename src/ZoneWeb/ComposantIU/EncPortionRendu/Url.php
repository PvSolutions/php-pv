<?php

namespace Pv\ZoneWeb\ComposantIU\EncPortionRendu ;

class Url extends \Pv\ZoneWeb\ComposantIU\EncPortionRendu\Enc
{
	public $AppliquerTout = 1 ;
	public function Execute($params=array(), $elem=array())
	{
		return array_map('urlencode', $params) ;
	}
}