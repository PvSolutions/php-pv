<?php
	
	if(! defined('MEMBERSHIP_MONSITE'))
	{
		if(! defined('BASE_DONNEES_MONSITE'))
		{
			include dirname(__FILE__)."/BD.class.php" ;
		}
		
		class MembershipMonSite extends MembershipSws
		{
			protected function InitConfig(& $parent)
			{
				parent::InitConfig($parent) ;
				$this->Database = new BDMonSite() ;
			}
		}
		
	}
	
?>