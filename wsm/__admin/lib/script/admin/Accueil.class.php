<?php
	
	if(! defined('SCRIPT_ACCUEIL_ADMIN_WSM2'))
	{
		define('SCRIPT_ACCUEIL_ADMIN_WSM2', 1) ;
		
		class ScriptAccueilAdminWsm2 extends ScriptBaseAdminWsm2
		{
			protected function RenduExploration()
			{
				$bd = $this->ApplicationParent->CreeBDPrinc() ;
				$siteWsm = & $this->ApplicationParent->SiteWsm ;
				$ctn = '' ;
				$ctn .= '<div class="panel panel-default">'.PHP_EOL ;
				$ctn .= '<div class="panel-heading">EXPLORATION</div>'.PHP_EOL ;
				$ctn .= '<div class="panel-body">'.PHP_EOL ;
				$ctn .= '<p><a href="?appelleScript=parcourtPageRacine">Page Racine</a> | <a href="?appelleScript=ajoutPage">Ajouter une page</a> | <a href="?appelleScript=ajoutInstancePage">Ajouter une page à partir d\'un mod&ecirc;le</a> | <a href="?appelleScript=restaureBD">Restaurer la Base de donn&eacute;es</a></p>' ;
				$ctn .= '<hr>'.PHP_EOL ;
				$lgns = $bd->FetchSqlRows('select * from '.$siteWsm->NomTablePage.' where id_page_parent_page='.$siteWsm->IdPageRacine.' order by date_publish_page desc, time_publish_page desc') ;
				if(count($lgns) > 0)
				{
					$ctn .= '<div class="container-fluid">'.PHP_EOL ;
					$ctn .= '<div class="row">'.PHP_EOL ;
					foreach($lgns as $i => $lgn)
					{
						$ctn .= '<div class="col-sm-6"><i class="fa fa-folder"></i> <a href="?appelleScript=parcourtPage&idPage='.$lgn["id_page"].'">'.htmlentities($lgn["title_page"]).'</a></div>' ;
					}
					$ctn .= '</div>'.PHP_EOL ;
					$ctn .= '</div>' ;
				}
				$ctn .= '</div>'.PHP_EOL ;
				$ctn .= '</div>' ;
				return $ctn ;
			}
			protected function RenduDernPagesModifs()
			{
				$bd = $this->ApplicationParent->CreeBDPrinc() ;
				$siteWsm = & $this->ApplicationParent->SiteWsm ;
				$ctn = '' ;
				$ctn .= '<div class="panel panel-default">'.PHP_EOL ;
				$ctn .= '<div class="panel-heading">DERNIERES PAGES MODIFIEES</div>'.PHP_EOL ;
				$ctn .= '<div class="panel-body">'.PHP_EOL ;
				$lgns = $bd->FetchSqlRows('select * from '.$siteWsm->NomTablePage.' order by date_modif_page desc, time_modif_page desc limit 0, 5') ;
				if(count($lgns) > 0)
				{
					$ctn .= '<div class="container-fluid">'.PHP_EOL ;
					$ctn .= '<div class="row">'.PHP_EOL ;
					foreach($lgns as $i => $lgn)
					{
						$ctn .= '<div class="col-sm-12"><a href="?appelleScript=modifPage&idPage='.$lgn["id_page"].'">'.$siteWsm->EncodeHtmlChemin($lgn["path_title_page"]).'</a></div>' ;
					}
					$ctn .= '</div>'.PHP_EOL ;
					$ctn .= '</div>' ;
				}
				$ctn .= '</div>'.PHP_EOL ;
				$ctn .= '</div>' ;
				return $ctn ;
			}
			protected function RenduDernPagesPubls()
			{
				$bd = $this->ApplicationParent->CreeBDPrinc() ;
				$siteWsm = & $this->ApplicationParent->SiteWsm ;
				$ctn = '' ;
				$ctn .= '<div class="panel panel-default">'.PHP_EOL ;
				$ctn .= '<div class="panel-heading">DERNIERES PAGES PUBLIEES</div>'.PHP_EOL ;
				$ctn .= '<div class="panel-body">'.PHP_EOL ;
				$lgns = $bd->FetchSqlRows('select * from '.$siteWsm->NomTablePage.' order by date_publish_page desc, time_publish_page desc limit 0, 5') ;
				if(count($lgns) > 0)
				{
					$ctn .= '<div class="container-fluid">'.PHP_EOL ;
					$ctn .= '<div class="row">'.PHP_EOL ;
					foreach($lgns as $i => $lgn)
					{
						$ctn .= '<div class="col-sm-12"><a href="?appelleScript=parcourtPage&idPage='.$lgn["id_page"].'">'.$siteWsm->EncodeHtmlChemin($lgn["path_title_page"]).'</a></div>' ;
					}
					$ctn .= '</div>'.PHP_EOL ;
					$ctn .= '</div>' ;
				}
				$ctn .= '</div>'.PHP_EOL ;
				$ctn .= '</div>' ;
				return $ctn ;
			}
			protected function RenduBarreRecherche()
			{
				$ctn = '' ;
				return $ctn ;
			}
			public function RenduSpecifique()
			{
				$ctn = '' ;
				$ctn .= $this->RenduExploration().PHP_EOL ;
				$ctn .= $this->RenduDernPagesModifs().PHP_EOL ;
				$ctn .= $this->RenduDernPagesPubls().PHP_EOL ;
				$ctn .= $this->RenduBarreRecherche() ;
				return $ctn ;
			}
		}
	}
	
?>