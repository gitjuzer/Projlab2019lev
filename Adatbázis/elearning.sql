-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1:3306
-- Létrehozás ideje: 2019. Ápr 30. 17:44
-- Kiszolgáló verziója: 5.7.24
-- PHP verzió: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `elearning`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `course`
--

DROP TABLE IF EXISTS `course`;
CREATE TABLE IF NOT EXISTS `course` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `CategoryID` int(11) NOT NULL,
  `CreatorID` int(11) NOT NULL,
  `Name` varchar(200) NOT NULL,
  `Content` varchar(20000) NOT NULL,
  `ClassID` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `course`
--

INSERT INTO `course` (`ID`, `CategoryID`, `CreatorID`, `Name`, `Content`, `ClassID`) VALUES
(1, 1, 4, 'ElsÅ‘ kurzus!', 'Az elsÅ‘ <b>kurzus</b> nagyon <b>hos</b>szÃº tartalma. \r\n\r\nA Loveâ˜…Com teljes nevÃ©n Lovely Complex sÃ³dzso mangasorozat, amelyet Nakahara Aja rajzolt. A mangÃ¡bÃ³l kÃ©szÃ¼lt egy 24 rÃ©szes animesorozat is, a Toei Animation gondozÃ¡sÃ¡ban, Ã©s egy Ã©lÅ‘szereplÅ‘s film 2006-ban. A manga a Shueisha Besszacu Margaret nevÅ± antolÃ³giÃ¡jÃ¡ban futott 2001-2006-ig.\r\n\r\n<hr>\r\n\r\nKoizumi Risa egy gimnazista lÃ¡ny, aki a maga 172 centijÃ©vel kitÅ±nik az Ã¡tlagos magassÃ¡gÃº lÃ¡nyok kÃ¶zÃ¼l. Ha ez nem lenne elÃ©g, a kettes osztÃ¡lyba jÃ¡r egy srÃ¡c, Atsushi Otani, aki szintÃ©n effÃ©le problÃ©mÃ¡kkal kÃ¼szkÃ¶dik, csak pont az ellenkezÅ‘jÃ©vel. Å a maga 156 centijÃ©vel jÃ³val alacsonyabb, mint az Ã¡tlagos japÃ¡n srÃ¡cok. Emiatt mindkettejÃ¼knek van egyfajta komplexusa, ami a magassÃ¡gukhoz kÃ¶thetÅ‘. Az iskola kezdete utÃ¡n elÃ©g jÃ³ barÃ¡tokkÃ¡ vÃ¡lnak, de folyton veszekednek, ami Ã¡ltalÃ¡ban oda fajul, hogy mindenki rajtuk rÃ¶hÃ¶g. EbbÅ‘l a viselkedÃ©sbÅ‘l kifolyÃ³lag ragasztja rÃ¡juk az osztÃ¡lyfÅ‘nÃ¶kÃ¼k az \"All-Hashin Kyoujin\" nevet (magyar fordÃ­tÃ¡sban Defekt DuÃ³), egy nÃ©pszerÅ± komikus duÃ³ utÃ¡n, akik kÃ¶zÃ¶tt szintÃ©n nagy volt a magassÃ¡gkÃ¼lÃ¶nbsÃ©g.\r\n\r\n<hr>\r\n\r\nA kÃ©t fiatalnak azonban nincs szerencsÃ©je a szerelemben. Egy balul elsÃ¼lt szerelmi prÃ³bÃ¡lkozÃ¡s utÃ¡n - aminek oka persze a magassÃ¡g - elhatÃ¡rozzÃ¡k, hogy akkor sem adjÃ¡k fel. SzerelmÃ¼k tÃ¡rgya, Suzuki-kun Ã©s Chiharu Ã¶sszejÃ¶nnek ugyan, de Å‘k mindent beleadnak. Otani Ã©s Risa egyre tÃ¶bb idÅ‘t tÃ¶lt egyÃ¼tt, ami nagyrÃ©szt annak is kÃ¶szÃ¶nhetÅ‘, hogy a szemÃ©lyisÃ©gÃ¼k Ã©s Ã©rdeklÅ‘dÃ©si kÃ¶rÃ¼k nagyon hasonlÃ­t. MÃ©g zene tÃ©ren is, hiszen mindketten odÃ¡ig vannak a japÃ¡n rap mÅ±fajban tevÃ©kenykedÅ‘ UmibouzuÃ©rt.', 2),
(2, 3, 4, 'MÃ¡sodik tanulnivalÃ³', 'Fontos szÃ¶veg, amit meg kell tanulni. Nagyon sok okos Ã©s kedves dolog, a tanulÃ³ Ã©rdeklÅ‘dve olvassa az itt lÃ¡thatÃ³ tananyagot.', 2),
(3, 2, 6, 'Kurzus tanÃ¡r hozta lÃ©tre', 'Matek Ã­gy, matek Ãºgy, szÃ¡mok Ã­gy, szÃ¡mok Ãºgy. :D', 0);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `course_category`
--

DROP TABLE IF EXISTS `course_category`;
CREATE TABLE IF NOT EXISTS `course_category` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(200) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `course_category`
--

INSERT INTO `course_category` (`ID`, `Name`) VALUES
(1, '(alapÃ©rtelmezett)'),
(2, 'Matematika'),
(3, 'Informatika');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `course_read`
--

DROP TABLE IF EXISTS `course_read`;
CREATE TABLE IF NOT EXISTS `course_read` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `CourseID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `Last` int(11) NOT NULL,
  `Max` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `course_read`
--

INSERT INTO `course_read` (`ID`, `CourseID`, `UserID`, `Last`, `Max`) VALUES
(1, 1, 9, 4, 5),
(7, 2, 9, 1, 1),
(8, 2, 7, 1, 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `test`
--

DROP TABLE IF EXISTS `test`;
CREATE TABLE IF NOT EXISTS `test` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `CourseID` int(11) NOT NULL,
  `Name` varchar(200) NOT NULL,
  `Content` varchar(20000) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `test`
--

INSERT INTO `test` (`ID`, `CourseID`, `Name`, `Content`) VALUES
(1, 1, 'Szevasz', '{\"1\":{\"q\":\"első\",\"a1\":\"a\",\"a\":\"2\",\"a2\":\"b\",\"a3\":\"c\",\"a4\":\"d\"},\"2\":{\"q\":\"második\",\"a1\":\"e\",\"a2\":\"f\",\"a3\":\"go\",\"a\":\"4\",\"a4\":\"h\"},\"3\":{\"q\":\"\",\"a1\":\"\",\"a2\":\"\",\"a3\":\"\",\"a4\":\"\"},\"4\":{\"q\":\"\",\"a1\":\"\",\"a2\":\"\",\"a3\":\"\",\"a4\":\"\"},\"5\":{\"q\":\"\",\"a1\":\"\",\"a2\":\"\",\"a3\":\"\",\"a4\":\"\"},\"6\":{\"q\":\"\",\"a1\":\"\",\"a2\":\"\",\"a3\":\"\",\"a4\":\"\"},\"7\":{\"q\":\"\",\"a1\":\"\",\"a2\":\"\",\"a3\":\"\",\"a4\":\"\"},\"8\":{\"q\":\"\",\"a1\":\"\",\"a2\":\"\",\"a3\":\"\",\"a4\":\"\"},\"9\":{\"q\":\"\",\"a1\":\"\",\"a2\":\"\",\"a3\":\"\",\"a4\":\"\"},\"10\":{\"q\":\"\",\"a1\":\"\",\"a2\":\"\",\"a3\":\"\",\"a4\":\"\"}}'),
(2, 2, 'MÃ¡sodik felmÃ©rÅ‘', '{\"1\":{\"q\":\"\",\"a1\":\"\",\"a2\":\"\",\"a3\":\"\",\"a4\":\"\"},\"2\":{\"q\":\"\",\"a1\":\"\",\"a2\":\"\",\"a3\":\"\",\"a4\":\"\"},\"3\":{\"q\":\"\",\"a1\":\"\",\"a2\":\"\",\"a3\":\"\",\"a4\":\"\"},\"4\":{\"q\":\"\",\"a1\":\"\",\"a2\":\"\",\"a3\":\"\",\"a4\":\"\"},\"5\":{\"q\":\"\",\"a1\":\"\",\"a2\":\"\",\"a3\":\"\",\"a4\":\"\"},\"6\":{\"q\":\"\",\"a1\":\"\",\"a2\":\"\",\"a3\":\"\",\"a4\":\"\"},\"7\":{\"q\":\"\",\"a1\":\"\",\"a2\":\"\",\"a3\":\"\",\"a4\":\"\"},\"8\":{\"q\":\"\",\"a1\":\"\",\"a2\":\"\",\"a3\":\"\",\"a4\":\"\"},\"9\":{\"q\":\"\",\"a1\":\"\",\"a2\":\"\",\"a3\":\"\",\"a4\":\"\"},\"10\":{\"q\":\"\",\"a1\":\"\",\"a2\":\"\",\"a3\":\"\",\"a4\":\"\"}}'),
(3, 1, 'Csak Ãºgy', '{\"1\":{\"q\":\"\",\"a1\":\"\",\"a2\":\"\",\"a3\":\"\",\"a4\":\"\"},\"2\":{\"q\":\"\",\"a1\":\"\",\"a2\":\"\",\"a3\":\"\",\"a4\":\"\"},\"3\":{\"q\":\"\",\"a1\":\"\",\"a2\":\"\",\"a3\":\"\",\"a4\":\"\"},\"4\":{\"q\":\"\",\"a1\":\"\",\"a2\":\"\",\"a3\":\"\",\"a4\":\"\"},\"5\":{\"q\":\"\",\"a1\":\"\",\"a2\":\"\",\"a3\":\"\",\"a4\":\"\"},\"6\":{\"q\":\"\",\"a1\":\"\",\"a2\":\"\",\"a3\":\"\",\"a4\":\"\"},\"7\":{\"q\":\"\",\"a1\":\"\",\"a2\":\"\",\"a3\":\"\",\"a4\":\"\"},\"8\":{\"q\":\"\",\"a1\":\"\",\"a2\":\"\",\"a3\":\"\",\"a4\":\"\"},\"9\":{\"q\":\"\",\"a1\":\"\",\"a2\":\"\",\"a3\":\"\",\"a4\":\"\"},\"10\":{\"q\":\"\",\"a1\":\"\",\"a2\":\"\",\"a3\":\"\",\"a4\":\"\"}}');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `test_solved`
--

DROP TABLE IF EXISTS `test_solved`;
CREATE TABLE IF NOT EXISTS `test_solved` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `TestID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `Answers` varchar(20000) NOT NULL,
  `Date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `test_solved`
--

INSERT INTO `test_solved` (`ID`, `TestID`, `UserID`, `Answers`, `Date`) VALUES
(1, 1, 9, '{\"1\":{\"a\":\"3\"},\"2\":{\"a\":\"4\"}}', '2019-04-13 23:00:00'),
(2, 2, 9, '{\"1\":{\"a\":\"2\"},\"2\":{\"a\":\"2\"},\"3\":{\"a\":\"1\"},\"4\":{\"a\":\"3\"},\"5\":{\"a\":\"4\"},\"6\":{\"a\":\"1\"},\"7\":{\"a\":\"3\"},\"8\":{\"a\":\"3\"},\"9\":{\"a\":\"3\"},\"10\":{\"a\":\"2\"}}', '2019-04-14 02:09:11'),
(3, 2, 7, '{\"1\":{\"a\":\"2\"},\"2\":{\"a\":\"3\"},\"3\":{\"a\":\"1\"},\"4\":{\"a\":\"3\"},\"5\":{\"a\":\"4\"},\"6\":{\"a\":\"2\"},\"7\":{\"a\":\"3\"},\"8\":{\"a\":\"4\"},\"9\":{\"a\":\"3\"},\"10\":{\"a\":\"3\"}}', '2019-04-14 03:17:26');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET latin1 NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `permission` tinyint(1) NOT NULL DEFAULT '0',
  `ClassID` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `created_at`, `permission`, `ClassID`) VALUES
(1, 'admin', '$2y$10$rxSk3dfo6Y/QIGkPrOn6E.bReUxTW6ZqzlhSIFFI3/tuuru.I0Lra', '2019-03-26 13:01:53', 9, 0),
(2, 'felh', '$2y$10$mgroeL7pUFGIow0H837.y.ZCwwKMAXnuI9S6hAX7Lbxg5Z29FAwy6', '2019-04-13 11:01:11', 0, 0),
(4, 'tanar2', '$2y$10$DUA5RVD5rs15VmcOpI4hV.pDliOlILZcy/Q/q6LZ7RZhOosPRtl3.', '2019-04-13 11:02:46', 5, 0),
(6, 'tanar', '$2y$10$Fu3vgcu.iTX1jObp4K7sm.3YsV1szADRjfj/LF8Yx6y9a71ugGDaq', '2019-04-13 11:04:11', 5, 0),
(7, 'diak', '$2y$10$QxORJ8K.RmYf3r33ts0yn.yyGDJHWp6XzoQ5eStzKu4dEqs/MX4wm', '2019-04-13 11:10:11', 1, 2),
(8, 'admin2', '$2y$10$jUMNn7hWETwD6YxBZISV0u/6tlmRnqzD.cNA2iBlrxOhVSz/8IAu6', '2019-04-13 11:18:23', 9, 0),
(9, 'diak2', '$2y$10$T93gJVa/AnhZRc6X6jQOl.V9pKeRVQfNBKS1D7Q.wybtUHarxs3C6', '2019-04-13 15:46:52', 1, 2);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `user_class`
--

DROP TABLE IF EXISTS `user_class`;
CREATE TABLE IF NOT EXISTS `user_class` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `user_class`
--

INSERT INTO `user_class` (`ID`, `Name`) VALUES
(1, '3.A'),
(2, '6.B');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
