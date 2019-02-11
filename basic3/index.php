<?php
	
	if(! defined('APPLICATION_BASIC3'))
	{
		include dirname(__FILE__)."/lib/Application.class.php" ;
	}
	
	$app = new ApplicationBasic3() ;
	$app->Execute() ;
	
?>