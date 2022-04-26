drop table if exists compte;
drop table if exists infos_perso;
drop table if exists formation;
drop table if exists exp_pro;


CREATE TABLE `compte` (
  `idMail` varchar(50) NOT NULL,
  `typeC` varchar(50) DEFAULT NULL,
  `mot_de_passe` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `exp_pro` (
  `idPro` int(11) NOT NULL,
  `dateDebPro` date DEFAULT NULL,
  `dateFinPro` date DEFAULT NULL,
  `villePro` varchar(50) DEFAULT NULL,
  `CPPro` varchar(5) DEFAULT NULL,
  `typePro` varchar(50) DEFAULT NULL,
  `salaire` double(19,2) DEFAULT NULL,
  `description` varchar(120) DEFAULT NULL,
  `secteur_act` varchar(50) DEFAULT NULL,
  `organisme` varchar(50) DEFAULT NULL,
  `poste` varchar(50) DEFAULT NULL,
  `actiActuel` tinyint(1) DEFAULT NULL,
  `idMail` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `formation` (
  `idF` varchar(50) NOT NULL,
  `typeF` varchar(50) DEFAULT NULL,
  `dateDebut` date DEFAULT NULL,
  `dateFin` date DEFAULT NULL,
  `etablissement` varchar(50) DEFAULT NULL,
  `diplome` varchar(50) DEFAULT NULL,
  `villeF` varchar(50) DEFAULT NULL,
  `CPF` varchar(5) DEFAULT NULL,
  `idMail` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `infos_perso` (
  `idPerso` int(11) NOT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `genre` varchar(50) DEFAULT NULL,
  `telephone` varchar(11) DEFAULT NULL,
  `ville` varchar(50) DEFAULT NULL,
  `CPPerso` varchar(6) DEFAULT NULL,
  `promotion` int(11) DEFAULT NULL,
  `idMail` varchar(50) DEFAULT NULL,
  `mail` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;