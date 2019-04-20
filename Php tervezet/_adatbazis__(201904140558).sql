-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Gép: localhost
-- Létrehozás ideje: 2019. Ápr 14. 05:58
-- Kiszolgáló verziója: 5.5.23
-- PHP verzió: 5.6.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `peti_elearning`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `course`
--

CREATE TABLE `course` (
  `ID` int(11) NOT NULL,
  `CategoryID` int(11) NOT NULL,
  `CreatorID` int(11) NOT NULL,
  `Name` varchar(200) NOT NULL,
  `Content` varchar(20000) NOT NULL,
  `ClassID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `course`
--

INSERT INTO `course` (`ID`, `CategoryID`, `CreatorID`, `Name`, `Content`, `ClassID`) VALUES
(1, 1, 4, 'Első kurzus!', 'Az első <b>kurzus</b> nagyon <b>hos</b>szú tartalma. \r\n\r\nA Love★Com teljes nevén Lovely Complex sódzso mangasorozat, amelyet Nakahara Aja rajzolt. A mangából készült egy 24 részes animesorozat is, a Toei Animation gondozásában, és egy élőszereplős film 2006-ban. A manga a Shueisha Besszacu Margaret nevű antológiájában futott 2001-2006-ig.\r\n\r\n<hr>\r\n\r\nKoizumi Risa egy gimnazista lány, aki a maga 172 centijével kitűnik az átlagos magasságú lányok közül. Ha ez nem lenne elég, a kettes osztályba jár egy srác, Atsushi Otani, aki szintén efféle problémákkal küszködik, csak pont az ellenkezőjével. Ő a maga 156 centijével jóval alacsonyabb, mint az átlagos japán srácok. Emiatt mindkettejüknek van egyfajta komplexusa, ami a magasságukhoz köthető. Az iskola kezdete után elég jó barátokká válnak, de folyton veszekednek, ami általában oda fajul, hogy mindenki rajtuk röhög. Ebből a viselkedésből kifolyólag ragasztja rájuk az osztályfőnökük az „All-Hashin Kyoujin” nevet (magyar fordításban Defekt Duó), egy népszerű komikus duó után, akik között szintén nagy volt a magasságkülönbség.\r\n\r\n<hr>\r\n\r\nA két fiatalnak azonban nincs szerencséje a szerelemben. Egy balul elsült szerelmi próbálkozás után - aminek oka persze a magasság - elhatározzák, hogy akkor sem adják fel. Szerelmük tárgya, Suzuki-kun és Chiharu összejönnek ugyan, de ők mindent beleadnak. Otani és Risa egyre több időt tölt együtt, ami nagyrészt annak is köszönhető, hogy a személyiségük és érdeklődési körük nagyon hasonlít. Még zene téren is, hiszen mindketten odáig vannak a japán rap műfajban tevékenykedő Umibouzuért.\r\n\r\n<hr>\r\n\r\nAhogy egyre többet vannak együtt, Risa elkezd máshogy érezni a fiú iránt, amit eleinte nem mer megosztani a sráccal, azonban Nobu-chan unszolására - aki történetesen Risa legjobb barátnője - megpróbál közelebb kerülni a hozzá.\r\n\r\nVajon a magasság tényleg ennyire számítana, ha szeretünk valakit? Tényleg ennyire meghatározó az egy szerelemben, hogy akit szeretünk magasabb vagy alacsonyabb?\r\n\r\n<hr>\r\n\r\nŐszinte leszek veletek, én egyszerűen imádom ezt az animét. Alapvetően nem tartozik a kedvenc műfajaim közé a vígjáték, de ebben az animében valahogy benne maradt a lelkem. Igaz, néhol nagyon idegesített, hogy Otani milyen idióta és értetlen tud lenni, de nagyon a szívembe lopta magát a történet, ami arra sarkallt, hogy a mangát is lefordítsam. A grafika nekem nagyon tetszik. Bevallom, a betétdalokat nem igazán figyeltem, mert a cselekmény annyira elragadta a figyelmem, hogy időm sem volt arra, hogy arra is figyeljek. Az opening és az ending nagyon illik az animéhez.\r\n\r\nNagyon aranyos anime, és ajánlom mindenkinek, aki egy kis humorra és romantikára vágyik!', 2),
(2, 3, 4, 'Második tanulnivaló', 'Fontos szöveg, amit meg kell tanulni. Nagyon sok okos és kedves dolog, a tanuló érdeklődve olvassa az itt látható tananyagot.', 2),
(3, 2, 6, 'Kurzus tanár hozta létre', 'Matek így, matek úgy, szám így, számok úgy. :D', 0);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `course_category`
--

CREATE TABLE `course_category` (
  `ID` int(11) NOT NULL,
  `Name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `course_category`
--

INSERT INTO `course_category` (`ID`, `Name`) VALUES
(1, '(alapértelmezett)'),
(2, 'Matematika'),
(3, 'Informatika');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `course_read`
--

CREATE TABLE `course_read` (
  `ID` int(11) NOT NULL,
  `CourseID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `Last` int(11) NOT NULL,
  `Max` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

CREATE TABLE `test` (
  `ID` int(11) NOT NULL,
  `CourseID` int(11) NOT NULL,
  `Name` varchar(200) NOT NULL,
  `Content` varchar(20000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `test`
--

INSERT INTO `test` (`ID`, `CourseID`, `Name`, `Content`) VALUES
(1, 1, 'Szevasz', '{\"1\":{\"q\":\"első\",\"a1\":\"a\",\"a\":\"2\",\"a2\":\"b\",\"a3\":\"c\",\"a4\":\"d\"},\"2\":{\"q\":\"második\",\"a1\":\"e\",\"a2\":\"f\",\"a3\":\"go\",\"a\":\"4\",\"a4\":\"h\"},\"3\":{\"q\":\"\",\"a1\":\"\",\"a2\":\"\",\"a3\":\"\",\"a4\":\"\"},\"4\":{\"q\":\"\",\"a1\":\"\",\"a2\":\"\",\"a3\":\"\",\"a4\":\"\"},\"5\":{\"q\":\"\",\"a1\":\"\",\"a2\":\"\",\"a3\":\"\",\"a4\":\"\"},\"6\":{\"q\":\"\",\"a1\":\"\",\"a2\":\"\",\"a3\":\"\",\"a4\":\"\"},\"7\":{\"q\":\"\",\"a1\":\"\",\"a2\":\"\",\"a3\":\"\",\"a4\":\"\"},\"8\":{\"q\":\"\",\"a1\":\"\",\"a2\":\"\",\"a3\":\"\",\"a4\":\"\"},\"9\":{\"q\":\"\",\"a1\":\"\",\"a2\":\"\",\"a3\":\"\",\"a4\":\"\"},\"10\":{\"q\":\"\",\"a1\":\"\",\"a2\":\"\",\"a3\":\"\",\"a4\":\"\"}}'),
(2, 2, 'Második felmérő', '{\"1\":{\"q\":\"Hány pinget küld alapértelmezetten a Windows u0022pingu0022 parancsa?\",\"a1\":\"1-et\",\"a\":\"2\",\"a2\":\"4-et\",\"a3\":\"10-et\",\"a4\":\"végtelen sokat\"},\"2\":{\"q\":\"Hogy hívták II. Bélát?\",\"a1\":\"József\",\"a2\":\"Adam\",\"a\":\"3\",\"a3\":\"Béla\",\"a4\":\"ismeretlen\"},\"3\":{\"q\":\"Miért ütjük a billentyűket?\",\"a\":\"1\",\"a1\":\"simogatva nem működik\",\"a2\":\"erőfitogtatás\",\"a3\":\"jó érzés\",\"a4\":\"rossz érzés\"},\"4\":{\"q\":\"Mennyi 2*2?\",\"a1\":\"5\",\"a2\":\"néha 5\",\"a\":\"3\",\"a3\":\"4\",\"a4\":\"nem kiszámolható\"},\"5\":{\"q\":\"Mikor volt a 3. világháború?\",\"a1\":\"1955\",\"a2\":\"1985\",\"a3\":\"2015\",\"a\":\"4\",\"a4\":\"nem volt 3. világháború\"},\"6\":{\"q\":\"Melyik néptől vettük át a ma ismert QWERTZ kiosztást?\",\"a1\":\"angol\",\"a\":\"2\",\"a2\":\"német\",\"a3\":\"orosz\",\"a4\":\"japán\"},\"7\":{\"q\":\"Honnan örökölte a ma ismert billentyűzet a kiosztását?\",\"a1\":\"így találták ki\",\"a2\":\"ésszerű elrendezés\",\"a\":\"3\",\"a3\":\"írógépek kiosztása is ez volt\",\"a4\":\"a hagyományos mobiltelefon billentyűit vették alapul\"},\"8\":{\"q\":\"Az USB u0022Cu0022 típusú csatlakozó melyik USB verzióban jelent meg?\",\"a1\":\"1.0\",\"a2\":\"2.0\",\"a3\":\"3.0\",\"a\":\"4\",\"a4\":\"3.1\"},\"9\":{\"q\":\"Hány mozgó alkatrész van az SSD-ben?\",\"a1\":\"kettő (egy olvasófej és egy hűtő ventilátor)\",\"a2\":\"csak egy (olvasófej)\",\"a\":\"3\",\"a3\":\"nincs benne mozgó alkatrész\",\"a4\":\"az SSD egy nem létező mozaikszó az informatikában\"},\"10\":{\"q\":\"Milyen fénnyel világít a számítógép bekapcsolt állapotát jelző LED?\",\"a1\":\"zöld\",\"a2\":\"kék\",\"a3\":\"piros\",\"a\":\"4\",\"a4\":\"változó\"}}'),
(3, 1, 'Csak úgy', '{\"1\":{\"q\":\"Lehetséges, hogy ezt ne töltsd ki?\",\"a\":\"1\",\"a1\":\"igen\",\"a2\":\"persze\",\"a3\":\"aha\",\"a4\":\"egyértelmű\"},\"2\":{\"q\":\"\",\"a1\":\"\",\"a2\":\"\",\"a3\":\"\",\"a4\":\"\"},\"3\":{\"q\":\"\",\"a1\":\"\",\"a2\":\"\",\"a3\":\"\",\"a4\":\"\"},\"4\":{\"q\":\"\",\"a1\":\"\",\"a2\":\"\",\"a3\":\"\",\"a4\":\"\"},\"5\":{\"q\":\"\",\"a1\":\"\",\"a2\":\"\",\"a3\":\"\",\"a4\":\"\"},\"6\":{\"q\":\"\",\"a1\":\"\",\"a2\":\"\",\"a3\":\"\",\"a4\":\"\"},\"7\":{\"q\":\"\",\"a1\":\"\",\"a2\":\"\",\"a3\":\"\",\"a4\":\"\"},\"8\":{\"q\":\"\",\"a1\":\"\",\"a2\":\"\",\"a3\":\"\",\"a4\":\"\"},\"9\":{\"q\":\"\",\"a1\":\"\",\"a2\":\"\",\"a3\":\"\",\"a4\":\"\"},\"10\":{\"q\":\"\",\"a1\":\"\",\"a2\":\"\",\"a3\":\"\",\"a4\":\"\"}}');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `test_solved`
--

CREATE TABLE `test_solved` (
  `ID` int(11) NOT NULL,
  `TestID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `Answers` varchar(20000) NOT NULL,
  `Date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) CHARACTER SET latin1 NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `permission` tinyint(1) NOT NULL DEFAULT '0',
  `ClassID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

CREATE TABLE `user_class` (
  `ID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `user_class`
--

INSERT INTO `user_class` (`ID`, `Name`) VALUES
(1, '3.A'),
(2, '6.B');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`ID`);

--
-- A tábla indexei `course_category`
--
ALTER TABLE `course_category`
  ADD PRIMARY KEY (`ID`);

--
-- A tábla indexei `course_read`
--
ALTER TABLE `course_read`
  ADD PRIMARY KEY (`ID`);

--
-- A tábla indexei `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`ID`);

--
-- A tábla indexei `test_solved`
--
ALTER TABLE `test_solved`
  ADD PRIMARY KEY (`ID`);

--
-- A tábla indexei `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- A tábla indexei `user_class`
--
ALTER TABLE `user_class`
  ADD PRIMARY KEY (`ID`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `course`
--
ALTER TABLE `course`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT a táblához `course_category`
--
ALTER TABLE `course_category`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT a táblához `course_read`
--
ALTER TABLE `course_read`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT a táblához `test`
--
ALTER TABLE `test`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT a táblához `test_solved`
--
ALTER TABLE `test_solved`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT a táblához `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT a táblához `user_class`
--
ALTER TABLE `user_class`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
