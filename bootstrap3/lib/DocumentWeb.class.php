<?php
	
	if(! defined('DOCUMENT_WEB_BASE_BOOTSTRAP3'))
	{
		define('DOCUMENT_WEB_BASE_BOOTSTRAP3', 1) ;
		
		class DocWebBaseBootstrap3 extends PvDocumentWebHtml
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
		
		class DocWebDefautBootstrap3 extends DocWebBaseBootstrap3
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
		
		class DocWebIframeDlgBootstrap3 extends DocWebBaseBootstrap3
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
		
		class DocWebCadreVideBootstrap3 extends DocWebBaseBootstrap3
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