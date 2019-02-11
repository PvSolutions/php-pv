<?php
	
	if(! defined('COMPOSANT_APP_WSM2'))
	{
		if(! defined('COMPOSANT_APP_BASE_WSM2'))
		{
			include dirname(__FILE__)."/composantApp/Noyau.class.php" ;
		}
		if(! defined('SITE_WEB_WSM2'))
		{
			include dirname(__FILE__)."/composantApp/SiteWeb.class.php" ;
		}
		define('COMPOSANT_APP_BASE_WSM2', 1) ;
	}
	
?>