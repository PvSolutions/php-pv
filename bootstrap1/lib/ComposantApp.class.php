<?php
	
	if(! defined('COMPOSANT_APP_BOOTSTRAP1'))
	{
		if(! defined('COMPOSANT_APP_BASE_BOOTSTRAP1'))
		{
			include dirname(__FILE__)."/composantApp/Noyau.class.php" ;
		}
		define('COMPOSANT_APP_BASE_BOOTSTRAP1', 1) ;
	}
	
?>