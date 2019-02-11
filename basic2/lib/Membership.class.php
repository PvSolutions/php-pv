<?php
	
	if(! defined('MEMBERSHIP_BASIC2'))
	{
		if(! defined('BD_BASIC2'))
		{
			include dirname(__FILE__)."/BD.class.php" ;
		}
		define('MEMBERSHIP_BASIC2', 1) ;
		
		class MembershipBasic2 extends AkSqlMembership
		{
			public $MemberTable = "membership_member" ;
			public $ProfileTable = "membership_profile" ;
			public $RoleTable = "membership_role" ;
			public $PrivilegeTable = "membership_privilege" ;
			protected function InitConfig(& $parent)
			{
				parent::InitConfig($parent) ;
				$this->Database = new BDPrincBasic2() ;
			}
		}
	}
	
?>