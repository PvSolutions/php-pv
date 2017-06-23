<?php
	
	if(! defined('APPLICATION_BASIC1'))
	{
		include dirname(__FILE__)."/lib/Application.class.php" ;
	}
	
	$app = new ApplicationBasic1() ;
	$app->Execute() ;
	
?>