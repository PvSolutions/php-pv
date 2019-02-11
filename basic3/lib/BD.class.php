<?php
	
	if(! defined('BD_BASIC3'))
	{
		define('BD_BASIC3', 1) ;
		
		class BdPrincBasic3 extends MysqliDB
		{
			public $AutoSetCharacterEncoding = 1 ;
			public $MustSetCharacterEncoding = 1 ;
			public $SetCharacterEncodingOnFetch = 1 ;
			public $CharacterEncoding = 'utf8' ;
			public function InitConnectionParams()
			{
				parent::InitConnectionParams() ;
				$this->ConnectionParams["server"] = HOTE_BD_BASIC3 ;
				$this->ConnectionParams["user"] = USER_BD_BASIC3 ;
				$this->ConnectionParams["password"] = PWD_BD_BASIC3 ;
				$this->ConnectionParams["schema"] = SCHEMA_BD_BASIC3 ;
			}
		}
	}
	
?>