<?php

namespace Pv\ZoneWeb\TableauDonnees\ExtracteurValeurs ;

#[\AllowDynamicProperties]
class ChaineHttp extends \Pv\ZoneWeb\TableauDonnees\ExtracteurValeurs\ExtracteurValeurs
{
	protected function DecodeValeurs($texte, & $composant)
	{
		parse_str($texte, $valeurs) ;
		return $valeurs ;
	}
}