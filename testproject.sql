SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE TABLE IF NOT EXISTS `authors` (
  `id` int(11) NOT NULL,
  `firstname` varchar(64) NOT NULL,
  `lastname` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `authors` (`id`, `firstname`, `lastname`) VALUES
(1, 'Дин', 'Кунц'),
(2, 'Дуглас', 'Адамс'),
(3, 'Эд', 'Леки-Томпсон'),
(4, 'Люк', 'Веллинг'),
(5, 'Адам', 'Фримен');

CREATE TABLE IF NOT EXISTS `books` (
  `id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `date_create` datetime NOT NULL,
  `date_update` datetime NOT NULL,
  `preview` varchar(128) NOT NULL,
  `date` date NOT NULL,
  `author_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `regdate` datetime NOT NULL,
  `pass` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `users` (`id`, `email`, `regdate`, `pass`) VALUES
(1, 'test@example.com', '2015-11-29 12:08:21', '$2y$10$/lfknPtxhuQsO/E2gAZQL.v6FCrygi4bX.Txnv0lY42AFVitxLXW6');

ALTER TABLE `authors`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
