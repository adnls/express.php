#!/bin/bash

# A lancer sur un serveur avec la commande :
#ssh sde@ip 'bash -s' < deployer.sh

echo "Se depalcer dans le bon dossier"
cd ~/sites/sde

echo "Sourcer et afficher les variables d'environnement"
source mep/.env
printenv

echo "Supprimer tous les changements pour être certain de pouvoir faire le pull"
git checkout .
echo "Obtenir les dernières sources de la branche master"
git pull origin master

echo "Changer les mots de passe par les mots de passe issus des variables d'env"
sed -i -e "s/mdpadmin/$ADMIN_MYSQL_PASSWD/g" "$DIR_BDD/creer_bdd.sql"
sed -i -e "s/mdpenseignant/$ENSEIGNANT_MYSQL_PASSWD/g" "$DIR_BDD/creer_bdd.sql"

echo "Installer la base de données"
cat "$DIR_BDD/creer_bdd.sql" "$DIR_BDD/donner_droit.sql" "$DIR_BDD/remplir_bdd.sql" | $MYSQL -u $ROOT_MYSQL_LOGIN -p$ROOT_MYSQL_PASSWD
