<?php
	
	if(! defined('SCRIPT_BASE_BOOTSTRAP1'))
	{
		if(! defined('SCRIPT_NOYAU_BOOTSTRAP1'))
		{
			include dirname(__FILE__)."/script/Noyau.class.php" ;
		}
		if(! defined('SCRIPT_ACCUEIL_BOOTSTRAP1'))
		{
			include dirname(__FILE__)."/script/Accueil.class.php" ;
		}
		define('SCRIPT_BASE_BOOTSTRAP1', 1) ;
	}
	
?>