<?php
	
	if(! defined('PV_ZONE_PUBL_WSM'))
	{
		class PvZonePublBaseWsm extends PvZoneWebSimple
		{
			public $AccesWsm = "publ" ;
			public $NomParamScriptAppele = "action" ;
			public $NomScriptParDefaut = "home" ;
			public function & SiteWsm()
			{
				return $this->ApplicationParent->IHMs[$this->NomSiteWsm] ;
			}
		}
	}
	
?>