<?php

namespace Pv\ZoneWeb\ComposantRendu ;

#[\AllowDynamicProperties]
class CfgChartMorrisJs
{
	public $element ;
	public $data = array() ;
	public $xkey = "" ;
	public $ykeys = array() ;
	public $labels = array() ;
	public $pointSize = 1 ;
	public $hideHover = "auto" ;
	public $resize = true ;
}