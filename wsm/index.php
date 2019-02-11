<?php
	
	if(! defined('APPLICATION_WSM2'))
	{
		include dirname(__FILE__)."/__admin/lib/Application.class.php" ;
	}
	
	$app = new ApplicationWsm2() ;
	$app->Execute() ;
	
?>