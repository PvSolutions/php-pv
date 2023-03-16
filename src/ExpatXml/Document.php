<?php

namespace Pv\ExpatXml ;

#[\AllowDynamicProperties]
class Document extends ExpatXmlNode
{
	public $Path = "" ;
	public function RootNode()
	{
		if(count($this->ChildNodes) < 1)
			return false ;
		return $this->ChildNodes[0] ;
	}
	public function CreateNode()
	{
		return new ExpatXmlNode() ;
	}
}