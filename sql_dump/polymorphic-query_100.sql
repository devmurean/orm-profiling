-- Adminer 4.8.0 MySQL 8.0.31-0ubuntu0.20.04.2 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `employee_st`;
CREATE TABLE `employee_st` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `nik` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contract_duration` tinyint DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `employee_st` (`id`, `name`, `address`, `nik`, `contract_duration`) VALUES
(1,	'Morton Goodwin III',	'54162 Kohler Landing Suite 744\nNorth Rebeccaland, IA 20635-8529',	'89574',	NULL),
(2,	'Armand Gibson',	'356 Jevon Cape\nLake Ernaville, CO 69520',	'43342',	NULL),
(3,	'Magnolia Fritsch',	'39011 Efren Terrace Apt. 018\nLake Schuylerburgh, WV 97171',	'43903',	NULL),
(4,	'Prof. Maximilian Bahringer',	'1998 Nikki Dam Suite 146\nKuvalisberg, OK 88712-8752',	'62024',	NULL),
(5,	'Pauline Jast',	'27135 Dickinson Park\nFurmanhaven, CO 78696',	'25399',	NULL),
(6,	'Elise Zulauf',	'544 Virgie Motorway\nGorczanytown, NE 88257-4982',	'32868',	NULL),
(7,	'Michael Hessel',	'912 Mallory Trace\nNew Ariannatown, OH 63271',	'33257',	NULL),
(8,	'Lorena Gorczany',	'60786 Mayer Dale Suite 522\nRutherfordmouth, IL 51836',	'32194',	NULL),
(9,	'Miss Lavonne Cassin',	'8356 Rosina Springs\nJevonburgh, MS 08297',	'90999',	NULL),
(10,	'Vaughn Gaylord Jr.',	'671 Wiegand Port\nBoganfurt, NE 08948-1355',	'84551',	NULL),
(11,	'Prof. Buford Dietrich IV',	'90353 Johnny Mall\nPort Jarvisville, KY 47589-2831',	'35001',	NULL),
(12,	'Alexandre Connelly',	'412 Bud Parkway Apt. 952\nErickchester, NC 19799-6223',	'49187',	NULL),
(13,	'Melyssa Vandervort',	'8811 Berge Highway Apt. 478\nWest Fannieport, MI 93071',	'62288',	NULL),
(14,	'Burley Greenholt',	'17616 Blanda Roads Suite 661\nSeamusville, NM 11676',	'71411',	NULL),
(15,	'Miss Misty Kovacek',	'67266 Jacobs Flat Suite 839\nNew Emeraldfurt, RI 50860-4736',	'92885',	NULL),
(16,	'Coleman Wolf',	'848 Erik Rue Suite 718\nNorth Chadrick, OH 36041',	'62004',	NULL),
(17,	'Jaime Waelchi',	'2810 Mayert Viaduct\nNew Lancefort, IA 08732-8623',	'97189',	NULL),
(18,	'Declan Wilkinson',	'1275 Russel Glens\nLake Leanne, MA 29130',	'16759',	NULL),
(19,	'Alfonzo Konopelski Jr.',	'960 Arturo Pass\nMeredithhaven, NY 57604',	'38833',	NULL),
(20,	'Prof. Terrance Mosciski',	'72444 Jast Shoals\nSouth Edgardo, UT 04509',	'37131',	NULL),
(21,	'Mr. Delmer Rolfson',	'377 Blick River Suite 589\nSkilesside, CA 76871',	'99815',	NULL),
(22,	'Jamir Mosciski',	'5206 Nikolaus Squares\nHallieville, NC 17476',	'48950',	NULL),
(23,	'Audie Schiller I',	'28654 Tressie Ridge\nLake Brendan, NJ 27718',	'53721',	NULL),
(24,	'Marielle Marquardt',	'13913 Pollich Row Apt. 934\nLake Autumn, GA 89181-1083',	'13861',	NULL),
(25,	'Prof. Hazel Cronin',	'70439 Susie Overpass Suite 124\nLake Vergiemouth, DE 79938',	'26734',	NULL),
(26,	'Olen Volkman',	'306 Green Isle Apt. 698\nPort Emersonchester, MS 94532-2123',	'66470',	NULL),
(27,	'Audra Herzog',	'579 Emmerich Extensions\nPort Patrick, ME 20953',	'61637',	NULL),
(28,	'Josiah Kuhic',	'5647 Abernathy Center Suite 097\nGlennaport, VT 14046-7863',	'66848',	NULL),
(29,	'Lori Boyer',	'54728 Turner Club\nLarsonfort, NY 43726-6120',	'25581',	NULL),
(30,	'Virgil Macejkovic',	'6473 Quigley Oval\nYundtmouth, OR 68892-1424',	'21747',	NULL),
(31,	'Dr. Bradley Hammes DVM',	'824 Purdy Ways\nLake Abby, OR 99673',	'21092',	NULL),
(32,	'Jairo Luettgen Sr.',	'168 Harber Ramp Suite 754\nKristaborough, MD 77142',	'64214',	NULL),
(33,	'Lessie Mante',	'565 Danielle Trail\nClaudiabury, ND 74752',	'68659',	NULL),
(34,	'Chanel Ullrich',	'80056 Frank Gardens Suite 385\nOswaldbury, SC 54989',	'94980',	NULL),
(35,	'Paula Denesik',	'463 Alana Fort\nWest Greta, UT 73374',	'69577',	NULL),
(36,	'Dr. Frederick Rohan',	'738 Bella Corner Apt. 246\nKatharinaborough, MI 56017',	'22119',	NULL),
(37,	'Savanah Osinski',	'8800 Hills Oval Suite 140\nStreichton, IL 70428',	'98619',	NULL),
(38,	'Dereck Treutel',	'97929 Paul Junctions\nNorth Marianna, VA 90435',	'32486',	NULL),
(39,	'Adela Prohaska',	'32184 Garnett Way Suite 992\nMannland, IA 62333-3376',	'86094',	NULL),
(40,	'Prof. Gerard Orn IV',	'1963 Harvey Parkways Apt. 497\nDaniellamouth, TN 14669',	'70825',	NULL),
(41,	'Ryder Upton',	'20983 Frami Alley Suite 690\nAntonemouth, RI 87132',	'53551',	NULL),
(42,	'Mr. Gabe Nader',	'19836 Batz Hill Suite 014\nNew Haylieberg, NY 37530-2758',	'11021',	NULL),
(43,	'Andre VonRueden I',	'847 Boyle Orchard\nSchultzfurt, KY 45489-6014',	'61562',	NULL),
(44,	'Merle Dare Jr.',	'6784 Bartoletti Plaza Apt. 019\nSouth Edwina, NV 53717-1759',	'28755',	NULL),
(45,	'Pascale Williamson',	'4679 Yvonne Coves\nKihnstad, UT 55348-3610',	'67926',	NULL),
(46,	'Prof. Edwin Daugherty PhD',	'813 Hegmann Ports\nSouth Liliana, LA 58943-7998',	'83502',	NULL),
(47,	'Pearline Quitzon II',	'8169 Joseph Coves\nWest Vince, OH 77682-5732',	'88362',	NULL),
(48,	'Kattie Moore',	'67090 Schneider Island Suite 135\nEast Gavinside, CT 22905',	'36488',	NULL),
(49,	'Prof. Piper Lakin V',	'479 Zieme Club\nWest Pablo, MS 75590',	'92451',	NULL),
(50,	'Ike Lindgren',	'43826 Adams Common Apt. 352\nRaynorstad, OR 90659',	'98651',	NULL),
(51,	'Prof. Benjamin Haag Sr.',	'638 Randi Alley Apt. 474\nWest Merl, ND 97560-9477',	NULL,	1),
(52,	'Dr. Nikita Ritchie',	'3724 O\'Kon Junctions\nNew Dena, MA 67650-2245',	NULL,	5),
(53,	'Herbert Champlin',	'9638 Bayer Square\nGoodwinview, WV 86647',	NULL,	3),
(54,	'Nona Sipes Sr.',	'57385 Neva Lake Suite 008\nMullerside, AK 44223-9253',	NULL,	4),
(55,	'Mrs. Maximillia Predovic',	'772 McLaughlin Drives\nWillfurt, WV 66403',	NULL,	2),
(56,	'Deron Hickle',	'9684 Boyer Knolls Suite 564\nRashadville, WV 76162',	NULL,	5),
(57,	'Wade Lynch',	'729 Tara Lane\nHamillview, IA 36736-3827',	NULL,	2),
(58,	'Emie Bashirian V',	'42716 Hauck Crossroad\nNorth Florine, KS 38648',	NULL,	2),
(59,	'Anastasia Adams II',	'459 O\'Connell Trail\nSantamouth, TX 86509',	NULL,	3),
(60,	'Benton Metz',	'5492 Rodriguez Lights\nBashirianville, RI 62126',	NULL,	1),
(61,	'Josue Welch',	'284 Callie Lights Apt. 040\nEast Gaylord, GA 39337',	NULL,	3),
(62,	'Wiley Ferry',	'81193 Mitchell Wall\nKlingfurt, DC 18839',	NULL,	4),
(63,	'Christ Johnson PhD',	'9828 Bonnie Camp Suite 210\nPort Floymouth, MT 52526-0138',	NULL,	3),
(64,	'Prof. Alejandrin Davis',	'26149 Lambert Mission Apt. 992\nAraceliburgh, CO 37613-5633',	NULL,	4),
(65,	'Cassie Goyette',	'8557 Brennan Drive\nNorth Matildeshire, TX 82041-0958',	NULL,	1),
(66,	'Alysha Welch',	'9212 Kuvalis Oval\nMuellerberg, NM 24537-7409',	NULL,	3),
(67,	'Shirley Bailey',	'58520 Thiel View Suite 359\nMoriahshire, DC 32471',	NULL,	4),
(68,	'Ericka Beahan',	'1450 Kuhlman Lock Suite 763\nStokesstad, WI 40992-3704',	NULL,	2),
(69,	'Ms. Layla Berge',	'21074 Garfield Center\nZulaufville, MS 11334-8419',	NULL,	2),
(70,	'Filomena Bernhard',	'1995 Bruen Trace\nWest Caleton, HI 86399-2247',	NULL,	1),
(71,	'Prof. Juston Emmerich IV',	'83010 Zulauf Points\nNew Hal, OH 53359',	NULL,	1),
(72,	'Joan Daugherty IV',	'70132 O\'Reilly Row Apt. 477\nNorth Joshua, RI 49364',	NULL,	4),
(73,	'Jacinthe Kunde Sr.',	'74360 Donna Fort Apt. 728\nNew Hipolitoport, CT 15089',	NULL,	2),
(74,	'Fae Stiedemann',	'8799 Hessel Cape\nAlvachester, NJ 94184',	NULL,	1),
(75,	'Mabelle Funk',	'2221 Kshlerin Road\nEast Sophie, NV 77631',	NULL,	4),
(76,	'Makayla Kris',	'4726 Skiles Drive Apt. 041\nValentinabury, DC 93131-6477',	NULL,	5),
(77,	'Mrs. Jackeline Hoeger',	'414 Crooks Roads\nMichaelaberg, AL 64550-9787',	NULL,	4),
(78,	'Cathryn West',	'2525 Mylene Land Apt. 739\nLake Kiley, WI 41346-8144',	NULL,	5),
(79,	'Rachelle McClure DDS',	'15451 Abelardo Mews\nNew Aliviamouth, GA 93355',	NULL,	2),
(80,	'Dr. Weldon Hill',	'161 Nitzsche Highway\nKevenland, NE 08590',	NULL,	4),
(81,	'Chance Lockman',	'56203 Schoen Pike Suite 400\nLake Zackville, MS 12407',	NULL,	1),
(82,	'Roel Glover',	'8436 Yesenia Crest\nDarianamouth, WI 84824-5376',	NULL,	2),
(83,	'Mackenzie Howell',	'753 Liliana Square\nJoanneberg, AK 27684',	NULL,	4),
(84,	'Dr. Elbert Walter',	'1406 Steuber Manor Suite 302\nSydnimouth, AK 65659',	NULL,	4),
(85,	'Prudence Auer I',	'32752 Konopelski Flats Apt. 056\nSouth Thalia, LA 97229',	NULL,	3),
(86,	'Freddy Cronin',	'62128 Camden Roads Suite 902\nGibsonside, WV 68922-8182',	NULL,	2),
(87,	'Mariane Aufderhar I',	'80345 Ortiz Route Suite 717\nNew Calista, NC 92653',	NULL,	1),
(88,	'Dr. Jimmy Raynor PhD',	'239 White Mews Apt. 756\nPort Christophemouth, WI 14387',	NULL,	1),
(89,	'Florencio Gislason',	'5251 Kulas Square Suite 883\nSteuberland, MN 65300-9489',	NULL,	5),
(90,	'Margarett Boyer',	'67017 Ankunding Forest Apt. 630\nVergieville, RI 72333-5690',	NULL,	1),
(91,	'Gardner Schumm',	'261 Lelah Ports Apt. 587\nLake Maryjaneberg, MI 25018',	NULL,	1),
(92,	'Dr. May Schmitt MD',	'769 Madisyn Alley Apt. 433\nSouth Cordelia, NY 78039',	NULL,	1),
(93,	'Malcolm Williamson',	'2852 Dixie Center Suite 243\nGrahamside, AL 77437-4231',	NULL,	4),
(94,	'Declan Deckow',	'8143 Bernhard Station Suite 485\nTamiaville, IN 55163',	NULL,	4),
(95,	'Dr. Nona Spencer',	'57179 Dickinson Squares\nNorth Darronburgh, WA 29780',	NULL,	4),
(96,	'Jaclyn Beier',	'6821 O\'Conner Spring Suite 541\nEast Sabina, OK 57730',	NULL,	1),
(97,	'Maurine Stark',	'894 Donato Drive Apt. 449\nRicardotown, NY 80575',	NULL,	3),
(98,	'Clare Crooks',	'68429 McLaughlin Land Apt. 341\nDeannaside, VT 06591',	NULL,	5),
(99,	'Anais Bernhard',	'75592 Jerad Mills Apt. 919\nNorth Hankmouth, AL 93415-0516',	NULL,	5),
(100,	'Timmy Dach',	'325 Lockman Estates Suite 027\nEast Jana, VT 78080',	NULL,	1);

-- 2023-01-09 11:24:41