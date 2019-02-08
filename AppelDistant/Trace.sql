CREATE TABLE `trace_appel_distant` (
  `id` int(11) NOT NULL,
  `id_ctrl` varchar(30) NOT NULL,
  `date_creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `origine_appel` varchar(20) DEFAULT NULL,
  `adresse_appel` varchar(255) DEFAULT NULL,
  `contenu_appel` text,
  `contenu_resultat` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `trace_appel_distant`
--
ALTER TABLE `trace_appel_distant`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IX1` (`id_ctrl`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `trace_appel_distant`
--
ALTER TABLE `trace_appel_distant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;