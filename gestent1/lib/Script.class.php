<?php
	
	if(! defined('SCRIPT_BASE_GESTENT1'))
	{
		if(! defined('SCRIPT_NOYAU_GESTENT1'))
		{
			include dirname(__FILE__)."/script/Noyau.class.php" ;
		}
		if(! defined('SCRIPT_ACCUEIL_GESTENT1'))
		{
			include dirname(__FILE__)."/script/Accueil.class.php" ;
		}
		if(! defined('SCRIPT_MATABLE1_GESTENT1'))
		{
			include dirname(__FILE__)."/script/MaTable1.class.php" ;
		}
		define('SCRIPT_BASE_GESTENT1', 1) ;
	}
	
?>