<?php
	
	if(! defined('COMPOSANT_IU_BASE_BOOTSTRAP3'))
	{
		if(! defined('COMPOSANT_IU_NOYAU_BOOTSTRAP3'))
		{
			include dirname(__FILE__)."/composantIU/Noyau.class.php" ;
		}
		define('COMPOSANT_IU_BASE_BOOTSTRAP3', 1) ;
	}
	
?>