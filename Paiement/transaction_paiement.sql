
DROP TABLE IF EXISTS `transaction_paiement`;

CREATE TABLE `transaction_paiement` (
  `id` int(11) NOT NULL,
  `id_transaction` varchar(20) NOT NULL,
  `designation` varchar(120) DEFAULT NULL,
  `montant` double DEFAULT NULL,
  `monnaie` varchar(20) DEFAULT NULL,
  `nom_fournisseur` varchar(30) DEFAULT NULL,
  `contenu_brut` text,
  `id_etat` varchar(30) DEFAULT NULL,
  `timestamp_etat` int(16) DEFAULT NULL,
  `msg_erreur_etat` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

ALTER TABLE `transaction_paiement`
  ADD PRIMARY KEY (`id`);
 
ALTER TABLE `transaction_paiement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;