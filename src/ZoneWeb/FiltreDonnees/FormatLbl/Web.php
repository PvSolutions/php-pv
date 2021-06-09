<?php

namespace Pv\ZoneWeb\FiltreDonnees\FormatLbl ;

class Web extends \Pv\ZoneWeb\FiltreDonnees\FormatLbl\FormalLbl
{
	public function Rendu($valeur, & $composant)
	{
		return ($composant->EncodeHtmlEtiquette) ? htmlentities($valeur) : $valeur ;
	}
}