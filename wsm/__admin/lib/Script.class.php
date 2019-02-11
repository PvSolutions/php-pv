<?php
	
	if(! defined('SCRIPT_BASE_WSM2'))
	{
		if(! defined('SCRIPT_NOYAU_WSM2'))
		{
			include dirname(__FILE__)."/script/Noyau.class.php" ;
		}
		if(! defined('SCRIPT_PUBL_BASE_WSM2'))
		{
			include dirname(__FILE__)."/script/Publ.class.php" ;
		}
		if(! defined('SCRIPT_ADMIN_BASE_WSM2'))
		{
			include dirname(__FILE__)."/script/Admin.class.php" ;
		}
		define('SCRIPT_BASE_WSM2', 1) ;
	}
	
?>