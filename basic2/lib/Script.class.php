<?php
	
	if(! defined('SCRIPT_BASE_BASIC2'))
	{
		if(! defined('SCRIPT_NOYAU_BASIC2'))
		{
			include dirname(__FILE__)."/script/Noyau.class.php" ;
		}
		if(! defined('SCRIPT_ACCUEIL_BASIC2'))
		{
			include dirname(__FILE__)."/script/Accueil.class.php" ;
		}
		define('SCRIPT_BASE_BASIC2', 1) ;
	}
	
?>