<?php
	
	if(! defined('COMPOSANT_APP_BOOTSTRAP2'))
	{
		if(! defined('COMPOSANT_APP_BASE_BOOTSTRAP2'))
		{
			include dirname(__FILE__)."/composantApp/Noyau.class.php" ;
		}
		define('COMPOSANT_APP_BASE_BOOTSTRAP2', 1) ;
	}
	
?>