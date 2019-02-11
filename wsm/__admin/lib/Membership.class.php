<?php
	
	if(! defined('MEMBERSHIP_WSM2'))
	{
		if(! defined('BD_WSM2'))
		{
			include dirname(__FILE__)."/BD.class.php" ;
		}
		define('MEMBERSHIP_WSM2', 1) ;
		
		class MembershipWsm2 extends AkSqlMembership
		{
			public $MemberTable = "membership_member" ;
			public $ProfileTable = "membership_profile" ;
			public $RoleTable = "membership_role" ;
			public $PrivilegeTable = "membership_privilege" ;
			protected function InitConfig(& $parent)
			{
				parent::InitConfig($parent) ;
				$this->Database = new BDPrincWsm2() ;
			}
		}
	}
	
?>