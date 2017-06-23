<?php
	
	if(! defined('MEMBERSHIP_BASIC0'))
	{
		if(! defined('BD_BASIC0'))
		{
			include dirname(__FILE__)."/BD.class.php" ;
		}
		define('MEMBERSHIP_BASIC0', 1) ;
		
		class MembershipBasic0 extends AkSqlMembership
		{
			protected function InitConfig(& $parent)
			{
				parent::InitConfig($parent) ;
				$this->Database = new BDPrincBasic0() ;
			}
		}
	}
	
?>