# Notes pour la mise en production de l'application web

> Explique les procédures et documente le script bash d'installation.


## 1. Création des variables d'environnements

Ce fichier contient beaucoup de données sensibles : il est donc listé dans le .gitignore.
A la place on laissera un template (qu'il suffiera de mettre à jour).

usage :

    source creer_variable_environnement.sh

## 2. Installation de la BDD

cf [documentation officielle](https://dev.mysql.com/doc/refman/8.0/en/mysql-batch-commands.html), usage :

    mysql db_name < projet/bdd/creation_bdd.sql


## Versions des application

Mysql : Ver 15.1 Distrib 10.1.31-MariaDB, for Linux (x86_64) using readline 5.1
Php : PHP 7.1.15-0

## Deploiement sur Digital Ocean

> suivre les instrcutions de ce tutoriel : [Follow the testing Goat](https://www.obeythetestinggoat.com/book/chapter_manual_deployment.html)
> Necessite d'installer un Apache Mysql et PHP comme indiqué qur le tuto [digital ocean](https://www.digitalocean.com/community/tutorials/how-to-install-linux-apache-mysql-php-lamp-stack-on-ubuntu-16-04)

2 étapes à distinguer pour le déploiements:
- provisionning : consiste à mettre en marche le serveur pour qu'il puisse fonctionner la 1ere fois, installation (Apache2, PhP 7 et Mysql), configuration (apache2), telecharger le projet depuis git
- deploiement en tant que tel : met en place la dernière version de l'application. Comme on aura a le faire souvant cette partie sera automatiser avec un fichier bash

### provisionning

- Installer et Apache2

    # Update et Installer apache2
    sudo apt-get update
    sudo apt-get install -y apache2



- Installer Mysql (installera automatiquement la dernière version)[https://www.digitalocean.com/community/tutorials/how-to-install-mysql-on-ubuntu-16-04]

    # Update et installer mysql
    sudo apt-get update
    sudo apt-get install mysql-server


- Configurer mysql pour [améliorer la sécurité des mdp](https://www.howtoforge.com/setting-changing-resetting-mysql-root-passwords)

    mysql_secure_installation

- Installer [PHP 7.1](https://www.vultr.com/docs/how-to-install-and-configure-php-70-or-php-71-on-ubuntu-16-04)

    # Ajouter les sources des packages pour php 7
    sudo apt-get install -y python-software-properties
    sudo add-apt-repository -y ppa:ondrej/php
    sudo apt-get update -y

    # Installer php7
    sudo apt-get install -y php7.1 libapache2-mod-php7.1 php7.1-cli php7.1-common php7.1-mbstring php7.1-gd php7.1-intl php7.1-xml php7.1-mysql php7.1-mcrypt php7.1-zip

- Configurer Apache2


    # Faire une copie du fichier de configuration
    cp /etc/apache2/apache2.conf /etc/apache2/apache2.conf.ori20180508
    # Ajouter le nom du server
    echo "ServerName IP_OU_DOMANE" >> /etc/apache2/apache2.conf
    # Autoriser l'accès web sur le server
    sudo ufw allow in "Apache Full"
    # Ajouter la recherche d'un fichier index.php lors de l'ouverture d'un dossier
    cp /etc/apache2/mods-enabled/dir.conf  /etc/apache2/mods-enabled/dir.conf.ori20180508
    sudo vim /etc/apache2/mods-enabled/dir.conf


    # Changer le fichier en :
    <IfModule mod_dir.c>
        DirectoryIndex **index.php** index.html index.cgi index.pl index.xhtml index.htm
    </IfModule>

    # Relancer le serveur pour prendre en compte les changements
    sudo systemctl restart apache2

-  Créer l'arborescence et configurer le VirtualHost

    # Ajouter un utilisateur dédié
    adduser sde
    # entrer le password
    mkdir -p /home/sde/sites/sde
    # Ajouter un fichier test dans un dossier dédié à contenir le code du site sde
    touch /home/sde/sites/sde/index.html
    echo "hello world" > /home/sde/sites/sde/index.html

    # Ajouter un lien vers le dossier /home/sde/sites/sde/web
    cd /var/www
    ln -s /home/sde/sites/sde/web sde

    # Créer le VH
    sudo cp /etc/apache2/sites-available/000-default.conf /etc/apache2/sites-available/sde.conf
    vim /etc/apache2/sites-available/sde.conf

    # Faire pointer le virtualHost sur le lien "/var/www/sde"

    ```
        <VirtualHost *:80>
                #ServerName www.example.com

                ServerAdmin remidlnn@gmail.com
                DocumentRoot /var/www/sde

                ErrorLog ${APACHE_LOG_DIR}/error.log
                CustomLog ${APACHE_LOG_DIR}/access.log combined

        </VirtualHost>
    ```
    # Mettre en fonctionnement le site et éteindre celui par défaut
    a2dissite 000-default.conf
    a2ensite sde.conf
    service apache2 reload

    # A ce moment le site doit fonctionner avec un fichier test
    # Ajouter notre repo
    su sde
    cd ~/sites/sde
    git init
    git remote add origin https://github.com/remidlnn/gestion-planning.git
    git pull origin master

    # Maintenant on doit avoir accès au contenu du dossier web de notre repo git !


    # Mettre en place la base de données
    (trouver un moyen pour charger les mdp dans le script .sql)

    # Ajouter les variables d'environnement dans apache2 (pour pouvoir les utiliser dans php avec getenv())

    un72hycuuzr74ih78ky55ab!DEUS

- sécuriser le server en suivant quelques consignes

 [consignes](https://www.tecmint.com/apache-security-tips/)


Ajouter une connexion sécurisée en suivant ce [tuto](https://www.digitalocean.com/community/tutorials/how-to-secure-apache-with-let-s-encrypt-on-ubuntu-16-04)



### Déploiement

- Le script doit être lancé en tant que sde avec la commande :

    ssh sde@ip 'bash -s' < deployer.sh

- le script bash cf. `mep/deploter.sh`
## Deploiement sur Heroku

Procfile :
    web: vendor/bin/heroku-php-apache2 web/

composer.json (contient les dépendances)
