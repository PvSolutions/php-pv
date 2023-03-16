<?php

namespace Pv\ZoneWeb\PChart ;

#[\AllowDynamicProperties]
class DefSerie
{
	public $IndexChart = -1 ;
	public $Libelle ;
	public $NomDonnees = '' ;
	public $EtiquetteDonnees = '' ;
	public function ObtientLibelle()
	{
		return $this->Libelle != '' ? $this->Libelle : $this->NomDonnees ;
	}
}