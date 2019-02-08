CREATE TABLE `transaction_soumise` (
  `id` int(11) NOT NULL,
  `nom_interface_paiement` varchar(100) NOT NULL,
  `id_transaction` varchar(20) NOT NULL,
  `date_creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `designation` varchar(255) NOT NULL,
  `montant` double NOT NULL,
  `monnaie` varchar(6) NOT NULL,
  `infos_suppl` varchar(255) NOT NULL,
  `cfg` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `transaction_soumise`
--
ALTER TABLE `transaction_soumise`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `tonti_transaction_soumise`
--
ALTER TABLE `tonti_transaction_soumise`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;