<?php
	
	if(! defined('COMPOSANT_TM51543'))
	{
		if(! defined('CHEMIN_PVIEW'))
		{
			define('CHEMIN_PVIEW', '../../_PVIEW') ;
		}
		if(! defined('SYSTEME_SWS'))
		{
			include dirname(__FILE__)."/".CHEMIN_PVIEW."/Sws/Systeme.class.php" ;
		}
		define('COMPOSANT_TM51543', 1) ;
		
		class CompHeaderTM51543 extends PvPortionRenduHtml
		{
			public $IdGroupeMenu = 1 ;
			protected function RenduDispositifBrut()
			{
				$syst = & ReferentielSws::$SystemeEnCours ;
				$bd = $syst->ObtientBDSupport() ;
				$entMenu = & $syst->ModuleMenu->EntiteMenu ;
				$lgns = $bd->FetchSqlRows('select * from '.$bd->EscapeTableName($entMenu->NomTable).' where '.$bd->EscapeVariableName($entMenu->NomColIdGroupe).' = :id order by date_publication asc, heure_publication asc', array('id' => $this->IdGroupeMenu)) ;
				$ctn = '' ;
				$ctn .= '<div class="main">
<div class="wrapper">
<h1>
<a href="?">'.$this->ZoneParent->TitreLogo.'</a>
<strong>'.$this->ZoneParent->SloganLogo.'</strong>
</h1>
<nav>
<ul class="menu">'.PHP_EOL ;
				foreach($lgns as $i => $lgn)
				{
					$attrSpec = "" ;
					if($i == 0)
					{
						$attrSpec .= ' class="active"' ;
					}
					$ctn .= '<li><a'.$attrSpec.' href="'.$lgn["url"].'">'.$lgn["titre"].'</a></li>'.PHP_EOL ;
				}
				$ctn .= '</ul>
</nav>
</div>
</div>' ;
				return $ctn ;
			}
		}
		class CompSliderWrapperTM51543 extends PvPortionRenduHtml
		{
			public $IdSlider = 1 ;
			public $LibLirePlus = "Read more" ;
			protected function RenduDispositifBrut()
			{
				$syst = & ReferentielSws::$SystemeEnCours ;
				$bd = $syst->ObtientBDSupport() ;
				$entite = & $syst->ModuleSlider->EntiteElemSlider ;
				$ctnCorps = '' ;
				$ctnPagin = '' ;
				$lgns = $bd->FetchSqlRows("select * from ".$bd->EscapeTableName($entite->NomTable)." where ".$bd->EscapeVariableName($entite->NomColIdSlider)." = :id order by ".$bd->EscapeVariableName($entite->NomColDatePubl)." desc, ".$bd->EscapeVariableName($entite->NomColHeurePubl)." desc limit 0, 4", array("id" => $this->IdSlider)) ;
				$ctn = '' ;
				foreach($lgns as $i => $lgn)
				{
					$partsTitre = explode(" - ", $lgn[$entite->NomColTitre], 2) ;
					if(count($partsTitre) == 1)
						$partsTitre[] = "" ;
					// echo 'c : '.$syst->ObtientCheminPubl($lgn[$entite->NomColCheminImage]).'<br>' ;
					$ctnCorps .= '<li>
<img src="'.$syst->ObtientCheminPubl($lgn[$entite->NomColCheminImage]).'" alt="'.htmlspecialchars($partsTitre[0]).'" />
<strong class="banner">
<a class="close" href="#">x</a>
<strong>'.$partsTitre[0].'</strong>
<span>'.$partsTitre[1].'</span>
<b class="margin-bot">'.$lgn[$entite->NomColDescription].'</b>
<a class="button2" href="'.$lgn[$entite->NomColUrl].'">'.$this->LibLirePlus.'</a>
</strong>
</li>'.PHP_EOL ;
					$ctnPagin .= '<li><a class="item-'.($i + 1).'" href=""><strong>0'.($i + 1).'</strong></a></li>'.PHP_EOL ;
				}
				$ctn .= '<div id="'.$this->IDInstanceCalc.'" class="slider-wrapper">
<div class="slider">
<ul class="items">
'.$ctnCorps.'</ul>
</div>
<ul class="pagination">
'.$ctnPagin.'</ul>
</div>' ;
				$ctn .= '<script language="javascript">
jQuery(window).load(function() {
	jQuery("#'.$this->IDInstanceCalc.' .slider")._TMS({
		duration:800,
		easing:"easeOutQuart",
		preset:"diagonalExpand",
		slideshow:7000,
		pagNums:false,
		pagination:".pagination",
		banners:"fade",
		pauseOnHover:true,
		waitBannerAnimation:true
	});
});
</script>' ;
				return $ctn ;
			}
		}
		class CompList1TM51543 extends PvPortionRenduHtml
		{
			protected function RenduDispositifBrut()
			{
				$syst = & ReferentielSws::$SystemeEnCours ;
				$bd = $syst->ObtientBDSupport() ;
				$entite = & $syst->ModulePrestSvc->EntitePrestSvc ;
				$lgns = $bd->FetchSqlRows("select * from ".$bd->EscapeTableName($entite->NomTable)." order by date_publication desc, heure_publication desc, id desc") ;
				// print_r($bd) ;
				$ctn = '' ;
				$ctn .= '<ul id="'.$this->IDInstanceCalc.'" class="list-1">'.PHP_EOL ;
				foreach($lgns as $i => $lgn)
				{
					$attrSpec = '' ;
					if($i == count($lgns) - 1)
					{
						$attrSpec .= ' class="last-item"' ;
					}
					$ctn .= '<li><a href="?appelleScript=consult_prest_svc&id='.$lgn["id"].'">'.$lgn["titre"].'</a></li>'.PHP_EOL ;
				}
				$ctn .= '</ul>' ;
				return $ctn ;
			}
		}
		class CompList2TM51543 extends PvPortionRenduHtml
		{
			public $IdGroupeMenu = 2 ;
			protected function RenduDispositifBrut()
			{
				$syst = & ReferentielSws::$SystemeEnCours ;
				$bd = $syst->ObtientBDSupport() ;
				$entite = & $syst->ModuleArticle->EntiteArticle ;
				$lgns = $bd->FetchSqlRows('select * from '.$bd->EscapeTableName($entite->NomTable).' where '.$bd->EscapeVariableName($entite->NomColIdRubr).' = :id order by date_publication desc, heure_publication desc limit 0, 3', array('id' => $this->IdGroupeMenu)) ;
				$ctn = '' ;
				$ctn .= '<ul class="list-2">'.PHP_EOL ;
				foreach($lgns as $i => $lgn)
				{
					$ctn .= '<li>
<a class="item" href="#">'.$lgn["titre"].'</a>
<span>'.$lgn["description"].'</span>
</li>'.PHP_EOL ;
				}
				$ctn .= '</ul>' ;
				return $ctn ;
			}
		}
		class CompWelcomeBlocTM51543 extends PvPortionRenduHtml
		{
			public $IdArticle = 4 ;
			public $LibLirePlus = "Read more" ;
			public $MsgAucunArticle = "Aucun article trouv&eacute;" ;
			protected function RenduDispositifBrut()
			{
				$syst = & ReferentielSws::$SystemeEnCours ;
				$bd = $syst->ObtientBDSupport() ;
				$entite = & $syst->ModuleArticle->EntiteArticle ;
				$lgn = $bd->FetchSqlRow("select * from ".$bd->EscapeTableName($entite->NomTable)." where ".$bd->EscapeVariableName($entite->NomColId)." = :id", array("id" => $this->IdArticle)) ;
				$ctn = '' ;
				if(count($lgn))
				{
					$ctn .= '<h3>'.$lgn[$entite->NomColTitre].'</h3>
<div class="p1">
<figure class="img-border"><img src="'.$syst->ObtientCheminPubl($lgn[$entite->NomColCheminImage]).'" alt="'.htmlspecialchars($lgn[$entite->NomColTitre]).'" /></figure>
<div class="clear"></div>
</div>
<p class="img-indent-bot">'.$lgn[$entite->NomColDescription].'</p>
<a class="button" href="#">'.$this->LibLirePlus.'</a>' ;
				}
				else
				{
					$ctn .= $this->MsgAucunArticle ;
				}
				return $ctn ;
			}
		}
		class CompFooterTM51543 extends PvPortionRenduHtml
		{
			public $IdArticleSurbrill = 5 ;
			public $LibLirePlus = "Read more" ;
			public $LibLiensUtiles = "Links" ;
			public $MsgCopyright = 'Design Studio &copy; 2011 Website Template by <a class="color-1" href="http://www.templatemonster.com/" target="_blank" rel="nofollow">www.templatemonster.com</a>' ;
			public $IdGroupeMenuUtiles = 2 ;
			public $UrlFacebook = "" ;
			protected function RenduDispositifBrut()
			{
				$syst = & ReferentielSws::$SystemeEnCours ;
				$bd = $syst->ObtientBDSupport() ;
				$entite = & $syst->ModuleArticle->EntiteArticle ;
				$entite2 = & $syst->ModuleMenu->EntiteMenu ;
				$lgnSubrill = $bd->FetchSqlRow("select * from ".$bd->EscapeTableName($entite->NomTable)." where ".$bd->EscapeVariableName($entite->NomColId)." = :id", array("id" => $this->IdArticleSurbrill)) ;
				$lgnsUtiles = $bd->FetchSqlRows("select * from ".$bd->EscapeTableName($entite2->NomTable)." where ".$bd->EscapeVariableName($entite2->NomColIdGroupe)." = :id order by date_publication desc, heure_publication desc", array("id" => $this->IdGroupeMenuUtiles)) ;
				$ctn = "" ;
				$ctn .=	'<div class="main">
<div class="wrapper border-bot2 margin-bot">
<article class="fcol-1">
<div class="indent-left">
<h3 class="color-1">Stay Connected</h3>
<ul class="list-services">
<li><a href="#">Facebook</a></li>
<li><a class="it-2" href="#">Twitter</a></li>
<!--
<li><a class="it-3" href="#">Linked In</a></li>
<li class="last-item"><a class="it-4" href="#">Del.ico.us</a></li>
-->
</ul>
</div>
</article>
<article class="fcol-2">' ;
				$ctn .= '<h3 class="color-1">'.$lgnSubrill["titre"].'</h3>
<p class="p3">'.$lgnSubrill["description"].'</p>
<a class="button2" href="?appelleScript=consult_article&id='.$lgnSubrill["id"].'">'.$this->LibLirePlus.'</a>
</article>
<article class="fcol-3">
<h3 class="color-1">'.$this->LibLiensUtiles.'</h3>
<ul class="list-3">'.PHP_EOL ;
				foreach($lgnsUtiles as $i => $lgn)
				{
					$ctn .= '<li><a href="'.$lgn["url"].'">'.$lgn["titre"].'</a> <span> - '.$lgn["sommaire"].'</span></li>'.PHP_EOL ;
				}
				$ctn .= '</ul>
</article>
</div>
<div class="aligncenter">
'.$this->MsgCopyright.'
</div>
</div>' ;
				return $ctn ;
			}
		}
		
	}
	
?>