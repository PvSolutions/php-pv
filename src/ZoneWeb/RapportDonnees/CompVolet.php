<?php

namespace Pv\ZoneWeb\RapportDonnees ;

#[\AllowDynamicProperties]
class CompVolet extends \Pv\ZoneWeb\RapportDonnees\ElementIU
{
	public $Elements = array() ;
	public function ChargeConfig()
	{
		parent::ChargeConfig() ;
	}
	protected function ExtraitSqlSelection()
	{
	}
	protected function CalculeDonneesRendu()
	{
	}
	protected function RenduDispositifBrut()
	{
		$ctn = '' ;
		return $ctn ;
	}
}