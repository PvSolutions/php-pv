<?php
	
	if(! defined('DOCUMENT_WEB_BASE_BOOTSTRAP1'))
	{
		define('DOCUMENT_WEB_BASE_BOOTSTRAP1', 1) ;
		
		class DocWebBaseBootstrap1 extends PvDocumentWebHtml
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
		
		class DocWebDefautBootstrap1 extends DocWebBaseBootstrap1
		{
		}
		
	}
	
?>