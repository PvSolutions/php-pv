<?php
	
	if(! defined('PV_SCRIPT_BASE_WSM'))
	{
		if(! defined('PV_SCRIPT_PUBL_WSM'))
		{
			include dirname(__FILE__)."/Script/Publ.class.php" ;
		}
		if(! defined('PV_SCRIPT_ADMIN_WSM'))
		{
			include dirname(__FILE__)."/Script/Admin.class.php" ;
		}
		define('PV_SCRIPT_BASE_WSM', 1) ;
	}
	
?>