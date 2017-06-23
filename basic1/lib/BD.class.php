<?php
	
	if(! defined('BD_BASIC1'))
	{
		define('BD_BASIC1', 1) ;
		
		class BdPrincBasic1 extends MysqliDB
		{
			public $AutoSetCharacterEncoding = 1 ;
			public $CharacterEncoding = 'utf8' ;
			public function InitConnectionParams()
			{
				parent::InitConnectionParams() ;
				$this->ConnectionParams["server"] = HOTE_BD_BASIC1 ;
				$this->ConnectionParams["user"] = USER_BD_BASIC1 ;
				$this->ConnectionParams["password"] = PWD_BD_BASIC1 ;
				$this->ConnectionParams["schema"] = SCHEMA_BD_BASIC1 ;
			}
		}
	}
	
?>