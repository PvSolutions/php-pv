<?php
	
	if(! defined('BD_BOOTSTRAP2'))
	{
		define('BD_BOOTSTRAP2', 1) ;
		
		class BdPrincBootstrap2 extends MysqliDB
		{
			public $AutoSetCharacterEncoding = 1 ;
			public $MustSetCharacterEncoding = 1 ;
			public $SetCharacterEncodingOnFetch = 1 ;
			public $CharacterEncoding = 'utf8' ;
			public function InitConnectionParams()
			{
				parent::InitConnectionParams() ;
				$this->ConnectionParams["server"] = HOTE_BD_BOOTSTRAP2 ;
				$this->ConnectionParams["user"] = USER_BD_BOOTSTRAP2 ;
				$this->ConnectionParams["password"] = PWD_BD_BOOTSTRAP2 ;
				$this->ConnectionParams["schema"] = SCHEMA_BD_BOOTSTRAP2 ;
			}
		}
	}
	
?>