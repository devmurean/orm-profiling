-- Adminer 4.8.0 MySQL 8.0.31-0ubuntu0.20.04.2 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `user_isolation_propagations`;
CREATE TABLE `user_isolation_propagations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` text COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `user_isolation_propagations` (`id`, `first_name`, `last_name`, `address`, `email`) VALUES
(1,	'Abbey',	'Huel',	'8847 Lonie Unions Suite 455\nJonathonside, MD 98345',	'871ec623-414f-3768-a89d-4ae2106eff2e@example.com'),
(2,	'Queen',	'Gusikowski',	'38211 Sheridan Estate Suite 056\nLake Kari, WV 81739',	'81d08ec8-fd5b-37b5-9544-8bdbf06fbf33@example.com'),
(3,	'Vella',	'Toy',	'873 Alyson Springs Apt. 372\nPort Kellitown, NH 71369-7618',	'9c3ba26d-e6e7-36d1-95a9-1e3b55e4561a@example.com'),
(4,	'Gardner',	'Barton',	'6787 Meaghan Motorway Apt. 698\nSouth Merlinstad, SC 22176',	'4b7f5f03-e854-330b-a88a-735f936aec2e@example.com'),
(5,	'Rosalinda',	'Bins',	'909 Herman Roads Suite 993\nKulasborough, WA 33496',	'6c7f3840-15d3-30a0-b044-24fc08e12894@example.com'),
(6,	'Brayan',	'Stracke',	'90369 Maeve Estates Apt. 994\nStarkstad, IL 78457',	'22466297-5cf5-3835-a2df-41815540d42d@example.com'),
(7,	'Grover',	'Klocko',	'45539 Marjolaine Lock Apt. 853\nSouth Elwynmouth, WY 20856-8786',	'd25e0c62-ba1e-358f-b552-46edad3de3b5@example.com'),
(8,	'Hope',	'Waelchi',	'1611 Johns Ramp Apt. 922\nEast Madelynnside, SC 50125-6267',	'804f1599-4001-39d2-aa38-224dcedc7774@example.com'),
(9,	'Maia',	'Lowe',	'56910 Freddy Mountain Suite 766\nNorth Raphaelleberg, NE 25462-6129',	'e7b785dc-b03b-3246-9217-936e9b5c7f1f@example.com'),
(10,	'Kendall',	'Kerluke',	'590 Conroy Streets\nSouth Macyburgh, OH 18877',	'ee6d11f7-fbbf-3fa6-a144-cda024f435fd@example.com'),
(11,	'Griffin',	'Hoppe',	'4712 Kurt Neck Suite 464\nLubowitzmouth, CA 34911',	'35922a6b-0894-362a-96a3-ce2d9677ef73@example.com'),
(12,	'Emilia',	'O\'Keefe',	'844 Augustine Falls\nEast Margaretestad, MI 55388',	'31f0c149-1a48-327e-b793-ae70f7fc6fdf@example.com'),
(13,	'Kayden',	'Kuhic',	'4466 Icie Mission Apt. 869\nWest Jayceport, CO 50735',	'6dc4cec7-ba2d-37a6-a578-3afc2a91be79@example.com'),
(14,	'Damien',	'Bahringer',	'514 Schultz Ferry\nLangfort, MA 60895-5422',	'bb156c46-e34e-3797-907d-c8559ca9ce1d@example.com'),
(15,	'Shirley',	'Feeney',	'41842 Colleen Oval Suite 880\nEast Candido, TX 09475',	'6fc00859-194c-380f-b514-bd411540ec21@example.com'),
(16,	'Ariel',	'Considine',	'58683 Millie Flats Apt. 302\nStefanton, KS 85148',	'26dab059-f5af-3b92-9580-26e60e0cdb9b@example.com'),
(17,	'Emmalee',	'Reynolds',	'15083 Kolby Station Apt. 976\nWest Lydahaven, IL 02840',	'6f708283-ab68-3ab0-833a-12f4120c48ad@example.com'),
(18,	'Sydnie',	'Bernhard',	'7723 Shyanne Route\nSouth Leramouth, GA 33438-9421',	'6f2ef0c3-85eb-3953-95f9-a66c107ddc34@example.com'),
(19,	'Corene',	'Ebert',	'7443 Murray Ridges Suite 104\nJerdemouth, IN 02173-0444',	'23893699-41d2-3810-936d-54212bc5933e@example.com'),
(20,	'Cortney',	'Walter',	'6230 Hackett Mall Apt. 629\nNorth Nikolaston, CT 62062',	'c24564a8-fdc6-3ab8-98ed-b083f8067482@example.com'),
(21,	'Caleigh',	'Trantow',	'8943 Welch Shoals Apt. 128\nTellyborough, NV 68227',	'816728a0-1de1-33a8-8ee5-c767a0b3fed3@example.com'),
(22,	'Tina',	'Carter',	'62569 Wilfred Lock\nNorth Ollie, SD 14984',	'32409959-7a2f-31d8-9fcb-2787eb696148@example.com'),
(23,	'Rosina',	'Kerluke',	'63067 Bergstrom Walk\nTonyberg, MO 48592-3770',	'ccfd5b85-fc7f-3d92-872f-aa556c13dad8@example.com'),
(24,	'Arnulfo',	'Mraz',	'199 Miller Station Apt. 233\nWest Mabelberg, DC 48468',	'32d7fd96-901f-327d-824c-7cc108c639f7@example.com'),
(25,	'Chyna',	'Mertz',	'468 Ernser Stravenue Apt. 304\nWunschbury, ID 49105',	'ea802db1-0f64-3bf0-aa83-efa2af8ada87@example.com'),
(26,	'Opal',	'Eichmann',	'95363 Schmidt Points Apt. 667\nWest Fabiola, MO 10038',	'619f01c4-1b29-3b34-9ad2-068aacd2e108@example.com'),
(27,	'Gaetano',	'Senger',	'9690 Shanahan Summit\nRowetown, VA 33304-9487',	'da1c4626-ec73-3828-8dbd-14e539efc3cd@example.com'),
(28,	'Amaya',	'Treutel',	'2111 Goldner Plain\nNew Javonbury, NE 64202',	'980769b1-e1fc-3600-9b94-a2ba4bbf760d@example.com'),
(29,	'Erin',	'McCullough',	'3186 Kiarra Motorway\nNew Marlene, WI 48365-0852',	'8b1dd7e0-4b0a-3a6f-b7a4-e0dc0092a539@example.com'),
(30,	'Kira',	'Labadie',	'1838 Gusikowski Well\nPfannerstillborough, VT 69129',	'17826d37-8d93-3043-9c06-83892068c0fa@example.com'),
(31,	'Sincere',	'Beer',	'987 Shields Route Suite 656\nNorth Avatown, NJ 17209-5984',	'ce5d4121-2120-3cdb-a06d-caf66efbf7b5@example.com'),
(32,	'Rashad',	'Gibson',	'7666 Jaylen Hill Suite 887\nPort Rudolphland, SC 54407',	'edc61136-b9fa-348d-98fb-f33ecd448c28@example.com'),
(33,	'Jaylon',	'Brakus',	'8742 Goldner Station Apt. 382\nSouth Filomenaberg, MT 98404-0132',	'21d86598-5dd9-3fd3-97d8-9a2a3b33a9b6@example.com'),
(34,	'Bernard',	'Schuster',	'17711 Paucek Lake\nPort Grover, MS 43815-1532',	'664500bf-bd85-3404-9b69-c4e8e1cc0bcd@example.com'),
(35,	'Craig',	'Cruickshank',	'97947 Myrna Crossroad\nSouth Jason, CT 51293',	'f5c726b3-bdc4-3dc1-8583-cbc142d84521@example.com'),
(36,	'Lucile',	'Morissette',	'148 Herman Keys\nJoycemouth, NC 33562',	'94f5ff84-877e-33b0-90fc-61d25ed1e958@example.com'),
(37,	'Bobby',	'McLaughlin',	'623 Bruce Station Apt. 500\nSchoenton, NJ 16356',	'6795cdee-4117-39a6-bcb8-c91c527914c5@example.com'),
(38,	'Nichole',	'Grant',	'80717 Adams Route\nWindlerhaven, KY 46325',	'a663b7ac-7365-3094-b678-999adca8cd78@example.com'),
(39,	'Myah',	'Zemlak',	'126 Hirthe Divide\nNorth Edyth, WI 90566-5880',	'faf3b8f0-86a9-39f3-8413-fc804ad20642@example.com'),
(40,	'Phoebe',	'Rogahn',	'61125 Wolf Coves\nWeimannview, CT 90890',	'55026989-e39b-3316-b685-9c52d3767aa1@example.com'),
(41,	'Reese',	'Jacobson',	'245 Reinger Divide Suite 897\nNorth Markside, MI 11533',	'6879e270-a1b2-320e-807c-b011ed21b45b@example.com'),
(42,	'Rickey',	'Predovic',	'43625 Stokes Square Apt. 475\nSouth Isaiahland, NM 25255',	'1240abd1-eef0-3d2e-b260-df4bdb1ceab3@example.com'),
(43,	'Max',	'Zulauf',	'23411 Donnell Burg\nAnaistown, ME 46355',	'5633a11e-b847-382c-8b22-b05133c4dc5a@example.com'),
(44,	'Elinore',	'Hessel',	'71031 Clemens Lake Apt. 358\nNew Johanna, TN 08360',	'999b98b4-6423-3152-aa3d-9ca90ed320a0@example.com'),
(45,	'Vada',	'Skiles',	'4209 Franecki Gardens Apt. 733\nNew Lola, IL 55610-9406',	'f9119b9f-ee21-3dab-8a9d-20d7abdddf58@example.com'),
(46,	'Connie',	'Schmeler',	'23203 Kunde Parks\nPort Jackelinehaven, GA 92846',	'b0710b5d-0a5b-3458-85b9-00caf4919f71@example.com'),
(47,	'Noe',	'Wisozk',	'660 Rodriguez Estate Apt. 264\nHyattland, LA 43450-9668',	'7e8519c7-eea7-3f69-b3cd-122865033ad2@example.com'),
(48,	'Marilyne',	'Morissette',	'99550 Jedediah Mall\nEast Lyda, HI 92854-8892',	'863887e8-8708-3993-83b6-0965f8cf0c80@example.com'),
(49,	'Malcolm',	'Breitenberg',	'4308 Nora Crossing\nNorth Ben, VT 51061',	'6a1fd449-03fb-3097-8e8b-24b9edf21892@example.com'),
(50,	'Verlie',	'Powlowski',	'293 Zachary Underpass\nWest Diana, FL 09762',	'878cff8c-1c97-314e-9a26-3a513eb63cae@example.com'),
(51,	'Marielle',	'Oberbrunner',	'55299 Maggio Inlet\nWest Abdielchester, UT 47555',	'cdb6679d-474b-33e3-9154-6c4f9af5b4f8@example.com'),
(52,	'Irma',	'Green',	'587 Israel Lodge Suite 219\nSouth Leopoldohaven, OK 67321-1725',	'edb12e1d-e92f-3318-927b-ffbd423acd1c@example.com'),
(53,	'Kirk',	'Dooley',	'438 Armand Mews Apt. 582\nLake Ronmouth, MT 14959-6529',	'6ba9c559-2ba7-3e80-a2f0-20373554e648@example.com'),
(54,	'Clement',	'Schuppe',	'373 Carter Gardens\nNorth Jeradborough, CA 47201-3001',	'e2cdb284-d1ca-3b5c-a66f-dcc2b3060abc@example.com'),
(55,	'Mekhi',	'Langosh',	'80053 Jordyn Canyon Suite 207\nNathanialport, AL 44053',	'babce710-7fbd-3d99-b93f-1992a150266a@example.com'),
(56,	'Kennedy',	'Flatley',	'7967 Bartell Estates\nMcDermottmouth, KS 12892',	'5d893d11-2f0c-3f6c-89a8-47933d6efe3a@example.com'),
(57,	'Kraig',	'Auer',	'46989 Mante Island\nNew Assuntaberg, NH 78809-9647',	'8c0c7318-ada3-3424-a8d8-1922cecb0ff0@example.com'),
(58,	'Russel',	'Ward',	'38315 Clifford Burgs\nRosariomouth, IA 09879',	'e1d90b35-e08c-39b1-9a62-1926dee72d6d@example.com'),
(59,	'Mallie',	'Kuhn',	'59453 Block Vista\nLake Elwin, FL 31981',	'7dff0f14-abad-3f2d-8523-390edfac80fc@example.com'),
(60,	'Ocie',	'Eichmann',	'2416 Hugh Streets\nEmelyberg, ME 43318-6618',	'fa39e6e0-3fed-3326-9e4f-16a8d4819ebd@example.com'),
(61,	'Mikel',	'Ryan',	'969 Osinski Wells\nLake Kaiamouth, TN 91484-5920',	'39480231-f234-3612-8c98-dd420f6f9467@example.com'),
(62,	'Easton',	'Ortiz',	'8571 Zulauf Mall\nSouth Rheaport, OH 71340',	'641ebdbe-b82d-3887-883b-a8af5bfc646f@example.com'),
(63,	'Ebony',	'Gutkowski',	'8051 Purdy Passage Apt. 693\nNorth Rhea, TX 45554',	'266b6341-9c34-32e8-86ca-13dfdb49602c@example.com'),
(64,	'Jazmyne',	'Hessel',	'353 Katlyn Mills\nWest Jeanburgh, AR 36152',	'9a1f27e1-24e1-39db-94c6-a124e4927cb9@example.com'),
(65,	'Agustina',	'Keeling',	'571 Howe Gateway\nNorth Linahaven, IL 29228-2697',	'b62cb250-11f4-3cd4-94e0-5067a3dadad7@example.com'),
(66,	'Fredrick',	'Johns',	'53014 Lakin Pine\nSammystad, MA 46139-5385',	'5705114a-a5bf-3d1e-9707-2092a89a8234@example.com'),
(67,	'Guadalupe',	'Greenfelder',	'36177 Frederik Plains Apt. 331\nWindlerburgh, SC 35882',	'146a58c4-982e-3202-acd0-9be703092315@example.com'),
(68,	'Mireya',	'Abernathy',	'493 Vidal Trail Apt. 220\nKathleenhaven, MO 80393-3381',	'6b21b2a0-f655-3e3b-9328-3a724a046b12@example.com'),
(69,	'Sherwood',	'Cormier',	'51329 Claude Drive Suite 173\nNorth Mercedes, VA 03378',	'cc789eeb-76eb-39e0-8470-a968d2771bc1@example.com'),
(70,	'Alexandro',	'Gulgowski',	'56424 Jedediah Stravenue Apt. 334\nEast Meredithmouth, AK 07207',	'75d9bab2-8fc1-3094-ba84-9ee7c8794d37@example.com'),
(71,	'Athena',	'Murray',	'75116 Della Harbor Apt. 528\nNew Christina, FL 79959',	'e81b6ef7-4b5d-3f02-b2d9-dfdcbd074e11@example.com'),
(72,	'Brody',	'Tromp',	'144 Bartholome Prairie Suite 454\nReillytown, ID 75066',	'01ce660b-eaf7-385f-9f80-e0cbb8024b64@example.com'),
(73,	'Mariam',	'Mitchell',	'98097 Nicola Via Apt. 401\nPort Shyanne, IL 99346-3834',	'c84e6572-ae79-3d37-93d4-a629dbead2fa@example.com'),
(74,	'Haven',	'Wiegand',	'707 Hansen Park\nSouth Dorothyshire, IN 86085',	'542a4023-a52b-35b1-87df-6775f5d5fcc4@example.com'),
(75,	'Sid',	'Ward',	'834 Sipes Rapids Suite 717\nVandervortside, NJ 85110-1254',	'd24744a7-e8a5-3a7c-b0ca-5f59b9e22faf@example.com'),
(76,	'Timothy',	'Mosciski',	'3388 Gibson River\nLake Ricardo, IL 41275-0463',	'8077463b-82e8-3941-8962-cc04090a89a1@example.com'),
(77,	'Norene',	'Marquardt',	'68889 Ryley Lodge Suite 707\nGreenholtland, AZ 81336-5715',	'68a14201-0332-3241-a697-7b477dda947a@example.com'),
(78,	'Delfina',	'Walker',	'836 Ryan Fall\nLake Pink, NM 02012',	'0bcadc7d-098b-32ec-872c-4a1c73091010@example.com'),
(79,	'Mollie',	'Goodwin',	'831 Corwin Canyon\nNew Pink, ND 33531',	'40a11678-662f-3870-9829-bb7983e9eca9@example.com'),
(80,	'Heidi',	'Kozey',	'7783 Rashawn Harbors\nJorgeberg, TX 99555',	'0e2b9458-d094-32e2-a2bc-139950d33417@example.com'),
(81,	'Tomasa',	'Ziemann',	'6082 Emard Wells Apt. 089\nPort Fae, NH 79341-4842',	'32c7ae07-059e-338c-a11f-2da54493df9c@example.com'),
(82,	'Camila',	'Prohaska',	'698 Skiles Lock\nDarbyborough, AL 98024-9398',	'609029f5-968b-34dd-8bb7-dc405c6d42ca@example.com'),
(83,	'Annie',	'Sanford',	'6193 Louie Oval\nLeschchester, NM 59001-0060',	'5410fd53-b6af-3e10-8821-e30765a25464@example.com'),
(84,	'Gretchen',	'Davis',	'977 Demarco Passage Apt. 140\nAlexieville, MD 56324',	'e894aa11-7566-3875-b00c-63dce3fe93ea@example.com'),
(85,	'Evalyn',	'Cole',	'2276 Abernathy Lodge Apt. 631\nSporerburgh, MD 26590',	'bade9928-eb0e-3ad6-9b54-f4f4689facc1@example.com'),
(86,	'Delta',	'Bailey',	'39800 Drake Points Apt. 511\nVestafurt, IA 83854-0167',	'74d35bf4-8c21-37b1-bc4e-887f1cb4a298@example.com'),
(87,	'Mozelle',	'Kunde',	'8546 Stanton Drives Suite 172\nEast Kelley, UT 18193',	'52abe52a-513a-3f29-b36a-d84fd8eef53f@example.com'),
(88,	'Wellington',	'Becker',	'7218 Nitzsche Grove\nJaidenburgh, MO 29601',	'0f7d95ae-fd5d-3a85-9bf6-f8c81cad7d3e@example.com'),
(89,	'Jayson',	'Beahan',	'8613 Oleta Light\nDarrylborough, MN 92213-6645',	'3d873316-4fff-34d3-9d4a-f643484c5a97@example.com'),
(90,	'Darrell',	'Cummerata',	'4903 Gerlach Ridges Apt. 539\nSouth Fannie, OR 11453',	'ccf02f7a-e5ee-3fd7-b737-31e2bd7561b1@example.com'),
(91,	'Vern',	'Stokes',	'62544 Schneider Path\nSengerside, WA 41266-5220',	'a4d844e6-0445-3cea-8352-5dd056c731d3@example.com'),
(92,	'Miguel',	'Effertz',	'7201 O\'Connell Fields\nNorth Myahhaven, MN 53033',	'b23d803b-3a6c-39cf-9b20-db8e1d07a48b@example.com'),
(93,	'Melisa',	'McGlynn',	'7659 Ervin Camp Suite 112\nSouth Kelsie, MT 50725-1111',	'd379e81a-b3c9-3438-9199-599bb6ccc9ef@example.com'),
(94,	'Ansley',	'Macejkovic',	'71323 Huel Burg\nPort Chandlershire, NH 18058-4573',	'1e730b0c-9c1c-34cd-8411-6161d7a86b00@example.com'),
(95,	'Ophelia',	'McClure',	'930 Celestino Crossing\nLorenzmouth, AL 75027',	'e1dd6bb2-0446-350b-9c00-edc2ac127fca@example.com'),
(96,	'Devan',	'Wolff',	'2110 Karlee Passage\nLake Douglas, NH 68231',	'8a442d0a-22f0-39ae-9d25-3e1fbcda5090@example.com'),
(97,	'Amir',	'Gibson',	'4412 Will Fords Suite 662\nLake Reidfurt, MT 55550',	'88aad47a-b12c-37f7-af0a-113fba6d5160@example.com'),
(98,	'Gail',	'Greenholt',	'375 Ursula Drives Suite 803\nBergstromchester, AK 50014',	'fcce009b-c67b-3462-8366-3df37910f443@example.com'),
(99,	'Adelia',	'Bednar',	'444 Celia Burg\nWest Robynview, OK 75665-5109',	'1922cdd7-e243-3fee-b929-7787f7f2b39c@example.com'),
(100,	'Joanny',	'Stanton',	'5223 Audrey Plains\nDanialfort, RI 28161',	'a317676e-3fc4-3275-b8a0-5738073855bf@example.com');

-- 2023-01-09 11:26:12
