SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `configs` (
  `id` int(11) NOT NULL,
  `title` varchar(64) NOT NULL DEFAULT 'PHP eStore',
  `description` varchar(256) NOT NULL DEFAULT 'PHP eStore - это движок магазина цифровых товаров, который позволяет продавать и управлять цифровым товаром.',
  `keywords` varchar(256) NOT NULL DEFAULT 'PHP eStore, магазин, цифровых, товаров, купить eStore, купить php store, php, store, скрипты, веб скрипты',
  `currency` varchar(5) NOT NULL DEFAULT '₽',
  `template` varchar(64) NOT NULL DEFAULT 'standart',
  `version` varchar(32) NOT NULL DEFAULT '1.0',
  `time_update` int(15) NOT NULL,
  `cache` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `configs` (`id`, `title`, `description`, `keywords`, `currency`, `template`, `version`, `time_update`, `cache`) VALUES
(1, :project, :description, :keywords, '₽', :template, '1.2', 1635369223, 0);

CREATE TABLE `configs__cashier` (
  `id` int(11) NOT NULL,
  `code` varchar(32) NOT NULL,
  `id_shop` varchar(64) NOT NULL,
  `field` text NOT NULL,
  `field_2` text NOT NULL,
  `enable` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `configs__cashier` (`id`, `code`, `id_shop`, `field`, `field_2`, `enable`) VALUES
(1, 'qiwi', '', '', '', 0),
(2, 'free-kassa', '', '', '', 0);

CREATE TABLE `events` (
  `id` int(9) NOT NULL,
  `id_user` int(9) NOT NULL,
  `id_event` int(9) NOT NULL,
  `message` text NOT NULL,
  `time_event` int(15) NOT NULL,
  `visible` int(9) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `events__category` (
  `id` int(9) NOT NULL,
  `code` varchar(32) NOT NULL,
  `name` varchar(64) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `events__category` (`id`, `code`, `name`) VALUES
(1, 'balance', 'Баланс');

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `description` text NOT NULL,
  `resource` text NOT NULL,
  `price` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `id_category` int(11) NOT NULL,
  `image` text NOT NULL,
  `binding` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `product__category` (
  `id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `code` varchar(32) NOT NULL,
  `id_optgroup` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `product__category` (`id`, `name`, `code`, `id_optgroup`) VALUES
(1, 'Плагины', 'cs-plugins', 1),
(2, 'Моды', 'cs-mods', 1),
(3, 'Сборки', 'cs-builds', 1),
(4, 'Плагины', 'sp-plugins', 2),
(5, 'Моды', 'sp-mods', 2),
(6, 'Сборки', 'sp-builds', 2),
(7, 'Плагины', 'gta-plugins', 3),
(8, 'Моды', 'gta-mods', 3),
(9, 'Сборки', 'gta-builds', 3),
(10, 'Плагины', 'rust-plugins', 4),
(11, 'Моды', 'rust-mods', 4),
(12, 'Сборки', 'rust-builds', 4),
(13, 'GameCMS', 'gamecms-templates', 5),
(14, 'Bootstrap', 'bootstra-templates', 5),
(15, 'Rankme', 'gamecms-templates', 5),
(16, 'AmxBans', 'amxbans-templates', 5),
(17, 'HLStatsX: CE', 'hlstatsx-templates', 5),
(18, 'SourceBans', 'sourcebans-templates', 5),
(19, 'MaterialAdmin', 'madmin-templates', 5);

CREATE TABLE `product__images` (
  `id` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `product__links` (
  `id` int(9) NOT NULL,
  `id_product` int(9) NOT NULL,
  `hash` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `product__optgroup` (
  `id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `product__optgroup` (`id`, `name`) VALUES
(1, 'Counter-Strike'),
(2, 'SAMP'),
(3, 'GTA V'),
(4, 'Rust'),
(5, 'Шаблоны'),
(6, 'Веб скрипты'),
(7, 'Программы');

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(32) NOT NULL,
  `password` varchar(256) NOT NULL,
  `name` varchar(32) NOT NULL,
  `balance` int(11) NOT NULL DEFAULT '0',
  `id_group` int(11) NOT NULL DEFAULT '1',
  `cache` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `users__groups` (
  `id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `style` text NOT NULL,
  `access` varchar(64) NOT NULL DEFAULT 'z'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `users__groups` (`id`, `name`, `style`, `access`) VALUES
(1, 'Покупатель', '', 'z'),
(2, 'Создатель', '', 'abcdefghijklmnopqrstuvwxyz');

CREATE TABLE `users__purchases` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `address` varchar(64) NOT NULL DEFAULT 'none',
  `hash` varchar(256) NOT NULL DEFAULT 'none',
  `time_buy` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `configs`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `configs__cashier`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `events__category`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `product__category`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `product__images`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `product__links`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `product__optgroup`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `users__groups`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `users__purchases`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `configs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `configs__cashier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `events`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `events__category`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `product__category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

ALTER TABLE `product__images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `product__links`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `product__optgroup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `users__groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `users__purchases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
COMMIT;