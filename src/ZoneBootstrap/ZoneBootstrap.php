<?php

namespace Pv\ZoneBootstrap ;

class ZoneBootstrap extends \Pv\ZoneWeb\ZoneWeb
{
	public $LangueDocument = "en" ;
	public $EncodageDocument = "utf-8" ;
	public $InclureCtnJsEntete = 1 ;
	public $InclureJQuery = 1 ;
	public $VersionBootstrap = 5 ;
	public $InclureBootstrap = 1 ;
	public $InclureNavbarFlottant = 0 ;
	public $RenduExtraHead = '<meta http-equiv="X-UA-Compatible" content="IE=edge">' ;
	public $ViewportMeta = 'width=device-width, initial-scale=1' ;
	public $HauteurTableauFixe = '600px' ;
	public $BackgroundEnteteTableauFixe = 'white' ;
	public $ClasseCSSMsgExecSucces = "alert alert-success" ;
	public $ClasseCSSMsgExecErreur = "alert alert-danger" ;
	public $BackgroundNavbarFlottant = "white" ;
	public $CouleurBordureNavbarFlottant = "" ;
	public $CouleurTexteNavbarFlottant = "black" ;
	public $CheminCSSBootstrap = 'css/bootstrap.min.css' ;
	public $NomClasseScriptConnexion = 'Pv\ZoneBootstrap\ScriptMembership\Connexion' ;
	public $CheminFontAwesome = 'vendor/fontawesome/css/all.min.css' ;
	protected function AfficheRenduIndisponible(& $script, $msg)
	{
		$ctn = '' ;
		$this->ScriptPourRendu = & $script ;
		$ctn .= $this->RenduEnteteDocument() ;
		$ctn .= '<div class="alert alert-danger" role="alert">'.$msg.'</div>' ;
		$ctn .= $this->RenduPiedDocument() ;
		$this->ScriptPourRendu = null ;
		echo $ctn ;
		exit ;
	}
	public function CreeTablPrinc()
	{
		return new \Pv\ZoneBootstrap\TableauDonnees\TableauDonnees() ;
	}
	public function CreeFormPrinc()
	{
		return new \Pv\ZoneBootstrap\FormulaireDonnees\FormulaireDonnees() ;
	}
}

