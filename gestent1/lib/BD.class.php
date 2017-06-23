<?php
	
	if(! defined('BD_GESTENT1'))
	{
		define('BD_GESTENT1', 1) ;
		
		class BDPrincGestEnt1 extends MysqliDB
		{
			public $AutoSetCharacterEncoding = 1 ;
			public $CharacterEncoding = 'utf8' ;
			public function InitConnectionParams()
			{
				parent::InitConnectionParams() ;
				$this->ConnectionParams["server"] = HOTE_BD_GESTENT1 ;
				$this->ConnectionParams["user"] = USER_BD_GESTENT1 ;
				$this->ConnectionParams["password"] = PWD_BD_GESTENT1 ;
				$this->ConnectionParams["schema"] = SCHEMA_BD_GESTENT1 ;
			}
		}
		
	}
	
?>