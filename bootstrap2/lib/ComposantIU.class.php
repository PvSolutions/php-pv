<?php
	
	if(! defined('COMPOSANT_IU_BASE_BOOTSTRAP2'))
	{
		if(! defined('COMPOSANT_IU_NOYAU_BOOTSTRAP2'))
		{
			include dirname(__FILE__)."/composantIU/Noyau.class.php" ;
		}
		define('COMPOSANT_IU_BASE_BOOTSTRAP2', 1) ;
	}
	
?>