<?php
	
	if(! defined('DOCUMENT_WEB_BASE_BASIC3'))
	{
		define('DOCUMENT_WEB_BASE_BASIC3', 1) ;
		
		class DocWebBaseBasic3 extends PvDocumentWebHtml
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
		
		class DocWebNonConnecteBasic3 extends DocWebBaseBasic3
		{
		}
		
		class DocWebConnecteBasic3 extends DocWebBaseBasic3
		{
		}
		
	}
	
?>