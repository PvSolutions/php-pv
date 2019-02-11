<?php
	
	if(! defined('SCRIPT_BASE_ADMIN_WSM2'))
	{
		if(! defined('SCRIPT_NOYAU_ADMIN_WSM2'))
		{
			include dirname(__FILE__)."/admin/Noyau.class.php" ;
		}
		if(! defined('SCRIPT_ACCUEIL_ADMIN_WSM2'))
		{
			include dirname(__FILE__)."/admin/Accueil.class.php" ;
		}
		if(! defined('SCRIPT_ADMIN_PAGE_WSM2'))
		{
			include dirname(__FILE__)."/admin/Page.class.php" ;
		}
		define('SCRIPT_BASE_ADMIN_WSM2', 1) ;
	}
	
?>