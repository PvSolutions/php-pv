<?php

namespace Pv\ZoneWeb\Action ;

#[\AllowDynamicProperties]
class EnvoiFichierCSS extends \Pv\ZoneWeb\Action\EnvoiFichier
{
	public $TypeMime = "text/css" ;
	public $ExtensionFichierAttache = "css" ;
}