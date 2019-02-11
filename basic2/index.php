<?php
	
	if(! defined('APPLICATION_BASIC2'))
	{
		include dirname(__FILE__)."/lib/Application.class.php" ;
	}
	
	$app = new ApplicationBasic2() ;
	$app->Execute() ;
	
?>