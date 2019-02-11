<?php
	
	if(! defined("MODELE_PAGE_NOYAU_WSM2"))
	{
		define("MODELE_PAGE_NOYAU_WSM2", 1) ;
		
		class ModelePageBaseWsm2
		{
			// Identifiants
			public $NomElementSite = "__noyau" ;
			public $NomFichier = "__noyau" ;
			// Application Parent
			public $ApplicationParent ;
			// Modeles script
			public $NomsModeleScriptPubl = array() ;
			public $NomsModeleScriptAdmin = array() ;
			public $DefsColDefaut = array() ;
			public $DefsColExtra = array() ;
			// Modeles Fils
			public $NomModelesFils = array() ;
			// Modeles cols Auto
			public $DefColId ;
			public $DefColModele ;
			public $DefColIdPageParent ;
			public $DefColChemin ;
			public $DefColTitreChemin ;
			public $DefColTitreCourt ;
			public $DefColTitre ;
			public $DefColNomFichier ;
			public $DefColSommaire ;
			public $DefColTexte ;
			public $DefColIdAdminCreation ;
			public $DefColIdAdminModif ;
			public $DefColDateCreation ;
			public $DefColHeureCreation ;
			public $DefColDateModif ;
			public $DefColHeureModif ;
			public $DefColEstPublie ;
			public $DefColDatePubl ;
			public $DefColHeurePubl ;
			public $DefColTitreRech ;
			public $DefColSommaireRech ;
			public $DefColTexteRech ;
			public $DefColMotsCleMeta ;
			public $DefColDescriptionMeta ;
			public $DefColExtra ;
			public $DefColCodeEval ;
			public $DefColScriptInclus ;
			public $DefColTypePage ;
			public $DefColNomLangue ;
			public $DefColExprLangue ;
			public $DefColModeleListage ;
			public $DefColInclusionModele ;
			public $DefColUrlRedirection ;
			public $DefColCheminImage ;
			public $DefColCheminBanniere ;
			public $DefColCheminIconeFils ;
			public $DefColCheminVideo ;
			public $DefColCheminDocument ;
			public $DefColCheminSon ;
			public $DefColCheminFichier ;
			public $DefColPresentMenu ;
			public $DefColNomContactLivreDor ;
			public $DefColEmailLivreDor ;
			public $DefColTitreLivreDor ;
			public $DefColTexteLivreDor ;
			// Contruct
			public function __construct()
			{
				$this->InitConfig() ;
			}
			protected function InitConfig()
			{
				$this->InitDefsColDefaut() ;
				$this->InitDefsColExtra() ;
				$this->InitAutresDefsCol() ;
			}
			public function AdopteSite(& $site)
			{
				$this->SiteParent = & $site ;
				$this->ApplicationParent = & $site->ApplicationParent ;
			}
			public function & InsereDefCol($nom, & $modeleCol)
			{
				$this->DefsColDefaut[$nom] = & $modeleCol ;
				return $this->DefsColDefaut[$nom] ;
			}
			public function & InsereDefColExtra($nom, & $modeleCol)
			{
				$this->DefsColExtra[$nom] = & $modeleCol ;
				return $this->DefsColExtra[$nom] ;
			}
			public function & InsereModeleExtra($nom, & $modeleCol)
			{
				$this->DefsColExtra[$nom] = & $modeleCol ;
				return $this->DefsColExtra[$nom] ;
			}
			protected function InitDefsColDefaut()
			{
				$this->DefColId = $this->InsereDefCol("id", new PvDefColAutoIncWsm()) ;
				$this->DefColIdPageParent = $this->InsereDefCol("id_page_parent_page", new PvDefColPageParentWsm()) ;
				$this->DefColTitre = $this->InsereDefCol("title_page", new PvDefColTitreWsm()) ;
				$this->DefColChemin = $this->InsereDefCol("path_page", new PvDefColTitreWsm()) ;
				$this->DefColTitreChemin = $this->InsereDefCol("path_title_page", new PvDefColTitreWsm()) ;
				$this->DefColTitreCourt = $this->InsereDefCol("short_title_page", new PvDefColTitreWsm()) ;
				$this->DefColNomFichier = $this->InsereDefCol("file_name_page", new PvDefColTitreWsm()) ;
				$this->DefColSommaire = $this->InsereDefCol("summary_page", new PvDefColSommaireWsm()) ;
				$this->DefColTexte = $this->InsereDefCol("text_page", new PvDefColTexteWsm()) ;
				$this->DefColIdAdminCreation = $this->InsereDefCol("id_admin_creator_page", new PvDefColIdAdminCreaWsm()) ;
				$this->DefColIdAdminModif = $this->InsereDefCol("id_admin_modif_page", new PvDefColIdAdminModifWsm()) ;
				$this->DefColDateCreation = $this->InsereDefCol("date_creation_page", new PvDefColDateWsm()) ;
				$this->DefColHeureCreation = $this->InsereDefCol("time_creation_page", new PvDefColHeureWsm()) ;
				$this->DefColDateModif = $this->InsereDefCol("date_modif_page", new PvDefColDateWsm()) ;
				$this->DefColHeureModif = $this->InsereDefCol("time_modif_page", new PvDefColHeureWsm()) ;
				$this->DefColDatePubl = $this->InsereDefCol("date_publish_page", new PvDefColDateWsm()) ;
				$this->DefColHeurePubl = $this->InsereDefCol("time_publish_page", new PvDefColHeureWsm()) ;
				$this->DefColTitreRech = $this->InsereDefCol("search_title_page", new PvDefColRechWsm()) ;
				$this->DefColSommRech = $this->InsereDefCol("search_summary_page", new PvDefColRechWsm()) ;
				$this->DefColTexteRech = $this->InsereDefCol("search_text_page", new PvDefColRechWsm()) ;
				$this->DefColMotsCleMeta = $this->InsereDefCol("meta_keywords_page", new PvDefColRechWsm()) ;
				$this->DefColDescriptionMeta = $this->InsereDefCol("meta_description_page", new PvDefColRechWsm()) ;
				$this->DefColInclScriptPage = $this->InsereDefCol("included_script_page", new PvDefColBaseWsm()) ;
				$this->DefColEvalCodePage = $this->InsereDefCol("evaluated_code_page", new PvDefColBaseWsm()) ;
				$this->DefColCheminIconeFils = $this->InsereDefCol("child_icon_page", new PvDefColUploadWsm()) ;
				$this->DefColCheminImage = $this->InsereDefCol("image_page", new PvDefColUploadWsm()) ;
				$this->DefColCheminBanniere = $this->InsereDefCol("banner_page", new PvDefColUploadWsm()) ;
				$this->DefColCheminSon = $this->InsereDefCol("sound_page", new PvDefColUploadWsm()) ;
				$this->DefColCheminVideo = $this->InsereDefCol("video_page", new PvDefColUploadWsm()) ;
				$this->DefColCheminDocument = $this->InsereDefCol("document_page", new PvDefColUploadWsm()) ;
				$this->DefColCheminFichier = $this->InsereDefCol("file_page", new PvDefColUploadWsm()) ;
				$this->DefColModele = $this->InsereDefCol("template_name_page", new PvDefColNomWsm()) ;
				$this->DefColUtilModele = $this->InsereDefCol("template_use_mode_page", new PvDefColNomWsm()) ;
				$this->DefColModeleListage = $this->InsereDefCol("template_child_listing_page", new PvDefColNomWsm()) ;
				$this->DefColNomLangue = $this->InsereDefCol("name_lang_page", new PvDefColNomWsm()) ;
				$this->DefColExprLangue = $this->InsereDefCol("expr_lang_page", new PvDefColNomWsm()) ;
			}
			protected function InitDefsColExtra()
			{
			}
			protected function InitAutresDefsCol()
			{
			}
			public function AppliqueValsSupplParcourtAdmin(& $composant, $ligneDonnees)
			{
				return array() ;
			}
			public function DetermineScriptParcourtAdmin(& $script)
			{
				$this->TablPrinc = $this->SiteParent->CreeGrillePrinc($script) ;
				$this->TablPrinc->AdopteScript('tablPrinc', $script) ;
				$this->TablPrinc->ChargeConfig() ;
				$this->TablPrinc->InsereDefsColCachee('id_page', 'path_title_page', 'path_page', 'title_page', 'short_title_page', 'search_title_page', 'search_summary_page', 'search_text_page', 'template_name_page', 'extra_page') ;
				$this->TablPrinc->ContenuLigneModele = '<div class="panel panel-default">
<div class="panel-heading">
<div class="row">
<div class="col-xs-12 col-sm-4">
<a tabindex="0" href="?appelleScript=parcourtPage&idPage=${id_page_query_string}" class="lien-sous-page" role="button" data-html="true" data-toggle="popover" data-trigger="hover" title="${title_page_html}" data-placement="bottom" data-content="<div>${search_summary_page_attr} ${search_text_page_attr}</div>">${id_page}. ${title_page_html}</a> [<a href="?appelleScript=modifValPage&colonne=title_page&idPage=${id_page_query_string}">Changer</a>]
</div>
<div class="col-xs-12 col-sm-8">
<a class="btn btn-default" href="?appelleScript=parcourtPage&idPage=${id_page_query_string}" title="Explorer"><span class="fa fa-folder"></span></a>
<a class="btn btn-default" href="?appelleScript=listeRelsPage&idPage=${id_page_query_string}" title="Relations"><span class="fa fa-link"></span></a>
<a class="btn btn-default" href="?appelleScript=proprietesPage&idPage=${id_page_query_string}" title="Propri&eacute;t&eacute;s"><span class="fa fa-list"></span></a>

<a class="btn btn-default" href="?appelleScript=ajoutPage&idPage=${id_page_query_string}" title="Nouvelle page"><span class="fa fa-plus"></span> page</a>
<a class="btn btn-default" href="?appelleScript=ajoutInstancePage&idPage=${id_page_query_string}" title="Nouvelle instance de page"><span class="fa fa-plus"></span> inst. page</a>
<a class="btn btn-default" href="?appelleScript=ajoutRelPage&idPage=${id_page_query_string}" title="Nouvelle relation"><span class="fa fa-plus"></span> rel.</a>

<a class="btn btn-default" href="?appelleScript=modifPage&idPage=${id_page_query_string}" title="Modifier"><span class="fa fa-pencil"></span></a>
<a class="btn btn-default" href="?appelleScript=deplacePage&idPage=${id_page_query_string}" title="Deplacer"><span class="fa fa-arrow-left"></span></a>
<a class="btn btn-default" href="?appelleScript=dupliquePage&idPage=${id_page_query_string}" title="Dupliquer"><span class="fa fa-copy"></span></a>
<a class="btn btn-default" href="?appelleScript=supprPage&idPage=${id_page_query_string}" title="Supprimer"><span class="fa fa-remove"></span></a>
</div>
</div>
</div>
</div>' ;
				$this->TablPrinc->MessageAucunElement = '-- Aucune page enregistr&eacute;e --' ;
				$this->TablPrinc->SourceValeursSuppl = new SrcValSupplTablParcourtPageAdminWsm2() ;
				$this->TablPrinc->SourceValeursSuppl->ModelePageParent = & $this ;
				$this->TablPrinc->FournisseurDonnees = $script->CreeFournBDPrinc() ;
				$this->TablPrinc->FournisseurDonnees->RequeteSelection = $this->SiteParent->NomTablePage ;
				$this->TablPrinc->InsereFltSelectFixe('idParent', $script->ValeurParamIdPage, 'id_page_parent_page = <self>') ;
			}
			public function RenduScriptParcourtAdmin(& $script)
			{
				return $this->TablPrinc->RenduDispositif() ;
			}
			public function DetermineScriptPropsAdmin(& $script)
			{
			}
			public function RenduScriptPropsAdmin(& $script)
			{
			}
			public function DetermineScriptListRelsAdmin(& $script)
			{
				$this->TablPrinc = $this->SiteParent->CreeGrillePrinc($script) ;
				$this->TablPrinc->AdopteScript('tablPrinc', $script) ;
				$this->TablPrinc->ChargeConfig() ;
				$this->TablPrinc->InsereDefsColCachee('id_rel_page', 'name_rel_page', 'value_rel_page', 'id_page', 'path_title_page', 'path_page', 'title_page', 'short_title_page', 'search_title_page', 'search_summary_page', 'search_text_page', 'template_name_page', 'extra_page') ;
				$this->TablPrinc->ContenuLigneModele = '<div class="panel panel-default">
<div class="panel-heading">
<div class="row">
<div class="col-xs-12 col-sm-4"></div>
<div class="col-xs-12 col-sm-8"></div>
</div>
</div>
</div>' ;
				$this->TablPrinc->MessageAucunElement = '-- Aucune relation enregistr&eacute;e --' ;
				$this->TablPrinc->SourceValeursSuppl->ModelePageParent = & $this ;
				$this->TablPrinc->FournisseurDonnees = $script->CreeFournBDPrinc() ;
				$this->TablPrinc->FournisseurDonnees->RequeteSelection = '(select * from '.$this->SiteParent->NomTableRelPage.' t1 inner join '.$this->SiteParent->NomTableRelPage.' t2 on t1.id_page_dest_rel_page=t2.id_page)' ;
				$this->TablPrinc->InsereFltSelectFixe('idSrc', $script->ValeurParamIdPage, 'id_page_src_rel_page = <self>') ;
			}
			public function RenduScriptListRelsAdmin(& $script)
			{
			}
			public function DetermineScriptAjoutRelAdmin(& $script)
			{
			}
			public function RenduScriptAjoutRelAdmin(& $script)
			{
			}
			public function DetermineScriptModifRelAdmin(& $script)
			{
			}
			public function RenduScriptModifRelAdmin(& $script)
			{
			}
			public function DetermineScriptSupprRelAdmin(& $script)
			{
			}
			public function RenduScriptSupprRelAdmin(& $script)
			{
			}
			public function DetermineScriptRechAdmin(& $script)
			{
			}
			public function RenduScriptRechAdmin(& $script)
			{
			}
			public function DetermineScriptRemplAdmin(& $script)
			{
			}
			public function RenduScriptRemplAdmin(& $script)
			{
			}
			public function DetermineScriptAjoutPageAdmin(& $script)
			{
			}
			public function RenduScriptAjoutPageAdmin(& $script)
			{
			}
			public function DetermineScriptAjoutInstPageAdmin(& $script)
			{
			}
			public function RenduScriptAjoutInstPageAdmin(& $script)
			{
			}
			public function DetermineScriptModifPageAdmin(& $script)
			{
			}
			public function RenduScriptModifPageAdmin(& $script)
			{
			}
			public function DetermineScriptDeplPageAdmin(& $script)
			{
			}
			public function RenduScriptDeplPageAdmin(& $script)
			{
			}
			public function DetermineScriptDuplPageAdmin(& $script)
			{
			}
			public function RenduScriptDuplPageAdmin(& $script)
			{
			}
			public function DetermineScriptOrdonnePageAdmin(& $script)
			{
			}
			public function RenduScriptOrdonnePageAdmin(& $script)
			{
			}
			public function DetermineScriptVidePageAdmin(& $script)
			{
			}
			public function RenduScriptVidePageAdmin(& $script)
			{
			}
			public function DetermineScriptSupprPageAdmin(& $script)
			{
			}
			public function RenduScriptSupprPageAdmin(& $script)
			{
			}
		}
		
		class SrcValSupplTablParcourtPageAdminWsm2 extends PvSrcValsSupplGrilleDonnees
		{
			public $ModelePageParent ;
			public function Applique(& $composant, $ligneDonnees)
			{
				$ligneBrute = $ligneDonnees ;
				foreach($ligneBrute as $nom => $val)
				{
					$ligneDonnees[$nom.'_attr'] = htmlspecialchars($val) ;
				}
				$result = array_merge($ligneDonnees, parent::Applique($composant, $ligneBrute)) ;
				$resultExtra = $this->ModelePageParent->AppliqueValsSupplParcourtAdmin($composant, $ligneBrute) ;
				return array_merge($result, $resultExtra) ;
			}
		}
		
		class ModelePageDefautWsm2 extends ModelePageBaseWsm2
		{
			// Identifiants
			public $NomElementSite = "index" ;
			public $NomFichier = "index" ;
		}
		
		class ModelePageRacineWsm2 extends ModelePageBaseWsm2
		{
			// Identifiants
			public $NomElementSite = "__top" ;
			public $NomFichier = "__top" ;
			protected function InitAutresDefsCol()
			{
				$this->DefColTitreCourt->ValeurParDefaut = "Page [Top]" ;
				$this->DefColTitre->ValeurParDefaut = "Page [Top]" ;
			}
		}
	}
	
?>