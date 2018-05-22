CREATE TABLE `organisateur` (
  `idOrganisateur` int(11) NOT NULL,
  `nom` varchar(45) NOT NULL,
  `prenom` varchar(45) NOT NULL,
  `adresse` varchar(300) NOT NULL,
  `mail` varchar(90) NOT NULL,
  `motdepasse` varchar(45) NOT NULL,
  `login` varchar(255) DEFAULT NULL,
  
) ENGINE=InnoDB DEFAULT CHARSET=utf8;







