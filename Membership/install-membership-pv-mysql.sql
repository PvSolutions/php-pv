SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";
-- --------------------------------------------------------

--
-- Structure de la table `membership_member`
--

CREATE TABLE IF NOT EXISTS `membership_member` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login_member` varchar(30) NOT NULL,
  `password_member` varchar(255) NOT NULL,
  `email` varchar(255) NULL,
  `first_name` varchar(150) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `address` varchar(255) NULL,
  `contact` varchar(255) NULL,
  `enabled` tinyint(1) NOT NULL,
  `ad_activated` tinyint(1) NOT NULL,
  `profile_id` int(5) NOT NULL,
  PRIMARY KEY (`id`)
)  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

INSERT INTO `membership_member` (`id`, `login_member`, `password_member`, `email`, `first_name`, `last_name`, `address`, `contact`, `enabled`, `ad_activated`, `profile_id`) VALUES
(1, 'root', password('ADMIN'), 'root@localhost', 'Super', 'Administrateur', '', '', 1, 0, 1),
(2, 'guest', '*00A51F3F48415C7D4E8908980D443C29C69B60C9', 'guest@monsite.com', 'Invité', 'Utilisateur', '', '', 1, 0, 2);

-- --------------------------------------------------------

--
-- Structure de la table `membership_profile`
--

CREATE TABLE IF NOT EXISTS `membership_profile` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NULL,
  `enabled` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
)  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

INSERT INTO `membership_profile` (`id`, `title`, `description`, `enabled`) VALUES
(null, 'Super administrateur', '', 1),
(null, 'Utilisateur invite', '', 1);

-- --------------------------------------------------------

--
-- Structure de la table `membership_role`
--

CREATE TABLE IF NOT EXISTS `membership_role` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
)  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

INSERT INTO `membership_role` (`id`, `name`, `title`, `description`, `enabled`) VALUES
(1, 'super_admin', 'Super administrateur', 'Acces à tout sur l''application', 1),
(2, 'invite', 'Invité', 'Acces aux fonctionnalites qu''un invite aurait acces.', 1);

-- --------------------------------------------------------

--
-- Structure de la table `membership_privilege`
--

CREATE TABLE IF NOT EXISTS `membership_privilege` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `profile_id` int(5) NOT NULL,
  `role_id` int(5) NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
)  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

INSERT INTO `membership_privilege` (`id`, `profile_id`, `role_id`, `active`) VALUES
(null, 1, 1, 1),
(null, 1, 2, 0),
(null, 2, 1, 0),
(null, 2, 2, 1);
