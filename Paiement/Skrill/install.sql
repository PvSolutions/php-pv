--
-- Structure de la table `transaction_skrill`
--

DROP TABLE IF EXISTS `transaction_skrill`;
CREATE TABLE `transaction_skrill` (
  `id_transaction` varchar(30) NOT NULL,
  `date_session` datetime DEFAULT NULL,
  `id_controle` int(6) NOT NULL,
  `ctn_req_session` text NOT NULL,
  `ctn_res_session` text,
  `valeur_session` varchar(30) DEFAULT NULL,
  `code_err_session` varchar(8) DEFAULT NULL,
  `msg_err_session` varchar(50) DEFAULT NULL,
  `date_annule` datetime NOT NULL,
  `est_annule` tinyint(1) NOT NULL,
  `date_statut` datetime NOT NULL,
  `ctn_res_statut` text,
  `valeur_statut` tinyint(1),
  `date_termine` datetime NOT NULL,
  `est_regle` tinyint(1) NOT NULL
) ENGINE=MyISAM ;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `transaction_cinetpay`
--
ALTER TABLE `transaction_skrill`
  ADD PRIMARY KEY (`id_transaction`);
