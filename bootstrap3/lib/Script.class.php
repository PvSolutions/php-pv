<?php
	
	if(! defined('SCRIPT_BASE_BOOTSTRAP3'))
	{
		if(! defined('SCRIPT_NOYAU_BOOTSTRAP3'))
		{
			include dirname(__FILE__)."/script/Noyau.class.php" ;
		}
		if(! defined('SCRIPT_ACCUEIL_BOOTSTRAP3'))
		{
			include dirname(__FILE__)."/script/Accueil.class.php" ;
		}
		define('SCRIPT_BASE_BOOTSTRAP3', 1) ;
	}
	
?>