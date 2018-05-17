# Notes BDD

> Présente l'écritue de la BDD

## Workflow

Ecrire le MCD sur JMerise. Ensuite reporter le MLD sur MysqlWorkbench pour :
- générer le script (il y a beaucoup plus d'options que sur JMerise)
- et accessoirement exporter le MLD (le rendu graphique est nettement plus lisible !)

## Modélisation

### Entité Statuts

L'ensemble des combinaisons possible (titulaire / non titulaire, departement / hors département, et les status) peut être stocker dans une entité Statuts (nom, heureService, titulaire (bool)) et e champ depEco (bool) dans l'Entité Enseignants

**Relation de reflexivité dans l'entité Statuts**

On pourrait distinguer le statut (PR, MCF, etc.) et la catégorie des enseignant dans une seule table avec  une relation de reflexivité on regroupe les deux informations dans une seule table. On a un système à tiroir avec au premier niveau les catégories qui pourront (ou pas pour les TITULAIRE HORS DEPARTEMENT et les EXTERIEUR) faire référence à un deuxième niveau : les statuts. Ainsi on cloisonne les statuts dans des catégories.

Voir cet [article](http://mikehillyer.com/articles/managing-hierarchical-data-in-mysql/)

### Relation tripates et entité Cours
Les Enseignements sont découpés en cours (morceau d'enseignements), voir si ça ne correspond pas plutot à une relation tripates.

### Groupe et CMTD
Le nombre total d'heure d'un enseignement sera directement calculé avec :
CM + nbGroupe * TD

### code APOGEE/ECUE
Dans le CDC il est fait référence au CDC pour identifier un enseignement mais dans le tableau excel le terme ECUE est utilisé : est-ce qu'il s'agit de la même chose ?

## Les vues
3 VIEWS prédéfinies correspondant au vue coté PHP:

- liste des enseignants :
    - Enseignants.nom
    - Enseignants.prenom
    - Categories.nom
    - Categories.heureService
    - nb de cours (à calculer)
- liste des enseignements :
    - Enseignements.apoge
    - Enseignements.intitule
    - Enseignements.heureCM
    - Enseignements.heureeTP
    - Enseignements.semestre
    - Enseignements.nbGroupes
    - Formations.nom
    - Formations.diplome
    - heureCMAffecte (somme des nb d'heure des cours CM de l'enseigmenet)
    - heureTPAffecte (somme des nb d'heure des cours TP de l'enseigmenet)
    - heureTotal (heureCM + nbGroupes*heureTP)
- La liste des cours (a filtrer par enseignant pour avoir le détail de ses cours ou par enseignements pour le détail des enseignements) :
    - Enseignements.apogee
    - Enseignement.intitule,
    - TypesCours.nomC
    - Cours.nbHeure
    - Cours.annee (pour filtrer sur une année)

> Les vues sont préfixé par "Vue" : VueListeEnseignants

## Procédures

Allez voir le petit rappel sur les procédure en MySQL sur [openclassroom](https://openclassrooms.com/courses/administrez-vos-bases-de-donnees-avec-mysql/procedures-stockees).

On aura besoin des procédures "métier":

- ajouter : un Enseignants, Enseignements, Cours, Formations
- modifier : un Enseignants, Enseignements, Cours, Formations (UPDATE sur l'ensemble des champs)
- supprimer : un cours (Et c'est tout car sinon on va devoir gérer énormément de CASCADE)

et de procédures d'"administration":
- modifier les catégories (nom, nb d'heure)
- attention on ne pourra pas modifier TypesCours, car bcp de procédures repose sur le fait que TypesCours 1 vaut CM et 2 vaut TP

Ces procédures reposeront sur des procédures de controle :

- Les procédures InsererCours et ModifierCours utilisent VeérifierNbHCours et CalculerNbHeuresAffectees permettent de vérifier qu'on ne va pas créer un cours qui rendrait le total des heures de cours d'un enseignement supérieur à son champ nbHeure (les procédures gèrent les deux type de cours TD et CM et sont utilisé pour). **Attention**, ces procédure repose sur le fait que les enregistrement CM et TP dans la tables TypesCours ont pour id respectif 1 et 2 !

> Dans le script les paramètres des procédures sont préfixées pas un p

## VueListeEnseignements et Procédure SelectionnerEnseignements

Afin d'afficher les champs :

- heureCMAffecte (somme des nb d'heure des cours CM de l'enseigmenet)
- heureTPAffecte (somme des nb d'heure des cours TP de l'enseigmenet)
- heureTotal (heureCM + nbGroupes*heureTP)

Il est nécessaire de faire des sous-requetes, ce qui est interdit dans une view (cf [issue](https://stackoverflow.com/questions/23765093/mysql-error-code-1349-views-select-contains-a-subquery-in-the-from-clause)). On devra donc passer par une procédure (sur laquelle l'user admin et enseignant auront des droits)

## Contraint check

Ajouter des contraintes de types check pour s'assurer que les données sont cohérente.

Forme :

  CREATE TABLE WhatEver
  (
      ...
      NumericField INTEGER NOT NULL CHECK(NumericField BETWEEN 1234 AND 4523),
      ...
  );

Exemple :
- semestre de 1 à 6 max pour un enseignements de type licence ou de 1 à 4 pour un enseignement de type master.

## Sécurité

Afin d'améliorer la sécurité ET les performances on utilisera des **procédures** et des **vues**. Il faudra limiter les droits des comptes applicatif à des select les vues et des call sur les procédures.

On aura 2 users :

- admin (avec des droits sur les vues ET les procédures)
- enseignant (avec des droits sur les vues uniquement)

Cette séparation suit la logique au niveau de l'application
