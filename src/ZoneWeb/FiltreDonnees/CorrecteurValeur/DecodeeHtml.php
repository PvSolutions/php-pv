<?php

namespace Pv\ZoneWeb\FiltreDonnees\CorrecteurValeur ;

#[\AllowDynamicProperties]
class EncodeeHtml extends \Pv\ZoneWeb\FiltreDonnees\CorrecteurValeur\Correcteur
{
	public function Applique($valeur, & $filtre)
	{
		return htmlspecialchars($valeur) ;
	}
}