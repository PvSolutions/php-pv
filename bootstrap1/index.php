<?php
	
	if(! defined('APPLICATION_BOOTSTRAP1'))
	{
		include dirname(__FILE__)."/lib/Application.class.php" ;
	}
	
	$app = new ApplicationBootstrap1() ;
	$app->Execute() ;
	
?>