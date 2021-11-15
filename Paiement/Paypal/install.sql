--
-- Structure de la table `transaction_paypal`
--

DROP TABLE IF EXISTS `transaction_paypal`;
CREATE TABLE `transaction_paypal` (
  `id_transaction` varchar(30) NOT NULL,
  `date_envoi` timestamp DEFAULT CURRENT_TIMESTAMP,
  `designation` varchar(255) NOT NULL,
  `montant` decimal(11,2) NOT NULL default 0,
  `monnaie` varchar(4) default NULL,
  `id_commande` varchar(127) null,
  `nom_client` varchar(127) DEFAULT NULL,
  `prenom_client` varchar(255) DEFAULT NULL,
  `email_client` varchar(255) DEFAULT NULL,
  `id_client` varchar(127) DEFAULT NULL,
  `id_achat` varchar(127) DEFAULT NULL,
  `date_annule` datetime NULL,
  `est_annule` tinyint(1) default 0,
  `date_verif` datetime NULL,
  `code_erreur_verif` varchar(50) DEFAULT NULL,
  `ctn_req_auth_order` text default null,
  `ctn_rep_auth_order` text default null,
  `ctn_req_check_order` text default null,
  `ctn_rep_check_order` text default null,
  `est_regle` tinyint(1) default 0,
  `date_regle` datetime NULL
) ENGINE=MyISAM ;

ALTER TABLE `transaction_paypal`
  ADD PRIMARY KEY (`id_transaction`);
