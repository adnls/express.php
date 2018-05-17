# Notes générales

> Documente l'écriture du programme, liste tous les problèmes rencontrés avec les solutions apportées et les question à poser à Christophe

## Installation de l'environnement de travail

- Voir s'il est possible de connecter MySQL Workbench sur le mysql de xampp ?


## Apache 2

## Variable d'environnement

Pour pouvoir utiliser getenv() il faut ajouter les variables d'environnement dans un fichier de conf qui est utilisé à apache lorsqu'il lance php. Ajouter les variable à la fin du fichier `/opt/lampp/apache2`

En production il faudra les ajouter dans le fichier de conf du VH.

## PHP

## Cookie / Session

Rappel sur les cookies et session sur le site d'[openclassroom](https://openclassrooms.com/courses/concevez-votre-site-web-avec-php-et-mysql/session-cookies)

## Questions CHRISTOPHE

- type de cours CM TP et CMTD, a quoi correspond CMTD ??

## Fonctionnalités :

- Copier/coller cours d'une année sur l'autre : le traitement sera fait dans PHP avec un appel de la procédure InsererCours(annee) sur un ensemble de cours
