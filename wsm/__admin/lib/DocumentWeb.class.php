<?php
	
	if(! defined('DOCUMENT_WEB_BASE_WSM2'))
	{
		define('DOCUMENT_WEB_BASE_WSM2', 1) ;
		
		class DocWebBaseWsm2 extends PvDocumentWebHtml
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
		
	}
	
?>