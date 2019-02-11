<?php
	
	if(! defined('COMPOSANT_IU_BASE_BOOTSTRAP1'))
	{
		if(! defined('COMPOSANT_IU_NOYAU_BOOTSTRAP1'))
		{
			include dirname(__FILE__)."/composantIU/Noyau.class.php" ;
		}
		define('COMPOSANT_IU_BASE_BOOTSTRAP1', 1) ;
	}
	
?>