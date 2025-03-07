DROP TABLE IF EXISTS `transaction_cinetpay2`;
CREATE TABLE `transaction_cinetpay2` (
  `id_transaction` varchar(30) NOT NULL,
  `date_envoi` datetime NULL,
  `ctn_envoi` text NULL,
  `designation` varchar(255) NULL,
  `montant` integer NULL,
  `monnaie` varchar(3) NULL,
  `date_annule` datetime NULL,
  `est_annule` tinyint(1) NOT NULL default 0,
  `date_retour` datetime NULL,
  `ctn_res_retour` text,
  `est_regle` tinyint(1) NOT NULL default 0,
  `code_err_retour` varchar(30) NULL,
  `msg_err_retour` varchar(255) NULL
) ENGINE=MyISAM ;

--
-- Index pour la table `transaction_cinetpay2`
--
ALTER TABLE `transaction_cinetpay2`
  ADD PRIMARY KEY (`id_transaction`);