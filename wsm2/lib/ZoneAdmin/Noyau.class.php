<?php
	
	if(! defined('PV_ZONE_ADMIN_WSM'))
	{
		class PvZoneAdminBaseWsm extends PvZoneBootstrap
		{
			public $AccesWsm = "admin" ;
			public $NomParamScriptAppele = "action" ;
			public $NomScriptParDefaut = "home" ;
			public function & SiteWsm()
			{
				return $this->ApplicationParent->IHMs[$this->NomSiteWsm] ;
			}
		}
	}
	
?>