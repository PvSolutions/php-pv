<?php

namespace Pv\ZoneWeb\FiltreDonnees\Composant ;

class ZoneBoiteOptionsCocher extends \Pv\ZoneWeb\FiltreDonnees\Composant\ZoneBoiteOptionsRadio
{
	public $ChoixMultiple = 1 ;
	protected $CalculerValeurParJs = 0 ;
	protected function InstrsJsSelectElement()
	{
		$ctn = '' ;
		$ctn .= 'var sel = noeud.getAttribute("checked") ;
switch(mode)
{
case 1 :
{
	if(noeud.checked != undefined)
		noeud.checked = "checked" ;
	else
		noeud.setAttribute("checked", "checked") ;
}
break ;
case 0 :
{
	if(noeud.checked != undefined)
		noeud.checked = "" ;
	else
		noeud.removeAttribute("checked") ;
}
break ;
}
' ;
		return $ctn ;
	}
	protected function RenduOptionElement($valeur, $libelle, $ligne, $position=0)
	{
		$forcerSelection = 0 ;
		if(! $this->PossedeValeursSelectionnees())
		{
			if($this->NomColonneValeurParDefaut == "" && $position == 1 && ($this->CocherAutoPremiereOption))
			{
				$forcerSelection = 1 ;
			}
		}
		if(! $forcerSelection && $this->NomColonneValeurParDefaut != "" && $ligne[$this->NomColonneValeurParDefaut] == 1)
		{
			$forcerSelection = 1 ;
		}
		// echo $valeur.' : '.$forcerSelection.'<br />' ;
		$ctn = '' ;
		$nomElementHtml = $this->NomElementHtml.'[]' ;
		$ctn .= '<input type="checkbox" name="'.$nomElementHtml.'" id="'.$this->IDInstanceCalc.'_'.$position.'"' ;
		$ctn .= ' value="'.htmlentities($valeur).'"' ;
		if($this->EstValeurSelectionnee($valeur) || $forcerSelection)
		{
			$ctn .= ' checked' ;
		}
		$ctn .= ' />' ;
		return $ctn ;
	}	
}