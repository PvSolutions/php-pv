<?php

namespace Pv\ZoneWeb\Action ;

#[\AllowDynamicProperties]
class EnvoiFichierJs extends \Pv\ZoneWeb\Action\EnvoiFichier
{
	public $TypeMime = "text/javascript" ;
	public $ExtensionFichierAttache = "js" ;
}