<?php

namespace Pv\Membership\Object ;

#[\AllowDynamicProperties]
class ObjectBase
{
	public $ObjectName = "" ;
	public function LoadConfig()
	{
	}
	public function NullValue()
	{
		$nullValue = null ;
		return $nullValue ;
	}
}