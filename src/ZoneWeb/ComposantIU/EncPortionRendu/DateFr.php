<?php

namespace Pv\ZoneWeb\ComposantIU\EncPortionRendu ;

class DateFr extends \Pv\ZoneWeb\ComposantIU\EncPortionRendu\Enc
{
	public $AppliquerTout = 0 ;
	public function Execute($params=array(), $elem=array())
	{
		return array_map('\Pv\Misc::date_fr', $params) ;
	}
}