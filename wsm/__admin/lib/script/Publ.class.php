<?php
	
	if(! defined('SCRIPT_BASE_PUBL_WSM2'))
	{
		if(! defined('SCRIPT_NOYAU_PUBL_WSM2'))
		{
			include dirname(__FILE__)."/publ/Noyau.class.php" ;
		}
		if(! defined('SCRIPT_ACCUEIL_PUBL_WSM2'))
		{
			include dirname(__FILE__)."/publ/Accueil.class.php" ;
		}
		define('SCRIPT_BASE_PUBL_WSM2', 1) ;
	}
	
?>