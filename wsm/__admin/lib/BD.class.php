<?php
	
	if(! defined('BD_WSM2'))
	{
		define('BD_WSM2', 1) ;
		
		class BdPrincWsm2 extends MysqliDB
		{
			public $AutoSetCharacterEncoding = 0 ;
			public $MustSetCharacterEncoding = 0 ;
			public $SetCharacterEncodingOnFetch = 1 ;
			public $CharacterEncoding = 'latin1' ;
			public function InitConnectionParams()
			{
				parent::InitConnectionParams() ;
				$this->ConnectionParams["server"] = HOTE_BD_WSM2 ;
				$this->ConnectionParams["user"] = USER_BD_WSM2 ;
				$this->ConnectionParams["password"] = PWD_BD_WSM2 ;
				$this->ConnectionParams["schema"] = SCHEMA_BD_WSM2 ;
			}
			public function DecodeRowValue($value)
			{
				if(! is_string($value))
				{
					return parent::DecodeRowValue($value) ;
				}
				return html_entity_decode(htmlentities($value, ENT_COMPAT, 'ISO-8859-1')) ;
			}
			public function EncodeParamValue($value)
			{
				if(! is_string($value))
				{
					return parent::EncodeParamValue($value) ;
				}
				return html_entity_decode(htmlentities($value, ENT_COMPAT, 'UTF-8'), ENT_COMPAT, 'ISO-8859-1') ;
			}
		}
	}
	
?>