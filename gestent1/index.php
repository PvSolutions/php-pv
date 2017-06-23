<?php
	
	if(! defined('APPLICATION_GESTENT1'))
	{
		include dirname(__FILE__)."/lib/Application.class.php" ;
	}
	
	$app = new ApplicationGestEnt1() ;
	$app->Execute() ;
	
?>