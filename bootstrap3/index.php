<?php
	
	if(! defined('APPLICATION_BOOTSTRAP3'))
	{
		include dirname(__FILE__)."/lib/Application.class.php" ;
	}
	
	$app = new ApplicationBootstrap3() ;
	$app->Execute() ;
	
?>