CREATE TABLE `assistance_paiement` (
  `id` int(11) NOT NULL,
  `date_creation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_transaction` varchar(20) NOT NULL,
  `email1` varchar(255) NOT NULL,
  `email2` varchar(255) NOT NULL,
  `tel1` varchar(255) NOT NULL,
  `tel2` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

ALTER TABLE `assistance_paiement`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `assistance_paiement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;