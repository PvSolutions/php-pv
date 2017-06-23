<?php
	
	if(! defined('DOCUMENT_WEB_BASE_BASIC1'))
	{
		define('DOCUMENT_WEB_BASE_BASIC1', 1) ;
		
		class DocWebBaseBasic1 extends PvDocumentWebHtml
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
		
		class DocWebNonConnecteBasic1 extends DocWebBaseBasic1
		{
		}
		
		class DocWebConnecteBasic1 extends DocWebBaseBasic1
		{
		}
		
	}
	
?>