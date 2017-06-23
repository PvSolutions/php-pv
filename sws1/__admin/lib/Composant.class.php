<?php
	
	if(! defined('COMPOSANT_MONSITE'))
	{
		if(! defined('CHEMIN_PVIEW'))
		{
			define('CHEMIN_PVIEW', '../../_PVIEW') ;
		}
		if(! defined('SYSTEME_SWS'))
		{
			include dirname(__FILE__)."/".CHEMIN_PVIEW."/Sws/Systeme.class.php" ;
		}
		define('COMPOSANT_MONSITE', 1) ;
		
		class CompEnteteCorpsPublMonSite extends PvPortionRenduHtml
		{
			protected function RenduDispositifBrut()
			{
				$ctn = '' ;
				$ctn .= '<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td width="30%"><img src="images/logo.png" border="0" /></td>
<td width="*">
<table width="100%" cellspacing="0" class="menuTop" cellpadding="0">
<tr>'.PHP_EOL ;
				$bd = & $this->ApplicationParent->BDPrinc ;
				$lgns = $bd->FetchSqlRows('select * from menu where id_groupe=1 order by date_publication, heure_publication') ;
				$ctn .= '<td>
<a href="?">ACCUEIL</a>
</td>'.PHP_EOL ;
				foreach($lgns as $i => $lgn)
				{
					$url = $lgn["url"] != "" ? $lgn["url"] : "javascript:;" ;
					$ctn .= '<td class="sep"></td>'.PHP_EOL ;
					$ctn .= '<td>
<a href="'.$url.'">'.htmlentities(strtoupper($lgn["titre"])).'</a>
</td>'.PHP_EOL ;
				}
				$ctn .= '</tr>
</table>
</td>
</tr>
</table>'.PHP_EOL ;
				$ctn .= '<script type="text/javascript">
	jQuery(function() {
		jQuery(\'.menuTop a\').hover(function (){
			jQuery(this).closest(\'td\').addClass(\'hover\') ;
		}, function (){
			jQuery(this).closest(\'td\').removeClass(\'hover\') ;
		}) ;
	}) ;
</script>' ;
				return $ctn ;
			}
		}
		class CompPiedCorpsPublMonSite extends PvPortionRenduHtml
		{
			public $MsgDroitsReserv = 'MonSiteices (c) 2014 Tous droits r&eacute;serv&eacute;s' ;
			protected function RenduDispositifBrut()
			{
				return "<p align='center'>".$this->MsgDroitsReserv."</p>" ;
			}
		}
		
	}
	
?>