<?php

namespace Pv\ZoneWeb\FiltreDonnees\Composant ;

class ElementFormulaire extends \Pv\ZoneWeb\ComposantIU\BaliseHtml
{
	public $TypeEditeur = "base" ;
	public $Largeur = "" ;
	public $Hauteur = "" ;
	public $Valeur = "" ;
	public $EspaceReserve = "" ;
	public $FmtLbl ;
	public $EncodeHtmlEtiquette = 1 ;
	public $AttrsSupplHtml = array() ;
	public function RenduJsDefinitValeur()
	{
		return 'if(document.getElementById("'.$this->IDInstanceCalc.'") != null) {
document.getElementById("'.$this->IDInstanceCalc.'").value = valeur ;
}' ;
	}
	public function RenduJsDefinitEtiquette()
	{
		return 'if(document.getElementById("'.$this->IDInstanceCalc.'") != null) {
document.getElementById("'.$this->IDInstanceCalc.'").innerText = valeur ;
}' ;
	}
	protected function CreeFmtLbl()
	{
		return new \Pv\ZoneWeb\FiltreDonnees\FormatLbl\Web() ;
	}
	protected function InitConfig()
	{
		parent::InitConfig() ;
		$this->FmtLbl = $this->CreeFmtLbl() ;
	}
	public function EncodeEtiquette($valeur)
	{
		return $this->FmtLbl->Rendu($valeur, $this) ;
	}
	public function RenduEtiquette()
	{
		return '<span id="'.$this->IDInstanceCalc.'">'.$this->EncodeEtiquette($this->Valeur).'</span>' ;
	}
	protected function RenduAttrStyleCSS()
	{
		$styleCSS = '' ;
		$ctn = '' ;
		if($this->Largeur != '')
		{
			$styleCSS .= 'width:'.$this->Largeur.';' ;
		}
		if($this->Hauteur != '')
		{
			$styleCSS .= 'height:'.$this->Hauteur.';' ;
		}
		if($this->StyleCSS != '')
		{
			$styleCSS .= $this->StyleCSS ;
		}
		if($styleCSS != '')
		{
			$ctn .= ' style="'.$styleCSS.'"' ;
		}
		// echo $this->NomElementHtml." : ".count($this->ClassesCSS)."<br />" ;
		if(count($this->ClassesCSS) > 0)
		{
			$ctn .= ' class="'.join(" ", $this->ClassesCSS).'"' ;
		}
		return $ctn ;
	}
	protected function RenduAttrsSupplHtml()
	{
		$ctn = '' ;
		if($this->EspaceReserve != "")
		{
			$ctn .= ' placeholder="'.htmlspecialchars(html_entity_decode($this->EspaceReserve)).'"' ;
		}
		if(count($this->AttrsSupplHtml) > 0)
		{
			foreach($this->AttrsSupplHtml as $attr => $val)
			{
				$ctn .= ' '.htmlspecialchars($attr).'="'.htmlspecialchars($val).'"' ;
			}
		}
		return $ctn ;
	}
}