INSERT INTO `compte` (`idMail`, `typeC`, `mot_de_passe`) VALUES
('123', '0', 'secret'),
('aneyra', '2', 'mot de passe'),
('aneyracontr', '1', '1234');

INSERT INTO `exp_pro` (`idPro`, `dateDebPro`, `dateFinPro`, `villePro`, `CPPro`, `typePro`, `salaire`, `description`, `secteur_act`, `organisme`, `poste`, `actiActuel`, `idMail`) VALUES
(1, '2021-03-01', '2021-03-24', 'Bordeaux', '33000', 'CDI', 2000.00, 'Une description qui vous veut du bien.', 'Batiment', 'Total', 'ingénieur civil', 1, 'aneyracontr'),
(2, '2019-03-01', '0000-00-00', 'montreuil', '93100', 'stage', 0.00, 'Métier chronophage mais très rémunérateur.', 'Pédagogie', 'A7', 'Ingenieur pédagogique', 0, 'aneyracontr');

INSERT INTO `formation` (`idF`, `typeF`, `dateDebut`, `dateFin`, `etablissement`, `diplome`, `villeF`, `CPF`, `idMail`) VALUES
('1', 'stage', '2021-03-01', '2021-03-31', 'NASA', 'blague', 'Californie', '33400', 'aneyracontr'),
('2', 'etude', '2021-03-09', '2021-03-24', 'jean jaures', 'bac', 'montreuil', '93100', 'aneyracontr'),
('3', 'stage', '2020-03-10', '2021-02-02', 'condorcet', 'bac+1', 'bondy', '93100', 'aneyracontr');

INSERT INTO `infos_perso` (`idPerso`, `nom`, `prenom`, `genre`, `telephone`, `ville`, `CPPerso`, `promotion`, `idMail`, `mail`) VALUES
(1, 'Serna Hernandez', 'Antoine', 'Autre', '0652294309', 'Bordeaux', '33000', 2022, 'aneyracontr', 'aneyracontr@ensc.fr'),
(5, 'Neyra', 'Antoine', NULL, '0912345678', 'Talence', '33400', 2023, 'aneyra', NULL);