<?php

namespace Pv\ZoneWeb\ComposantIU ;

class ActRecupCtnBlocAjax extends \Pv\ZoneWeb\Action\EnvoiFichier
{
	protected function AfficheContenu()
	{
		echo $this->ComposantIUParent->RecupContenu() ;
	}
}