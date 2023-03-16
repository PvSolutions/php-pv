<?php

namespace Pv\ActionCtrl ;

#[\AllowDynamicProperties]
class ArreteSvcPers extends \Pv\ActionCtrl\ManipSvcPers
{
	protected function ExecuteManip($args)
	{
		$this->ServPersistSelect->ArreteService() ;
		$this->TacheCtrlParent->DesactiveServPersist($this->ServPersistSelect->NomElementApplication) ;
	}
}