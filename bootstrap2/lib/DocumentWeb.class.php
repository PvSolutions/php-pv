<?php
	
	if(! defined('DOCUMENT_WEB_BASE_BOOTSTRAP2'))
	{
		define('DOCUMENT_WEB_BASE_BOOTSTRAP2', 1) ;
		
		class DocWebBaseBootstrap2 extends PvDocumentWebHtml
		{
			protected function RenduEnteteHtmlSimple(& $zone)
			{
				return parent::RenduEntete($zone) ;
			}
			protected function RenduPiedHtmlSimple(& $zone)
			{
				return parent::RenduPied($zone) ;
			}
		}
		
		class DocWebDefautBootstrap2 extends DocWebBaseBootstrap2
		{
			public function PrepareRendu(& $zone)
			{
				parent::PrepareRendu($zone) ;
				$autoRafraichActive = ($zone->ScriptPourRendu->DoitAutoRafraich()) ? 1 : 0 ;
				$zone->InscritContenuCSS('#iframe-dlg .modal-body {
max-height: 800px;
}') ;
				$zone->InscritContenuJs('var IframeDlg = {
	getNode : function() {
		return jQuery("#iframe-dlg") ;
	},
	init : function() {
		var node = IframeDlg.getNode() ;
		node.on("hidden.bs.modal", function(e) {
			var node = IframeDlg.getNode() ;
			node.find("iframe").attr("src", "about:blank") ;
			if(IframeDlg.onClose !== undefined && IframeDlg.onClose !== null) {
				IframeDlg.onClose() ;
			}'.(($autoRafraichActive == 1) ? '
demarreAutoRafraich()' : '').'
		}) ;
	},
	open : function(url) {
		var node = IframeDlg.getNode() ;'.(($autoRafraichActive == 1) ? '
annulAutoRafraich()' : '').'
		node.find("iframe").attr("src", url) ;
		node.modal() ;
	},
	close : function() {
		var node = IframeDlg.getNode() ;
		node.modal("hide") ;
	},
	setTitle : function (title) {
		var node = IframeDlg.getNode() ;
		node.find(".modal-title").text(title) ;
	},
	setHeight : function(height) {
		var node = IframeDlg.getNode() ;
		var winHeight = jQuery(window).height() ;
		var iframeHeight = node.find("iframe").height() ;
		if(height < winHeight) {
			if(height > iframeHeight) {
				var realHeight = height + 20 ;
				node.find("iframe").css({ height : realHeight + "px", overflow : "hidden" }) ;
				node.find("iframe").attr("scrolling", "no") ;
			}
		}
		else {
			node.find("iframe").css({ height : (height) + "px", overflow : "scroll" }) ;
			node.find("iframe").attr("scrolling", "yes") ;
		}
	},
	onClose : function() {'.(($zone->ScriptPourRendu->ContenuJsFermeDlg != '') ? PHP_EOL . '
	'.$zone->ScriptPourRendu->ContenuJsFermeDlg : 'window.location.href = window.location.href ;').'}
} ;
jQuery(function() {
	IframeDlg.init() ;
}) ;') ;
			}
			public function RenduEntete(& $zone)
			{
				$ctn = '' ;
				$ctn .= parent::RenduEntete($zone) ;
				$ctn .= '<table width="100%" cellspacing="0" class="barre-logo">' ;
				$ctn .= '<tr>'.PHP_EOL ;
				$ctn .= '<td width="50%">'.$zone->Titre.'</td>'.PHP_EOL ;
				$ctn .= '<td width="*" align="right">' ;
				if($zone->SurScriptConnecte())
				{
					$ctn .= '<div class="dropdown">
Votre compte :
<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown">
'.htmlentities($zone->TitreProfilConnecte()).' <b>'.htmlentities($zone->LoginMembreConnecte()).'</b>
<span class="caret"></span>
</button>
<ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="dropdownMenu1">
<li role="presentation"><a role="menuitem" tabindex="-1" href="?appelleScript=modifPrefs">Infos perso</a></li>
<li role="presentation" class="divider"></li>
<li role="presentation"><a role="menuitem" tabindex="-1" href="?appelleScript=deconnexion">Deconnexion</a></li>
</ul>
</div>' ;
				}
				else
				{
					$ctn .= '<a href="?appelleScript=connexion" class="btn btn-default"><i class="fa fa-log-in"></i> Connexion</a>' ;
				}
				$ctn .= '</td>'.PHP_EOL ;
				$ctn .= '</tr>'.PHP_EOL ;
				$ctn .= '</table>'.PHP_EOL ;
				if($zone->SurScriptConnecte())
				{
					$ctn .= '<nav class="navbar navbar-default" role="navigation">
<div class="container-fluid">
<!-- Brand and toggle get grouped for better mobile display -->
<div class="navbar-header">
<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
<span class="sr-only">Derouler menu</span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</button>
<a class="navbar-brand" href="#">&nbsp;</a>
</div>'.PHP_EOL ;
					$ctn .= '<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
<ul class="nav navbar-nav">
<li class="active"><a href="?"><i class="fa fa-home"></i></a></li>'.PHP_EOL ;
					if($zone->PossedePrivileges($zone->PrivilegesEditMembership) || $zone->PossedePrivileges($zone->PrivilegesEditMembres))
					{
						$ctn .= '<li class="dropdown">'.PHP_EOL ;
						$ctn .= '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Acc&egrave;s <span class="caret"></span></a>
<ul class="dropdown-menu">
<li><a href="?appelleScript=ajoutMembre">Cr&eacute;er membre</a></li>
<li><a href="?appelleScript=listeMembres">Tous les membres</a></li>'.PHP_EOL ;
						if($zone->PossedePrivileges($zone->PrivilegesEditMembership))
						{
							$ctn .= '<li role="separator" class="divider"></li>
<li><a href="?appelleScript=ajoutProfil">Cr&eacute;er profil</a></li>
<li><a href="?appelleScript=listeProfils">Tous les profils</a></li>
<li role="separator" class="divider"></li>
<li><a href="?appelleScript=ajoutRole">Cr&eacute;er r&ocirc;le</a></li>
<li><a href="?appelleScript=listeRoles">Tous les r&ocirc;les</a></li>'.PHP_EOL ;
						}
						$ctn .= '</ul>
</li>' ;
					}
					$ctn .= '</ul>
</div>'.PHP_EOL ;
					$ctn .= '</div>
</nav>' ;
				}
				else
				{
					$ctn .= '<hr />'.PHP_EOL ;
					$ctn .= '<div>' ;
				}
				return $ctn ;
			}
			public function RenduPied(& $zone)
			{
				$ctn = '' ;
				$ctn .= $this->RenduIframeDlg($zone) ;
				$ctn .= parent::RenduPied($zone) ;
				return $ctn ;
			}
			protected function RenduIframeDlg(& $zone)
			{
				$ctn = '' ;
				$ctn .= '<div class="modal fade" id="iframe-dlg" tabindex="-1" role="dialog" aria-labelledby="iframe-dlg-label">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h4 class="modal-title" id="iframe-dlg-label"></h4>
</div>
<div class="modal-body">
<iframe src="about:blank" frameborder="0" style="width:98%; height:auto"></iframe> 
</div>
</div>
</div>
</div>' ;
				return $ctn ;
			}
		}
		
		class DocWebIframeDlgBootstrap2 extends DocWebBaseBootstrap2
		{
			public function PrepareRendu(& $zone)
			{
				$zone->InscritContenuJs('jQuery(window).load(function() {
window.top.IframeDlg.setTitle(document.title) ;
setTimeout(function() {
window.top.IframeDlg.setHeight(jQuery(document).height()) ;
},
500) ;
})') ;
			}
			public function RenduEntete(& $zone)
			{
				$zone->ScriptPourRendu->InclureRenduTitre = 0 ;
				$ctn = '' ;
				$ctn .= parent::RenduEntete($zone) ;
				return $ctn ;
			}
			public function RenduPied(& $zone)
			{
				$ctn = '' ;
				$ctn .= parent::RenduPied($zone) ;
				return $ctn ;
			}
		}
		
		class DocWebCadreVideBootstrap2 extends DocWebBaseBootstrap2
		{
			public function RenduEntete(& $zone)
			{
				$zone->ScriptPourRendu->InclureRenduTitre = 0 ;
				$ctn = '' ;
				$ctn .= parent::RenduEntete($zone) ;
				return $ctn ;
			}
			public function RenduPied(& $zone)
			{
				$ctn = '' ;
				$ctn .= parent::RenduPied($zone) ;
				return $ctn ;
			}
		}
		
	}
	
?>