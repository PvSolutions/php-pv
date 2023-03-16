<?php

namespace Pv\ZoneWeb\Action ;

#[\AllowDynamicProperties]
class EnvoiFichierTxt extends \Pv\ZoneWeb\Action\EnvoiFichier
{
	public $TypeMime = "text/plain" ;
	public $ExtensionFichierAttache = "txt" ;
}