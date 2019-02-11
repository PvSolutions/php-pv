<?php
	
	if(! defined('APPLICATION_BOOTSTRAP2'))
	{
		include dirname(__FILE__)."/lib/Application.class.php" ;
	}
	
	$app = new ApplicationBootstrap2() ;
	$app->Execute() ;
	
?>