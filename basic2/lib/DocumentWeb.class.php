<?php
	
	if(! defined('DOCUMENT_WEB_BASE_BASIC2'))
	{
		define('DOCUMENT_WEB_BASE_BASIC2', 1) ;
		
		class DocWebBaseBasic2 extends PvDocumentWebHtml
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
		
		class DocWebNonConnecteBasic2 extends DocWebBaseBasic2
		{
		}
		
		class DocWebConnecteBasic2 extends DocWebBaseBasic2
		{
		}
		
	}
	
?>