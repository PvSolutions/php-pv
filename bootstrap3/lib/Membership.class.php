<?php
	
	if(! defined('MEMBERSHIP_BOOTSTRAP3'))
	{
		if(! defined('BD_BOOTSTRAP3'))
		{
			include dirname(__FILE__)."/BD.class.php" ;
		}
		define('MEMBERSHIP_BOOTSTRAP3', 1) ;
		
		class MembershipBootstrap3 extends AkSqlMembership
		{
			public $MemberTable = "membership_member" ;
			public $ProfileTable = "membership_profile" ;
			public $RoleTable = "membership_role" ;
			public $PrivilegeTable = "membership_privilege" ;
			protected function InitConfig(& $parent)
			{
				parent::InitConfig($parent) ;
				$this->Database = new BDPrincBootstrap3() ;
			}
		}
	}
	
?>