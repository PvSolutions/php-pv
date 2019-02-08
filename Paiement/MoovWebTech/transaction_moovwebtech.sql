CREATE TABLE `transaction_moovwebtech` (
  `id` int(11) NOT NULL,
  `date_creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_transaction` varchar(30) NOT NULL,
  `url_envoi_demande` varchar(255) DEFAULT NULL,
  `date_envoi_demande` datetime DEFAULT NULL,
  `ctn_retour_demande` varchar(255) DEFAULT NULL,
  `succes_retour_demande` tinyint(4) DEFAULT NULL,
  `id_transact_spec` int(11) DEFAULT NULL,
  `date_envoi_statut` datetime DEFAULT NULL,
  `url_envoi_statut` varchar(255) DEFAULT NULL,
  `ctn_retour_statut` text,
  `date_retour_statut` datetime DEFAULT NULL,
  `valeur_retour_statut` tinyint(2) DEFAULT NULL,
  `message_statut_retour` varchar(124) DEFAULT NULL,
  `total_essais_statut` tinyint(4) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


ALTER TABLE `transaction_moovwebtech`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IX_ID_TRANSACT` (`id_transaction`);


ALTER TABLE `transaction_moovwebtech`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;