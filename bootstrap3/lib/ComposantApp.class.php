<?php
	
	if(! defined('COMPOSANT_APP_BOOTSTRAP3'))
	{
		if(! defined('COMPOSANT_APP_BASE_BOOTSTRAP3'))
		{
			include dirname(__FILE__)."/composantApp/Noyau.class.php" ;
		}
		define('COMPOSANT_APP_BASE_BOOTSTRAP3', 1) ;
	}
	
?>