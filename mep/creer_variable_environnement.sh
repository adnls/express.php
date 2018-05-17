#!/bin/bash

####################################################
# DEFINIT UN ENSEMBLE DE VARIABLES D'ENVIRONNEMENT #
####################################################

# Définit les chemins, les logins et mdp
export DIR_BIN=/opt/lampp/bin
export DIR_PROJET=/home/pise/www/projet
export DIR_BDD="$DIR_PROJET/bdd"

# Login BDD
export ROOT_MYSQL_PASSWD="wqa&2ZSX"
export ROOT_MYSQL_LOGIN="root"
# Les users applicatifs
export ADMIN_MYSQL_PASSWD="wqa&2ZSX"
export ADMIN_MYSQL_LOGIN="admin"
export ENSEIGNANT_MYSQL_PASSWD="wqa&2ZSX"
export ENSEIGNANT_MYSQL_LOGIN="enseignant"
export BDD_NOM="sde"
