<?php
	
	if(! defined('BD_BASIC0'))
	{
		define('BD_BASIC0', 1) ;
		
		class BdPrincBasic0 extends MysqliDB
		{
			public $AutoSetCharacterEncoding = 1 ;
			public $CharacterEncoding = 'utf8' ;
			public function InitConnectionParams()
			{
				parent::InitConnectionParams() ;
				$this->ConnectionParams["server"] = HOTE_BD_BASIC0 ;
				$this->ConnectionParams["user"] = USER_BD_BASIC0 ;
				$this->ConnectionParams["password"] = PWD_BD_BASIC0 ;
				$this->ConnectionParams["schema"] = SCHEMA_BD_BASIC0 ;
			}
		}
	}
	
?>