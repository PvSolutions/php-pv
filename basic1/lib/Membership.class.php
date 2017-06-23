<?php
	
	if(! defined('MEMBERSHIP_BASIC1'))
	{
		if(! defined('BD_BASIC1'))
		{
			include dirname(__FILE__)."/BD.class.php" ;
		}
		define('MEMBERSHIP_BASIC1', 1) ;
		
		class MembershipBasic1 extends AkSqlMembership
		{
			protected function InitConfig(& $parent)
			{
				parent::InitConfig($parent) ;
				$this->Database = new BDPrincBasic1() ;
			}
		}
	}
	
?>