<?php

namespace Pv\ZoneWeb\TableauDonnees\Commande ;

class CommandeExportVers extends \Pv\ZoneWeb\TableauDonnees\Commande\CommandeExport
{
	public $SeparateurColonnes = ";" ;
	public $SeparateurLignes = "\r\n" ;
	public $ExprAvantValeur = "" ;
	public $ExprApresValeur = "" ;
	public $TotalLignes = 0 ;
	public $NomFichier = "resultat.txt" ;
	protected function EnvoieContenu()
	{
		$defCols = $this->TableauDonneesParent->DefinitionsColonnesExport() ;
		$requete = $this->TableauDonneesParent->FournisseurDonnees->OuvreRequeteSelectElements($this->TableauDonneesParent->FiltresSelection, $defCols) ;
		$this->EnvoieEntete() ;
		$this->TotalLignes = 0 ;
		while($ligne = $this->TableauDonneesParent->FournisseurDonnees->LitRequete($requete))
		{
			$valeurs = $this->TableauDonneesParent->ExtraitValeursExport($ligne, $this) ;
			$this->EnvoieValeurs($valeurs) ;
			$this->TotalLignes++ ;
		}
		$this->TableauDonneesParent->FournisseurDonnees->FermeRequete($requete) ;
		$this->EnvoiePied() ;
	}
	protected function EnvoieEntete()
	{
		if(! $this->InclureEntete)
		{
			return ;
		}
		$libelles = $this->TableauDonneesParent->ExtraitLibellesExport() ;
		foreach($libelles as $i => $libelle)
		{
			if($i > 0)
			{
				echo $this->SeparateurColonnes ;
			}
			echo \Pv\Misc::clean_special_chars($libelle) ;
		}
		echo $this->SeparateurLignes ;
	}
	protected function EnvoieValeurs($valeurs)
	{
		foreach($valeurs as $i => $valeur)
		{
			if($i != 0)
			{
				echo $this->SeparateurColonnes ;
			}
			echo $this->ExprAvantValeur.strip_tags(\Pv\Misc::clean_special_chars($valeur)).$this->ExprApresValeur ;
		}
		echo $this->SeparateurLignes ;
	}
	protected function EnvoiePied()
	{
	
	}
}

class CommandeExportVers extends \Pv\ZoneWeb\TableauDonnees\Commande\CommandeExportVers
{
	public $NomFichier = "resultat.xls" ;
	protected function EnvoieEntete()
	{
		echo '<!doctype html>
<html>
<head>
<style type="text/css">
tr {mso-height-source:auto;}
col {mso-width-source:auto;}
br {mso-data-placement:same-cell;}
.style0 {
mso-number-format:General;
text-align:general;
vertical-align:bottom;
white-space:nowrap;
mso-rotate:0;
mso-background-source:auto;
mso-pattern:auto;
color:black;
font-size:11.0pt;
font-weight:400;
font-style:normal;
text-decoration:none;
font-family:Calibri, sans-serif;
mso-font-charset:0;
border:none;
mso-protection:locked visible;
mso-style-name:Normal;
mso-style-id:0;
}
td {
mso-style-parent:style0;
padding-top:1px;
padding-right:1px;
padding-left:1px;
mso-ignore:padding;
color:black;
font-size:11.0pt;
font-weight:400;
font-style:normal;
text-decoration:none;
font-family:Calibri, sans-serif;
mso-font-charset:0;
mso-number-format:General;
text-align:general;
vertical-align:bottom;
border:none;
mso-background-source:auto;
mso-pattern:auto;
mso-protection:locked visible;
white-space:nowrap;
mso-rotate:0;
}
.xl65 {mso-style-parent:style0; mso-number-format:"\@";}
</style>
<body>
<table>'.PHP_EOL ;
		if($this->InclureEntete)
		{
			echo '<tr>' ;
			$colonnes = $this->TableauDonneesParent->DefinitionsColonnesExport() ;
			foreach($colonnes as $i => $colonne)
			{
				echo '<th align="'.$colonne->AlignEntete.'" width="'.$colonne->Largeur.'" valign="'.$colonne->AlignVEntete.'">'.PHP_EOL ;
				echo $colonne->ObtientLibelle(). PHP_EOL ;
				echo '</th>'. PHP_EOL ;
			}
			echo '</tr>'.PHP_EOL ;
		}
	}
	protected function EnvoieValeurs($valeurs)
	{
		echo '<tr>'.PHP_EOL ;
		$colonnes = $this->TableauDonneesParent->DefinitionsColonnesExport() ;
		foreach($valeurs as $i => $valeur)
		{
			$colonne = $colonnes[$i] ;
			echo '<td class="xl65" align="'.$colonne->AlignElement.'" valign="'.$colonne->AlignVElement.'">'.$valeur.'</td>'.PHP_EOL ;
		}
		echo '</tr>'.PHP_EOL ;
	}
	protected function EnvoiePied()
	{
		echo '</table>
</body>
</html>' ;
	}
}