<?php
	
	if(! defined("APP_TM51543"))
	{
		include dirname(__FILE__)."/lib/Application.class.php" ;
	}
	
	$app = new ApplicationTM51543() ;
	$app->Execute() ;
	
?>