-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: db_server
-- Erstellungszeit: 16. Jun 2026 um 12:45
-- Server-Version: 9.7.0
-- PHP-Version: 8.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `so26`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `Badge`
--

CREATE TABLE `Badge` (
  `badge_id` int NOT NULL,
  `badgename` varchar(30) NOT NULL,
  `badgepath` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Daten für Tabelle `Badge`
--

INSERT INTO `Badge` (`badge_id`, `badgename`, `badgepath`) VALUES
(1, 'VIP', '/assets/images/badges/1.png'),
(2, 'Mixologist', '/assets/images/badges/2.png'),
(3, 'Red Cup', '/assets/images/badges/3.png'),
(4, 'Celebration King', '/assets/images/badges/4.png'),
(5, 'Party Animal', '/assets/images/badges/5.png'),
(6, 'Clubber', '/assets/images/badges/6.png'),
(7, 'Socializer', '/assets/images/badges/7.png'),
(8, 'Energizer', '/assets/images/badges/8.png'),
(9, 'Dancer', '/assets/images/badges/9.png'),
(10, 'Hot Streak', '/assets/images/badges/10.png'),
(11, 'Glow Getter', '/assets/images/badges/11.png'),
(12, 'Life Saver', '/assets/images/badges/12.png'),
(13, 'Flirt', '/assets/images/badges/13.png'),
(14, 'Event Photographer', '/assets/images/badges/14.png'),
(15, 'Road Tripper', '/assets/images/badges/15.png'),
(16, 'Vibe Curator', '/assets/images/badges/16.png'),
(17, 'Legend', '/assets/images/badges/17.png'),
(18, 'Bass Lover', '/assets/images/badges/18.png'),
(19, 'Explorer', '/assets/images/badges/19.png'),
(20, 'Energy Booster', '/assets/images/badges/20.png'),
(21, 'Night Owl', '/assets/images/badges/21.png'),
(22, 'Cool Kid', '/assets/images/badges/22.png'),
(23, 'Chill Vibes', '/assets/images/badges/23.png'),
(24, 'Party King/Queen', '/assets/images/badges/24.png'),
(25, 'Hype Master', '/assets/images/badges/25.png'),
(26, 'Team Player', '/assets/images/badges/26.png'),
(27, 'Hydrated', '/assets/images/badges/27.png'),
(28, 'DJ', '/assets/images/badges/28.png'),
(29, 'Confetti Cannon', '/assets/images/badges/29.png'),
(30, 'Firestarter', '/assets/images/badges/30.png'),
(31, 'Smooth Talker', '/assets/images/badges/31.png'),
(32, 'Connector', '/assets/images/badges/32.png'),
(33, 'Party Starter', '/assets/images/badges/33.png'),
(34, 'All Nighter', '/assets/images/badges/34.png'),
(35, 'Crowd Rocker', '/assets/images/badges/35.png'),
(36, 'Foodie', '/assets/images/badges/36.png'),
(37, 'Music Lover', '/assets/images/badges/37.png'),
(38, 'Event Hunter', '/assets/images/badges/38.png'),
(39, 'Gamer', '/assets/images/badges/39.png'),
(40, 'Balloon Artist', '/assets/images/badges/40.png'),
(41, 'Champagne Lover', '/assets/images/badges/41.png'),
(42, 'Cheers Champion', '/assets/images/badges/42.png'),
(43, 'Risk Taker', '/assets/images/badges/43.png'),
(44, 'Vinyl Junkie', '/assets/images/badges/44.png'),
(45, 'Party Guru', '/assets/images/badges/45.png'),
(46, 'Shot King', '/assets/images/badges/46.png'),
(47, 'Sun Chaser', '/assets/images/badges/47.png'),
(48, 'Good Vibes', '/assets/images/badges/48.png');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `Drink`
--

CREATE TABLE `Drink` (
  `drink_id` int NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `describtion` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Daten für Tabelle `Drink`
--

INSERT INTO `Drink` (`drink_id`, `name`, `describtion`) VALUES
(1, 'Mojito', 'Frischer Cocktail mit Minze, Limette und Rum'),
(2, 'Caipirinha', 'Klassischer Drink mit Cachaça, Limette und Rohrzucker'),
(3, 'Aperol Spritz', 'Spritziger Aperitif mit Aperol, Prosecco und Soda'),
(4, 'Gin Tonic', 'Herber Longdrink mit Gin und Tonic Water'),
(5, 'Moscow Mule', 'Ingwerbetonter Drink mit Wodka und Limette'),
(6, 'Piña Colada', 'Cremiger Cocktail mit Rum, Kokos und Ananas'),
(7, 'Whiskey Sour', 'Saurer Whiskey-Cocktail mit Zitrone'),
(8, 'Espresso Martini', 'Kaffee-Cocktail mit Wodka und Espresso'),
(9, 'Cuba Libre', 'Rum-Cola mit Limette'),
(10, 'Negroni', 'Bitterer Aperitif mit Gin, Campari und Wermut'),
(11, 'Virgin Mojito', 'Alkoholfreie Minz-Limetten-Erfrischung'),
(12, 'Ipanema', 'Alkoholfreier Maracuja-Limetten-Drink'),
(13, 'Hauslimonade', 'Hausgemachte Zitronenlimonade'),
(14, 'Eistee Pfirsich', 'Kalter Tee mit Pfirsichgeschmack'),
(15, 'Cola', 'Klassische Cola'),
(16, 'Mineralwasser', 'Sprudelwasser'),
(17, 'Orangensaft', 'Frisch gepresster Orangensaft'),
(18, 'Apfelschorle', 'Apfelsaft mit Mineralwasser'),
(19, 'Prosecco', 'Prickelnder Schaumwein'),
(20, 'Rotwein', 'Trockener Merlot'),
(21, 'Weißwein', 'Fruchtiger Riesling'),
(22, 'Bier Pils', 'Herbes Pils vom Fass'),
(23, 'Weizenbier', 'Hefeweizen'),
(24, 'Hugo', 'Holunder-Minz-Aperitif'),
(25, 'Sex on the Beach', 'Fruchtiger Cocktail mit Wodka und Pfirsichlikör');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `Drink_Ingredient`
--

CREATE TABLE `Drink_Ingredient` (
  `drink_ingredient_id` int NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `alcoholic` char(1) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Daten für Tabelle `Drink_Ingredient`
--

INSERT INTO `Drink_Ingredient` (`drink_ingredient_id`, `name`, `alcoholic`, `description`) VALUES
(1, 'Limette', 'N', 'Frische Limette'),
(2, 'Minze', 'N', 'Frische Minzblätter'),
(3, 'Weißer Rum', 'Y', 'Rum für Cocktails'),
(4, 'Rohrzucker', 'N', 'Brauner Rohrzucker'),
(5, 'Cachaça', 'Y', 'Brasilianischer Zuckerrohrschnaps'),
(6, 'Aperol', 'Y', 'Bitterlikör'),
(7, 'Prosecco', 'Y', 'Italienischer Schaumwein'),
(8, 'Soda', 'N', 'Mineralwasser mit Kohlensäure'),
(9, 'Gin', 'Y', 'Klarer Wacholderschnaps'),
(10, 'Tonic Water', 'N', 'Bitteres Erfrischungsgetränk'),
(11, 'Wodka', 'Y', 'Neutraler klarer Schnaps'),
(12, 'Ingwerbier', 'N', 'Scharfes Ginger Beer'),
(13, 'Ananassaft', 'N', 'Saft aus Ananas'),
(14, 'Kokoscreme', 'N', 'Cremige Kokosbasis'),
(15, 'Whiskey', 'Y', 'Amerikanischer Bourbon'),
(16, 'Zitronensaft', 'N', 'Frisch gepresster Zitronensaft'),
(17, 'Espresso', 'N', 'Starker Kaffee'),
(18, 'Kaffeelikör', 'Y', 'Likör mit Kaffeegeschmack'),
(19, 'Cola', 'N', 'Kohlensäurehaltiges Cola-Getränk'),
(20, 'Campari', 'Y', 'Bitterer italienischer Aperitif'),
(21, 'Roter Wermut', 'Y', 'Wermut für Aperitifs'),
(22, 'Maracujasaft', 'N', 'Saft aus Passionsfrucht'),
(23, 'Holundersirup', 'N', 'Sirup mit Holunderblüte'),
(24, 'Orangensaft', 'N', 'Saft aus Orangen'),
(25, 'Pfirsichlikör', 'Y', 'Likör mit Pfirsicharoma');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `Drink_Ingredient_Drink`
--

CREATE TABLE `Drink_Ingredient_Drink` (
  `drink_ingredient_id` int NOT NULL,
  `drink_id` int NOT NULL,
  `portion` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Daten für Tabelle `Drink_Ingredient_Drink`
--

INSERT INTO `Drink_Ingredient_Drink` (`drink_ingredient_id`, `drink_id`, `portion`) VALUES
(1, 1, 1),
(2, 1, 8),
(3, 1, 4),
(3, 9, 4),
(4, 2, 2),
(5, 2, 4),
(6, 3, 2),
(7, 3, 6),
(8, 3, 1),
(9, 4, 4),
(9, 10, 3),
(10, 4, 8),
(11, 5, 4),
(12, 5, 8),
(13, 6, 8),
(14, 6, 4),
(15, 7, 4),
(16, 7, 2),
(17, 8, 1),
(18, 8, 2),
(19, 9, 10),
(20, 10, 3),
(21, 10, 3),
(23, 24, 2),
(25, 25, 2);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `Event`
--

CREATE TABLE `Event` (
  `event_id` int NOT NULL,
  `name` varchar(30) NOT NULL,
  `startDate` datetime NOT NULL,
  `endDate` datetime NOT NULL,
  `describtion` varchar(200) DEFAULT NULL,
  `dresscode_desc` varchar(50) DEFAULT NULL,
  `ranking` int DEFAULT NULL,
  `like_count` int DEFAULT NULL,
  `location_id` int DEFAULT NULL,
  `master_userid` int DEFAULT NULL,
  `cover_image` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Daten für Tabelle `Event`
--

INSERT INTO `Event` (`event_id`, `name`, `startDate`, `endDate`, `describtion`, `dresscode_desc`, `ranking`, `like_count`, `location_id`, `master_userid`, `cover_image`) VALUES
(1, 'Frühlings Kickoff', '2026-03-20 19:30:00', '2026-03-21 01:30:00', 'Gemütlicher Start in die Frühlingssaison mit Drinks und Musik. Gemütlicher Start in die Frühlingssaison mit Drinks und Musik. Gemütlicher Start in die Frühlingssaison mit Drinks und Musik', 'Casual Chic', 5, 42, 1, 25, NULL),
(2, 'BBQ Abend', '2026-04-12 18:00:00', '2026-04-13 01:00:00', 'Grillabend mit Freunden im Garten', 'Bequem', 4, 35, 2, 16, NULL),
(3, 'Rooftop Sundowner', '2026-05-08 19:00:00', '2026-05-09 00:00:00', 'Afterwork auf der Dachterrasse mit Aperitifs', 'Sommerlich', 5, 51, 3, 7, NULL),
(4, 'Kellerbar Classics', '2026-01-18 20:30:00', '2026-01-19 04:30:00', 'Oldschool-Party mit Karaoke und Klassikern', 'Locker', 4, 29, 4, 10, NULL),
(5, 'White Night', '2026-06-14 21:00:00', '2026-06-15 05:00:00', 'Sommerparty ganz in Weiß', 'Weiße Kleidung', 5, 67, 5, 3, NULL),
(6, 'WG Spieleabend', '2026-02-06 18:30:00', '2026-02-06 23:30:00', 'Spieleabend mit Snacks und Teamgames', 'Casual', 4, 26, 6, 9, NULL),
(7, 'Sunset Aperitivo', '2026-07-02 20:00:00', '2026-07-03 00:00:00', 'Aperitivo-Abend auf dem Balkon', 'Smart Casual', 5, 39, 7, 12, NULL),
(8, 'Dart & Drinks', '2026-02-20 20:15:00', '2026-02-21 02:15:00', 'Dartturnier mit Longdrinks', 'Locker', 4, 24, 8, 5, NULL),
(9, 'Garden Chillout', '2026-05-28 17:30:00', '2026-05-28 23:30:00', 'Entspannter Abend im Gartenhaus', 'Sommerlich', 4, 33, 9, 15, NULL),
(10, 'Hinterhof Beats', '2026-06-05 19:00:00', '2026-06-06 02:00:00', 'DJ-Set und Streetfood im Hinterhof', 'Urban', 5, 54, 10, 10, NULL),
(11, 'Creative Night', '2026-03-11 18:00:00', '2026-03-12 00:00:00', 'Mottoabend mit Kunst und Musik', 'Farbig', 4, 21, 11, 5, NULL),
(12, 'Scheunenfest', '2026-08-22 18:00:00', '2026-08-23 03:00:00', 'Großes Sommerfest in der Scheune', 'Landhaus Chic', 5, 73, 12, 17, NULL),
(13, 'Wintergarten Dinner', '2026-11-13 19:30:00', '2026-11-14 00:30:00', 'Dinnerparty mit Kerzenlicht', 'Elegant', 5, 31, 13, 21, NULL),
(14, 'Terrassen Lounge', '2026-04-30 20:15:00', '2026-05-01 01:15:00', 'Loungiger Abend mit Cocktails', 'Casual Chic', 4, 28, 14, 4, NULL),
(15, 'Penthouse Party', '2026-09-19 21:00:00', '2026-09-20 05:00:00', 'Stylische Party mit Dresscode und DJ', 'Black & Gold', 5, 80, 15, 5, NULL),
(16, 'Quiz Cup', '2026-03-27 18:45:00', '2026-03-28 00:30:00', 'Großes Kneipenquiz im Vereinsheim', 'Casual', 4, 37, 16, 11, NULL),
(17, 'Rooftop Glow', '2026-07-17 20:30:00', '2026-07-18 03:30:00', 'Abend mit Neon-Deko und Musik', 'Neon', 5, 59, 17, 17, NULL),
(18, 'Atelier Soirée', '2026-10-09 19:30:00', '2026-10-10 00:30:00', 'Kreativer Abend im Atelier', 'Elegant Casual', 4, 25, 18, 25, NULL),
(19, 'Garage Party Reloaded', '2026-05-16 20:00:00', '2026-05-17 03:00:00', 'Legere Party mit Klassiker-Playlist', 'Locker', 4, 34, 19, 23, NULL),
(20, 'Innenhof Brunch', '2026-04-26 11:30:00', '2026-04-26 15:30:00', 'Später Brunch mit Mocktails und Snacks', 'Frühlingslook', 5, 40, 20, 14, NULL),
(21, 'Landhaus Dinner', '2026-10-24 19:00:00', '2026-10-25 01:00:00', 'Herbstliches Dinner mit Weinbegleitung', 'Smart Casual', 5, 43, 21, 1, NULL),
(22, 'Poolside Vibes', '2026-08-07 18:30:00', '2026-08-08 02:30:00', 'Sommerfest am Pool mit Beats', 'Bademode optional', 5, 76, 22, 12, NULL),
(23, 'Wohnheim Mixer', '2026-01-29 19:00:00', '2026-01-29 23:00:00', 'Kennenlernabend im Gemeinschaftsraum', 'Casual', 3, 18, 23, 5, NULL),
(24, 'Seeabend', '2026-07-30 20:00:00', '2026-07-31 02:00:00', 'Abend an der Strandhütte mit Lagerfeuer', 'Sommerlich', 5, 62, 24, 17, NULL),
(25, 'Winter Closing Party', '2026-12-18 21:30:00', '2026-12-19 06:00:00', 'Jahresabschluss mit Musik, Spielen und Cocktails', 'Festlich', 5, 88, 25, 17, NULL),
(26, 'Neujahrs House Party', '2026-01-10 20:00:00', '2026-01-11 03:30:00', 'Gemütliche House Party zum Jahresstart mit Cocktails, Musik und Partyspielen.', 'Casual Chic', 5, 31, 2, 2, NULL),
(27, 'Rolands Haus', '1999-02-20 20:20:00', '2000-02-20 23:00:00', 'dad', 'dwad', 3, 0, 26, 40, NULL),
(45, 'Image', '2026-05-28 11:38:00', '2026-06-04 11:38:00', 'dwadad', 'adwad', 1, 0, 27, 40, '45'),
(47, 'Images', '2026-05-15 12:33:00', '2026-05-29 12:33:00', 'dawd', 'aawd', 5, 0, 26, 40, '46'),
(54, 'This Week', '2026-06-02 09:53:00', '2026-06-03 09:53:00', 'Some Text', 'Casual', 5, 0, 26, 42, '99'),
(55, 'This Month', '2026-06-09 09:58:00', '2026-06-10 09:58:00', 'Some Text', 'Casual', 5, 0, 26, 42, NULL),
(58, 'This Year', '2026-07-24 10:01:00', '2026-07-25 10:01:00', 'Some Text', 'Casual', 5, 0, 26, 42, NULL),
(62, 'Hütte bei Roli', '2026-08-18 18:00:00', '2026-08-18 23:00:00', 'Some text', 'Casual', 5, 0, 26, 44, '103');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `Event_Drink`
--

CREATE TABLE `Event_Drink` (
  `event_id` int NOT NULL,
  `drink_id` int NOT NULL,
  `count` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Daten für Tabelle `Event_Drink`
--

INSERT INTO `Event_Drink` (`event_id`, `drink_id`, `count`) VALUES
(1, 4, 12),
(1, 16, 20),
(1, 24, 18),
(2, 15, 24),
(2, 22, 40),
(2, 23, 35),
(3, 1, 20),
(3, 19, 14),
(3, 24, 16),
(4, 9, 18),
(4, 20, 10),
(4, 22, 30),
(5, 3, 30),
(5, 19, 25),
(5, 21, 18),
(6, 11, 15),
(6, 13, 18),
(6, 15, 20),
(7, 3, 20),
(7, 19, 16),
(7, 24, 18),
(8, 4, 12),
(8, 9, 15),
(8, 22, 24),
(9, 16, 18),
(9, 18, 12),
(9, 24, 14),
(10, 4, 20),
(10, 22, 35),
(10, 25, 18),
(11, 8, 12),
(11, 17, 15),
(11, 20, 10),
(12, 3, 25),
(12, 20, 20),
(12, 23, 45),
(13, 19, 12),
(13, 20, 15),
(13, 21, 18),
(14, 1, 16),
(14, 4, 18),
(14, 24, 14),
(15, 3, 25),
(15, 8, 20),
(15, 10, 15),
(16, 15, 22),
(16, 18, 14),
(16, 22, 24),
(17, 3, 20),
(17, 24, 22),
(17, 25, 16),
(18, 8, 12),
(18, 20, 14),
(18, 21, 10),
(19, 4, 15),
(19, 9, 18),
(19, 22, 28),
(20, 12, 14),
(20, 17, 16),
(20, 18, 18),
(21, 19, 14),
(21, 20, 16),
(21, 21, 18),
(22, 1, 24),
(22, 5, 18),
(22, 24, 20),
(23, 13, 15),
(23, 15, 18),
(23, 22, 20),
(24, 1, 16),
(24, 23, 22),
(24, 24, 18),
(25, 8, 20),
(25, 10, 18),
(25, 22, 30),
(62, 2, 1),
(62, 3, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `Event_Game`
--

CREATE TABLE `Event_Game` (
  `event_id` int NOT NULL,
  `game_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Daten für Tabelle `Event_Game`
--

INSERT INTO `Event_Game` (`event_id`, `game_id`) VALUES
(12, 1),
(62, 1),
(19, 2),
(5, 3),
(14, 4),
(6, 5),
(7, 6),
(23, 7),
(9, 8),
(20, 10),
(4, 11),
(8, 12),
(21, 13),
(10, 14),
(1, 15),
(16, 15),
(15, 16),
(25, 18),
(22, 19),
(3, 20),
(17, 20),
(2, 21),
(11, 22),
(24, 23),
(13, 24),
(18, 25);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `Event_Image`
--

CREATE TABLE `Event_Image` (
  `event_id` int NOT NULL,
  `image_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Daten für Tabelle `Event_Image`
--

INSERT INTO `Event_Image` (`event_id`, `image_id`) VALUES
(47, 47),
(47, 48),
(47, 49),
(47, 50),
(47, 51),
(47, 52),
(47, 53),
(47, 54),
(47, 55),
(54, 100);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `Event_Snack`
--

CREATE TABLE `Event_Snack` (
  `snack_id` int NOT NULL,
  `event_id` int NOT NULL,
  `count` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Daten für Tabelle `Event_Snack`
--

INSERT INTO `Event_Snack` (`snack_id`, `event_id`, `count`) VALUES
(1, 1, 8),
(1, 62, 20),
(2, 15, 13),
(2, 54, 20),
(3, 16, 10),
(4, 8, 8),
(5, 24, 11),
(6, 25, 13),
(7, 10, 14),
(8, 13, 7),
(9, 22, 16),
(10, 9, 9),
(11, 17, 8),
(13, 4, 12),
(14, 18, 9),
(15, 23, 8),
(16, 6, 7),
(17, 3, 6),
(18, 7, 10),
(18, 20, 14),
(19, 14, 11),
(20, 21, 10),
(21, 2, 20),
(22, 12, 22),
(23, 19, 12),
(24, 5, 15),
(25, 11, 18);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `Friend_Request`
--

CREATE TABLE `Friend_Request` (
  `friend_request_id` int NOT NULL,
  `status` varchar(20) NOT NULL,
  `date_of_req` date NOT NULL,
  `userid` int DEFAULT NULL,
  `userid1` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Daten für Tabelle `Friend_Request`
--

INSERT INTO `Friend_Request` (`friend_request_id`, `status`, `date_of_req`, `userid`, `userid1`) VALUES
(1, 'pending', '2026-01-03', 1, 6),
(2, 'accepted', '2026-01-05', 2, 7),
(3, 'declined', '2026-01-07', 3, 8),
(4, 'pending', '2026-01-10', 4, 9),
(5, 'accepted', '2026-01-12', 5, 10),
(6, 'accepted', '2026-01-13', 6, 11),
(7, 'pending', '2026-01-15', 7, 12),
(8, 'declined', '2026-01-18', 8, 13),
(9, 'accepted', '2026-01-20', 9, 14),
(10, 'pending', '2026-01-22', 10, 15),
(11, 'accepted', '2026-01-24', 11, 16),
(12, 'pending', '2026-01-25', 12, 17),
(13, 'accepted', '2026-01-26', 13, 18),
(14, 'declined', '2026-01-27', 14, 19),
(15, 'pending', '2026-01-28', 15, 20),
(16, 'accepted', '2026-01-29', 16, 21),
(17, 'pending', '2026-01-30', 17, 22),
(18, 'accepted', '2026-01-31', 18, 23),
(19, 'pending', '2026-02-01', 19, 24),
(20, 'accepted', '2026-02-02', 20, 25),
(21, 'declined', '2026-02-03', 21, 1),
(22, 'pending', '2026-02-04', 22, 2),
(23, 'accepted', '2026-02-05', 23, 3),
(24, 'pending', '2026-02-06', 24, 4),
(25, 'accepted', '2026-02-07', 25, 5),
(26, 'Pending', '2026-04-27', 1, 2),
(27, 'accepted', '2026-05-04', 33, 34),
(28, 'declined', '2026-05-04', 34, 33),
(29, 'accepted', '2026-05-04', 33, 34),
(30, 'accepted', '2026-05-05', 33, 35),
(31, 'accepted', '2026-05-05', 34, 35),
(32, 'Pending', '2026-05-06', 1, 37),
(33, 'accepted', '2026-05-10', 37, 34),
(34, 'accepted', '2026-05-13', 40, 41),
(35, 'Pending', '2026-06-03', 42, 33),
(36, 'Pending', '2026-06-06', 42, 44),
(37, 'accepted', '2026-06-06', 44, 33);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `Friend_Ship`
--

CREATE TABLE `Friend_Ship` (
  `friend_ship_id` int NOT NULL,
  `created_at` date NOT NULL,
  `userid` int DEFAULT NULL,
  `userid1` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Daten für Tabelle `Friend_Ship`
--

INSERT INTO `Friend_Ship` (`friend_ship_id`, `created_at`, `userid`, `userid1`) VALUES
(1, '2026-01-08', 1, 2),
(2, '2026-01-09', 1, 3),
(3, '2026-01-10', 2, 4),
(4, '2026-01-11', 3, 5),
(5, '2026-01-12', 4, 6),
(6, '2026-01-13', 5, 7),
(7, '2026-01-14', 6, 8),
(8, '2026-01-15', 7, 9),
(9, '2026-01-16', 8, 10),
(10, '2026-01-17', 9, 11),
(11, '2026-01-18', 10, 12),
(12, '2026-01-19', 11, 13),
(13, '2026-01-20', 12, 14),
(14, '2026-01-21', 13, 15),
(15, '2026-01-22', 14, 16),
(16, '2026-01-23', 15, 17),
(17, '2026-01-24', 16, 18),
(18, '2026-01-25', 17, 19),
(19, '2026-01-26', 18, 20),
(20, '2026-01-27', 19, 21),
(21, '2026-01-28', 20, 22),
(22, '2026-01-29', 21, 23),
(23, '2026-01-30', 22, 24),
(24, '2026-01-31', 23, 25),
(25, '2026-02-01', 24, 25),
(26, '2026-05-04', 33, 34),
(27, '2026-05-04', 33, 34),
(28, '2026-05-05', 33, 35),
(29, '2026-05-05', 34, 35),
(30, '2026-05-10', 37, 34),
(31, '2026-05-22', 40, 41),
(32, '2026-06-06', 44, 33);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `Game`
--

CREATE TABLE `Game` (
  `game_id` int NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `max_pl` int DEFAULT NULL,
  `min_pl` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Daten für Tabelle `Game`
--

INSERT INTO `Game` (`game_id`, `name`, `description`, `max_pl`, `min_pl`) VALUES
(1, 'Beer Pong', 'Klassisches Wurfspiel mit Bechern', 8, 2),
(2, 'Flip Cup', 'Schnelles Teamspiel mit Bechern', 12, 4),
(3, 'Kings Cup', 'Kartenspiel für Partygruppen', 10, 4),
(4, 'Wer bin ich?', 'Rate-Spiel mit Post-its', 12, 3),
(5, 'Activity', 'Begriffe zeichnen, erklären oder pantomimisch darstellen', 16, 4),
(6, 'Tabu', 'Begriffe erklären ohne Tabuwörter', 12, 4),
(7, 'Uno', 'Beliebtes Kartenspiel für Gruppen', 10, 2),
(8, 'Jenga', 'Geschicklichkeitsspiel mit Holzklötzen', 6, 2),
(9, 'Looping Louie', 'Reaktionsspiel mit Flugzeug', 4, 2),
(10, 'Stadt Land Fluss', 'Klassisches Schreibspiel', 20, 2),
(11, 'Karaoke Battle', 'Gesangsduell in Teams', 12, 2),
(12, 'Dart', 'Punktespiel mit Pfeilen', 6, 2),
(13, 'Billiard', 'Klassisches Kneipenspiel', 4, 2),
(14, 'Mario Kart Turnier', 'Videospiel-Rennen im Wettkampfmodus', 8, 2),
(15, 'Quiz Night', 'Allgemeinwissensquiz in Teams', 20, 4),
(16, 'Cards Against Humanity', 'Humorvolles Kartenspiel für Erwachsene', 10, 4),
(17, 'Mensch ärgere dich nicht', 'Klassisches Brettspiel', 4, 2),
(18, 'Scharade', 'Begriffe pantomimisch darstellen', 14, 4),
(19, 'Wahrheit oder Pflicht', 'Mutproben und Fragen', 12, 3),
(20, 'Song-Ratequiz', 'Lieder erkennen und zuordnen', 16, 4),
(21, 'Tischkicker', 'Fußballspiel am Kickertisch', 4, 2),
(22, 'Pantomime', 'Begriffe nur mit Gestik darstellen', 12, 4),
(23, 'Escape-Rätselrunde', 'Kooperative Denkaufgaben', 8, 2),
(24, 'Pokerabend', 'Kartenspiel mit Jetons', 8, 4),
(25, 'Montagsmaler', 'Zeichenspiel in Teams', 12, 4);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `Image`
--

CREATE TABLE `Image` (
  `images_id` int NOT NULL,
  `path` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Daten für Tabelle `Image`
--

INSERT INTO `Image` (`images_id`, `path`) VALUES
(34, '../../api/uploads/demo-user.png'),
(35, '../../api/uploads/shot-badge.png'),
(36, '../../api/uploads/music-badge.png'),
(37, '../../api/uploads/demo-user.png'),
(38, '../../api/uploads/demo-user.png'),
(39, '../../api/uploads/demo-user.png'),
(40, '../../api/uploads/johnGoon.jpeg'),
(41, '../../api/uploads/1.png'),
(42, '../../api/uploads/1.png'),
(43, '../../api/uploads/14.png'),
(44, '../api/uploads/demo-party.jpg'),
(45, '../api/uploads/demo-party.jpg'),
(46, '../api/uploads/demo-party.jpg'),
(47, '../api/uploads/1.png'),
(48, '../api/uploads/2.png'),
(49, '../api/uploads/3.png'),
(50, '../api/uploads/4.png'),
(51, '../api/uploads/5.png'),
(52, '../api/uploads/6.png'),
(53, '../api/uploads/7.png'),
(54, '../api/uploads/8.png'),
(55, '../api/uploads/9.png'),
(56, '../api/uploads/1.png'),
(57, '../api/uploads/2.png'),
(58, '../api/uploads/3.png'),
(59, '../api/uploads/4.png'),
(60, '../api/uploads/5.png'),
(61, '../api/uploads/6.png'),
(62, '../api/uploads/7.png'),
(63, '../api/uploads/8.png'),
(64, '../api/uploads/9.png'),
(65, '../api/uploads/photo1.jpg'),
(66, '../api/uploads/photo1.jpg'),
(67, '../api/uploads/photo2.jpg'),
(68, '../api/uploads/photo3.jpg'),
(69, '../api/uploads/photo4.jpg'),
(70, '../api/uploads/photo5.jpg'),
(71, '../api/uploads/1.png'),
(72, '../api/uploads/2.png'),
(73, '../api/uploads/3.png'),
(74, '../api/uploads/4.png'),
(75, '../api/uploads/5.png'),
(76, '../api/uploads/6.png'),
(77, '../api/uploads/7.png'),
(78, '../api/uploads/8.png'),
(79, '../api/uploads/9.png'),
(80, '../api/uploads/demo-party.jpg'),
(81, '../api/uploads/demo-party.jpg'),
(82, '../api/uploads/demo-party.jpg'),
(83, '../api/uploads/demo-party.jpg'),
(84, '../api/uploads/demo-party.jpg'),
(85, '../api/uploads/snippet.png'),
(86, '../api/uploads/demo-party.jpg'),
(87, '../api/uploads/demo-party.jpg'),
(88, '../api/uploads/1.png'),
(89, '../api/uploads/2.png'),
(90, '../api/uploads/3.png'),
(91, '../api/uploads/4.png'),
(92, '../api/uploads/5.png'),
(93, '../api/uploads/6.png'),
(94, '../api/uploads/7.png'),
(95, '../api/uploads/8.png'),
(96, '../api/uploads/9.png'),
(97, '../api/uploads/demo-party.jpg'),
(98, '../../api/uploads/IMG_6122.jpeg'),
(99, '../api/uploads/IMG_6144.jpeg'),
(100, '../api/uploads/IMG_6139.jpeg'),
(101, '../../api/uploads/demo-user.png'),
(102, '../../api/uploads/demo-user.png'),
(103, '../api/uploads/Maelmin_-_reconstruction_of_Mesolithic_hut_-_geograph.org.uk_-_420786.jpg');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `Location`
--

CREATE TABLE `Location` (
  `location_id` int NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Daten für Tabelle `Location`
--

INSERT INTO `Location` (`location_id`, `name`, `description`) VALUES
(1, 'Anna Wohnung', 'Große Altbauwohnung in der Innenstadt, Sonnenstraße 14, 80331 München'),
(2, 'Ben Garten', 'Garten mit Grillplatz und Feuerstelle, Lindenweg 22, 50667 Köln'),
(3, 'Clara Dachterrasse', 'Dachterrasse mit Blick über die Stadt, Friedrichstraße 88, 10117 Berlin'),
(4, 'David Kellerbar', 'Gemütliche Kellerbar mit Musikanlage, Bergstraße 6, 60311 Frankfurt'),
(5, 'Emma Loft', 'Modernes Loft für private Feiern, Hafenstraße 31, 20457 Hamburg'),
(6, 'Felix WG', 'Studentische WG mit großem Wohnzimmer, Uniweg 9, 48149 Münster'),
(7, 'Greta Balkon', 'Großer Balkon für Sommerabende, Rosenweg 18, 70173 Stuttgart'),
(8, 'Hannes Partykeller', 'Partykeller mit Dartscheibe, Hauptstraße 42, 40213 Düsseldorf'),
(9, 'Ida Gartenhaus', 'Rustikales Gartenhaus am Stadtrand, Waldweg 7, 01067 Dresden'),
(10, 'Jonas Hinterhof', 'Hinterhof mit Sitzgelegenheiten und Lichterkette, Marktgasse 15, 04109 Leipzig'),
(11, 'Klara Studio', 'Kleines Eventstudio für kreative Abende, Atelierstraße 5, 90402 Nürnberg'),
(12, 'Lukas Scheune', 'Ausgebaute Scheune für größere Gruppen, Dorfstraße 33, 79098 Freiburg'),
(13, 'Mia Wintergarten', 'Heller Wintergarten mit Barwagen, Blumenweg 12, 55116 Mainz'),
(14, 'Noah Terrasse', 'Überdachte Terrasse mit Lounge-Möbeln, Seeufer 4, 24103 Kiel'),
(15, 'Olivia Penthouse', 'Penthouse mit offener Küche, Panoramaweg 77, 20095 Hamburg'),
(16, 'Paul Vereinsheim', 'Vereinsheim mit großem Saal, Sportallee 10, 44135 Dortmund'),
(17, 'Quirin Rooftop', 'Rooftop-Location mit Musikbox, Skyline Avenue 21, 60313 Frankfurt'),
(18, 'Rosa Atelier', 'Künstleratelier für Mottoabende, Kreativhof 3, 28195 Bremen'),
(19, 'Simon Garage', 'Ausgebaute Garage mit Stehtischen, Werkstraße 19, 30159 Hannover'),
(20, 'Tina Innenhof', 'Geschützter Innenhof mit Pavillon, Hofgasse 8, 93047 Regensburg'),
(21, 'Uwe Landhaus', 'Landhaus mit großem Esstisch, Eichenweg 44, 86150 Augsburg'),
(22, 'Valentina Poolhaus', 'Poolhaus für Sommerfeste, Seestraße 28, 78462 Konstanz'),
(23, 'Yara Gemeinschaftsraum', 'Moderner Gemeinschaftsraum im Wohnheim, Campusallee 11, 35037 Marburg'),
(24, 'Zoe Strandhütte', 'Gemietete Strandhütte am See, Uferpromenade 2, 23552 Lübeck'),
(25, 'Max Eventraum', 'Privater Eventraum mit Lichttechnik, Eventpark 55, 45127 Essen'),
(26, 'Rolands Hütte', 'Roland seine coole Hütte'),
(27, 'Lucas Haus', ''),
(28, 'Lucas Dh', 'Lucas Dh ist super');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `Snack`
--

CREATE TABLE `Snack` (
  `snack_id` int NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Daten für Tabelle `Snack`
--

INSERT INTO `Snack` (`snack_id`, `name`, `description`) VALUES
(1, 'Nachos', 'Maischips mit Dip'),
(2, 'Salzstangen', 'Klassische Salzstangen'),
(3, 'Chips Paprika', 'Kartoffelchips mit Paprikageschmack'),
(4, 'Erdnüsse', 'Geröstete und gesalzene Erdnüsse'),
(5, 'Popcorn süß', 'Süßes Popcorn für Filmabende'),
(6, 'Popcorn salzig', 'Salziges Popcorn'),
(7, 'Mini-Pizzen', 'Kleine Pizzastücke zum Teilen'),
(8, 'Käsewürfel', 'Milder Gouda in Würfeln'),
(9, 'Trauben', 'Frische grüne und rote Trauben'),
(10, 'Gemüsesticks', 'Karotten, Gurken und Paprika'),
(11, 'Hummus', 'Kichererbsendip'),
(12, 'Guacamole', 'Avocado-Dip mit Limette'),
(13, 'Brownies', 'Saftige Schokoladenbrownies'),
(14, 'Muffins', 'Mini-Muffins mit Schokostückchen'),
(15, 'Gummibärchen', 'Fruchtgummi-Mix'),
(16, 'Cracker', 'Knusprige Weizencracker'),
(17, 'Oliven', 'Grüne und schwarze Oliven'),
(18, 'Fruchtspieße', 'Spieße mit frischem Obst'),
(19, 'Pizzaschnecken', 'Blätterteigschnecken mit Käse'),
(20, 'Flammkuchen-Stücke', 'Kleine Stücke vom Flammkuchen'),
(21, 'Mini-Burger', 'Kleine Burger für Partys'),
(22, 'Chicken Wings', 'Würzige Hähnchenflügel'),
(23, 'Mozzarella-Sticks', 'Panierte Käse-Sticks'),
(24, 'Donuts', 'Bunte Mini-Donuts'),
(25, 'Macarons', 'Französisches Mandelgebäck');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `User`
--

CREATE TABLE `User` (
  `userid` int NOT NULL,
  `username` varchar(30) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `dob` date NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `created_at` date NOT NULL,
  `profile_image_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Daten für Tabelle `User`
--

INSERT INTO `User` (`userid`, `username`, `firstname`, `lastname`, `dob`, `email`, `password`, `created_at`, `profile_image_id`) VALUES
(1, 'amüller', 'Anna', 'Müller', '1998-03-14', 'anna.mueller@example.com', 'hash_anna_2026', '2025-01-10', NULL),
(2, 'bschneider', 'Ben', 'Schneider', '1995-07-22', 'ben.schneider@example.com', 'hash_ben_2026', '2025-01-11', NULL),
(3, 'cfischer', 'Clara', 'Fischer', '2000-11-05', 'clara.fischer@example.com', 'hash_clara_2026', '2025-01-12', NULL),
(4, 'dweber', 'David', 'Weber', '1997-02-18', 'david.weber@example.com', 'hash_david_2026', '2025-01-13', NULL),
(5, 'ewagner', 'Emma', 'Wagner', '1999-09-30', 'emma.wagner@example.com', 'hash_emma_2026', '2025-01-14', NULL),
(6, 'fbecker', 'Felix', 'Becker', '1996-04-12', 'felix.becker@example.com', 'hash_felix_2026', '2025-01-15', NULL),
(7, 'ghoffmann', 'Greta', 'Hoffmann', '2001-06-25', 'greta.hoffmann@example.com', 'hash_greta_2026', '2025-01-16', NULL),
(8, 'hschulz', 'Hannes', 'Schulz', '1994-12-09', 'hannes.schulz@example.com', 'hash_hannes_2026', '2025-01-17', NULL),
(9, 'iklein', 'Ida', 'Klein', '1998-08-17', 'ida.klein@example.com', 'hash_ida_2026', '2025-01-18', NULL),
(10, 'jneumann', 'Jonas', 'Neumann', '1997-05-03', 'jonas.neumann@example.com', 'hash_jonas_2026', '2025-01-19', NULL),
(11, 'kwolf', 'Klara', 'Wolf', '2002-01-19', 'klara.wolf@example.com', 'hash_klara_2026', '2025-01-20', NULL),
(12, 'lschröder', 'Lukas', 'Schröder', '1995-10-27', 'lukas.schroeder@example.com', 'hash_lukas_2026', '2025-01-21', NULL),
(13, 'mbraun', 'Mia', 'Braun', '1999-02-11', 'mia.braun@example.com', 'hash_mia_2026', '2025-01-22', NULL),
(14, 'nhartmann', 'Noah', 'Hartmann', '1996-06-07', 'noah.hartmann@example.com', 'hash_noah_2026', '2025-01-23', NULL),
(15, 'okrüger', 'Olivia', 'Krüger', '2000-03-29', 'olivia.krueger@example.com', 'hash_olivia_2026', '2025-01-24', NULL),
(16, 'plehmann', 'Paul', 'Lehmann', '1998-11-14', 'paul.lehmann@example.com', 'hash_paul_2026', '2025-01-25', NULL),
(17, 'qschmitt', 'Quirin', 'Schmitt', '1997-01-08', 'quirin.schmitt@example.com', 'hash_quirin_2026', '2025-01-26', NULL),
(18, 'rkaiser', 'Rosa', 'Kaiser', '2001-07-16', 'rosa.kaiser@example.com', 'hash_rosa_2026', '2025-01-27', NULL),
(19, 'skönig', 'Simon', 'König', '1994-09-04', 'simon.koenig@example.com', 'hash_simon_2026', '2025-01-28', NULL),
(20, 'tvogel', 'Tina', 'Vogel', '1999-12-21', 'tina.vogel@example.com', 'hash_tina_2026', '2025-01-29', NULL),
(21, 'umaier', 'Uwe', 'Maier', '1993-05-26', 'uwe.maier@example.com', 'hash_uwe_2026', '2025-01-30', NULL),
(22, 'vfrank', 'Valentina', 'Frank', '2002-04-02', 'valentina.frank@example.com', 'hash_valentina_2026', '2025-01-31', NULL),
(23, 'yalbrecht', 'Yara', 'Albrecht', '2000-08-28', 'yara.albrecht@example.com', 'hash_yara_2026', '2025-02-01', NULL),
(24, 'zpeters', 'Zoe', 'Peters', '1998-10-10', 'zoe.peters@example.com', 'hash_zoe_2026', '2025-02-02', NULL),
(25, 'mrichter', 'Max', 'Richter', '1996-01-31', 'max.richter@example.com', 'hash_max_2026', '2025-02-03', NULL),
(33, 'Julian Warlisch', 'Julian', 'Warlischek', '2009-09-20', 'warlischek@gmail.com', '$2y$10$niVz4iyLyHlMoRq5pfIJqOgvTZxN6SRCMOVk3faj70cmoauOUYZ4q', '2026-04-30', 43),
(34, 'Julian', 'Juls', 'Warlischek', '2026-05-04', 'warlischekjuli@gmail.com', '$2y$10$EDH6fYYxzhig0An3X3Wz0ORPHPCSJx8WKaA43wiaAFbc9fSKScQ3a', '2026-05-04', 35),
(35, 'Luca Ebner', 'Luca', 'Ebner', '2009-08-18', 'luca@gmail.com', '$2y$10$xvb/rpVTts1XIcLdbg1TD.i82xzhtqHvF78kvbld.hC4y2nDTrArK', '2026-05-05', 37),
(36, 'Clemens', 'Clemens', 'Altrichter', '2000-02-20', 'altrichter@gmail.com', '$2y$10$/E4EgeWHt.4lEGtOnrBD3O9nHzI.MjwePKCoIBUilI9tK49RYg7rS', '2026-05-06', NULL),
(37, 'Roland', 'Roland ', 'Bauer', '2000-02-20', 'roland@gmail.com', '$2y$10$3d9y1n/iwoH/2/Tbo.9ntO3MBICOcdJQKVw7u.L8Lke8VANkLSGt.', '2026-05-06', 36),
(39, 'Tobias P', 'Tobias', 'Payreder', '2000-02-20', 'tobias@gmail.com', '$2y$10$BR/.ovbTpdUQmhtRNWPCP.0w3OWq7GmQe8zTu8hErIkJD57dqwsl.', '2026-05-11', 38),
(40, 'Admin', 'Admin', 'Admin', '2000-01-01', 'julian@gmail.com', '$2y$10$0EHGxIOl9IDsOmzqHJYkCOAMhljo5OAtt8zgyzy208tVrsi8yXRga', '2026-05-11', 41),
(41, 'Admin2', 'Admin', 'Admin', '2000-01-01', 'admin@gmail.com', '$2y$10$xZENRHQA6cQG2eCNhyPh2.lESpg9piS2o4G60sQwSeHE0DGKMoFn6', '2026-05-13', 42),
(42, 'MiaWat', 'Mia', 'Watzinger', '2009-09-28', 'mia@gmail.com', '$2y$10$h6yLM30qbU2iDdSnAIY.zO9JYAmxFYbtp9CVS6gjKFuV5AWqJ8q0q', '2026-06-02', 98),
(43, 'Mia', 'Ma', 'Wat', '2009-08-18', 'wat@gmail.com', '$2y$10$YpJv5uBQe72.Bod.Iwp2eOuBjXtkkUw4zXpLqYHbw.1CyInu.kYsO', '2026-06-06', 101),
(44, 'JulianX', 'Julian', 'Warlischek', '2009-08-18', 'warl@gmail.com', '$2y$10$F/Z2orHPySf7i/yT2pNmwOVkroVNVvC7znflSjGI0/ztT0TXgctlS', '2026-06-06', 102);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `User_Badge`
--

CREATE TABLE `User_Badge` (
  `userid` int NOT NULL,
  `badge_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Daten für Tabelle `User_Badge`
--

INSERT INTO `User_Badge` (`userid`, `badge_id`) VALUES
(10, 1),
(18, 1),
(25, 1),
(33, 1),
(34, 1),
(37, 1),
(40, 1),
(41, 1),
(2, 2),
(12, 2),
(20, 2),
(33, 2),
(34, 2),
(35, 2),
(39, 2),
(41, 2),
(4, 3),
(15, 3),
(23, 3),
(33, 3),
(34, 3),
(35, 3),
(3, 4),
(13, 4),
(22, 4),
(42, 4),
(1, 5),
(10, 5),
(17, 5),
(25, 5),
(35, 5),
(42, 5),
(2, 6),
(11, 6),
(19, 6),
(34, 6),
(35, 6),
(42, 6),
(5, 7),
(14, 7),
(24, 7),
(34, 7),
(42, 7),
(6, 8),
(16, 8),
(35, 8),
(1, 9),
(12, 9),
(21, 9),
(4, 10),
(13, 10),
(22, 10),
(5, 11),
(15, 11),
(23, 11),
(35, 11),
(6, 12),
(18, 12),
(3, 13),
(14, 13),
(4, 14),
(12, 14),
(20, 14),
(7, 15),
(17, 15),
(8, 16),
(16, 16),
(24, 16),
(1, 17),
(10, 17),
(21, 17),
(25, 17),
(2, 18),
(11, 18),
(19, 18),
(5, 19),
(13, 19),
(6, 20),
(15, 20),
(7, 21),
(18, 21),
(8, 22),
(16, 22),
(9, 23),
(19, 23),
(3, 24),
(14, 24),
(24, 24),
(2, 25),
(11, 25),
(22, 25),
(7, 26),
(20, 26),
(9, 27),
(23, 27),
(4, 28),
(17, 28),
(8, 29),
(21, 29),
(1, 30),
(10, 30),
(19, 30),
(6, 31),
(15, 31),
(9, 32),
(22, 32),
(5, 33),
(16, 33),
(10, 34),
(18, 34),
(25, 34),
(3, 35),
(13, 35),
(21, 35),
(12, 36),
(23, 36),
(7, 37),
(20, 37),
(14, 38),
(8, 39),
(17, 39),
(9, 40),
(24, 40),
(8, 41),
(17, 41),
(2, 42),
(11, 42),
(20, 42),
(6, 43),
(15, 43),
(24, 43),
(4, 44),
(13, 44),
(22, 44),
(5, 45),
(12, 45),
(18, 45),
(25, 45),
(7, 46),
(16, 46),
(23, 46),
(3, 47),
(11, 47),
(19, 47),
(1, 48),
(9, 48),
(14, 48),
(21, 48);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `User_Event`
--

CREATE TABLE `User_Event` (
  `userid` int NOT NULL,
  `event_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Daten für Tabelle `User_Event`
--

INSERT INTO `User_Event` (`userid`, `event_id`) VALUES
(2, 1),
(3, 1),
(33, 1),
(1, 2),
(2, 2),
(3, 2),
(1, 3),
(2, 3),
(3, 3),
(1, 4),
(2, 4),
(3, 4),
(1, 5),
(2, 5),
(3, 5),
(1, 6),
(2, 6),
(3, 6),
(1, 7),
(2, 7),
(3, 7),
(1, 8),
(2, 8),
(3, 8),
(1, 9),
(2, 9),
(3, 9),
(1, 10),
(2, 10),
(3, 10),
(1, 11),
(2, 11),
(3, 11),
(1, 12),
(2, 12),
(3, 12),
(1, 13),
(2, 13),
(3, 13),
(1, 14),
(2, 14),
(3, 14),
(1, 15),
(2, 15),
(3, 15),
(1, 16),
(2, 16),
(3, 16),
(1, 17),
(2, 17),
(3, 17),
(1, 18),
(2, 18),
(3, 18),
(1, 19),
(2, 19),
(3, 19),
(1, 20),
(2, 20),
(3, 20),
(1, 21),
(2, 21),
(3, 21),
(1, 22),
(2, 22),
(3, 22),
(1, 23),
(2, 23),
(3, 23),
(1, 24),
(2, 24),
(3, 24),
(1, 25),
(2, 25),
(3, 25),
(41, 47),
(42, 54),
(33, 62);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `Badge`
--
ALTER TABLE `Badge`
  ADD PRIMARY KEY (`badge_id`);

--
-- Indizes für die Tabelle `Drink`
--
ALTER TABLE `Drink`
  ADD PRIMARY KEY (`drink_id`);

--
-- Indizes für die Tabelle `Drink_Ingredient`
--
ALTER TABLE `Drink_Ingredient`
  ADD PRIMARY KEY (`drink_ingredient_id`);

--
-- Indizes für die Tabelle `Drink_Ingredient_Drink`
--
ALTER TABLE `Drink_Ingredient_Drink`
  ADD PRIMARY KEY (`drink_ingredient_id`,`drink_id`),
  ADD KEY `drink_id` (`drink_id`);

--
-- Indizes für die Tabelle `Event`
--
ALTER TABLE `Event`
  ADD PRIMARY KEY (`event_id`),
  ADD KEY `location_id` (`location_id`),
  ADD KEY `fk_event_master_user` (`master_userid`);

--
-- Indizes für die Tabelle `Event_Drink`
--
ALTER TABLE `Event_Drink`
  ADD PRIMARY KEY (`event_id`,`drink_id`),
  ADD KEY `drink_id` (`drink_id`);

--
-- Indizes für die Tabelle `Event_Game`
--
ALTER TABLE `Event_Game`
  ADD PRIMARY KEY (`event_id`,`game_id`),
  ADD KEY `game_id` (`game_id`);

--
-- Indizes für die Tabelle `Event_Image`
--
ALTER TABLE `Event_Image`
  ADD PRIMARY KEY (`event_id`,`image_id`),
  ADD KEY `images_id` (`image_id`);

--
-- Indizes für die Tabelle `Event_Snack`
--
ALTER TABLE `Event_Snack`
  ADD PRIMARY KEY (`snack_id`,`event_id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indizes für die Tabelle `Friend_Request`
--
ALTER TABLE `Friend_Request`
  ADD PRIMARY KEY (`friend_request_id`),
  ADD KEY `userid` (`userid`),
  ADD KEY `userid1` (`userid1`);

--
-- Indizes für die Tabelle `Friend_Ship`
--
ALTER TABLE `Friend_Ship`
  ADD PRIMARY KEY (`friend_ship_id`),
  ADD KEY `userid` (`userid`),
  ADD KEY `userid1` (`userid1`);

--
-- Indizes für die Tabelle `Game`
--
ALTER TABLE `Game`
  ADD PRIMARY KEY (`game_id`);

--
-- Indizes für die Tabelle `Image`
--
ALTER TABLE `Image`
  ADD PRIMARY KEY (`images_id`);

--
-- Indizes für die Tabelle `Location`
--
ALTER TABLE `Location`
  ADD PRIMARY KEY (`location_id`);

--
-- Indizes für die Tabelle `Snack`
--
ALTER TABLE `Snack`
  ADD PRIMARY KEY (`snack_id`);

--
-- Indizes für die Tabelle `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`userid`),
  ADD KEY `fk_user_profile_image` (`profile_image_id`);

--
-- Indizes für die Tabelle `User_Badge`
--
ALTER TABLE `User_Badge`
  ADD PRIMARY KEY (`userid`,`badge_id`),
  ADD KEY `badge_id` (`badge_id`);

--
-- Indizes für die Tabelle `User_Event`
--
ALTER TABLE `User_Event`
  ADD PRIMARY KEY (`userid`,`event_id`),
  ADD KEY `event_id` (`event_id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `Badge`
--
ALTER TABLE `Badge`
  MODIFY `badge_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT für Tabelle `Drink`
--
ALTER TABLE `Drink`
  MODIFY `drink_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT für Tabelle `Drink_Ingredient`
--
ALTER TABLE `Drink_Ingredient`
  MODIFY `drink_ingredient_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT für Tabelle `Event`
--
ALTER TABLE `Event`
  MODIFY `event_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT für Tabelle `Friend_Request`
--
ALTER TABLE `Friend_Request`
  MODIFY `friend_request_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT für Tabelle `Friend_Ship`
--
ALTER TABLE `Friend_Ship`
  MODIFY `friend_ship_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT für Tabelle `Game`
--
ALTER TABLE `Game`
  MODIFY `game_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT für Tabelle `Image`
--
ALTER TABLE `Image`
  MODIFY `images_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT für Tabelle `Location`
--
ALTER TABLE `Location`
  MODIFY `location_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT für Tabelle `Snack`
--
ALTER TABLE `Snack`
  MODIFY `snack_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT für Tabelle `User`
--
ALTER TABLE `User`
  MODIFY `userid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `Drink_Ingredient_Drink`
--
ALTER TABLE `Drink_Ingredient_Drink`
  ADD CONSTRAINT `Drink_Ingredient_Drink_ibfk_1` FOREIGN KEY (`drink_ingredient_id`) REFERENCES `Drink_Ingredient` (`drink_ingredient_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `Drink_Ingredient_Drink_ibfk_2` FOREIGN KEY (`drink_id`) REFERENCES `Drink` (`drink_id`) ON DELETE CASCADE;

--
-- Constraints der Tabelle `Event`
--
ALTER TABLE `Event`
  ADD CONSTRAINT `Event_ibfk_1` FOREIGN KEY (`location_id`) REFERENCES `Location` (`location_id`),
  ADD CONSTRAINT `fk_event_master_user` FOREIGN KEY (`master_userid`) REFERENCES `User` (`userid`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints der Tabelle `Event_Drink`
--
ALTER TABLE `Event_Drink`
  ADD CONSTRAINT `Event_Drink_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `Event` (`event_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `Event_Drink_ibfk_2` FOREIGN KEY (`drink_id`) REFERENCES `Drink` (`drink_id`) ON DELETE CASCADE;

--
-- Constraints der Tabelle `Event_Game`
--
ALTER TABLE `Event_Game`
  ADD CONSTRAINT `Event_Game_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `Event` (`event_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `Event_Game_ibfk_2` FOREIGN KEY (`game_id`) REFERENCES `Game` (`game_id`) ON DELETE CASCADE;

--
-- Constraints der Tabelle `Event_Image`
--
ALTER TABLE `Event_Image`
  ADD CONSTRAINT `Event_Image_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `Event` (`event_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `Event_Image_ibfk_2` FOREIGN KEY (`image_id`) REFERENCES `Image` (`images_id`) ON DELETE CASCADE;

--
-- Constraints der Tabelle `Event_Snack`
--
ALTER TABLE `Event_Snack`
  ADD CONSTRAINT `Event_Snack_ibfk_1` FOREIGN KEY (`snack_id`) REFERENCES `Snack` (`snack_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `Event_Snack_ibfk_2` FOREIGN KEY (`event_id`) REFERENCES `Event` (`event_id`) ON DELETE CASCADE;

--
-- Constraints der Tabelle `Friend_Request`
--
ALTER TABLE `Friend_Request`
  ADD CONSTRAINT `Friend_Request_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `User` (`userid`),
  ADD CONSTRAINT `Friend_Request_ibfk_2` FOREIGN KEY (`userid1`) REFERENCES `User` (`userid`);

--
-- Constraints der Tabelle `Friend_Ship`
--
ALTER TABLE `Friend_Ship`
  ADD CONSTRAINT `Friend_Ship_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `User` (`userid`),
  ADD CONSTRAINT `Friend_Ship_ibfk_2` FOREIGN KEY (`userid1`) REFERENCES `User` (`userid`);

--
-- Constraints der Tabelle `User`
--
ALTER TABLE `User`
  ADD CONSTRAINT `fk_user_profile_image` FOREIGN KEY (`profile_image_id`) REFERENCES `Image` (`images_id`);

--
-- Constraints der Tabelle `User_Badge`
--
ALTER TABLE `User_Badge`
  ADD CONSTRAINT `User_Badge_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `User` (`userid`) ON DELETE CASCADE,
  ADD CONSTRAINT `User_Badge_ibfk_2` FOREIGN KEY (`badge_id`) REFERENCES `Badge` (`badge_id`) ON DELETE CASCADE;

--
-- Constraints der Tabelle `User_Event`
--
ALTER TABLE `User_Event`
  ADD CONSTRAINT `User_Event_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `User` (`userid`) ON DELETE CASCADE,
  ADD CONSTRAINT `User_Event_ibfk_2` FOREIGN KEY (`event_id`) REFERENCES `Event` (`event_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
