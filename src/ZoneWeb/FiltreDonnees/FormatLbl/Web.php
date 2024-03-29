<?php

namespace Pv\ZoneWeb\FiltreDonnees\FormatLbl ;

#[\AllowDynamicProperties]
class Web extends \Pv\ZoneWeb\FiltreDonnees\FormatLbl\FormalLbl
{
	public function Rendu($valeur, & $composant)
	{
		return ($composant->EncodeHtmlEtiquette && $valeur !== null) ? htmlentities(($valeur !== null) ? $valeur : "") : $valeur ;
	}
}