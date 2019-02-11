<?php
	
	if(! defined('MODELE_PAGE_BASE_WSM2'))
	{
		if(! defined('DEF_COL_PAGE_WSM2'))
		{
			include dirname(__FILE__)."/DefCol.class.php" ;
		}
		if(! defined('MODELE_PAGE_NOYAU_WSM2'))
		{
			include dirname(__FILE__)."/ModelePageWeb/Noyau.class.php" ;
		}
		define('MODELE_PAGE_WEB_BASE_WSM2', 1) ;
	}
	
?>