<?php

namespace Pv\ZoneWeb\Critere ;

#[\AllowDynamicProperties]
class ValideRegexpTabl extends \Pv\ZoneWeb\Critere\ValideRegexpForm
{
	protected function & ObtientFiltresCibles()
	{
		return $this->TableauDonneesParent->FiltresSelection ;
	}
}