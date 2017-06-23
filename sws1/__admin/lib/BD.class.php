<?php
	
	if(! defined('BASE_DONNEES_MONSITE'))
	{
		if(! defined('COMMON_DB_INCLUDED'))
		{
			if(! defined('CHEMIN_PVIEW'))
			{
				define('CHEMIN_PVIEW', '../../_PVIEW') ;
			}
			include dirname(__FILE__)."/".CHEMIN_PVIEW."/CommonDB/Base.class.php" ;
		}		
		define('BASE_DONNEES_MONSITE', 1) ;
		
		class BDMonSite extends MysqliDB
		{
			public $AutoSetCharacterEncoding = 1 ;
			public $CharacterEncoding = 'utf8' ;
			public function InitConnectionParams()
			{
				parent::InitConnectionParams() ;
				$this->ConnectionParams["server"] = HOTE_BD_MONSITE ;
				$this->ConnectionParams["user"] = USER_BD_MONSITE ;
				$this->ConnectionParams["password"] = PWD_BD_MONSITE ;
				$this->ConnectionParams["schema"] = SCHEMA_BD_MONSITE ;
			}
		}
		
	}
	
?>