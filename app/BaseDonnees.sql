-- phpMyAdmin SQL Dump
-- version 3.5.8.1
-- http://www.phpmyadmin.net
--
-- Host: 10.246.16.225:3306
-- Generation Time: Dec 11, 2013 at 12:02 PM
-- Server version: 5.1.72-2
-- PHP Version: 5.3.3-7+squeeze15

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `moktarba_com`
--
CREATE DATABASE `moktarba_com` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `moktarba_com`;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'informatique'),
(2, 'hihg-tech'),
(3, 'sport'),
(4, 'divers');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` varchar(200) DEFAULT NULL,
  `pseudo` varchar(45) DEFAULT NULL,
  `mail` varchar(45) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `users_id` int(11) DEFAULT NULL,
  `posts_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_comments_users1` (`users_id`),
  KEY `fk_comments_posts1` (`posts_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=46 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `text`, `pseudo`, `mail`, `created_at`, `users_id`, `posts_id`) VALUES
(1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type a', 'abratkom', 'moktarba@hotmail.fr', '2013-01-03 00:00:00', 1, 3),
(2, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type a', 'developer', 'developer@gmail.com', '2013-06-09 08:21:23', 1, 4),
(3, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type a', 'moktarba', 'abratkom@gmail.com', '2013-01-04 09:13:34', NULL, 5),
(4, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type a', 'testeur', 'testeur@testeur.com', '2013-06-05 11:26:00', 1, 6),
(5, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type a', 'borom ndam', 'moktarba@gonal.com', '2013-01-04 09:13:34', NULL, 6),
(6, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type a', 'nono', 'nono@gmail.fr', '2013-06-06 12:27:28', NULL, 7),
(8, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. ', 'testeur', 'testeur@gmail.com', '2013-07-02 22:25:34', 1, 6),
(9, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. ', 'momo', 'testeur@gmail.com', '2013-07-02 22:31:28', 1, 6),
(10, 'Lorem Ipsum is simply dummy text of the printing...', 'momo', 'testeur@gmail.com', '2013-07-02 22:33:23', 1, 6),
(11, 'Lorem Ipsum is simply....', 'momo', 'testeur@gmail.com', '2013-07-02 22:34:01', 1, 6),
(12, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. ', 'testeur', 'testeur@gmail.com', '2013-07-03 01:47:08', 1, 4),
(13, 'Cette maison, elle est vraiment belle!', 'momo', 'testeur@gmail.com', '2013-07-03 17:48:28', 1, 8),
(14, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry....', 'guedj ndar', 'testeur@gmail.com', '2013-07-04 22:36:09', 1, 7),
(15, 'Lorem Ipsum is simply dummy text of the printing....', 'guedj ndar', 'testeur@gmail.com', '2013-07-04 22:38:38', 1, 7),
(18, 'no comment', 'testeur', 'testeur@yahoo.fr', '2013-08-01 05:14:12', 1, 4),
(19, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. ', 'momo', 'coco@hotmail.fr', '2013-08-30 02:22:29', 1, 7),
(20, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. ', 'momo', 'coco@hotmail.fr', '2013-08-30 02:27:34', 1, 7),
(21, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. ', 'moktarba', 'moktarba@hotmail.fr', '2013-11-14 18:06:30', 1, 9),
(22, 'Iphone est précurseur en matière de smartphone.', 'moktarba', 'moktarba@hotmail.fr', '2013-11-14 18:07:44', 1, 9),
(23, 'Elle est au top niveau!', 'moktarba', 'moktarba@hotmail.fr', '2013-11-14 18:12:05', 1, 3),
(24, 'Elle innove', 'moktarba', 'moktarba@hotmail.fr', '2013-11-14 18:16:55', 1, 3),
(25, 'Elle travaille ses morceaux', 'moktarba', 'moktarba@hotmail.fr', '2013-11-14 18:19:26', 1, 3),
(26, 'lorem ipsum....', 'moktarba', 'moktarba@hotmail.fr', '2013-11-14 18:19:58', 1, 9),
(27, 'Le ballon d\\''or est fait pour lui', 'moktarba', 'moktarba@hotmail.fr', '2013-11-14 18:25:40', 1, 10),
(28, 'bgvjhujh hkyv ugkuygiug jvuvujv uigygygv ètèggvtgètègvbuyttèvutrtvvvgtbbbv vygyihggyu yiguygg yufugfyu yt vuètègg trèttè tètrègfèt èfètè ', 'moktarba', 'moktarba@hotmail.fr', '2013-11-14 19:23:57', 1, 9),
(29, 'ddsvfsdf cvfsgkslsfv v fsdgffl;', 'moktarba', 'moktarba@hotmail.fr', '2013-11-15 11:50:57', 1, 3),
(30, 'C\\''est une belle montre', 'moktarba', 'moktarba@hotmail.fr', '2013-11-15 12:13:09', 1, 4),
(31, 'Shop New Holiday UGG Styles Now!Shop Authentic UGG Boots and Slippers with Free Shipping.\r\n &lt;a href=\\&quot;http://uggssss.weebly.com/1/post/2013/11/fashion-ugg-bootsvictoria-justice-talks-uggs-feel', 'cheap ugg boots', 'npopnju@gmail.com', '2013-12-04 13:25:56', 1, 4),
(32, 'Its really a very nice miumiu fairy bag .. its simply stunning to look at and very nice design.. right now im looking for another miumiu bag seen below.\r\n &lt;a href=\\&quot;http://miumiubags2019.wordp', 'miu miu bags in france', 'pnngubsxogz@gmail.com', '2013-12-05 00:39:33', 1, 4),
(33, 'Shop fabulous parajumpers jackets at cheap parajumpers online store.\r\n &lt;a href=\\&quot;http://parajumpersjacketsonlines.weebly.com/1/post/2013/11/parajumpers-new-products.html\\&quot; title=\\&quot;pa', 'parajumpers online shop', 'aeskrejlvfw@gmail.com', '2013-12-05 09:21:11', 1, 4),
(34, 'This miumiu handbag really is a sweet touch! I love today\\''s outfit, is so pretty!\r\n &lt;a href=\\&quot;http://miumiubags2013.wordpress.com/2013/11/08/miu-miu-online-9/\\&quot; title=\\&quot;miu miu bags', 'miu miu bags polyvore', 'qpzzmi@gmail.com', '2013-12-06 01:07:00', 1, 4),
(35, 'Michael Kors is such a pretty!\r\n &lt;a href=\\&quot;http://parajumpersjacketsonlines.weebly.com/1/post/2013/11/how-to-store-your-winter-pjs-some-useful-tips.html\\&quot; title=\\&quot;parajumpers canada\\', 'parajumpers canada', 'azyywgf@gmail.com', '2013-12-06 05:44:48', 1, 4),
(36, 'Vintage bandage dresses were donned by celebrities including Victoria Beckham and Keira Knightly.\r\n &lt;a href=\\&quot;http://hervelegerdressonline2013.wordpress.com/\\&quot; title=\\&quot;herve leger ai', 'herve leger airbrush dress', 'akmqzr@gmail.com', '2013-12-06 05:58:19', 1, 4),
(37, 'Check out Barbour 2013 new collection.Buy a Barbour jackets for your family as a Christmas gift.\r\n &lt;a href=\\&quot;http://barboursaleoutlet.weebly.com/1/post/2013/11/barbour-vision-mission-and-value', 'barbour jacket accessories', 'vqvoafih@gmail.com', '2013-12-06 08:31:30', 1, 4),
(38, 'Find the largest selection of canada goose parka on sale.Get free shipping on all orders.\r\n &lt;a href=\\&quot;http://canadagooseonline2013.tumblr.com/\\&quot; title=\\&quot;canada goose chilliwack real ', 'canada goose chilliwack real or fake', 'ktqpleh@gmail.com', '2013-12-06 08:34:37', 1, 4),
(39, 'Buy your family a warm Woolrich Parka for the cold winter.100% authentic with free shipping.\r\n &lt;a href=\\&quot;http://woolrichparkaoutlet.tumblr.com/post/66080174365/woolrich-parka-outlet-10\\&quot; ', 'woolrich parka coats women', 'bctougoqkz@gmail.com', '2013-12-06 08:35:00', 1, 4),
(40, 'Michael Kors is such a pretty!\r\n &lt;a href=\\&quot;https://twitter.com/michaelkors21\\&quot; title=\\&quot;michael kors bag with lock\\&quot;&gt;michael kors bag with lock&lt;/a&gt;', 'michael kors bag with lock', 'wmcpynfy@gmail.com', '2013-12-07 08:04:15', 1, 4),
(41, 'Michael Kors is such a pretty!\r\n[url=https://twitter.com/michaelkors21]michael kors bag velvet[/url]', 'michael kors bag velvet', 'siufiqnbvpq@gmail.com', '2013-12-09 06:49:40', 1, 4),
(42, 'Michael Kors is such a pretty!\r\n &lt;a href=\\&quot;http://michaelkors2013blr.tumblr.com/\\&quot; title=\\&quot;michael kors bag ebay\\&quot;&gt;michael kors bag ebay&lt;/a&gt;', 'michael kors bag ebay', 'bjrwjp@gmail.com', '2013-12-10 00:24:34', 1, 4),
(43, 'Our Canada Goose products are only using the best materials, is not beyond the quality, high-tech high-end design, welcome to place an order from us!\r\n &lt;a href=\\&quot;http://canadagooseparkasjacket', 'canada goose jacka gjord av', 'zlgltbtyeux@gmail.com', '2013-12-10 17:17:17', 1, 4),
(44, 'Michael Kors is such a pretty!\r\n &lt;a href=\\&quot;https://twitter.com/michaelkors21\\&quot; title=\\&quot;michael kors bag with lock\\&quot;&gt;michael kors bag with lock&lt;/a&gt;', 'michael kors bag with lock', 'gokxcbunke@gmail.com', '2013-12-11 06:07:32', 1, 4),
(45, 'I\\''m usually a fan of miu miu bags, I\\''m  crazy about this one.\r\n &lt;a href=\\&quot;https://twitter.com/miumiuonline2\\&quot; title=\\&quot;miu miu bags on ebay\\&quot;&gt;miu miu bags on ebay&lt;/a&gt;', 'miu miu bags on ebay', 'iulmuq@gmail.com', '2013-12-11 09:21:09', 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) NOT NULL,
  `title2` varchar(45) NOT NULL,
  `image` varchar(100) NOT NULL,
  `image2` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `description2` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `categories_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `css` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_posts_categories` (`categories_id`),
  KEY `fk_posts_users1` (`users_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `title2`, `image`, `image2`, `description`, `description2`, `created_at`, `updated_at`, `categories_id`, `users_id`, `css`) VALUES
(3, 'La plus belle voix du soul', '', 'img/alicia.jpg', '', 'Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '', '2013-06-05 12:29:34', '0000-00-00 00:00:00', 4, 1, 1),
(4, 'La montre smartphone', '', 'img/high-tech3.jpg', '', 'Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '', '2013-06-06 12:27:28', '0000-00-00 00:00:00', 2, 1, 2),
(5, 'Iphone vs Galaxy S', 'A quand sur le marché?', 'img/high-tech4.jpg', 'img/high-tech5.jpg', 'Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2013-06-06 20:35:25', '0000-00-00 00:00:00', 2, 1, 3),
(6, 'Un nouveau style pour la sorento', '', 'img/auto.jpg', '', 'Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '', '2013-06-08 17:00:00', '0000-00-00 00:00:00', 4, 1, 1),
(7, 'Le futur fait peur?', 'Les geeks vont adorer', 'img/high-tech6.jpg', 'img/high-tech7.jpg', 'Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2013-06-06 07:40:33', '0000-00-00 00:00:00', 2, 1, 3),
(8, 'La maison connectée', '', 'img/high-tech8.png', '', 'Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '', '2013-06-09 08:21:23', '0000-00-00 00:00:00', 2, 1, 2),
(9, 'Iphone 5C, réussite ou flop?', '', 'img/iphone5c.jpg', '', 'Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l''imprimerie depuis les années 1500, quand un peintre anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte. Il n''a pas fait que survivre cinq siècles, mais s''est aussi adapté à la bureautique informatique, sans que son contenu n''en soit modifié. Il a été popularisé dans les années 1960 grâce à la vente de feuilles Letraset contenant des passages du Lorem Ipsum, et, plus récemment, par son inclusion dans des applications de mise en page de texte, comme Aldus PageMaker.', '', '2013-09-28 20:37:24', '0000-00-00 00:00:00', 1, 1, 1),
(10, 'Ballon D''or combien de fois...?', '', 'img/messi0.jpg', '', 'Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l''imprimerie depuis les années 1500, quand un peintre anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte. Il n''a pas fait que survivre cinq siècles, mais s''est aussi adapté à la bureautique informatique, sans que son contenu n''en soit modifié. Il a été popularisé dans les années 1960 grâce à la vente de feuilles Letraset contenant des passages du Lorem Ipsum, et, plus récemment, par son inclusion dans des applications de mise en page de texte, comme Aldus PageMaker.', '', '2013-09-28 09:59:00', '0000-00-00 00:00:00', 3, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `avatar` varchar(100) NOT NULL DEFAULT '',
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `token` varchar(255) NOT NULL,
  `last_login` datetime NOT NULL,
  `name` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `rule` varchar(100) NOT NULL DEFAULT 'user',
  `bio` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`, `updated_at`, `avatar`, `active`, `token`, `last_login`, `name`, `lastname`, `rule`, `bio`) VALUES
(1, 'abratkom', 'moktarba@hotmail.fr', '', '2013-06-01 00:00:00', '2013-12-10 23:05:25', 'img/uploads/571e32a9497bc9ce85a05dda04543fd6.jpg', 1, '', '2013-12-10 22:53:06', 'moktarba', 'ba', 'admin', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop p'),
(4, 'moktarba', 'bamoktar@gmail.com', '6948fda2a4eba67de4c013c25cce73953dcc1707', '2013-07-01 07:18:18', '2013-08-14 01:41:20', '', 1, '75d84d8bb00134baffd08f678dc591829d6a35a7', '2013-08-13 22:33:51', '', '', '', 'Je m''appelle Moktar Ba et je suis le créateur et le propriétaire de ce blog.'),
(5, 'amina', 'aminata.kebe@hotmail.fr', '1210be7a347dc83398074cc7dd1402bb061df375', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 0, '10b78be853326e1c4b61df2ac12822a63f2d0290', '0000-00-00 00:00:00', '', '', 'user', ''),
(6, 'amina88', 'aminata.kebe@bulac.fr', '4859cafac5f9f319e521293aa0cf528503737d75', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 0, 'e28b5285ad1ce4f251c6513b51a608a6c7b09c7d', '0000-00-00 00:00:00', '', '', 'user', '');

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE IF NOT EXISTS `videos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `link` varchar(100) DEFAULT NULL,
  `artist` varchar(100) DEFAULT NULL,
  `album` varchar(100) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`id`, `link`, `artist`, `album`, `title`) VALUES
(1, '//www.youtube.com/embed/IcrbM1l_BoI', 'Avicii', 'TRUE', 'Wake Me Up'),
(2, 'http://www.youtube.com/embed/rmc1nuaX0Yw', 'Pape & Cheikh', 'Esprit Live', 'Lonkotina'),
(3, 'http://www.youtube.com/embed/TtUL5DqYj-I', 'Yoro Ndiaye', 'Laamisso', 'Bella'),
(4, '//www.youtube.com/embed/F_rEHfLgdcY', 'Maitre Gims', 'SUBLIMINAL', 'J''me tire'),
(5, 'http://www.youtube.com/embed/_ug8zrlPhfk', 'Youssou Ndour', '', 'Xale Bi');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
