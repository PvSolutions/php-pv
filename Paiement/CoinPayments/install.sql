CREATE TABLE `transaction_coinpayments` (
  `id_transaction` varchar(30) NOT NULL,
  `date_envoi` datetime DEFAULT NULL,
  `url_envoi` varchar(255) NOT NULL,
  `ctn_req_envoi` text NOT NULL,
  `date_annule` datetime NOT NULL,
  `est_annule` tinyint(1) NOT NULL,
  `date_retour` datetime NOT NULL,
  `ctn_res_retour` text,
  `succes_confirm_ipn_retour` tinyint(1) NOT NULL,
  `mtd_confirm_ipn_retour` tinyint(1) NOT NULL,
  `param1_confirm_ipn_retour` varchar(60) NOT NULL,
  `param2_confirm_ipn_retour` varchar(60) NOT NULL,
  `est_regle` tinyint(1) NOT NULL,
  `code_err_retour` varchar(8) NOT NULL,
  `msg_err_retour` varchar(255) NOT NULL
) ;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `transaction_coinpayments`
--
ALTER TABLE `transaction_coinpayments`
  ADD PRIMARY KEY (`id_transaction`);
