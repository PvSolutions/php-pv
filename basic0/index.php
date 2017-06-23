<?php
	
	if(! defined('APPLICATION_BASIC0'))
	{
		include dirname(__FILE__)."/lib/Application.class.php" ;
	}
	
	$app = new ApplicationBasic0() ;
	$app->Execute() ;
	
?>