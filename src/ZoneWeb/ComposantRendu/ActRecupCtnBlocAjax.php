<?php

namespace Pv\ZoneWeb\ComposantRendu ;

#[\AllowDynamicProperties]
class ActRecupCtnBlocAjax extends \Pv\ZoneWeb\Action\EnvoiFichier
{
	protected function AfficheContenu()
	{
		echo $this->ComposantRenduParent->RecupContenu() ;
	}
}