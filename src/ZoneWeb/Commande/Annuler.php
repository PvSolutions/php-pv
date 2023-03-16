<?php

namespace Pv\ZoneWeb\Commande ;

#[\AllowDynamicProperties]
class Annuler extends \Pv\ZoneWeb\Commande\FormulaireDonnees
{
	/* Ne verifie pas le telechargement des fichiers :) */
	protected function VerifiePreRequis()
	{
	}
}