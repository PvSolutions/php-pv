<?php

namespace Pv\ZoneWeb\FiltreDonnees\Composant ;

#[\AllowDynamicProperties]
class ZoneColor extends \Pv\ZoneWeb\FiltreDonnees\Composant\ElementFormulaire
{
	public $TypeEditeur = "input_text_color" ;
	public $TypeElementFormulaire = "color" ;
	protected function RenduDispositifBrut()
	{
		$this->CorrigeIDsElementHtml() ;
		$ctn = '' ;
		$styleCSS = '' ;
		$ctn .= '<input name="'.htmlspecialchars($this->NomElementHtml).'"' ;
		$ctn .= ' id="'.$this->IDInstanceCalc.'"' ;
		$ctn .= ' type="'.$this->TypeElementFormulaire.'"' ;
		$ctn .= $this->RenduAttrStyleCSS() ;
		$ctn .= $this->RenduAttrsSupplHtml() ;
		$valeurEnc = ($this->Valeur != "") ? htmlspecialchars($this->Valeur) : "" ;
		$ctn .= ' value="'.$valeurEnc.'"' ;
		$ctn .= ' />' ;
		return $ctn ;
	}
}