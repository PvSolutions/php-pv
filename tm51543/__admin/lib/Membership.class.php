<?php
	
	if(! defined('MEMBERSHIP_TM51543'))
	{
		if(! defined('BASE_DONNEES_TM51543'))
		{
			include dirname(__FILE__)."/BD.class.php" ;
		}
		
		class MembershipTM51543 extends MembershipSws
		{
			protected function InitConfig(& $parent)
			{
				parent::InitConfig($parent) ;
				$this->Database = new BDTM51543() ;
			}
		}
		
	}
	
?>