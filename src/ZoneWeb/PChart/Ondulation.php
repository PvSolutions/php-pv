<?php

namespace Pv\ZoneWeb\PChart ;

#[\AllowDynamicProperties]
class Ondulation extends \Pv\ZoneWeb\PChart\Diagramme
{
	protected function AppliqueRendu(& $graphe)
	{
		$graphe->Support->drawLineGraph($graphe->JeuDonnees->GetData(),$graphe->JeuDonnees->GetDataDescription());
	}
}