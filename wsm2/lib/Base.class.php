<?php
	
	if(! defined("PV_WSM"))
	{
		if(! defined("PV_BASE"))
		{
			include dirname(__FILE__)."/../../_PVIEW/Pv/Base.class.php" ;
		}
		if(! defined('PV_SCRIPT_BASE_WSM'))
		{
			include dirname(__FILE__)."/Script.class.php" ;
		}
		if(! defined('PV_ZONE_ADMIN_WSM'))
		{
			include dirname(__FILE__)."/ZoneAdmin.class.php" ;
		}
		if(! defined('PV_ZONE_PUBL_WSM'))
		{
			include dirname(__FILE__)."/ZonePubl.class.php" ;
		}
		if(! defined('PV_MODELE_PAGE_WSM'))
		{
			include dirname(__FILE__)."/ModelePage.class.php" ;
		}
		if(! defined('PV_MODELE_COL_WSM'))
		{
			include dirname(__FILE__)."/ModeleCol.class.php" ;
		}
		if(! defined('PV_SITE_WSM'))
		{
			include dirname(__FILE__)."/Site.class.php" ;
		}
		define("PV_WSM", 1) ;
	}
	
	
?>