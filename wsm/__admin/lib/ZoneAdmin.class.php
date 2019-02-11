<?php
	
	if(! defined('ZONE_ADMIN_WSM2'))
	{
		if(! defined('DOCUMENT_WEB_BASE_WSM2'))
		{
			include dirname(__FILE__)."/DocumentWeb.class.php" ;
		}
		if(! defined('COMPOSANT_IU_BASE_WSM2'))
		{
			include dirname(__FILE__)."/ComposantIU.class.php" ;
		}
		if(! defined('SCRIPT_BASE_WSM2'))
		{
			include dirname(__FILE__)."/Script.class.php" ;
		}
		define('ZONE_ADMIN_WSM2', 1) ;
		
		class ZoneAdminWsm2 extends PvZoneBaseBootstrap
		{
			public $EncodageDocument = "utf-8" ;
			public $CheminFichierRelatif = CHEMIN_FIC_REL_ZONE_ADMIN_WSM2 ;
			public $UtiliserDocumentWeb = 1 ;
			public $InclureFontAwesome = 1 ;
			public $InclureScriptsMembership = 1 ;
			public $RedirigerVersConnexion = 1 ;
			public $AutoriserInscription = 0 ;
			public $AutoriserModifPrefs = 1 ;
			public $NomClasseMembership = "MembershipWsm2" ;
			public $CheminCSSBootstrap = "css/bootstrap.min.css" ;
			public $InclureCtnJsEntete = 0 ;
			public $NomDocumentWebEditMembership = "connecte" ;
			public $TagTitre = "h3" ;
			public $Titre = "<b>W</b>eb<b>S</b>ite<b>M</b>anagement <b>II</b>" ;
			public function BDPrinc()
			{
				return $this->ApplicationParent->BDPrinc() ;
			}
			public function CreeBDPrinc()
			{
				return $this->ApplicationParent->CreeBDPrinc() ;
			}
			protected function ChargeScripts()
			{
				$this->InsereScriptParDefaut(new ScriptAccueilAdminWsm2()) ;
				$this->InsereScript("parcourtPageRacine", new ScriptParcourtPageRacineAdmWsm2()) ;
				$this->InsereScript("parcourtPage", new ScriptParcourtPageAdminWsm2()) ;
				$this->InsereScript("listeRelsPage", new ScriptListRelsPageAdminWsm2()) ;
			}
			protected function ChargeDocumentsWeb()
			{
				$this->DocumentsWeb["connecte"] = new DocWebAdminConnecteWsm2() ;
				$this->DocumentsWeb["non_connecte"] = new DocWebAdminNonConnecteWsm2() ;
			}
		}
		
		class DocWebAdminBaseWsm2 extends DocWebBaseWsm2
		{
			public $ClasseCSSBackgroundSidebar = "bg-primary" ;
			public $LargeurSidebar = "300px" ;
			public $CouleurLienSidebar = "white" ;
			public $CouleurLienHoverSidebar = "black" ;
			public function PrepareRendu(& $zone)
			{
				parent::PrepareRendu($zone) ;
				$zone->InscritContenuJs($this->CtnJsChargDocument($zone)) ;
				$zone->InscritContenuCSS($this->CtnCSSSidebar($zone)) ;
				$zone->InscritContenuCSS('.lien-sous-page {
color:black; text-decoration:none; font-weight:bold ;
}') ;
			}
			protected function CtnJsChargDocument(& $zone)
			{
				return '// Fonctions Sidebar
function hideSidebar'.$zone->IDInstanceCalc.'() {
jQuery(\'#'.$zone->IDInstanceCalc.'_sidebar\').removeClass(\'active\');
jQuery(\'#'.$zone->IDInstanceCalc.'_overlay\').fadeOut();
}
function showSidebar'.$zone->IDInstanceCalc.'() {
jQuery(\'#'.$zone->IDInstanceCalc.'_sidebar\').addClass(\'active\');
jQuery(\'#'.$zone->IDInstanceCalc.'_overlay\').fadeIn();
jQuery(\'.collapse.in\').toggleClass(\'in\');
jQuery(\'a[aria-expanded=true]\').attr(\'aria-expanded\', \'false\');
}
jQuery(document).ready(function () {
// Overlays
jQuery(\'#'.$zone->IDInstanceCalc.'_dismiss, #'.$zone->IDInstanceCalc.'_overlay\').on(\'click\', function () {
hideSidebar'.$zone->IDInstanceCalc.'() ;
});
jQuery(\'#'.$zone->IDInstanceCalc.'_sidebarCollapse\').on(\'click\', function () {
showSidebar'.$zone->IDInstanceCalc.'() ;
});
// Popover
jQuery(\'[data-toggle="popover"]\').popover({
trigger: \'manual\',
html: true,
animation: false
})
.on(\'mouseenter\', function () {
var _this = this;
jQuery(this).popover(\'show\');
jQuery(\'.popover\').on(\'mouseleave\', function () {
jQuery(_this).popover(\'hide\');
});
}).on(\'mouseleave\', function () {
var _this = this;
setTimeout(function () {
if (!jQuery(\'.popover:hover\').length) {
jQuery(_this).popover(\'hide\');
}
}, 300);
}) ;
}) ;' ;
			}
			protected function CtnCSSSidebar(& $zone)
			{
				return '#'.$zone->IDInstanceCalc.'_sidebar {
    width: '.$this->LargeurSidebar.';
    position: fixed;
    top: 0;
    left: -'.$this->LargeurSidebar.';
    height: 100vh;
    z-index: 999;
    color: #fff;
    transition: all 0.3s;
    overflow-y: scroll;
    box-shadow: 3px 3px 3px rgba(0, 0, 0, 0.2);
}
#'.$zone->IDInstanceCalc.'_sidebar.active {
    left: 0;
}
#'.$zone->IDInstanceCalc.'_dismiss {
    width: 35px;
    height: 35px;
    line-height: 35px;
    text-align: center;
    position: absolute;
    top: 10px;
    right: 10px;
    cursor: pointer;
    -webkit-transition: all 0.3s;
    -o-transition: all 0.3s;
    transition: all 0.3s;
}
#'.$zone->IDInstanceCalc.'_dismiss:hover {
    background: #fff;
    color: #7386D5;
}
#'.$zone->IDInstanceCalc.'_overlay {
    position: fixed;
	top:0px ;
	left:0px ;
    width: 100vw;
    height: 100vh;
    background: rgba(0, 0, 0, 0.7);
    z-index: 998;
    display: none;
}
#'.$zone->IDInstanceCalc.'_sidebar .sidebar-header {
    padding: 20px;
}
#'.$zone->IDInstanceCalc.'_sidebar ul.components {
    padding: 20px 0;
    border-bottom: 1px solid #47748b;
}
#'.$zone->IDInstanceCalc.'_sidebar ul p {
    padding: 10px;
}
#'.$zone->IDInstanceCalc.'_sidebar ul li a {
    padding: 10px;
    font-size: 1.1em;
    display: block;
	color:'.$this->CouleurLienSidebar.';
}
#'.$zone->IDInstanceCalc.'_sidebar ul li.active > a, a[aria-expanded="true"] {
    color: '.$this->CouleurLienSidebar.';
}
#'.$zone->IDInstanceCalc.'_sidebar a, #'.$zone->IDInstanceCalc.'_sidebar a:hover, #'.$zone->IDInstanceCalc.'_sidebar a:focus {
    color: inherit;
    text-decoration: none;
    transition: all 0.3s;
}
#'.$zone->IDInstanceCalc.'_sidebar ul li a:hover {
    background: #fff;
	color:'.$this->CouleurLienHoverSidebar.';
}

a[data-toggle="collapse"] {
    position: relative;
}
a[aria-expanded="false"]::before, a[aria-expanded="true"]::before {
    content: \'\e259\';
    display: block;
    position: absolute;
    right: 20px;
    font-family: \'Glyphicons Halflings\';
    font-size: 0.6em;
}
a[aria-expanded="true"]::before {
    content: \'\e260\';
}
ul ul a {
    font-size: 0.9em !important;
    padding-left: 30px !important;
}' ;
			}
			protected function RenduSidebar(& $zone)
			{
				$ctn = '' ;
				$ctn .= '<nav id="'.$zone->IDInstanceCalc.'_sidebar" class="'.$this->ClasseCSSBackgroundSidebar.'">
<div id="'.$zone->IDInstanceCalc.'_dismiss" title="Fermer">
<i class="glyphicon glyphicon-arrow-left"></i>
</div>
<br />'.PHP_EOL ;
				if(! $zone->PossedeMembreConnecte())
				{
					$ctn .= '<p align="center"><b>Inconnu</b>,<br>Veuillez vous connecter</p>'.PHP_EOL ;
				}
				else
				{
					$ctn .= '<p align="center"><b>'.$zone->LoginMembreConnecte().'</b>,<br>'.$zone->TitreProfilConnecte().'</p>'.PHP_EOL ;
				}
				$ctn .= '<ul class="list-unstyled components">'.PHP_EOL ;
				if($zone->PossedeMembreConnecte() == false)
				{
					$ctn .= '<li class="active">
<a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false"><span class="fa fa-home"></span> VOTRE SITE</a>
<ul class="list-unstyled" id="homeSubmenu">
<li><a href="../index.php?" target="public">Partie publique</a></li>
<li><a href="?">Administration</a></li>
</ul>
</li>'.PHP_EOL ;
				}
				else
				{
					// Compte
					$ctn .= '<li>
<a href="#homeSubmenu" data-toggle="collapse" aria-expanded="true"><span class="fa fa-home"></span> VOTRE COMPTE</a>
<ul class="list-unstyled collapse" id="homeSubmenu">
<li><a href="?">Accueil</a></li>
<li><a href="../index.php?" target="public">Site Web</a></li>' ;
					$ctn .= '<li><a href="?appelleScript=listeVisites">Visiteurs</a></li>'.PHP_EOL ;
					if($zone->AutoriserModifPrefs == 1)
					{
						$ctn .= '<li><a href="?appelleScript=modifPrefs">Param&egrave;tres</a></li>'.PHP_EOL ;
					}
					$ctn .= '<li><a href="?appelleScript=deconnexion">Deconnexion</a></li>'.PHP_EOL ;
					$ctn .= '</ul>
</li>'.PHP_EOL ;
					// Pages & Admins
					$ctn .= '<li class="active">
<a href="#repertSousMenu" data-toggle="collapse" aria-expanded="false"><span class="fa fa-folder"></span> REPERTOIRE</a>
<ul class="list-unstyled" id="repertSousMenu">'.PHP_EOL ;
					$ctn .= '<li><a href="?appelleScript=parcourtPageRacine">Pages</a></li>' ;
					if($zone->PossedePrivileges($zone->PriviligesEditMembership))
					{
						$ctn .= '<li><a href="?appelleScript=listeMembres">Administrateurs</a></li>'.PHP_EOL ;
						$ctn .= '<li><a href="?appelleScript=ajoutMembre">Cr&eacute;er admin.</a></li>'.PHP_EOL ;
					}
					$ctn .= '<li><a href="?appelleScript=detailCache">Cache</a></li>'.PHP_EOL ;
					$ctn .= '</ul>
</li>'.PHP_EOL ;
					// Outils
					$ctn .= '<li>
<a href="#outilsSousMenu" data-toggle="collapse" aria-expanded="false"><span class="fa fa-wrench"></span> OUTILS</a>
<ul class="collapse list-unstyled" id="outilsSousMenu">'.PHP_EOL ;
					$ctn .= '<li><a href="?appelleScript=genereFichPdf">Régénerer les fichiers PDF</a></li>'.PHP_EOL ;
					$ctn .= '<li><a href="?appelleScript=repareArborescence">Réconstruire l\'arborescence</a></li>'.PHP_EOL ;
					$ctn .= '<li><a href="?appelleScript=reconstruitRecherche">Réconstruire la recherche</a></li>'.PHP_EOL ;
					$ctn .= '<li><a href="?appelleScript=repareContenu">Réparer le contenu</a></li>'.PHP_EOL ;
					$ctn .= '<li><a href="?appelleScript=construirePageStatique">Construire les pages</a></li>'.PHP_EOL ;
					$ctn .= '<li><a href="?appelleScript=executeCodePHP">Exécuter du code PHP</a></li>'.PHP_EOL ;
					$ctn .= '</ul>
</li>'.PHP_EOL ;
					// Registre
					$ctn .= '<li>
<a href="#registreSousMenu" data-toggle="collapse" aria-expanded="false"><span class="fa fa-database"></span> REGISTRE</a>
<ul class="collapse list-unstyled" id="registreSousMenu">'.PHP_EOL ;
					$ctn .= '<li><a href="?appelleScript=listeTachesProg">Tâches programmées</a></li>'.PHP_EOL ;
					$ctn .= '</ul>
</li>'.PHP_EOL ;
					
					// Traductions
					$ctn .= '<li>
<a href="#traductSousMenu" data-toggle="collapse" aria-expanded="false"><span class="fa fa-weixin"></span> TRADUCTIONS</a>
<ul class="collapse list-unstyled" id="traductSousMenu">'.PHP_EOL ;
					$ctn .= '<li><a href="?appelleScript=choisitLangueDefaut">Langue par défaut</a></li>'.PHP_EOL ;
					$ctn .= '<li><a href="?appelleScript=listeLangues">Langues</a></li>'.PHP_EOL ;
					$ctn .= '<li><a href="?appelleScript=listeFichsLangue">Fichiers de langue</a></li>'.PHP_EOL ;
					$ctn .= '</ul>
</li>'.PHP_EOL ;
					
					// Securite
					$ctn .= '<li>
<a href="#securSousMenu" data-toggle="collapse" aria-expanded="false"><span class="fa fa-warning"></span> SECURITE</a>
<ul class="collapse list-unstyled" id="securSousMenu">'.PHP_EOL ;
					$ctn .= '<li><a href="?appelleScript=exportBD">Exporter la BD</a></li>'.PHP_EOL ;
					$ctn .= '<li><a href="?appelleScript=restaureBD">Restaurer la BD</a></li>'.PHP_EOL ;
					$ctn .= '<li><a href="?appelleScript=copieFichsModifs">Copie des fichiers modifiés</a></li>'.PHP_EOL ;
					$ctn .= '<li><a href="?appelleScript=fixeAccesFich">Accès aux fichiers</a></li>'.PHP_EOL ;
					$ctn .= '</ul>
</li>'.PHP_EOL ;
				}
				$ctn .= '</ul>'.PHP_EOL ;
				$ctn .= '</nav>' ;
				return $ctn ;
			}
			public function RenduEntete(& $zone)
			{
				$ctn = '' ;
				$ctn .= $this->RenduEnteteHtmlSimple($zone).PHP_EOL ;
				$ctn .= $this->RenduSidebar($zone).PHP_EOL ;
				$ctn .= '<div class="container-fluid">'.PHP_EOL ;
				$ctn .= '<div class="row">'.PHP_EOL ;
				$ctn .= '<div class="col-xs-2 col-sm-2">
<button type="button" title="Menu" id="'.$zone->IDInstanceCalc.'_sidebarCollapse" class="btn btn-info navbar-btn">
<i class="fa fa-bars"></i>
</button>
</div>'.PHP_EOL ;
				$ctn .= '<div class="col-xs-10 col-sm-10" align="center"><h3>'.$zone->Titre.'</h3></div>'.PHP_EOL ;
				$ctn .= '</div>'.PHP_EOL ;
				$ctn .= '</div>'.PHP_EOL ;
				$ctn .= '<hr />' ;
				return $ctn ;
			}
			public function RenduPied(& $zone)
			{
				$ctn = '' ;
				$ctn .= '<div id="'.$zone->IDInstanceCalc.'_overlay"></div>' ;
				$ctn .= $this->RenduPiedHtmlSimple($zone).PHP_EOL ;
				return $ctn ;
			}
		}
		
		class DocWebAdminNonConnecteWsm2 extends DocWebAdminBaseWsm2
		{
		}
		
		class DocWebAdminConnecteWsm2 extends DocWebAdminBaseWsm2
		{
		}
	}
	
?>