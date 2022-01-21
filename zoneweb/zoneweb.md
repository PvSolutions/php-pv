---
layout: default
title: Zone Web - Présentation
description: Zone affichant du contenu HTML
---

## Définition

La zone web simple représente un ensemble de pages web. L'utilisateur pourra y accéder s'il possède les droits adéquats.

## Déclaration

Créez une classe héritant de **\Pv\ZoneWeb\ZoneWeb**.

```php
class MaZone1 extends \Pv\ZoneWeb\ZoneWeb
{
}
```

La zone est un élément d'application, à inscrire avec la méthode **InsereIHM()**.

```php
class MonApplication1 extends \Pv\Application\Application
{
	protected function ChargeIHMs()
	{
		$this->InsereIHM("maZone", new MaZone1()) ;
	}
}
```

## Voir aussi

- [Entêtes de document](entetedoc.html)
- [Scripts web](scripts.html)
- [Documents web](documents.html)
- [Actions](actions.html)
- [Filtres de données](filtresdonnees.html)
- [Tâches planifiées](taches.html)
- [Composants de rendu](composants_rendu.html)
- [Tableaux de données](tableauxdonnees.html)
- [Formulaires de données](formulairedonnees.html)
- [Scripts membership](scriptsmembership.html)
- [Le composant ChartJS](chartjs.html)
- [Index](../index.html)
