<?php
	
	if(! defined('COMPOSANT_IU_BASE_BASIC1'))
	{
		if(! defined('COMPOSANT_IU_NOYAU_BASIC1'))
		{
			include dirname(__FILE__)."/composantIU/Noyau.class.php" ;
		}
		define('COMPOSANT_IU_BASE_BASIC1', 1) ;
	}
	
?>