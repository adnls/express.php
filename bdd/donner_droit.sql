-- Donner les droits au compte applicatif enseignant
-- Donner les droits de selection sur les vues
GRANT SELECT ON `sde`.`VueListeCours` TO 'enseignant';
GRANT SELECT ON `sde`.`VueListeEnseignants` TO 'enseignant';
GRANT SELECT ON `sde`.`VueListeEnseignements` TO 'enseignant';
-- Donner droit de selection sur la liste des Enseignements
GRANT EXECUTE ON PROCEDURE `sde`.`SelectionnerEnseignements` TO 'enseignant';

-- Donner les droits au compte applicatif administrateur
-- Donner les droits de selection sur les vues
GRANT SELECT ON `sde`.`VueListeCours` TO 'admin';
GRANT SELECT ON `sde`.`VueListeEnseignants` TO 'admin';
-- GRANT SELECT ON `sde`.`VueListeEnseignements` TO 'admin';
-- Donner droit de selection sur la liste des Enseignements
GRANT EXECUTE ON PROCEDURE `sde`.`SelectionnerEnseignements` TO 'admin';
-- Donner les droits d'exécution sur les procédures
GRANT EXECUTE ON PROCEDURE `sde`.`InsererCours` TO 'admin';
GRANT EXECUTE ON PROCEDURE `sde`.`InsererEnseignant` TO 'admin';
GRANT EXECUTE ON PROCEDURE `sde`.`InsererEnseignement` TO 'admin';
GRANT EXECUTE ON PROCEDURE `sde`.`InsererFormation` TO 'admin';
GRANT EXECUTE ON PROCEDURE `sde`.`ModifierCours` TO 'admin';
GRANT EXECUTE ON PROCEDURE `sde`.`ModifierEnseignant` TO 'admin';
GRANT EXECUTE ON PROCEDURE `sde`.`ModifierEnseignement` TO 'admin';
GRANT EXECUTE ON PROCEDURE `sde`.`ModifierFormation` TO 'admin';
GRANT EXECUTE ON PROCEDURE `sde`.`SupprimerCours` TO 'admin';
GRANT EXECUTE ON PROCEDURE `sde`.`SelectionnerCours` TO 'admin';
