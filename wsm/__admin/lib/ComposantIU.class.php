<?php
	
	if(! defined('COMPOSANT_IU_BASE_WSM2'))
	{
		if(! defined('COMPOSANT_IU_NOYAU_WSM2'))
		{
			include dirname(__FILE__)."/composantIU/Noyau.class.php" ;
		}
		define('COMPOSANT_IU_BASE_WSM2', 1) ;
	}
	
?>