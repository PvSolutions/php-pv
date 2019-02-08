-- --------------------------------------------------------

--
-- Structure de la table `visite_web`
--

DROP TABLE IF EXISTS `visite_web`;
CREATE TABLE IF NOT EXISTS `visite_web` (
  `adresse_ip` varchar(20) NOT NULL,
  `id_session` varchar(50) NOT NULL,
  `date_creation` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `nom_zone` varchar(30) NOT NULL,
  `nom_script` varchar(30) NOT NULL,
  `id_membre` int(11) DEFAULT NULL,
  `param1` varchar(30) DEFAULT NULL,
  `param2` varchar(30) DEFAULT NULL,
  `param3` varchar(30) DEFAULT NULL,
  `param4` varchar(30) DEFAULT NULL,
  `param5` varchar(30) DEFAULT NULL,
  `param6` varchar(30) DEFAULT NULL,
  `param7` varchar(30) DEFAULT NULL,
  `param8` varchar(30) DEFAULT NULL,
  `total` bigint(20) NOT NULL DEFAULT '1',
  KEY `date_creation` (`date_creation`),
  KEY `param1` (`param1`),
  KEY `param2` (`param2`),
  KEY `param3` (`param3`),
  KEY `param4` (`param4`),
  KEY `id_membre_connecte` (`id_membre`),
  KEY `total` (`total`),
  KEY `visite` (`adresse_ip`,`id_session`,`nom_zone`,`nom_script`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
