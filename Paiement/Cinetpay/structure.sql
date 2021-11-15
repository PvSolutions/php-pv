--
-- Structure de la table `transaction_cinetpay`
--

DROP TABLE IF EXISTS `transaction_cinetpay`;
CREATE TABLE `transaction_cinetpay` (
  `id_transaction` varchar(30) NOT NULL,
  `date_signature` datetime DEFAULT NULL,
  `url_signature` varchar(255) NOT NULL,
  `ctn_req_signature` text NOT NULL,
  `ctn_res_signature` text,
  `ctn_form_transact` text,
  `valeur_signature` varchar(30) DEFAULT NULL,
  `code_err_signature` varchar(8) DEFAULT NULL,
  `msg_err_signature` varchar(50) DEFAULT NULL,
  `date_annule` datetime NULL,
  `est_annule` tinyint(1) NOT NULL default 0,
  `date_retour` datetime NULL,
  `ctn_res_retour` text,
  `date_verif` datetime NULL,
  `url_verif` varchar(255) NOT NULL,
  `ctn_req_verif` text NOT NULL,
  `ctn_res_verif` text NOT NULL,
  `est_regle` tinyint(1) NOT NULL,
  `code_err_verif` varchar(8) NULL,
  `msg_err_verif` varchar(255) NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `transaction_cinetpay`
--
ALTER TABLE `transaction_cinetpay`
  ADD PRIMARY KEY (`id_transaction`);
