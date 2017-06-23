<?php
	
	if(! defined('SCRIPT_BASE_BASIC1'))
	{
		if(! defined('SCRIPT_NOYAU_BASIC1'))
		{
			include dirname(__FILE__)."/script/Noyau.class.php" ;
		}
		if(! defined('SCRIPT_ACCUEIL_BASIC1'))
		{
			include dirname(__FILE__)."/script/Accueil.class.php" ;
		}
		define('SCRIPT_BASE_BASIC1', 1) ;
	}
	
?>