<?php
	
	if(! defined('PV_COMPOSANT_SIMPLE_IU_BASE'))
	{
		if(! defined('PV_COMPOSANT_UI'))
		{
			include dirname(__FILE__)."/../../ComposantIU.class.php" ;
		}
		if(! defined('PV_NOYAU_SIMPLE_IHM'))
		{
			include dirname(__FILE__)."/../Noyau.class.php" ;
		}
		if(! defined('PV_FOURNISSEUR_DONNEES_SIMPLE'))
		{
			include dirname(__FILE__)."/../FournisseurDonnees.class.php" ;
		}
		define('PV_COMPOSANT_SIMPLE_IU_BASE', 1) ;
		
		class PvCfgAppelAjaxActionSimple
		{
			public $Async = true ;
			public $InstrsSucces = "" ;
			public $InstrsEchec = "" ;
			public $InstrsChargement = "" ;
		}
		
		class PvActionBaseZoneWebSimple extends PvObjet
		{
			public $ZoneParent = null ;
			public $NomElementZone = "" ;
            /*
             * Script parent
             * 
             * @var PvScriptWebSimple
             */
			public $ScriptParent = null ;
			public $NomElementScript = "" ;
			public $ComposantIUParent = null ;
			public $NomElementComposantIU = "" ;
			public $Params = array() ;
			public $Privileges = array() ;
			public $NecessiteMembreConnecte = 0 ;
			public function EstAccessible()
			{
				if(! $this->NecessiteMembreConnecte)
				{
					return 1 ;
				}
				return $this->ZoneParent->PossedePrivileges($this->Privileges) ;
			}
			public function Invoque($params=array(), $valeurPost=array(), $async=1)
			{
				$urlAct = $this->ObtientUrl($params) ;
				return PvApplication::TelechargeUrl($urlAct, $valeurPost, $async) ;
			}
			public function InstrsJsAppelAjax($params=array(), $valeurPost=array(), $cfg=null)
			{
				if($cfg == null)
				{
					$cfg = new PvCfgAppelAjaxActionSimple() ;
				}
				$urlAct = $this->ObtientUrl($params) ;
				$methode = (! empty($valeurPost) && count($valeurPost) > 0) ? "POST" : "GET" ;
				return 'var xhttp_'.$this->IDInstanceCalc.' = new XMLHttpRequest();
xhttp_'.$this->IDInstanceCalc.'.onreadystatechange = function() {
if (xhttp_'.$this->IDInstanceCalc.'.readyState == 4)
{
if(xhttp_'.$this->IDInstanceCalc.'.status == 200)
{
'.$cfg->InstrsSucces.'
}
else
{
'.$cfg->InstrsEchec.'
}
}
else
{
'.$cfg->InstrsChargement.'
}
}
xhttp_'.$this->IDInstanceCalc.'.open("'.$methode.'", '.svc_json_encode($urlAct).', '.svc_json_encode($cfg->Async).') ;
xhttp_'.$this->IDInstanceCalc.'.send() ;' ;
			}
			public function InsereAppelAjax($params=array(), $valeurPost=array(), $cfg=null)
			{
				$this->ZoneParent->InsereContenuCSS($params, $valeurPost, $cfg) ;
			}
			public function ObtientUrl($params=array())
			{
				if($this->EstPasNul($this->ScriptParent))
				{
					$url = update_url_params(
						$this->ScriptParent->ObtientUrl(),
						array_merge(
							$this->Params,
							$params,
							array($this->ZoneParent->NomParamActionAppelee => $this->NomElementZone)
						)
					) ;
					return $url ;
				}
				if($this->EstNul($this->ZoneParent))
				{
					return false ;
				}
				$chaineParams = http_build_query_string(array_merge($this->Params, $params)) ;
				if($chaineParams != '')
					$chaineParams = "&".$chaineParams ;
				$url = $this->ZoneParent->ObtientUrl()."?".urlencode($this->ZoneParent->NomParamActionAppelee).'='.urlencode($this->NomElementZone).$chaineParams ;
				return $url ;
			}
			public function ObtientUrlFmt($params=array(), $autresParams=array())
			{
				$url = $this->ObtientUrl($autresParams) ;
				foreach($params as $nom => $val)
				{
					$url .= '&'.urlencode($nom).'='.$val ;
				}
				return $url ;
			}
			public function AdopteZone($nom, & $zone)
			{
				$this->ZoneParent = & $zone ;
				$this->NomElementZone = $nom ;
			}
			public function AdopteScript($nom, & $script)
			{
				$this->ScriptParent = & $script ;
				$this->NomElementScript = $nom ;
				$this->AdopteZone($this->ScriptParent->NomElementZone."_".$this->NomElementScript, $script->ZoneParent) ;
			}
			public function AdopteComposantIU($nom, & $composant)
			{
				$this->ComposantIUParent = & $composant ;
				$this->NomElementComposantIU = $nom ;
				$this->AdopteScript($this->ComposantIUParent->NomElementScript."_".$this->NomElementComposantIU, $composant->ScriptParent) ;
			}
			public function Accepte($valeurAction)
			{
				// echo 'Nom elem : '.$valeurAction ;
				return ($this->NomElementZone == $valeurAction) ? 1 : 0 ;
			}
			public function Execute()
			{
			}
		}
		class PvActionImprimeScript extends PvActionBaseZoneWebSimple
		{
			public function Execute()
			{
				$this->ZoneParent->DemarreRenduImpression() ;
				echo $this->ZoneParent->RenduEnteteDocument() ;
				echo '<body onload="window.print() ;">' ;
				echo $this->ZoneParent->ScriptPourRendu->RenduDispositif() ;
				echo $this->ZoneParent->RenduPiedDocument() ;
				echo '</body>
</html>' ;
				$this->ZoneParent->TermineRenduImpression() ;
				exit ;
			}
		}
		class PvActionRenduPageWeb extends PvActionBaseZoneWebSimple
		{
			public $TitreDocument ;
			public $ContenusCSS = array() ;
			public $ContenusJs = array() ;
			public $CtnExtraHead ;
			public $InclureCtnJsEntete = 0 ;
			public $CtnAttrsBody = "" ;
			public function InscritContenuCSS($contenu)
			{
				$ctnCSS = new PvBaliseCSS() ;
				$ctnCSS->Definitions = $contenu ;
				$this->ContenusCSS[] = $ctnCSS ;
			}
			public function InscritLienCSS($href)
			{
				$ctnCSS = new PvLienFichierCSS() ;
				$ctnCSS->Href = $href ;
				$this->ContenusCSS[] = $ctnCSS ;
			}
			public function InscritContenuJs($contenu)
			{
				$ctnJs = new PvBaliseJs() ;
				$ctnJs->Definitions = $contenu ;
				$this->ContenusJs[] = $ctnJs ;
			}
			public function InscritContenuJsCmpIE($contenu, $versionMin=9)
			{
				$ctnJs = new PvBaliseJsCmpIE() ;
				$ctnJs->Definitions = $contenu ;
				$ctnJs->VersionMin = $versionMin ;
				$this->ContenusJs[] = $ctnJs ;
			}
			public function InscritLienJs($src)
			{
				$ctnJs = new PvLienFichierJs() ;
				$ctnJs->Src = $src ;
				$this->ContenusJs[] = $ctnJs ;
			}
			public function InscritLienJsCmpIE($src, $versionMin=9)
			{
				$ctnJs = new PvLienFichierJsCmpIE() ;
				$ctnJs->Src = $src ;
				$ctnJs->VersionMin = $versionMin ;
				$this->ContenusJs[] = $ctnJs ;
			}
			public function RenduLienCSS($href)
			{
				$ctnCSS = new PvLienFichierCSS() ;
				$ctnCSS->Href = $href ;
				return $ctnCSS->RenduDispositif() ;
			}
			public function RenduContenuCSS($contenu)
			{
				$ctnCSS = new PvBaliseCSS() ;
				$ctnCSS->Definitions = $contenu ;
				return $ctnCSS->RenduDispositif() ;
			}
			public function RenduContenuJsInclus($contenu)
			{
				$ctn = '' ;
				$ctnJs = new PvBaliseJs() ;
				$ctnJs->Definitions = $contenu ;
				if(! $this->InclureCtnJsEntete)
				{
					$this->ContenusJs[] = $ctnJs ;
				}
				else
				{
					$ctn = $ctnJs->RenduDispositif() ;
				}
				return $ctn ;
			}
			public function RenduContenuJsCmpIEInclus($contenu, $versionMin=9)
			{
				$ctn = '' ;
				$ctnJs = new PvBaliseJsCmpIE() ;
				$ctnJs->Definitions = $contenu ;
				$ctnJs->VersionMin = $versionMin ;
				if(! $this->InclureCtnJsEntete)
				{
					$this->ContenusJs[] = $ctnJs ;
				}
				else
				{
					$ctn = $ctnJs->RenduDispositif() ;
				}
				return $ctn ;
			}
			public function RenduLienJsInclus($src)
			{
				$ctn = '' ;
				$ctnJs = new PvLienFichierJs() ;
				$ctnJs->Src = $src ;
				if(! $this->InclureCtnJsEntete)
				{
					$this->ContenusJs[] = $ctnJs ;
				}
				else
				{
					$ctn = $ctnJs->RenduDispositif() ;
				}
				return $ctn ;
			}
			public function RenduLienJsCmpIEInclus($src, $versionMin=9)
			{
				$ctn = '' ;
				$ctnJs = new PvLienFichierJsCmpIE() ;
				$ctnJs->Src = $src ;
				$ctnJs->VersionMin = $versionMin ;
				$this->ContenusJs[] = $ctnJs ;
				if(! $this->InclureCtnJsEntete)
				{
					$this->ContenusJs[] = $ctnJs ;
				}
				else
				{
					$ctn = $ctnJs->RenduDispositif() ;
				}
				return $ctn ;
			}
			protected function RenduCtnsCSS()
			{
				$ctn = '' ;
				for($i=0; $i<count($this->ContenusCSS); $i++)
				{
					$ctnCSS = $this->ContenusCSS[$i] ;
					$ctn .= $ctnCSS->RenduDispositif().PHP_EOL ;
				}
				return $ctn ;
			}
			protected function RenduCtnsJs()
			{
				$ctn = '' ;
				for($i=0; $i<count($this->ContenusJs); $i++)
				{
					$ctnJs = $this->ContenusJs[$i] ;
					$ctn .= $ctnJs->RenduDispositif().PHP_EOL ;
				}
				return $ctn ;
			}
			protected function RenduEnteteDoc()
			{
				$ctn = '' ;
				$ctn .= '<!doctype html>'.PHP_EOL ;
				$ctn .= '<head>'.PHP_EOL ;
				$ctn .= '<title>'.$this->TitreDocument.'</title>'.PHP_EOL ;
				$ctn .= $this->RenduCtnsCSS() ;
				if($this->InclureCtnJsEntete == 1)
				{
					$ctn .= $this->RenduCtnsJs() ;
				}
				$ctn .= $this->CtnExtraHead ;
				$ctn .= '</head>'.PHP_EOL ;
				$ctn .= '<body'.(($this->CtnAttrsBody != '') ? ' '.$this->CtnAttrsBody :  '').'>';
				return $ctn ;
			}
			protected function RenduPiedDoc()
			{
				$ctn = '' ;
				if($this->InclureCtnJsEntete == 0)
				{
					$ctn .= $this->RenduCtnsJs() ;
				}
				$ctn .= '</body>'.PHP_EOL ;
				$ctn .= '</html>' ;
				return $ctn ;
			}
			public function Execute()
			{
				echo $this->RenduEnteteDoc() ;
				echo $this->RenduCorpsDoc() ;
				echo $this->RenduPiedDoc() ;
				exit ;
			}
			protected function RenduCorpsDoc()
			{
				return '' ;
			}
		}
		class PvActionPageWeb extends PvActionRenduPageWeb
		{
		}
		class PvActionSoumetFormSimple extends PvActionRenduPageWeb
		{
			public $ParamsGet = array() ;
			public $ParamsPost = array() ;
			public $DelaiEnvoi = 0 ;
			public $UrlEnvoi = "" ;
			public $MsgChargement = "Veuillez patienter..." ;
			public $CtnAttrsBody = 'onload="demarreSoumissForm() ;"' ;
			protected function RenduCorpsDoc()
			{
				$urlEnvoi = update_url_params($this->UrlEnvoi, $this->ParamsGet) ;
				$ctn = '' ;
				$ctn .= '<div class="msg-chargement" align="center">'.$this->MsgChargement.'</div>'.PHP_EOL ;
				$ctn .= '<form action="'.htmlentities($urlEnvoi).'" id="formSoumis" method="post">'.PHP_EOL ;
				foreach($this->ParamsPost as $n => $v)
				{
					$ctn .= '<input type="hidden" name="'.htmlentities($n).'" value="'.htmlentities($v).'" />'.PHP_EOL ;
				}
				$ctn .= '</form>' ;
				$ctn .= '<script type="text/javascript">
	function demarreSoumissForm()
	{
		var delai = '.intval($this->DelaiEnvoi).' ;
		var formSoumisNode = document.getElementById("formSoumis") ;
		if(delai > 0) {
			setTimeout(function() { formSoumisNode.submit() ; }, delai * 1000) ;
		}
		else
		{
			formSoumisNode.submit() ;
		}
	}
</script>' ;
				return $ctn ;
			}
		}
		class PvActionResultatJSONZoneWeb extends PvActionBaseZoneWebSimple
		{
			public $Resultat = null ;
			public $InclureEnteteContenu = 0 ;
			public function Execute()
			{
				if(! is_object($this->Resultat))
				{
					$this->Resultat = new StdClass() ;
				}
				$this->ConstruitResultat() ;
				if($this->InclureEnteteContenu)
				{
					Header('Content-Type:application/json'."\r\n") ;
				}
                echo @svc_json_encode($this->Resultat) ;
				$this->ZoneParent->AnnulerRendu = 1 ;
				exit ;
			}
			protected function ConstruitResultat()
			{
			}
		}
		class PvActionEnvoiJSON extends PvActionResultatJSONZoneWeb
		{
		}
		class PvActionEnvoiFichierBaseZoneWeb extends PvActionBaseZoneWebSimple
		{
			public $UtiliserTypeMime = 1 ;
			public $UtiliserFichierSource = 1 ;
			public $UtiliserFichierAttache = 1 ;
			public $TypeMime = "" ;
			public $DispositionFichierAttache = "inline" ;
			public $NomFichierAttache = "" ;
			public $ExtensionFichierAttache = "" ;
			public $CheminFichierSource = "" ;
			public $TailleContenu = 0 ;
			public $SupprimerCaractsSpec = 1 ;
			public $AutresEntetes = array() ;
			protected function CalculeTailleContenu()
			{
			}
			public function Execute()
			{
				$this->DetermineFichierAttache() ;
				$this->CalculeTailleContenu() ;
				$this->AfficheEntetes() ;
				$this->AfficheContenu() ;
				exit ;
			}
			protected function DetermineFichierAttache()
			{
				/*
				if($this->ExtensionFichierAttache == "")
				{
					$this->NomFichierAttache = $this->NomElementZone.".".$this->ExtensionFichierAttache ;
				}
				*/
				$infosFich = @pathinfo($this->CheminFichierSource) ;
				if($this->ExtensionFichierAttache == "" && $this->CheminFichierSource != "")
				{
					$this->ExtensionFichierAttache = $infosFich["extension"] ;
				}
			}
			public function SupprimeCaractsSpec($valeur)
			{
				return preg_replace('/[^a-z0-9_\.]/i', '_', $valeur) ;
			}
			protected function AfficheEntetes()
			{
				// echo $this->SupprimeCaractsSpec($this->NomFichierAttache) ;
				// exit ;
				if($this->UtiliserFichierSource == 1 && $this->TypeMime != "")
				{
					Header("Content-type:".$this->TypeMime."\r\n") ;
				}
				if($this->UtiliserFichierAttache == 1 && $this->NomFichierAttache != "")
				{
					Header("Content-disposition:".$this->DispositionFichierAttache."; filename=".$this->SupprimeCaractsSpec($this->NomFichierAttache).(($this->ExtensionFichierAttache != '') ? '.'.$this->ExtensionFichierAttache : '')."\r\n") ;
				}
				if($this->TailleContenu > 0)
				{
					Header("Content-Length:".$this->TailleContenu."\r\n") ;
				}
				foreach($this->AutresEntetes as $i => $entete)
				{
					Header($entete."\r\n") ;
				}
			}
			protected function AfficheContenu()
			{
				if($this->UtiliserFichierSource && $this->CheminFichierSource != "")
				{
					if(file_exists($this->CheminFichierSource))
					{
						$fr = @fopen($this->CheminFichierSource, "rb") ;
						if($fr !== false)
						{
							while(! feof($fr))
							{
								echo fgets($fr) ;
							}
							fclose($fr) ;
						}
						else
						{
							die("Impossible d'acceder au fichier ".$this->CheminFichierSource.". Verifier que les droits en acces et lecture sont bien octroyes") ;
						}
					}
					else
					{
						die("Le fichier ".$this->CheminFichierSource." n'existe pas.") ;
					}
				}
			}
		}
		class PvActionTelechargFichier extends PvActionEnvoiFichierBaseZoneWeb
		{
			public $TypeMime = "application/octet-stream" ;
			public $AutresEntetes = array("Pragma: public", "Expires: 0", "Cache-Control: must-revalidate, post-check=0, pre-check=0", "Content-Transfer-Encoding: binary") ;
			public $DispositionFichierAttache = "attachment" ;
		}
		class PvActionEnvoiFichierJSZoneWeb extends PvActionEnvoiFichierBaseZoneWeb
		{
			public $TypeMime = "text/javascript" ;
			public $ExtensionFichierAttache = "js" ;
		}
		class PvActionEnvoiFichierCSSZoneWeb extends PvActionEnvoiFichierBaseZoneWeb
		{
			public $TypeMime = "text/css" ;
			public $ExtensionFichierAttache = "css" ;
		}
		
		class PvDessinateurRenduBase
		{
			public function Execute(& $script, & $composant, $parametres)
			{
				return "" ;
			}
			protected function RenduFiltre(& $filtre, & $composant)
			{
				$ctn = '' ;
				if($composant->Editable)
				{
					// $ctn .= $filtre->Lie() ;
					$ctn .= $filtre->Rendu() ;
				}
				else
				{
					$ctn .= $filtre->Etiquette() ;
				}
				return $ctn ;
			}
		}
		class PvDessinateurRenduHtmlFiltresDonnees extends PvDessinateurRenduBase
		{
			public $Largeur = "" ;
			public $MaxFiltresParLigne = 2 ;
			public $InclureRenduLibelle = 1 ;
			public $LargeurLibelles = "" ;
			public $LargeurEditeurs = "" ;
			public $InclureSeparateurFiltres = 1 ;
			public $ValeurSeparateurFiltres = "&nbsp;" ;
			protected function RenduMarquesFiltre(& $marques)
			{
				$ctn = '' ;
				foreach($marques as $i => $marque)
				{
					$ctn .= ' <span style="color:'.$marque->CouleurPolice.';">'.$marque->Contenu.'</span>' ;
				}
				return $ctn ;
			}
			protected function RenduLibelleFiltre(& $filtre)
			{
				$ctn = '' ;
				$ctn .= $this->RenduMarquesFiltre($filtre->PrefixesLibelle) ;
				$ctn .= $filtre->ObtientLibelle() ;
				$ctn .= $this->RenduMarquesFiltre($filtre->SuffixesLibelle) ;
				return $ctn ;				
			}
			public function Execute(& $script, & $composant, $parametres)
			{
				$filtres = $composant->ExtraitFiltresDeRendu($parametres) ;
				$ctn = '' ;
				$ctn .= '<table' ;
				if($this->Largeur != '')
				{
					$ctn .= ' width="'.$this->Largeur.'"' ;
				}
				$ctn .= '>'.PHP_EOL ;
				$colonnesTotalFusionnees = $this->MaxFiltresParLigne * 2 ;
				if($this->InclureSeparateurFiltres)
				{
					$colonnesTotalFusionnees += ($this->MaxFiltresParLigne - 1) ;
				}
				$nomFiltres = array_keys($filtres) ;
				$filtreRendus = 0 ;
				// echo count($filtres) ;
				foreach($nomFiltres as $i => $nomFiltre)
				{
					$filtre = $filtres[$nomFiltre] ;
					if($filtre->LectureSeule)
					{
						$ctn .= '<input type="hidden" id="'.htmlentities($filtre->ObtientIDComposant()).'" name="'.htmlentities($filtre->ObtientNomComposant()).'" value="'.htmlentities($filtre->Lie()).'" />'.PHP_EOL ;
						continue ;
					}
					if($filtreRendus % $this->MaxFiltresParLigne == 0)
					{
						$ctn .= '<tr>'.PHP_EOL ;
					}
					if($filtreRendus % $this->MaxFiltresParLigne > 0)
					{
						$ctn .= '<td>'.$this->ValeurSeparateurFiltres.'</td>'.PHP_EOL ;
					}
					if($this->InclureRenduLibelle)
					{
						$ctn .= '<td' ;
						$ctn .= ' valign="top"' ;
						$ctn .= '>'.PHP_EOL ;
						$ctn .= '<label for="'.$filtre->ObtientIDElementHtmlComposant().'">'.$this->RenduLibelleFiltre($filtre).'</label>'.PHP_EOL ;
						$ctn .= '</td>'.PHP_EOL ;
					}
					$ctn .= '<td' ;
					$ctn .= ' valign="top"' ;
					$ctn .= '>'.PHP_EOL ;
					$ctn .= $this->RenduFiltre($filtre, $composant).PHP_EOL ;
					$ctn .= '</td>'.PHP_EOL ;
					$filtreRendus++ ;
					if($filtreRendus % $this->MaxFiltresParLigne == 0)
					{
						$ctn .= '</tr>'.PHP_EOL ;
					}
				}
				if($filtreRendus % $this->MaxFiltresParLigne != 0)
				{
					$colonnesFusionnees = ($this->MaxFiltresParLigne - ($filtreRendus % $this->MaxFiltresParLigne)) * (($this->InclureRenduLibelle) ? 2 : 1) ;
					$colonnesFusionnees += ($this->MaxFiltresParLigne - 1) ;
					$ctn .= '<td colspan="'.$colonnesFusionnees.'">&nbsp;</td>'.PHP_EOL ;
					$ctn .= '</tr>'.PHP_EOL ;
				}
				$ctn .= '</table>' ;
				return $ctn ;
			}
			public function VersionTexte(& $composant, $parametres)
			{
				$filtres = $composant->ExtraitFiltresDeRendu($parametres) ;
				$nomFiltres = array_keys($filtres) ;
				$ctn = '' ;
				foreach($nomFiltres as $i => $nomFiltre)
				{
					$ctn .= $this->RenduLibelleFiltre($filtre) ;
					$ctn .= ' : ' ;
					$ctn .= $filtre->Etiquette() ;
					$ctn .= "\r\n" ;
				}
				return $ctn ;
			}
		}
		class PvDessinateurLigneFiltresDonnees extends PvDessinateurRenduHtmlFiltresDonnees
		{
			public $Largeur = "" ;
			public $InclureRenduLibelle = 1 ;
			public function Execute(& $script, & $composant, $parametres)
			{
				$filtres = $parametres ;
				$ctn = '' ;
				$ctn .= '<table' ;
				if($this->Largeur != '')
				{
					$ctn .= ' width="'.$this->Largeur.'"' ;
				}
				$ctn .= '>'.PHP_EOL ;
				$nomFiltres = array_keys($filtres) ;
				$filtreRendus = 0 ;
				foreach($nomFiltres as $i => $nomFiltre)
				{
					$filtre = $parametres[$i] ;
					if(! $filtre->RenduPossible())
					{
						continue ;
					}
					if($this->InclureRenduLibelle)
					{
						$ctn .= '<tr>'.PHP_EOL ;
						$ctn .= '<td' ;
						$ctn .= ' valign="top"' ;
						$ctn .= '>'.PHP_EOL ;
						$ctn .= '<label for="'.$filtre->ObtientIDElementHtmlComposant().'">'.$filtre->ObtientLibelle().'</label>'.PHP_EOL ;
						$ctn .= '</td>'.PHP_EOL ;
						$ctn .= '</tr>'.PHP_EOL ;
					}
					$ctn .= '<tr>'.PHP_EOL ;
					$ctn .= '<td' ;
					$ctn .= ' valign="top"' ;
					$ctn .= '>'.PHP_EOL ;
					$ctn .= $this->RenduFiltre($filtre, $composant).PHP_EOL ;
					$ctn .= '</td>'.PHP_EOL ;
					$ctn .= '</tr>'.PHP_EOL ;
				}
				$ctn .= '</table>' ;
				return $ctn ;
			}
		}
		class PvDessinFltsDonneesHtml extends PvDessinateurRenduHtmlFiltresDonnees
		{
		}
		class PvDessinFltsIllustrHtml extends PvDessinateurRenduHtmlFiltresDonnees
		{
			public static $StyleGlobalInclus = 0 ;
			public $AlignIcone = "droite" ;
			public static function RenduStyleGlobal()
			{
				$val = PvDessinFltsIllustrHtml::$StyleGlobalInclus ;
				if($val == 1)
				{
					return "" ;
				}
				return '<style type="text/css">
.editeur-illustr { 
    position: relative;
	margin-bottom:12px ;
}
.editeur-illustr .icone-illustr {
  position: absolute;
  padding: 10px;
  pointer-events: none;
}
.illustr-gauche .icone-illustr  { left:  0px;}
.illustr-droite .icone-illustr { right: 0px;}

/* add padding  */
.illustr-gauche > input, .illustr-gauche > select { padding-left:  30px; }
.illustr-droite > input, .illustr-droite > select { padding-right: 30px; }
</style>' ;
				PvDessinFltsIllustrHtml::$StyleGlobalInclus = 1 ;
			}
			public function Execute(& $script, & $composant, $parametres)
			{
				$filtres = $composant->ExtraitFiltresDeRendu($parametres) ;
				$ctn = '' ;
				$ctn .= PvDessinFltsIllustrHtml::RenduStyleGlobal() ;
				$alignIcone = ($this->AlignIcone == "droite") ? "droite" : "gauche" ;
				$ctn .= '<div' ;
				if($this->Largeur != '')
				{
					$ctn .= ' style="width:'.$this->Largeur.'px"' ;
				}
				$ctn .= '>'.PHP_EOL ;
				$nomFiltres = array_keys($filtres) ;
				$filtreRendus = 0 ;
				foreach($nomFiltres as $i => $nomFiltre)
				{
					$filtre = $filtres[$nomFiltre] ;
					if($filtre->LectureSeule)
					{
						$ctn .= '<input type="hidden" id="'.htmlentities($filtre->ObtientIDComposant()).'" name="'.htmlentities($filtre->ObtientNomComposant()).'" value="'.htmlentities($filtre->Lie()).'" />'.PHP_EOL ;
						continue ;
					}
					$ctn .= '<div class="editeur-illustr">'.PHP_EOL ;
					if($alignIcone == "gauche")
					{
						$ctn .= $this->RenduIconeFiltre($alignIcone, $filtre) ;
					}
					$ctn .= $this->RenduFiltre($filtre, $composant).PHP_EOL ;
					if($alignIcone == "droite")
					{
						$ctn .= $this->RenduIconeFiltre($alignIcone, $filtre) ;
					}
					$ctn .= '</div>'.PHP_EOL ;
					$filtreRendus++ ;
				}
				$ctn .= '</div>' ;
				return $ctn ;
			}
			protected function RenduIconeFiltre($alignIcone, & $filtre)
			{
				$ctn = '' ;
				$ctn .= '<i class="illustr-'.$alignIcone.' '.$filtre->NomClasseCSSIcone.'">'.(($filtre->CheminIcone != "") ? '<img src="'.$filtre->CheminIcone.'" />' : '').'</i>' ;
				return $ctn ;
			}
		}
		
		class PvDessinateurRenduHtmlCommandes extends PvDessinateurRenduBase
		{
			public $InclureIcones = 1 ;
			public $InclureLibelle = 1 ;
			public $HauteurIcone = 20 ;
			public $CheminIconeParDefaut = "images/execute_icon.png" ;
			public $SeparateurIconeLibelle = "&nbsp;&nbsp;" ;
			public $SeparateurCommandes = "&nbsp;&nbsp;&nbsp;&nbsp;" ;
			protected function DebutExecParam(& $script, & $composant, $i, $param)
			{
				return "" ;
			}
			protected function FinExecParam(& $script, & $composant, $i, $param)
			{
				return "" ;
			}
			protected function PeutAfficherCmd(& $commande)
			{
				if($commande->Visible == 0 || $commande->EstBienRefere() == 0 || $commande->EstAccessible() == 0)
				{
					return 0 ;
				}
				return 1 ;
			}
			public function Execute(& $script, & $composant, $parametres)
			{
				$ctn = '' ;
				$commandes = $parametres ;
				$nomCommandes = array_keys($commandes) ;
				foreach($nomCommandes as $i => $nomCommande)
				{
					$commande = & $commandes[$nomCommande] ;
					if($this->PeutAfficherCmd($commande) == 0)
					{
						continue ;
					}
					if($ctn != '')
					{
						$ctn .= $this->SeparateurCommandes. PHP_EOL ;
					}
					if($commande->UtiliserRenduDispositif)
					{
						$ctn .= $commande->RenduDispositif() ;
					}
					else
					{
						$ctn .= $this->DebutExecParam($script, $composant, $i, $commande) ;
						if($commande->ContenuAvantRendu != '')
						{
							$ctn .= $commande->ContenuAvantRendu ;
						}
						$ctn .= '<button class="Commande '.$commande->NomClsCSS.'" type="submit" rel="'.$commande->NomElementSousComposantIU.'"' ;
						$ctn .= ' onclick="'.$composant->IDInstanceCalc.'_ActiveCommande(this) ;"' ;
						if($this->InclureLibelle == 0)
						{
							$ctn .= ' title="'.htmlspecialchars($commande->Libelle).'"' ;
						}
						$ctn .= '>'.PHP_EOL ;
						if($this->InclureIcones)
						{
							$cheminIcone = $this->CheminIconeParDefaut ;
							if($commande->CheminIcone != '')
							{
								$cheminIcone = $commande->CheminIcone ;
							}
							if(file_exists($cheminIcone))
							{
								$ctn .= '<img src="'.$cheminIcone.'" height="'.$this->HauteurIcone.'" border="0" />' ;
							}
							if($commande->InclureLibelle == 1)
							{
								$ctn .= $this->SeparateurIconeLibelle ;
							}
						}
						if($this->InclureLibelle)
						{
							$ctn .= $commande->Libelle ;
						}
						$ctn .= '</button>'.PHP_EOL ;
						if($commande->ContenuApresRendu != '')
						{
							$ctn .= $commande->ContenuApresRendu ;
						}
						$ctn .= $this->FinExecParam($script, $composant, $i, $commande) ;
					}
				}
				return $ctn ;
			}
		}
		class PvDessinCmdsHtml extends PvDessinateurRenduHtmlCommandes
		{
		}
		
		class PvNavigateurRangeesDonneesBase
		{
			public function Execute(& $script, & $composant)
			{
				return $this->ExecuteInstructions($script, $composant) ;
			}
			protected function ExecuteInstructions(& $script, & $composant)
			{
				$ctn = '' ;
				return $ctn ;
			}
		}
		
		class PvBaliseHtmlBase extends PvComposantIUBase
		{
			public $IDElementHtml = "" ;
			public $NomElementHtml = "" ;
			public $TitreElementHtml = "" ;
			public $ClassesCSS = array() ;
			public $StyleCSS = "" ;
			public static $SourceInclus = 0 ;
			public static $CheminSource = "" ;
			public $BaliseInclusionSource = null ;
			protected function InclutSource()
			{
				if($this->ObtientValeurStatique('SourceInclus') == 1)
				{
					return "" ;
				}
				$this->BaliseInclusionSource = new PvLienFichierJs() ;
				$this->BaliseInclusionSource->Src = $this->ObtientValeurStatique('CheminSource') ;
				$this->BaliseInclusionSource->AdopteScript("source".get_class($this), $this->ScriptParent) ;
				$this->AffecteValeurStatique('SourceInclus', 1) ;
				return $this->BaliseInclusionSource->RenduDispositif() ;
			}
			public function CorrigeIDsElementHtml()
			{
				if($this->NomElementHtml == '')
				{
					$this->NomElementHtml = $this->NomElementScript ;
				}
			}
		}
		class PvPortionRenduHtml extends PvComposantIUBase
		{
			public $Contenu = '' ;
			protected function RenduDispositifBrut()
			{
				return $this->Contenu ;
			}
		}
		
		class EncBasePortionRenduFmt
		{
			public $Prefixe ;
			public function __construct($prefixe='')
			{
				$this->Prefixe = $prefixe;
			}
			public function Execute($params=array())
			{
				return array() ;
			}
		}
		class EncUrlPortionRenduFmt extends EncBasePortionRenduFmt
		{
			public function Execute($params=array())
			{
				return array_map('urlencode', $params) ;
			}
		}
		class EncHtmlEntPortionRenduFmt extends EncBasePortionRenduFmt
		{
			public function Execute($params=array())
			{
				return array_map('htmlentities', $params) ;
			}
		}
		class PvPortionRenduFmt extends PvComposantIUBase
		{
			public $PrefixeEncUrl = "url_" ;
			public $EncoderUrl = 1 ;
			public $PrefixeEncHtmlEnt = "html_" ;
			public $EncoderHtmlEnt = 1 ;
			public $Encodeurs = array() ;
			public $Params = array() ;
			public $Contenu = "" ;
			public $NomClasseCSS ;
			protected $ParamsCalc = array() ;
			protected function RenduVideActif()
			{
				return ($this->Contenu == '') ;
			}
			protected function ObtientEncodeurs()
			{
				$encodeurs = $this->Encodeurs;
				if($this->EncoderUrl)
				{
					$encodeurs[] = new EncUrlPortionRenduFmt($this->PrefixeEncUrl) ;
				}
				if($this->EncoderHtmlEnt)
				{
					$encodeurs[] = new EncHtmlEntPortionRenduFmt($this->PrefixeEncHtmlEnt) ;
				}
				return $encodeurs ;
			}
			protected function DetecteParamsCalc()
			{
				$this->ParamsCalc = $this->Params ;
				$encodeurs = $this->ObtientEncodeurs() ;
				foreach($encodeurs as $i => $encodeur)
				{
					$params = $encodeur->Execute($this->Params) ;
					if(count($params) == 0)
					{
						continue ;
					}
					$params = array_apply_prefix($params, $encodeur->Prefixe) ;
					$this->ParamsCalc = array_merge($this->ParamsCalc, $params) ;
				}
			}
			public function EstVide()
			{
				return (empty($this->Contenu)) ;
			}
			protected function RenduDispositifBrut()
			{
				$ctn = '' ;
				if($this->RenduVideActif())
				{
					return $ctn ;
				}
				$this->DetecteParamsCalc() ;
				$ctn .= '<div id="'.$this->IDInstanceCalc ;
				if($this->NomClasseCSS != "")
					$ctn .= ' class="'.$this->NomClasseCSS.'"' ;
				$ctn .= '">' ;
				$ctn .= _parse_pattern($this->Contenu, $this->ParamsCalc) ;
				$ctn .= '</div>' ;
				return $ctn ;
			}
		}
		
		class PvComposantIUDonneesSimple extends PvComposantIUDonnees
		{
			public function & CreeFiltreRef($nom, & $filtreRef)
			{
				$filtre = new PvFiltreDonneesRef() ;
				$filtre->Source = & $filtreRef ;
				$filtre->AdopteScript($nom, $this->ScriptParent) ;
				$filtre->NomParametreDonnees = $nom ;
				return $filtre ;
			}
			public function & CreeFiltreFixe($nom, $valeur)
			{
				$filtre = new PvFiltreDonneesFixe() ;
				$filtre->NomParametreDonnees = $nom ;
				$filtre->ValeurParDefaut = $valeur ;
				$filtre->AdopteScript($nom, $this->ScriptParent) ;
				return $filtre ;
			}
			public function & CreeFiltreCookie($nom)
			{
				$filtre = new PvFiltreDonneesCookie() ;
				$filtre->NomParametreDonnees = $nom ;
				$filtre->AdopteScript($nom, $this->ScriptParent) ;
				return $filtre ;
			}
			public function & CreeFiltreSession($nom)
			{
				$filtre = new PvFiltreDonneesSession() ;
				$filtre->NomParametreDonnees = $nom ;
				$filtre->AdopteScript($nom, $this->ScriptParent) ;
				return $filtre ;
			}
			public function & CreeFiltreMembreConnecte($nom, $nomParamLie='')
			{
				$filtre = new PvFiltreDonneesMembreConnecte() ;
				$filtre->AdopteScript($nom, $this->ScriptParent) ;
				$filtre->NomParametreDonnees = $nom ;
				$filtre->NomParametreLie = $nomParamLie ;
				return $filtre ;
			}
			public function & CreeFiltreHttpUpload($nom, $cheminDossierDest="")
			{
				$filtre = new PvFiltreDonneesHttpUpload() ;
				$filtre->AdopteScript($nom, $this->ScriptParent) ;
				$filtre->NomParametreDonnees = $nom ;
				$filtre->CheminDossier = $cheminDossierDest ;
				return $filtre ;
			}
			public function & CreeFiltreHttpGet($nom)
			{
				$filtre = new PvFiltreDonneesHttpGet() ;
				$filtre->AdopteScript($nom, $this->ScriptParent) ;
				$filtre->NomParametreLie = $nom ;
				$filtre->NomParametreDonnees = $nom ;
				return $filtre ;
			}
			public function & CreeFiltreHttpPost($nom)
			{
				$filtre = new PvFiltreDonneesHttpPost() ;
				$filtre->AdopteScript($nom, $this->ScriptParent) ;
				$filtre->NomParametreLie = $nom ;
				$filtre->NomParametreDonnees = $nom ;
				return $filtre ;
			}
			public function & CreeFiltreHttpRequest($nom)
			{
				$filtre = new PvFiltreDonneesHttpRequest() ;
				$filtre->AdopteScript($nom, $this->ScriptParent) ;
				$filtre->NomParametreLie = $nom ;
				$filtre->NomParametreDonnees = $nom ;
				return $filtre ;
			}
			public function CreeFltRef($nom, & $filtreRef)
			{
				return $this->CreeFiltreRef($nom, $filtreRef) ;
			}
			public function CreeFltFixe($nom, $valeur)
			{
				return $this->CreeFiltreRef($nom, $valeur) ;
			}
			public function CreeFltCookie($nom)
			{
				return $this->CreeFiltreCookie($nom) ;
			}
			public function CreeFltSession($nom)
			{
				return $this->CreeFiltreSession($nom) ;
			}
			public function CreeFltMembreConnecte($nom, $nomParamLie='')
			{
				return $this->CreeFiltreMembreConnecte($nom, $nomParamLie) ;
			}
			public function CreeFltHttpUpload($nom, $cheminDossierDest="")
			{
				return $this->CreeFiltreHttpUpload($nom, $cheminDossierDest) ;
			}
			public function CreeFltHttpGet($nom)
			{
				return $this->CreeFiltreHttpGet($nom) ;
			}
			public function CreeFltHttpPost($nom)
			{
				return $this->CreeFiltreHttpPost($nom) ;
			}
			public function CreeFltHttpRequest($nom)
			{
				return $this->CreeFiltreHttpRequest($nom) ;
			}
			public function ExtraitValeursParametre(& $filtres)
			{
				$nomFiltres = array_keys($filtres) ;
				$valeurs = array() ;
				foreach($nomFiltres as $i => $nomFiltre)
				{
					$filtre = & $filtres[$nomFiltre] ;
					$filtre->Lie() ;
					$valeurs[$filtre->NomParametreDonnees] = $filtre->ValeurParametre ;
				}
				return $valeurs ;
			}
			public function ExtraitValeursColonneLiee(& $filtres)
			{
				$nomFiltres = array_keys($filtres) ;
				$valeurs = array() ;
				foreach($nomFiltres as $i => $nomFiltre)
				{
					$filtre = & $filtres[$nomFiltre] ;
					$filtre->Lie() ;
					$valeurs[$filtre->NomColonneLiee] = $filtre->ValeurParametre ;
				}
				return $valeurs ;
			}
			public function ObtientFiltre(& $filtres, $nomParamLie)
			{
			}
			public function CreeCmdRedirectUrl()
			{
				return new PvCommandeRedirectionHttp() ;
			}
			public function CreeCmdRedirectScript()
			{
				return new PvCommandeRedirectionHttp() ;
			}
			protected function AppliqueHabillage()
			{
				if($this->ZoneParent->EstNul($this->ZoneParent->Habillage))
				{
					return ;
				}
				$this->ZoneParent->Habillage->AppliqueSur($this) ;
				return $this->ZoneParent->Habillage->Rendu ;
			}
			public function ExtraitFiltresDeRendu(& $filtres)
			{
				$resultats = array() ;
				foreach($filtres as $i => $filtre)
				{
					// print $i.'- '.$filtre->NomParametreLie.' '.$filtre->RenduPossible().'<br />' ;
					if($filtre->RenduPossible())
					{
						$resultats[$i] = & $filtres[$i] ;
					}
				}
				return $resultats ;
			}
			public function ExtraitFiltresAffichables(& $filtres)
			{
				$resultats = array() ;
				foreach($filtres as $i => $filtre)
				{
					if($filtre->RenduPossible() && ! $filtre->LectureSeule)
					{
						$resultats[$i] = & $filtres[$i] ;
					}
				}
				return $resultats ;
			}
		}
		class PvPortionRenduDonneesHtml extends PvComposantIUDonneesSimple
		{
			public $PrefixeEncUrl = "url_" ;
			public $EncoderUrl = 1 ;
			public $PrefixeEncHtmlEnt = "html_" ;
			public $EncoderHtmlEnt = 1 ;
			public $Encodeurs = array() ;
			public $ElementsBruts = array() ;
			public $Elements = array() ;
			public $ElementsTrouves = 0 ;
			public $ParamsSelection = array() ;
			public $RequeteSelection = "" ;
			public $ContenuModele = "" ;
			protected $ContenuModeleUse = "" ;
			protected $ErreurTrouvee = 0 ;
			protected $ContenuErreurTrouvee = "" ;
			protected $MsgSiErreurTrouvee = "Le composant ne peut s'afficher car une erreur est survenue lors de l'affichage." ;
			protected function ObtientEncodeurs()
			{
				$encodeurs = $this->Encodeurs;
				if($this->EncoderUrl)
				{
					$encodeurs[] = new EncUrlPortionRenduFmt($this->PrefixeEncUrl) ;
				}
				if($this->EncoderHtmlEnt)
				{
					$encodeurs[] = new EncHtmlEntPortionRenduFmt($this->PrefixeEncHtmlEnt) ;
				}
				return $encodeurs ;
			}
			protected function VideErreur()
			{
				$this->ErreurTrouvee = 0 ;
				$this->ContenuErreurTrouvee = "" ;
			}
			protected function ConfirmeErreur($msg)
			{
				$this->ErreurTrouvee = 1 ;
				$this->ContenuErreurTrouvee = $msg ;
			}
			protected function PrepareCalcul()
			{
				$this->ElementsTrouves = 0 ;
				$this->VideErreur() ;
				$this->ElementsBruts = array() ;
				$this->Elements = array() ;
			}
			protected function CalculeElements()
			{
				$this->PrepareCalcul() ;
				if($this->ContenuModele == "")
				{
					$this->ConfirmeErreur("Le modele est vide") ;
					return ;
				}
				$this->ElementsBruts = $this->FournisseurDonnees->ExecuteRequete($this->RequeteSelection, $this->ParamsSelection) ;
				// echo $this->FournisseurDonnees->BaseDonnees->ConnectionException ;
				if(! is_array($this->ElementsBruts))
				{
					$this->ConfirmeErreur("La recuperation des elements a echoue") ;
					return ;
				}
				$this->ElementsTrouves = (count($this->ElementsBruts) > 0) ? 1 : 0 ;
				$this->Elements = array() ;
				foreach($this->ElementsBruts as $i => $elem)
				{
					$this->Elements[$i] = $this->ExtraitElementCalc($elem) ;
				}
			}
			protected function ExtraitElementCalc($elem)
			{
				$encodeurs = $this->ObtientEncodeurs() ;
				$result = $elem ;
				foreach($encodeurs as $i => $encodeur)
				{
					$params = $encodeur->Execute($elem) ;
					if(count($params) == 0)
					{
						continue ;
					}
					$params = array_apply_prefix($params, $encodeur->Prefixe) ;
					$result = array_merge($result, $params) ;
				}
				return $result ;
			}
			protected function RenduDispositifBrut()
			{
				$ctn = '' ;
				$this->CalculeElements() ;
				if($this->ErreurTrouvee)
				{
					$ctn .= $this->RenduErreurTrouvee() ;
					return $ctn ;
				}
				$ctn .= $this->ContenuAvantRendu ;
				foreach($this->Elements as $i => $elem)
				{
					$ctn .= _parse_pattern($this->ContenuModele, $elem) ;				
				}
				$ctn .= $this->ContenuApresRendu ;
				return $ctn ;
			}
			protected function RenduErreurTrouvee()
			{
				return '<div class="error">'.$this->MsgSiErreurTrouvee.'</div>' ;
			}
		}
		class PvPortionDonneesHtml extends PvPortionRenduDonneesHtml
		{
		}
		
		class PvCommandeComposantIUBase extends PvElementAccessible
		{
			public $Visible = 1 ;
			public $NecessiteFormulaireDonnees = 0 ;
			public $NecessiteTableauDonnees = 0 ;
			public $UtiliserRenduDispositif = 0 ;
			public $FormulaireDonneesParent = null ;
			public $TableauDonneesParent = null ;
			public $ScriptParent = null ;
			public $ZoneParent = null ;
			public $ApplicationParent = null ;
			public $NomElementFormulaireDonnees = "" ;
			public $NomElementSousComposantIU = "" ;
			public $CheminIcone ;
			public $Libelle = "" ;
			public $NomClsCSS = "" ;
			public $ContenuAvantRendu = "" ;
			public $ContenuApresRendu = "" ;
			public $InfoBulle = "" ;
			public $MessageErreurExecution = "La commande a &eacute;t&eacute; ex&eacute;cut&eacute;e avec des erreurs" ;
			public $MessageSuccesExecution = "La commande a &eacute;t&eacute; ex&eacute;cut&eacute;e avec succ&egrave;s" ;
			public $MessageExecution = "" ;
			public $StatutExecution = 0 ;
			public $Criteres = array() ;
			public $Actions = array() ;
			public $SeparateurCriteresNonRespectes = "<br/>" ;
			public function PrepareRendu(& $composant)
			{
			}
			protected function AdopteComposantIU($nom, &$composant)
			{
				$this->NomElementSousComposantIU = $nom ;
				$this->ScriptParent = & $composant->ScriptParent ;
				$this->ZoneParent = & $composant->ZoneParent ;
				$this->ApplicationParent = & $composant->ApplicationParent ;
			}
			public function AdopteFormulaireDonnees($nom, & $formulaireDonnees)
			{
				$this->NomElementFormulaireDonnees = $nom ;
				$this->FormulaireDonneesParent = & $formulaireDonnees ;
				$this->AdopteComposantIU($nom, $formulaireDonnees) ;
			}
			public function AdopteTableauDonnees($nom, & $tableauDonnees)
			{
				$this->NomElementTableauDonnees = $nom ;
				$this->TableauDonneesParent = & $tableauDonnees ;
				$this->AdopteComposantIU($nom, $tableauDonnees) ;
			}
			public function InscritCritere(& $critere)
			{
				$this->Criteres[] = & $critere ;
				$critere->AdopteCommande(count($this->Criteres), $this) ;
			}
			public function InscritCritr(& $critere)
			{
				$this->InscritCritere($critere) ;
			}
			public function & InsereCritereFormatUrl($nomFiltres = array())
			{
				$critere = new PvCritereFormatUrl() ;
				$this->InscritCritere($critere) ;
				call_user_func_array(array(& $critere, 'CibleFiltres'), $nomFiltres) ;
				return $critere ;
			}
			public function & InsereCritereFormatMotPasse($nomFiltres = array())
			{
				$critere = new PvCritereFormatMotPasse() ;
				$this->InscritCritere($critere) ;
				call_user_func_array(array(& $critere, 'CibleFiltres'), $nomFiltres) ;
				return $critere ;
			}
			public function & InsereCritereFormatLogin($nomFiltres = array())
			{
				$critere = new PvCritereFormatLogin() ;
				$this->InscritCritere($critere) ;
				call_user_func_array(array(& $critere, 'CibleFiltres'), $nomFiltres) ;
				return $critere ;
			}
			public function & InsereCritereFormatEmail($nomFiltres = array())
			{
				$critere = new PvCritereFormatEmail() ;
				$this->InscritCritere($critere) ;
				call_user_func_array(array(& $critere, 'CibleFiltres'), $nomFiltres) ;
				return $critere ;
			}
			public function & InsereCritereNonVide($nomFiltres = array())
			{
				$critere = new PvCritereNonVide() ;
				$this->InscritCritere($critere) ;
				call_user_func_array(array(& $critere, 'CibleFiltres'), $nomFiltres) ;
				return $critere ;
			}
			public function & InsereCritrNonVide($nomFiltres = array())
			{
				$critere = $this->InsereCritereNonVide($nomFiltres) ;
				return $critere ;
			}
			public function & InscritNouvActCmd($actCmd, $nomFiltresCibles=array())
			{
				return $this->InscritActCmd($actCmd, $nomFiltresCibles) ;
			}
			public function InscritNouvAction($actCmd)
			{
				$this->InscritActCmd($actCmd) ;
			}
			public function InscritActCmd(& $actCmd, $nomFiltresCibles=array())
			{
				$this->Actions[] = & $actCmd ;
				$actCmd->AdopteCommande(count($this->Actions), $this) ;
				call_user_func_array(array($actCmd, 'CibleFiltres'), $nomFiltresCibles) ;
				return $actCmd ;
			}
			public function InscritAction(& $actCmd)
			{
				$this->InscritActCmd($actCmd) ;
			}
			protected function VideStatutExecution()
			{
				$this->MessageExecution = "" ;
				$this->StatutExecution = 1 ;
			}
			public function RenseigneErreur($messageErreur="")
			{
				$this->MessageExecution = $messageErreur ;
				$this->StatutExecution = 0 ;
			}
			protected function ConfirmeSucces($msgSucces = '')
			{
				$this->StatutExecution = 1 ;
				$this->MessageExecution = ($msgSucces == '') ? $this->MessageSuccesExecution : $msgSucces ;
			}
			protected function ExecuteInstructions()
			{
			}
			public function ChargeConfig()
			{
				parent::ChargeConfig() ;
			}
			public function & InsereCritere($nomClasse, $nomFiltresCibles=array())
			{
				if(! class_exists($nomClasse))
				{
					die("La classe '$nomClasse' n'existe pas") ;
				}
				$critere = new $nomClasse() ;
				$this->InsereNouvCritere($critere, $nomFiltresCibles) ;
				return $critere ;
			}
			public function & InsereActCmd($nomClasse, $nomFiltresCibles=array())
			{
				if(! class_exists($nomClasse))
				{
					die("La classe '$nomClasse' n'existe pas") ;
				}
				$actCmd = new $nomClasse() ;
				$this->InscritNouvActCmd($actCmd, $nomFiltresCibles) ;
				return $actCmd ;
			}
			public function & InsereAction($nomClasse, $nomFiltresCibles=array())
			{
				$action = $this->InsereActCmd($nomClasse, $nomFiltresCibles) ;
				return $action ;
			}
			public function & InsereNouvCritere($critere, $nomFiltresCibles=array())
			{
				$this->InscritCritere($critere) ;
				call_user_func_array(array($critere, 'CibleFiltres'), $nomFiltresCibles) ;
				return $critere ;
			}
			public function & InsereNouvActCmd($actCmd, $nomFiltresCibles=array())
			{
				$this->InscritAction($actCmd) ;
				call_user_func_array(array($actCmd, 'CibleFiltres'), $nomFiltresCibles) ;
				return $actCmd ;
			}
			public function & InsereNouvAction($action, $nomFiltresCibles=array())
			{
				$action = $this->InsereActCmd($nomClasse, $nomFiltresCibles) ;
				return $action ;
			}
			public function Execute()
			{
				if(($this->NecessiteFormulaireDonnees && $this->EstNul($this->FormulaireDonneesParent)) || ($this->NecessiteTableauDonnees && $this->EstNul($this->TableauDonneesParent)))
				{
					return ;
				}
				$this->VideStatutExecution() ;
				if(! $this->RespecteCriteres())
				{
					return ;
				}
				// echo $this->MessageExecution ;
				$this->VerifiePreRequis() ;
				if($this->StatutExecution == 0)
				{
					return ;
				}
				$this->ExecuteInstructions() ;
				if($this->StatutExecution == 0)
				{
					return ;
				}
				$this->ExecuteActions() ;
			}
			protected function VerifiePreRequis()
			{
				
			}
			protected function VerifieFichiersUpload(& $filtres)
			{
				foreach($filtres as $n => & $flt)
				{
					if($flt->Role == "http_upload" && $flt->ToujoursRenseignerFichier == 1 && $flt->Lie() == '')
					{
						$this->RenseigneErreur($flt->LibelleErreurTelecharg) ;
					}
				}
			}
			protected function RespecteCriteres()
			{
				$indCriteres = array_keys($this->Criteres) ;
				$messageErreurs = array() ;
				foreach($indCriteres as $i => $indCritere)
				{
					$critere = & $this->Criteres[$indCritere] ;
					if($critere->EstRespecte() == 0)
					{
						$messageErreurs[] = $critere->MessageErreur ;
					}
				}
				$ok = 1 ;
				if(count($messageErreurs) > 0)
				{
					$this->RenseigneErreur(join($this->SeparateurCriteresNonRespectes, $messageErreurs)) ;
					$ok = 0 ;
				}
				return $ok ;
			}
			protected function ExecuteActions()
			{
				$nomActions = array_keys($this->Actions) ;
				if(count($nomActions) > 0)
				{
					$this->MessageExecution = $this->MessageSuccesExecution ;
					foreach($nomActions as $i => $nomAction)
					{
						$action = & $this->Actions[$nomAction] ;
						$action->Execute() ;
					}
				}
			}
			public function RenduDispositif()
			{
				if($this->Visible == 0)
				{
					return '' ;
				}
				if(! $this->EstBienRefere())
				{
					return $this->RenduMalRefere() ;
				}
				if(! $this->EstAccessible())
				{
					return $this->RenduInaccessible() ;
				}
				$ctn .= $this->RenduDispositifBrut() ;
				return $ctn ;
			}
			protected function RenduDispositifBrut()
			{
				return "" ;
			}
			public function InclureEnvoiFiltres()
			{
				return 1 ;
			}
		}
		class PvCommandeRedirectionHttp extends PvCommandeComposantIUBase
		{
			public $NecessiteFormulaireDonnees = 0 ;
			public $NecessiteTableauDonnees = 0 ;
			public $Url = "" ;
			public $NomScript = "" ;
			public $Parametres = array() ;
			public $Script = null ;
			protected function ObtientUrl()
			{
				$url = $this->Url ;
				$script = null ;
				if($this->NomScript != "" && isset($this->ZoneParent->Scripts[$this->NomScript]))
				{
					$script = $this->ZoneParent->Scripts[$this->NomScript] ;
				}
				if($this->EstNul($script) && $this->EstPasNul($this->Script))
				{
					$script = $this->Script ;
				}
				if($this->EstPasNul($script))
				{
					$url = $script->ObtientUrl() ;
				}
				if($url != '' && count($this->Parametres) > 0)
				{
					$url = update_url_params($url, $this->Parametres) ;
				}
				return $url ;
			}
			protected function ExecuteInstructions()
			{
				$url = $this->ObtientUrl() ;
				if($url == '')
				{
					$this->RenseigneErreur("URL non definie pour la commande ".$this->IDInstanceCalc) ;
					return ;
				}
				redirect_to($url) ;
			}
		}
		class PvCommandeOuvrePopup extends PvCommandeRedirectionHttp
		{
			public $NomFenetre = "" ;
			public $CoinGaucheEcran = "" ;
			public $CoinHautEcran = "" ;
			public $LargeurPopup = "" ;
			public $HauteurPopup = "" ;
			public $LargeurIntern = "" ;
			public $HauteurIntern = "" ;
			public $BarreAdrUrl = "" ;
			public $BarreDefil = "" ;
			public $BarreStatut = "" ;
			public $BarreOutils = "" ;
			public $BarreMenus = "" ;
			public $Dependant = "" ;
			public $CoinGauche = "" ;
			public $CoinHaut = "" ;
			public $RaccourcisClavier = "" ;
			public $Redimens = "" ;
			protected function ObtientNomFenetre()
			{
				$nomFenetre = $this->NomFenetre ;
				if($nomFenetre == "")
				{
					$nomFenetre = $this->IDInstanceCalc ;
				}
				return $nomFenetre ;
			}
			public function ObtientParamsOuverture()
			{
				$params = array() ;
				if($this->LargeurPopup != "")
					$params["width"] = $this->LargeurPopup ;
				if($this->HauteurPopup != "")
					$params["height"] = $this->HauteurPopup ;
				if($this->LargeurIntern != "")
					$params["innerWidth"] = $this->LargeurIntern ;
				if($this->HauteurIntern != "")
					$params["innerHeight"] = $this->HauteurIntern ;
				if($this->BarreAdrUrl != "")
					$params["location"] = $this->BarreAdrUrl ;
				if($this->BarreDefil != "")
					$params["scrollbars"] = $this->BarreDefil ;
				if($this->BarreStatut != "")
					$params["status"] = $this->BarreStatut ;
				if($this->BarreOutils != "")
					$params["toolbar"] = $this->BarreOutils ;
				if($this->BarreMenus != "")
					$params["menubar"] = $this->BarreMenus ;
				if($this->Redimens != "")
					$params["resizable"] = $this->Redimens ;
				if($this->CoinGauche != "")
					$params["left"] = $this->CoinGauche ;
				if($this->CoinHaut != "")
					$params["top"] = $this->CoinHaut ;
				if($this->CoinGaucheEcran != "")
					$params["screenX"] = $this->CoinGaucheEcran ;
				if($this->CoinHautEcran != "")
					$params["screenY"] = $this->CoinHautEcran ;
				if($this->LargeurPopup != "")
					$params["width"] = $this->LargeurPopup ;
				if($this->HauteurPopup != "")
					$params["height"] = $this->HauteurPopup ;
				if($this->LargeurIntern != "")
					$params["innerWidth"] = $this->LargeurIntern ;
				if($this->HauteurIntern != "")
					$params["innerHeight"] = $this->HauteurIntern ;
				return $params ;
			}
			protected function ExecuteInstructions()
			{
			}
		}
		
		class PvFilArianeDonneesHtml extends PvComposantIUDonneesSimple
		{
			public $NomClasseCSS = "FilAriane" ;
			public $NomClasseCSSLien = "" ;
			public $DefsLien = array() ;
			protected $LgnsLien = array() ;
			protected $CtnsLien = array() ;
			public $FiltresSelection = array() ;
			public $FournisseurDonnees ;
			public $SeparateurLiens = ' &gt; ' ;
			public $CacherSiVide = 1 ;
			public $InclureLienAccueil = 1 ;
			public $TitreLienAccueil = "Accueil" ;
			public $UrlLienAccueil = "?" ;
			public $NomClasseFournisseurDonnees = "PvFournisseurDonneesBase" ;
			protected function InitFournisseurDonnees()
			{
				if($this->EstNul($this->FournisseurDonnees) && $this->NomClasseFournisseurDonnees != "")
				{
					$nomClasse = $this->NomClasseFournisseurDonnees ;
					if(class_exists($nomClasse))
					{
						$this->FournisseurDonnees = new $nomClasse() ;
					}
				}
				if(! $this->EstNul($this->FournisseurDonnees))
				{
					$this->ChargeConfigFournisseurDonnees() ;
					$this->FournisseurDonnees->ChargeConfig() ;
				}
			}
			protected function ChargeConfigFournisseurDonnees()
			{
			}
			protected function CalculeElementsRendu()
			{
				$fourn = & $this->FournisseurDonnees ;
				$paramsSelect = $fourn->ParamsSelection ;
				$this->LgnsLien = array() ;
				foreach($this->DefsLien as $i => $defLien)
				{
					$lienTrouve = 0 ;
					if($defLien->RequeteSelection != '')
					{
						$fourn->RequeteSelection = $defLien->RequeteSelection ;
						$lgnPrec = array() ;
						do
						{
							$flts = $this->FiltresSelection ;
							$fourn->ParamsSelection = $paramsSelect ;
							foreach($lgnPrec as $nom => $valeur)
							{
								$nomFlt = "lgn_prec_".$nom ;
								$fourn->ParamsSelection[$nom] = $valeur ;
							}
							$lgn = $fourn->SelectElements(array(), $flts) ;
							if(is_array($lgn) && count($lgn) > 0)
							{
								$this->CtnsLien[] = $this->CreeCtnLien($defLien, $lgn) ;
								$lienTrouve = 1 ;
							}
							$lgnPrec = $lgn ;
						}
						while($defLien->Recursif == 1) ;
					}
					else
					{
						$lgn = array() ;
						$this->CtnsLien[] = $this->CreeCtnLien($defLien, $lgn) ;
						$lienTrouve = 1 ;
					}
					if($defLien->Obligatoire && $lienTrouve == 0)
					{
						break ;
					}
				}
			}
			protected function CtnsLienRendu()
			{
				$ctnsLien = $this->CtnsLien ;
				if($this->InclureLienAccueil == 1)
				{
					$ctnLien = new PvCtnLienFilArianeDonnees() ;
					$ctnLien->Titre = $this->TitreLienAccueil ;
					$ctnLien->Url = $this->UrlLienAccueil ;
					$ctnsLien[] = $ctnLien ;
				}
				return $ctnsLien ;
			}
			protected function CreeCtnLien($defLien, $lgn)
			{
				$ctnLien = new PvCtnLienFilArianeDonnees() ;
				$ctnLien->Titre = _parse_pattern($defLien->FormatTitre, $lgn) ;
				$ctnLien->Url = _parse_pattern($defLien->FormatUrl, $lgn) ;
				$ctnLien->AttrsHtmlExtra = $defLien->AttrsHtmlExtra ;
				return $ctnLien ;
			}
			protected function RenduDispositifBrut()
			{
				$this->InitFournisseurDonnees() ;
				if(! $this->EstNul($this->FournisseurDonnees))
				{
					$this->ChargeConfigFournisseurDonnees() ;
				}
				$this->CalculeElementsRendu() ;
				if($this->CacherSiVide == 0 || $this->LiensTrouves())
				{
					$ctn .= '<div id="'.$this->IDInstanceCalc.'" class="'.$this->NomClasseCSS.'">' ;
					if($this->EstVide() == 0)
					{
						$ctn .= $this->RenduLiens() ;
					}
					$ctn .= '</div>' ;
				}
				return $ctn ;
			}
			protected function RenduLiens()
			{
				$ctn = '' ;
				$ctnsLien = $this->CtnsLienRendu() ;
				for($i=count($ctnsLien) - 1; $i >= 0; $i--)
				{
					$ctnLien = $ctnsLien[$i] ;
					if($i < count($ctnsLien) - 1)
					{
						$ctn .= $this->SeparateurLiens ;
					}
					$ctn .= '<a href="'.$ctnLien->Url.'"'.(($ctnLien->AttrsHtmlExtra != '') ? ' '.$ctnLien->AttrsHtmlExtra : '').''.(($this->NomClasseCSSLien != '') ? ' class="'.$this->NomClasseCSSLien.'"' : '').'>'.$ctnLien->Titre.'</a>' ;
				}
				return $ctn ;
			}
			public function LiensTrouves()
			{
				return (count($this->CtnsLien) > 0) ;
			}
			public function EstVide()
			{
				return ($this->LiensTrouves() == false) ;
			}
			public function InsereDefLien($requeteSelect, $formatUrl, $formatTitre)
			{
				$lien = new PvDefLienFilArianeDonnees() ;
				$lien->RequeteSelection = $requeteSelect ;
				$lien->FormatUrl = $formatUrl ;
				$lien->FormatTitre = $formatTitre ;
				$this->DefsLien[] = & $lien ;
				return $lien ;
			}
			public function InsereDefLienStatique($formatUrl, $formatTitre)
			{
				$lien = new PvDefLienFilArianeDonnees() ;
				$lien->FormatUrl = $formatUrl ;
				$lien->FormatTitre = $formatTitre ;
				$this->DefsLien[] = & $lien ;
				return $lien ;
			}
			public function InsereDefLienFixe($formatUrl, $formatTitre)
			{
				return $this->InsereDefLienStatique($formatUrl, $formatTitre) ;
			}
		}
		class PvDefLienFilArianeDonnees extends PvObjet
		{
			public $RequeteSelection ;
			public $FormatTitre ;
			public $FormatUrl ;
			public $AttrsHtmlExtra ;
			public $NomClasseCSS ;
			public $Recursif = 0 ;
			public $Obligatoire = 1 ;
		}
		class PvCtnLienFilArianeDonnees
		{
			public $Titre ;
			public $Url ;
			public $AttrsHtmlExtra ;
		}
		
		class PvElementCommandeBase extends PvElementAccessible
		{
			public $TypeElementCommande = "base" ;
			public $FiltresCibles = array() ;
			public $IndiceCommande = -1 ;
			public $CommandeParent = null ;
			public $ScriptParent = null ;
			public $ZoneParent = null ;
			public $ApplicationParent = null ;
			public $FormulaireDonneesParent = null ;
			public function AdopteCommande($indice, & $commande)
			{
				$this->IndiceCommande = $indice ;
				$this->CommandeParent = & $commande ;
				$this->FormulaireDonneesParent = & $commande->FormulaireDonneesParent ;
				$this->ScriptParent = & $commande->FormulaireDonneesParent->ScriptParent ;
				$this->ZoneParent = & $commande->FormulaireDonneesParent->ZoneParent ;
				$this->ApplicationParent = & $commande->FormulaireDonneesParent->ApplicationParent ;
			}
			protected function LieFiltresCibles()
			{
				$this->FormulaireDonneesParent->LieFiltres($this->FiltresCibles) ;
			}
			public function CibleTousFiltres()
			{
				if($this->EstNul($this->FormulaireDonneesParent))
				{
					return ;
				}
				$nomFiltres = array_keys($this->FormulaireDonneesParent->FiltresEdition) ;
				$this->FiltresCibles = array() ;
				foreach($nomFiltres as $i => $nomFiltre)
				{
					$this->FiltresCibles[] = & $this->FormulaireDonneesParent->FiltresEdition[$nomFiltre] ;
				}
			}
			public function CibleFiltres()
			{
				if($this->EstNul($this->FormulaireDonneesParent))
				{
					return ;
				}
				$args = func_get_args() ;
				// print_r($args) ;
				$nomFiltres = array_keys($this->FormulaireDonneesParent->FiltresEdition) ;
				// print_r($nomFiltres) ;
				foreach($nomFiltres as $i => $nomFiltre)
				{
					$filtre = & $this->FormulaireDonneesParent->FiltresEdition[$nomFiltre] ;
					if(in_array($filtre->NomElementScript, $args) || in_array($nomFiltre, $args, true))
					{
						$this->FiltresCibles[] = & $filtre ;
					}
				}
			}
		}
	}
	
?>