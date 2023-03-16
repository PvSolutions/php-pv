<?php

namespace Pv\ZoneWeb\FiltreDonnees\Composant\Select2 ;

#[\AllowDynamicProperties]
class CfgAjax
{
	public $url ;
	public $dataType = "json" ;
	public $type = "GET" ;
	public $delay = 250 ;
	public $data ;
	public $processResults ;
	public $cache = true ;
}
