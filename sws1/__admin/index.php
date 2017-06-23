<?php
	
	if(! defined("APP_MONSITE"))
	{
		include dirname(__FILE__)."/lib/Application.class.php" ;
	}
	
	$app = new ApplicationMonSite() ;
	$app->Execute() ;
	
?>