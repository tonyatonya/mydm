-- phpMyAdmin SQL Dump
-- version 3.5.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 25, 2017 at 12:01 AM
-- Server version: 5.5.28
-- PHP Version: 5.3.28

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mydmme_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `d_products`
--

CREATE TABLE IF NOT EXISTS `d_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` double NOT NULL,
  `thumb_image` varchar(255) NOT NULL,
  `main_image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=41 ;

--
-- Dumping data for table `d_products`
--

INSERT INTO `d_products` (`id`, `category_id`, `name`, `price`, `thumb_image`, `main_image`) VALUES
(32, 7, 'RAMA', 55, '32_1427263498.jpg', '32_1427263498.jpg'),
(33, 7, 'RAVANA', 55, '33_1427263567.jpg', '33_1427263567.jpg'),
(34, 7, 'SITA', 55, '34_1427263652.jpg', '34_1427263652.jpg'),
(35, 7, 'GANESHA', 55, '35_1427263694.jpg', '35_1427263694.jpg'),
(36, 7, 'HANUMAN', 55, '36_1427263728.jpg', '36_1427263728.jpg'),
(37, 7, 'PRA PIRAP', 55, '37_1427263775.jpg', '37_1427263775.jpg'),
(38, 7, 'KARKANASOUN', 55, '38_1427263810.jpg', '38_1427263810.jpg'),
(39, 7, 'SUGRIVA', 55, '39_1427263940.jpg', '39_1427263940.jpg'),
(40, 7, 'RAHU', 55, '40_1427263987.jpg', '40_1427263987.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `d_product_categories`
--

CREATE TABLE IF NOT EXISTS `d_product_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `thumb_image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `d_product_categories`
--

INSERT INTO `d_product_categories` (`id`, `name`, `description`, `thumb_image`) VALUES
(7, 'KHON COLLECTION', '<p><em>Our Khon collection was inspired from RAMAYANA, the great hindu literature.</em></p>\n\n<p><em>MYDM would like to present Khon from our original graphic way,</em></p>\n\n<p>with hope that it''d help people understand more of each Khon character. </p>\n', '7_1427258174.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `d_works`
--

CREATE TABLE IF NOT EXISTS `d_works` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `website` varchar(255) NOT NULL,
  `thumb_image` varchar(255) NOT NULL,
  `doc_date` datetime NOT NULL,
  `seq` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=106 ;

--
-- Dumping data for table `d_works`
--

INSERT INTO `d_works` (`id`, `name`, `description`, `website`, `thumb_image`, `doc_date`, `seq`) VALUES
(66, 'ORIGIANAL RECIPE', '<p>Original Recipe collection is the result of very own passion in culinary &amp; cooking, modern graphics, bold colors, and the love in stationary. Here, we come up with patterns of Tom Yum Shrimp, Pad Thai, and Green Curry Chicken.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>~ Sticky Notes</strong>&nbsp;in various colour schemes of different authentic Thai dishes&nbsp;<strong>~</strong></p>\r\n\r\n<p>~<strong>&nbsp;Bookmark Sets</strong>&nbsp;of main ingredients of famous Thai dishes&nbsp;<strong>~</strong></p>\r\n', '', '20150210130046work-thumbs-new025.jpg', '0000-00-00 00:00:00', 1),
(67, 'DIM SUM LOVER', '<p>MYDM create the design for &quot;Dimsum Lover&quot; Guidebook, the great collection of the best chinese dumplings places in Thailand. The request is to come up with design, layout, and typography to reflect great combination of &nbsp;authentic chinese and the modernity all at once.</p>\r\n', '', '20150210131356work-thumbs-new024.jpg', '0000-00-00 00:00:00', 2),
(68, 'BANYAN TREE RESIDENCES', '<p>We have done several creative luxury designs for Banyan Tree Residences such as premium purchase box design, gift turndown postcard sets, map illustration, invitation design, and touchscreen design for Banywan Tree Residences in Bangkok, Bintan, Lijiang, and Phuket.</p>\r\n', '', '20150210133240work-thumbs-new023.jpg', '0000-00-00 00:00:00', 3),
(69, 'CASSIA WEBSITE', '<p>Cassia, a luxury residence, would like to have their website and touchscreen tailored. To come up with the right</p>\r\n\r\n<p>users experience, we create a sense of nature, tranquility, yet modern look for the brand and having main focus</p>\r\n\r\n<p>on the&nbsp;building plans and the floor plans for such a subtle commercial purpose.</p>\r\n', 'http://cassiaresidences.com/', '20150216143642work-thumbs-new022.jpg', '0000-00-00 00:00:00', 4),
(83, 'WORD FOR YOUTH', '<p><strong>&quot; เนเธยเนเธเธเนเธยเนเธยเนเธเธเนเธยเนเธยเนเธเธเนเธย - เนเธยเนเธยเนเธเธเนเธยเนเธเธเนเธเธเนเธยเนเธยเนเธเธเนเธเธ -&nbsp;เนเธยเนเธยเนเธเธเนเธเธเนเธเธเนเธยเนเธเธเนเธยเนเธเธ - เนเธยเนเธเธเนเธยเนเธยเนเธเธเนเธยเธขย &quot;</strong></p>\r\n\r\n<p>Thai teens started to say these kinds of stuff around 2013.&nbsp;</p>\r\n\r\n<p>This Words for Youth collection is&nbsp;so fun, interesting, and historical in a way.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>&quot; </strong><strong>เนเธยเนเธเธเนเธยเนเธยเนเธเธเนเธย</strong><strong> &quot;&nbsp;</strong><em>/Rangz/; Extremely utmost act</em></p>\r\n\r\n<p><strong>&quot; </strong><strong>เนเธยเนเธยเนเธเธเนเธเธเนเธเธเนเธยเนเธเธเนเธยเนเธเธ</strong><strong> &quot; /</strong><em>Naa Rug&nbsp;A/; Super duper cute</em></p>\r\n\r\n<p><strong>&quot;&nbsp;</strong><strong>เนเธยเนเธยเนเธเธเนเธยเนเธเธเนเธเธเนเธยเนเธยเนเธเธเนเธเธเธขย</strong><strong> &quot;&nbsp;</strong><em>/Feaw Ngeow/; Swanky &amp; Trendy</em></p>\r\n\r\n<p><strong>&quot; </strong><strong>เนเธยเนเธเธเนเธยเนเธยเนเธเธเนเธยเนเธยเนเธเธเนเธยเธขย</strong><strong> &quot;&nbsp;</strong><em>/Meb Khing Khing/; OMG what a Genius !</em></p>\r\n', '', '20150216141240work-thumbs-new013.jpg', '0000-00-00 00:00:00', 5),
(82, 'DIR4', '<p><strong>DIR</strong><strong>4</strong>,&nbsp;a film production house wants&nbsp;to create such a strong brand to be&nbsp;known for thier refined visual making. MYDM has formed the concept for the whole brand, and also designed&nbsp;separated identity for each of DIR4&nbsp;service.&nbsp;We create the logo, identity, key visuals, collaterals, brochure, and also website.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>DIR4 FILMS</strong>&nbsp;produces films, tv ads mostly for cosmetics &amp; hi-end consumer products,&nbsp;<strong>DIR4 TV</strong>&nbsp;produces tv contents focusing on documentary and edutainment, and&nbsp;<strong>4BY4</strong>&nbsp;produces budgeted ads such as web virals.</p>\r\n', '', '20150216141411work-thumbs-new014.jpg', '0000-00-00 00:00:00', 6),
(81, 'AMORVIDA', '<p>For the&nbsp;loft-style&nbsp;coffee place, Amorvida,&nbsp;MYDM has come up with the&nbsp;design concept,&nbsp;the store identity, graphic elements, and their website to reflect the meaning of Amorvida, &quot;Love&nbsp;Life&quot;.&nbsp;Our main challenge is to come up with design solution for the front black beam which&nbsp;was blocking the view. We came up with the type menu&nbsp;design that turns out to be very satisfying; it&nbsp;effectively&nbsp;opens up the space and at the same time&nbsp;become a nice&nbsp;visual&nbsp;to the interior&nbsp;itself</p>\r\n', '', '20150210141612work-thumbs-new015.jpg', '0000-00-00 00:00:00', 7),
(75, 'LAGUNA SHORES', '<p>From Laguna Sands to Laguna Shores, we have come with the key visual for the property. The simply&nbsp;clean and modern look appears through out our works for the brand; from the print production, website, mobile site, touchscreen, and the exhibition design for their Grand Opening.&nbsp;Here, we teamed up with our partner, YCOMM,&nbsp;for the walk way, ceiling, and other exterior&nbsp;paint.&nbsp;</p>\r\n', 'http://www.lagunaproperty.com/laguna-shores-bintan-attractively-priced-holiday-homes-in-bintan/', '20150216143449work-thumbs-new016.jpg', '0000-00-00 00:00:00', 8),
(76, 'KHON COLLECTION', '<p><em>Our Khon collection was inspired from RAMAYANA, the great hindu literature.</em></p>\r\n\r\n<p><em>MYDM would like to present Khon from our original graphic way,</em></p>\r\n\r\n<p><em>with hope that it&#39;d&nbsp;help people understand more of each Khon character.&nbsp;</em></p>\r\n', '', '20150216143324work-thumbs-new021.jpg', '0000-00-00 00:00:00', 9),
(77, 'ABP ONE DROP IS ONE SHARE', '<p>Au Bon Pain would like to have a nice tailored recycle bin for their corporate social responsibility program&nbsp;<em>&quot;One Drop is One Share.&quot;</em>&nbsp;MYDM was requested to design and produce a unique recycle&nbsp;trash bin collecting Au Bon Pain&#39;s used plastic water bottles, later turned&nbsp;into valuable materials which&nbsp;opened up career oportunities for underprivileged children.&nbsp;The box&nbsp;itself is made out &nbsp;of the recycle carton box, screened and&nbsp;printed with premium eco soy ink.</p>\r\n', '', '20150216141727work-thumbs-new020.jpg', '0000-00-00 00:00:00', 10),
(78, 'THE BEGINNING OF FOREVER', '<p>The artsy bride and groom requested MYDM to create the stylish chic retro wedding theme and concept; we then come up with the orginal script logo and wedding theme, the wedding party invitation vinyle cards as an eternal beautiful music playing in their wedding, and the pretty jams selected for the gift just to sweeten their love life. In this project, we also collaborated with 4by4 production to produce the beautiful wedding presentation as a lovely memorable time of the couple.</p>\r\n', '', '20150216141615work-thumbs-new019.jpg', '0000-00-00 00:00:00', 11),
(79, 'LAGUNA PROPERTY', '<p>We have done several projects for&nbsp;Laguna Property, a well-known residential company in Phuket, Thailand;&nbsp;from brand manual guideline, print design &amp; production, map illustration, website and mobile site, to ads collaterals.</p>\r\n', 'http://www.lagunaproperty.com/', '20150210141248work-thumbs-new018.jpg', '0000-00-00 00:00:00', 12),
(80, 'JK JOURNEY', '<p><strong style="line-height:1.6"><em>&quot; Our Journey Starting at&nbsp;Forever - Ending at Never &quot;</em></strong></p>\r\n\r\n<p><em>-----------------------------</em></p>\r\n\r\n<p>Under travel theme for their wedding, we came up with the whole concept and design for JK invitation card and unique wedding gift set. In this project, MYDM has got a special requested to use various printing techniques as wishes to state JK&nbsp;ownership of&nbsp;premium&nbsp;printing business.</p>\r\n', '', '20150210141336work-thumbs-new017.jpg', '0000-00-00 00:00:00', 13),
(84, 'NAKORNSRI THAMMARAT', '<p>MYDM has been requested to interpret data and design infographic for Nakorn Si Tammarat&#39;s power development plan. All reused bio power comes from wind, livestocks, plants, waste, and water.</p>\r\n', '', '20150216141126work-thumbs-new012.jpg', '0000-00-00 00:00:00', 14),
(85, 'STUDIO4', '<p>Studio 4, the loft-style studio offering rental services for films industry, has asked us to come up with the concept and create the design identity, website , and all collaterals for the brand.</p>\r\n\r\n<p>- Simple - Clean -&nbsp;Loft - Minimal -</p>\r\n', '', '20150216140531work-thumbs-new011.jpg', '0000-00-00 00:00:00', 15),
(86, 'FOMO', '<p><strong>FOMO Thai,&nbsp;</strong>a restaurant located in Melbourne, Australia,&nbsp;needs to represent their identity of thai food in fresh, relax and informal for good time, good beer and good food as common in Bangkok&rsquo;s urban culture.</p>\r\n', 'http://fomothai.com.au/', '20150216140507work-thumbs-new010.jpg', '0000-00-00 00:00:00', 16),
(87, 'ACTS OF GREEN', '<p>We have&nbsp;recently developed the eco brand identity for ACTs Of Green with the concept &quot;One Small Change can make One Big Difference&quot; by using the right visuals. Besides having original graphic, the brand&#39;s key message would speak out the&nbsp;unique and organic experience from identiy, graphic elements, color schemes, and material&nbsp;selections.</p>\r\n', '', '20150210143204work-thumbs-new09.jpg', '0000-00-00 00:00:00', 17),
(88, 'CREATIVE TEA SET', '<p>&nbsp;<strong>the Tea Set vs. the Stationary Box</strong></p>\n\n<p>_____</p>\n\n<p>The visual production house, DIR4, needs a creative gift set for the company&#39;s clients and agencies;&nbsp;</p>\n\n<p>MYDM has come up with this double-function premium tea set under the concept &quot;&nbsp;<strong><em>one small bag refreshes&nbsp;your creativity</em></strong>.&quot; The empty tea box itself can later on be converted into the stationary box as the brand&#39;s effective leave behind.</p>\n', '', '20150216140206work-thumbs-new08.jpg', '0000-00-00 00:00:00', 18),
(89, 'WISION', '<p>MYDM has been requested to come up with concept, identity&nbsp;and editorial&nbsp;design for DITP&#39;s publication&nbsp;&quot;Thailand&#39;s Kitchen of the World&quot;&nbsp;in modern thai look. For this food magazine, we came up with the name &quot;Wision&quot;; the identity itself&nbsp;implies the meaning of double visions which would then bring Thai food into the next level of being more well known around the world.</p>\r\n', '', '20150217113941work-thumbs-new07.jpg', '0000-00-00 00:00:00', 19),
(90, 'COMMIT A SIN', '<p>MYDM has come up with the creative&nbsp;concept and design the&nbsp;invitation for&nbsp;<strong>Commit a Sin</strong>&nbsp;brand launch and also for their first CAS collection 2014. To make the brand memorable as the premium and unique style of their&nbsp;outfits, we decide to use the great contrast between&nbsp;the sleek minimal of&nbsp;the outside package&nbsp;and the fancy popup card inside with all the flowery garden and&nbsp;the apple tree playing the&nbsp;the main character, which is well represented the name of this collection and the brand itself.</p>\r\n', '', '20150216134000work-thumbs-new06.jpg', '0000-00-00 00:00:00', 22),
(91, 'WANTHA', '<p>The cashew nut,&nbsp;<strong><em>Wantha</em></strong>, would like to revamp their look to be more friendly, lively, and of course tasty. MYDM has come up with the cute pattern and the gift package. We use different color and pattern to represent each of the flavour; Tomyum. Paprika, Salted, Nori, and Honey.</p>\r\n', '', '20150216133632work-thumbs-new05.jpg', '0000-00-00 00:00:00', 24),
(92, 'DDAY', '<p>&nbsp;MYDM has created the brand identity, patterns, and design concept for the organic Thai herbal drink, &quot;DDAY&quot;.</p>\r\n\r\n<p>As introducing to the market for the first time, the brand with hip and refreshing look has to be very impactful and outstanding from other healthy drinks.///</p>\r\n', '', '20150210143852work-thumbs-new04.jpg', '0000-00-00 00:00:00', 20),
(93, 'ALOFT STUDIO', '<p>ALOFT STUDIO, a loft style guesthouse in Bangkok, needs the right image and concept design. MYDM has&nbsp;created&nbsp;the whole identity package;&nbsp;from logo, guidebooks, postcard sets, to amenities, &nbsp;including the interior styling and photo shoots.&nbsp;</p>\r\n', 'http://www.aloftstudio.com/', '20150210144043work-thumbs-new02.jpg', '0000-00-00 00:00:00', 23),
(94, 'PAD THAI', '<p>Pad Thai Restaurant in Melbourne has been in their business for quite some time and now would like to refresh the brand. To create the new look and identity for Pad Thai, we want to have a concept of street food well combined with everyday&nbsp;Thai food, yet the place welcomes everyone to enjoy the original taste of Thai dishes.</p>\r\n', 'http://www.padthairestaurant.com.au/', '20150216133342work-thumbs-new01.jpg', '0000-00-00 00:00:00', 21),
(95, 'HAPPY DIARY', '<p>Collaborated with Lapis, the stationary brand, we have been assigned to create the notebook that inspires people to live happily.</p>\n', '', '20150325135909work-thumbs-new026.jpg', '0000-00-00 00:00:00', 25),
(98, 'CANVAS', 'CANVAS is the building with the space for rent, originally developed from the old commercial one in Bangkok. With the concept of possibility of creating anything on blank canvas, we have used the striking color combination on graphic, interior and paintings to make this space artsy and homey at the very same time.\r\n', 'http://www.canvas-livingandspace.com', '2016072815240303.jpg', '0000-00-00 00:00:00', 0),
(96, 'THAIGER BURGER', '<p>THAIGER needs to present itself as a welcoming, friendly, and chic burger place in Melbourne. Here, burger is so tasty and spicy with a twist of thai flavors, so we have created the whole identity, key visual, packaging, and website.</p>\r\n', 'http://www.thaiger.com.au', '20151128103836thumb-thaiger.jpg', '0000-00-00 00:00:00', 0),
(97, 'FLEUR', '<p>MYDM has created identity and packaging design for Fleur, the organic rose hip skincare.</p>\r\n\r\n<p>We would like the brand to be naturally beautiful, yet simply modern</p>\r\n\r\n<p>-- therefore we came up with handwriitten logo and&nbsp;the flower paint, using bold colors of pink and red.</p>\r\n', '', '20160120120630thumb.jpg', '0000-00-00 00:00:00', 0),
(99, 'HONOLULU', 'MYDM have created unique identity for Honolulu, the smoothie shop selling Mango & Coconut drinks. We have gone though the process of paper cutting, painting, and brushing to get the imperfect yet beautiful form of the fruits and the leaves for the brand''s graphic element. The color palette and the Hawaiian girls are also added to make the whole brand feel fun and refreshing at the same time.', '', '20160802101523thumbs.jpg', '0000-00-00 00:00:00', 0),
(100, 'SUM PUN NEE', 'MYDM have come up with the concept of edible flowers for SUM PUN NEE. With a modern twist to this traditional thai dessert, we combined Sum Pun Nee flowers into a delicate beautiful bouquet, making such a perfect gift.', '', '20160804014418thumbs.jpg', '0000-00-00 00:00:00', 0),
(101, 'MYDM CHADA', 'Under the concept "New Original", MYDM would like to show the thainess in today world, busy with technology and movement, where traditional and digital art are tuned each other till they are harmoniously integrated. Through this work "CHADA" we select the traditional ornament, Chada, to represent arts in the old days. It has been put on the model, then we apply the body paint used in traditional Chinese dance creating the real life painting effect to the work. ', '', '2017011719161101.jpg', '0000-00-00 00:00:00', 0),
(102, 'DOMO', 'MYDM got a chance to recreate and decorate the space for Studio4''s client guest room. The whole space has been done with a very clean homey set, with abundance of natural light. The main piece is the acrylic die-cut fonts attached on the wall, the red letters are assembled for the word STUDIO4, while the second line is read "DOMO" or "Thank you" in Japanese.', '', '2017031320130902.jpg', '0000-00-00 00:00:00', 0),
(103, 'CENTENARIANS', 'MYDM has developed the dietary supplement, CENTENARIANS; the brand''s product would be on shelf in hospitals as well as anti-aging clinics. This Astar series have been created with modern and clean look. The repetitive lines represent the ray that would damage the skin.', '', '2017031320175503.jpg', '0000-00-00 00:00:00', 0),
(104, 'TRIANGLES', 'With the love of colors and shapes, MYDM hand paint with triangle shapes are created in dimensions.', '', '2017031320185801.jpg', '0000-00-00 00:00:00', 0),
(105, 'LA CREPERIE', ' MYDM has created identity, menu design, food styling, including photography for La Creperie. With the concept of "Little Paris Kitchen," we are combining\r\nthe image of artistic french cuisine and homey dishes together. \r\nPeople can come and enjoy the grandma recipe in french set up dinning scene.', '', '20170622194126cover lc', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `d_work_items`
--

CREATE TABLE IF NOT EXISTS `d_work_items` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `work_id` int(11) NOT NULL,
  `type` varchar(10) NOT NULL,
  `title` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  `order_num` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=586 ;

--
-- Dumping data for table `d_work_items`
--

INSERT INTO `d_work_items` (`id`, `work_id`, `type`, `title`, `path`, `order_num`) VALUES
(2, 18, 'picture', 'CASSIA Website 2', 'work-0-2.jpg', 2),
(3, 18, 'picture', 'CASSIA Website 3', 'work-0-3.jpg', 3),
(47, 22, 'picture', '', '9f1a7a91e4794b4cda5d12da8f977aa5.jpg', 1),
(5, 18, 'picture', 'CASSIA Website 4', 'work-0-4.jpg', 5),
(48, 23, 'picture', '', '9f1a7a91e4794b4cda5d12da8f977aa5.jpg', 1),
(7, 18, 'picture', 'CASSIA Website 5', 'work-0-5.jpg', 7),
(49, 23, 'video', '', 'http://vimeo.com/98268016', 1),
(9, 18, 'picture', 'CASSIA Website 6', 'work-0-6.jpg', 9),
(10, 18, 'picture', 'CASSIA Website 7', 'work-0-7.jpg', 10),
(11, 18, 'picture', 'CASSIA Website 8', 'work-0-8.jpg', 11),
(27, 19, 'picture', '', 'w1.jpg', 3),
(23, 18, 'picture', '', 'work-0-1', 10),
(29, 20, 'picture', '', '1236665_701893843173226_998920843_n.jpg', 1),
(30, 21, 'picture', '', '1558663_767863026576307_246977301_n.jpg', 1),
(46, 21, 'video', '', 'http://vimeo.com/89017301', 1),
(52, 60, 'video', '', 'http://www.youtube.com/watch?v=IBObg42l3kI', 2),
(51, 60, 'picture', '', 'Jellyfish.jpg', 1),
(45, 21, 'video', '', 'http://vimeo.com/ondemand/beautyisembarrassing/53055888', 2),
(53, 23, 'video', '', 'http://vimeo.com/98658153', 1),
(54, 60, 'picture', '', 'Tulips.jpg', 3),
(55, 62, 'picture', '', 'd8fd15c6e32b94b19ce8aead7e19a8dc.jpg', 4),
(56, 62, 'picture', '', '96babcc78b0fc9860b3e480389295aa9.jpg', 4),
(57, 62, 'picture', '', 'c3a5fb9508eb685089c6a1be8379f1f4.jpg', 1),
(61, 63, 'picture', '', 'work-0-2.jpg', 1),
(60, 63, 'video', '', 'http://vimeo.com/channels/staffpicks/101912164', 2),
(62, 63, 'picture', '', 'work-0-3.jpg', 3),
(490, 94, 'picture', '', 'PADTHAI-09.jpg', 9),
(489, 94, 'picture', '', 'PADTHAI-08.jpg', 8),
(504, 95, 'picture', '', 'HAPPY DIARY_PORTFOLIO-12.jpg', 12),
(488, 94, 'picture', '', 'PADTHAI-07.jpg', 7),
(487, 94, 'picture', '', 'PADTHAI-06.jpg', 6),
(486, 94, 'picture', '', 'PADTHAI-05.jpg', 5),
(485, 94, 'picture', '', 'PADTHAI-04.jpg', 4),
(484, 94, 'picture', '', 'PADTHAI-03.jpg', 3),
(483, 94, 'picture', '', 'PADTHAI-02.jpg', 2),
(482, 94, 'picture', '', 'PADTHAI-01.jpg', 1),
(481, 93, 'picture', '', '11.ALOFT_PORT_015_logo.jpg', 11),
(480, 93, 'picture', '', '10.ALOFT_PORT_018_logo.jpg', 10),
(479, 93, 'picture', '', '09.ALOFT_PORT_017_logo.jpg', 9),
(478, 93, 'picture', '', '08.ALOFT_PORT_013_logo.jpg', 8),
(477, 93, 'picture', '', '07.ALOFT_PORT_011_logo.jpg', 7),
(476, 93, 'picture', '', '06.ALOFT_PORT_09_logo.jpg', 6),
(475, 93, 'picture', '', '05.ALOFT_PORT_08_logo.jpg', 5),
(474, 93, 'picture', '', '04.ALOFT_PORT_06_logo.jpg', 4),
(473, 93, 'picture', '', '03.ALOFT_PORT_04_logo.jpg', 3),
(472, 93, 'picture', '', '02.ALOFT_PORT_03_logo.jpg', 2),
(471, 93, 'picture', '', '01.ALOFT_PORT_02_logo.jpg', 1),
(467, 92, 'picture', '', '05.DDAY PORTFOLIO-05.jpg', 5),
(468, 92, 'picture', '', '06.DDAY PORTFOLIO-06.jpg', 6),
(469, 92, 'picture', '', '07.DDAY PORTFOLIO-07.jpg', 7),
(466, 92, 'picture', '', '04.DDAY PORTFOLIO-04.jpg', 4),
(465, 92, 'picture', '', '03.DDAY PORTFOLIO-03.jpg', 3),
(463, 92, 'picture', '', '01.DDAY PORTFOLIO-01.jpg', 1),
(464, 92, 'picture', '', '02.DDAY PORTFOLIO-02.jpg', 2),
(457, 91, 'picture', '', '9f1a7a91e4794b4cda5d12da8f977aa5.jpg', 1),
(458, 91, 'picture', '', '6a97b6ce957515fdb4703b8e9e9ed614.jpg', 2),
(459, 91, 'picture', '', '6b6e8cd896fb3bc06f2b95cca8ba1c15.jpg', 3),
(460, 91, 'picture', '', 'b5200592f25fb427c268e388c7b34724.jpg', 4),
(461, 91, 'picture', '', 'c594349576d7bcfbe2beeccd17b22753.jpg', 5),
(456, 90, 'picture', '', '08.commit a sin_05_logo.jpg', 8),
(455, 90, 'picture', '', '07.commit a sin_08_logo.jpg', 7),
(454, 90, 'picture', '', '06.commit a sin_07_logo.jpg', 6),
(453, 90, 'picture', '', '05.commit a sin_04_logo.jpg', 5),
(452, 90, 'picture', '', '04.commit a sin_03_logo.jpg', 4),
(451, 90, 'picture', '', '03.commit a sin_01_logo.jpg', 3),
(450, 90, 'picture', '', '02.commit a sin_02_logo.jpg', 2),
(449, 90, 'picture', '', '01.commit a sin_06_logo.jpg', 1),
(446, 89, 'picture', '', '03.74bf2970a8165230a5c9c2b7d8f73930.jpg', 3),
(445, 89, 'picture', '', '02.c7378ee84936be83621a0520e2eb8d0d.jpg', 2),
(444, 89, 'picture', '', '01.62e648f1d0d1ac7862592bf647a8d4c7 (1).jpg', 1),
(341, 76, 'picture', '', '03.jpg', 9),
(443, 88, 'picture', '', 'Tea5.jpg', 5),
(442, 88, 'picture', '', 'Tea4.jpg', 4),
(441, 88, 'picture', '', 'Tea3.jpg', 3),
(440, 88, 'picture', '', 'Tea2.jpg', 2),
(439, 88, 'picture', '', 'Tea1.jpg', 1),
(433, 87, 'picture', '', '01.AOG_04.jpg', 1),
(434, 87, 'picture', '', '02.AOG_05.jpg', 2),
(435, 87, 'picture', '', '03.AOG_01.jpg', 3),
(436, 87, 'picture', '', '04.AOG_02.jpg', 4),
(424, 86, 'picture', '', '01.FOMO  PORTFOLIO-01.jpg', 1),
(425, 86, 'picture', '', '02.FOMO  PORTFOLIO-02.jpg', 2),
(417, 85, 'picture', '', '06.Studio_logo_05.jpg', 6),
(418, 85, 'picture', '', '07.Studio_logo_06.jpg', 7),
(419, 85, 'picture', '', '08.Studio_logo_07.jpg', 8),
(420, 85, 'picture', '', '09.jpg', 9),
(421, 85, 'picture', '', '10.Studio_website_01.jpg', 10),
(416, 85, 'picture', '', '05.Studio_logo_04.jpg', 5),
(415, 85, 'picture', '', '04.Studio_logo_03_1.jpg', 4),
(414, 85, 'picture', '', '03.Studio_logo_02.jpg', 3),
(412, 85, 'picture', '', '01.Studio_01.jpg', 1),
(413, 85, 'picture', '', '02.STUDIO4  PORTFOLIO.jpg', 2),
(404, 84, 'picture', '', '01.NAKORN_MAP.gif', 1),
(405, 84, 'picture', '', '02.jpg', 2),
(406, 84, 'picture', '', '03.jpg', 3),
(407, 84, 'picture', '', '04.jpg', 4),
(408, 84, 'picture', '', '05.jpg', 5),
(343, 77, 'picture', '', '01.AU_01_logo.jpg', 1),
(344, 77, 'picture', '', '02.AU_08_logo.jpg', 2),
(345, 77, 'picture', '', '03.AU_02_logo.jpg', 3),
(346, 77, 'picture', '', '04.AU_03_logo.jpg', 4),
(347, 77, 'picture', '', '05.AU_04_logo.jpg', 5),
(388, 82, 'picture', '', 'Dir43.jpg', 3),
(387, 82, 'picture', '', 'Dir42.jpg', 2),
(389, 82, 'picture', '', 'Dir44.jpg', 4),
(390, 82, 'picture', '', 'Dir45.jpg', 5),
(391, 82, 'picture', '', 'Dir46.jpg', 6),
(392, 82, 'picture', '', 'Dir47.jpg', 7),
(393, 82, 'picture', '', 'Dir48.jpg', 8),
(386, 82, 'picture', '', 'Dir41.gif', 1),
(375, 81, 'picture', '', 'AMD2.jpg', 2),
(374, 81, 'picture', '', 'AMD1.jpg', 1),
(376, 81, 'picture', '', 'AMD3.jpg', 3),
(377, 81, 'picture', '', 'AMD4.jpg', 4),
(378, 81, 'picture', '', 'AMD5.jpg', 5),
(379, 81, 'picture', '', 'AMD6.jpg', 6),
(380, 81, 'picture', '', 'AMD7.jpg', 7),
(381, 81, 'picture', '', 'AMD8.jpg', 8),
(365, 80, 'picture', '', 'JK1.jpg', 1),
(366, 80, 'picture', '', 'JK2.jpg', 2),
(367, 80, 'picture', '', 'JK3.jpg', 3),
(368, 80, 'picture', '', 'JK4.jpg', 4),
(369, 80, 'picture', '', 'JK5.jpg', 5),
(362, 79, 'picture', '', '05.LAGUNA PORTFOLIO-05.jpg', 5),
(363, 79, 'picture', '', '06.LAGUNA PORTFOLIO-06.jpg', 6),
(358, 79, 'picture', '', '01.LAGUNA PORTFOLIO-01.jpg', 1),
(359, 79, 'picture', '', '02.LAGUNA PORTFOLIO-02.jpg', 2),
(360, 79, 'picture', '', '03.LAGUNA PORTFOLIO-03.jpg', 3),
(361, 79, 'picture', '', '04.LAGUNA PORTFOLIO-04.jpg', 4),
(356, 78, 'picture', '', '06.Ake_05_logo.jpg', 6),
(349, 77, 'picture', '', '07.AU_06_logo.jpg', 7),
(350, 77, 'picture', '', '08.AU_07_1_logo.jpg', 8),
(351, 78, 'picture', '', '01.Ake_06_logo.jpg', 1),
(352, 78, 'picture', '', '02.Ake_01_logo.jpg', 2),
(353, 78, 'picture', '', '03.Ake_02_logo.jpg', 3),
(354, 78, 'picture', '', '04.Ake_03_logo.jpg', 4),
(355, 78, 'picture', '', '05.Ake_04_logo.jpg', 5),
(364, 79, 'picture', '', '07.LAGUNA PORTFOLIO-07.jpg', 7),
(357, 78, 'picture', '', '07.Ake_07_logo.jpg', 7),
(340, 76, 'picture', '', '08.jpg', 8),
(337, 76, 'picture', '', '02.jpg', 7),
(338, 76, 'picture', '', '01.jpg', 6),
(335, 76, 'picture', '', '05.jpg', 5),
(332, 76, 'picture', '', '04.jpg', 4),
(339, 76, 'picture', '', '09.jpg', 3),
(334, 76, 'picture', '', '06.jpg', 1),
(333, 76, 'picture', '', '07.jpg', 2),
(293, 75, 'picture', '', '02.Lagunashore_02.jpg', 1),
(294, 75, 'picture', '', '01.Lagunashore_01.jpg', 2),
(218, 75, 'picture', '', '03.Lagunashore_03.jpg', 3),
(219, 75, 'picture', '', '04.Lagunashore_04.jpg', 4),
(328, 75, 'picture', '', '08.Lagunashore_05.jpg', 9),
(327, 75, 'picture', '', '07.Lagunashore_06.jpg', 8),
(326, 75, 'picture', '', '06.Lagunashore_07.jpg', 7),
(325, 75, 'picture', '', '05.Lagunashore_09.jpg', 6),
(324, 75, 'picture', '', '04.Lagunashore_08.jpg', 5),
(290, 69, 'picture', '', 'Cassia1.jpg', 7),
(227, 69, 'picture', '', 'Cassia2.jpg', 2),
(228, 69, 'picture', '', 'Cassia3.jpg', 3),
(229, 69, 'picture', '', 'Cassia4.jpg', 4),
(230, 69, 'picture', '', 'Cassia5.jpg', 5),
(231, 69, 'picture', '', 'Cassia6.jpg', 6),
(291, 69, 'picture', '', 'Cassia7.jpg', 1),
(233, 69, 'picture', '', 'Cassia8.jpg', 8),
(292, 68, 'picture', '', 'BANYANTREE PORTFOLIO-00-01.jpg', 1),
(235, 68, 'picture', '', 'BANYANTREE PORTFOLIO-01.jpg', 2),
(236, 68, 'picture', '', 'BANYANTREE PORTFOLIO-02.jpg', 3),
(237, 68, 'picture', '', 'BANYANTREE PORTFOLIO-03.jpg', 4),
(238, 68, 'picture', '', 'BANYANTREE PORTFOLIO-04.jpg', 5),
(239, 68, 'picture', '', 'BANYANTREE PORTFOLIO-05.jpg', 6),
(240, 68, 'picture', '', 'BANYANTREE PORTFOLIO-06.jpg', 7),
(241, 68, 'picture', '', 'BANYANTREE PORTFOLIO-07.jpg', 8),
(242, 68, 'picture', '', 'BANYANTREE PORTFOLIO-08.jpg', 9),
(243, 68, 'picture', '', 'BANYANTREE PORTFOLIO-09.jpg', 10),
(244, 68, 'picture', '', 'BANYANTREE PORTFOLIO-10.jpg', 11),
(245, 67, 'picture', '', 'Dim Sum Lover1.jpg', 1),
(246, 67, 'picture', '', 'Dim Sum Lover2.jpg', 2),
(247, 67, 'picture', '', 'Dim Sum Lover3.jpg', 3),
(248, 67, 'picture', '', 'Dim Sum Lover4.jpg', 4),
(249, 67, 'picture', '', 'Dim Sum Lover5.jpg', 5),
(250, 67, 'picture', '', 'Dim Sum Lover6.jpg', 6),
(251, 67, 'picture', '', 'Dim Sum Lover7.jpg', 7),
(252, 66, 'picture', '', '01.L1001395_R.jpg', 1),
(253, 66, 'picture', '', '02.L1001279_R.jpg', 2),
(254, 66, 'picture', '', '03.01.L1001369_R.jpg', 3),
(255, 66, 'picture', '', '04.hungry.jpg', 4),
(426, 86, 'picture', '', '03.FOMO  PORTFOLIO-03.jpg', 3),
(427, 86, 'picture', '', '04.FOMO  PORTFOLIO-04.jpg', 4),
(428, 86, 'picture', '', '05.FOMO  PORTFOLIO-05.jpg', 5),
(429, 86, 'picture', '', '06.FOMO  PORTFOLIO-06.jpg', 6),
(430, 86, 'picture', '', '07.FOMO  PORTFOLIO-07.jpg', 7),
(348, 77, 'picture', '', '06.AU_05_logo.jpg', 6),
(503, 95, 'picture', '', 'HAPPY DIARY_PORTFOLIO-11.jpg', 11),
(502, 95, 'picture', '', 'HAPPY DIARY_PORTFOLIO-10.jpg', 10),
(501, 95, 'picture', '', 'HAPPY DIARY_PORTFOLIO-09.jpg', 9),
(500, 95, 'picture', '', 'HAPPY DIARY_PORTFOLIO-08.jpg', 8),
(499, 95, 'picture', '', 'HAPPY DIARY_PORTFOLIO-07.jpg', 7),
(498, 95, 'picture', '', 'HAPPY DIARY_PORTFOLIO-06.jpg', 6),
(497, 95, 'picture', '', 'HAPPY DIARY_PORTFOLIO-05.jpg', 5),
(496, 95, 'picture', '', 'HAPPY DIARY_PORTFOLIO-04.jpg', 4),
(495, 95, 'picture', '', 'HAPPY DIARY_PORTFOLIO-03.jpg', 3),
(494, 95, 'picture', '', 'HAPPY DIARY_PORTFOLIO-02.jpg', 2),
(493, 95, 'picture', '', 'HAPPY DIARY_PORTFOLIO-01.jpg', 1),
(511, 96, 'picture', '', 'ce6bef25737845.56349fdb9f0ed.jpg', 7),
(510, 96, 'picture', '', '9359be25737845.5634a72d43240.jpg', 6),
(509, 96, 'picture', '', '9117e125737845.553f7de6952cf.jpg', 5),
(508, 96, 'picture', '', '36bd4825737845.56349fdba40d6.jpg', 4),
(507, 96, 'picture', '', '9b1d7d25737845.56349fdb9a0e0.jpg', 3),
(506, 96, 'picture', '', '4bb8bc25737845.56349fdb8b64d.jpg', 2),
(505, 96, 'picture', '', '4f15b225737845.56349fdb926e5.jpg', 1),
(518, 98, 'picture', '', '06.jpg', 6),
(517, 98, 'picture', '', '05.jpg', 5),
(516, 98, 'picture', '', '04.jpg', 4),
(515, 98, 'picture', '', '03.jpg', 3),
(514, 98, 'picture', '', '02.jpg', 2),
(513, 98, 'picture', '', '01.jpg', 1),
(370, 80, 'picture', '', 'JK6.jpg', 6),
(371, 80, 'picture', '', 'JK7.jpg', 7),
(372, 80, 'picture', '', 'JK8.jpg', 8),
(373, 80, 'picture', '', 'JK9.jpg', 9),
(382, 81, 'picture', '', 'AMD9.jpg', 9),
(383, 81, 'picture', '', 'AMD10.jpg', 10),
(384, 81, 'picture', '', 'AMD11.jpg', 11),
(394, 82, 'picture', '', 'Dir49.jpg', 9),
(395, 82, 'picture', '', 'Dir410.jpg', 10),
(396, 82, 'picture', '', 'Dir411.jpg', 11),
(397, 83, 'picture', '', '01.L1002423-01.jpg', 1),
(398, 83, 'picture', '', '02.L1002423-02.jpg', 2),
(399, 83, 'picture', '', '03.L1002423-05.jpg', 3),
(400, 83, 'picture', '', '04.L1002423-07.jpg', 4),
(401, 83, 'picture', '', '05.L1002423-08.jpg', 5),
(402, 83, 'picture', '', '06.L1002423-06.jpg', 6),
(403, 83, 'picture', '', '07.L1002423-04.jpg', 7),
(409, 84, 'picture', '', '06.jpg', 6),
(410, 84, 'picture', '', '07.jpg', 7),
(411, 84, 'picture', '', '08.jpg', 8),
(422, 85, 'picture', '', '11.6683_183736035109285_414078304_n.jpg', 11),
(423, 85, 'picture', '', '12.work-9-2.jpg', 12),
(431, 86, 'picture', '', '08.FOMO  PORTFOLIO-08.jpg', 8),
(432, 86, 'picture', '', '09.FOMO  PORTFOLIO-09.jpg', 9),
(437, 87, 'picture', '', '05.AOG_06.jpg', 5),
(438, 87, 'picture', '', '06.AOG_03.jpg', 6),
(447, 89, 'picture', '', '04.c4ab5273fd421e01d32c2713fbc0410a.jpg', 4),
(448, 89, 'picture', '', '05.6623ef95a3e1ad27949d1d69dc346e99.jpg', 5),
(462, 91, 'picture', '', 'f9fd1b2098e50860516b7f99252c2bfb.jpg', 6),
(470, 92, 'picture', '', '08.DDAY PORTFOLIO-08.jpg', 8),
(491, 94, 'picture', '', 'PADTHAI-10.jpg', 10),
(492, 94, 'picture', '', 'PADTHAI-11.jpg', 11),
(512, 96, 'picture', '', '4fc5f725737845.56349fdba8635.jpg', 8),
(519, 98, 'picture', '', '07.jpg', 7),
(520, 98, 'picture', '', '09.jpg', 8),
(521, 98, 'picture', '', '10.jpg', 9),
(522, 98, 'picture', '', '11.jpg', 10),
(523, 98, 'picture', '', '12.jpg', 11),
(524, 98, 'picture', '', '13.jpg', 12),
(525, 98, 'picture', '', '14.jpg', 13),
(526, 97, 'picture', '', '01.jpg', 1),
(527, 97, 'picture', '', '02.jpg', 2),
(528, 97, 'picture', '', '03.jpg', 3),
(529, 97, 'picture', '', '04.jpg', 4),
(530, 97, 'picture', '', '05.jpg', 5),
(531, 97, 'picture', '', '06.jpg', 6),
(532, 99, 'picture', '', '1.jpg', 1),
(533, 99, 'picture', '', '2.jpg', 2),
(534, 99, 'picture', '', '3.jpg', 3),
(535, 99, 'picture', '', '4.jpg', 4),
(536, 99, 'picture', '', '5.jpg', 5),
(537, 99, 'picture', '', '6.jpg', 6),
(538, 99, 'picture', '', '7.jpg', 7),
(539, 99, 'picture', '', '8.gif', 8),
(540, 99, 'picture', '', '9.jpg', 9),
(541, 99, 'picture', '', '10.jpg', 10),
(542, 99, 'picture', '', '11.jpg', 11),
(543, 99, 'picture', '', '12.jpg', 12),
(544, 100, 'picture', '', 'frame1.jpg', 1),
(545, 100, 'picture', '', 'frame2.jpg', 2),
(546, 100, 'picture', '', 'frame3.jpg', 3),
(547, 100, 'picture', '', 'frame4.jpg', 4),
(548, 100, 'picture', '', 'frame6.jpg', 5),
(549, 100, 'picture', '', 'frame7.jpg', 7),
(550, 101, 'picture', '', '1.jpg', 1),
(551, 101, 'picture', '', '2.jpg', 2),
(552, 101, 'picture', '', '3.jpg', 3),
(553, 101, 'picture', '', '4.jpg', 4),
(554, 101, 'picture', '', '5.jpg', 5),
(555, 101, 'picture', '', '6.jpg', 6),
(556, 101, 'picture', '', '7.jpg', 7),
(557, 102, 'picture', '', '1.jpg', 1),
(558, 102, 'picture', '', '2.jpg', 2),
(559, 102, 'picture', '', '3.jpg', 3),
(560, 102, 'picture', '', '4.jpg', 4),
(561, 102, 'picture', '', '5.jpg', 5),
(562, 102, 'picture', '', '6.jpg', 6),
(563, 103, 'picture', '', '01.jpg', 1),
(564, 103, 'picture', '', '02.jpg', 2),
(565, 103, 'picture', '', '03.jpg', 3),
(566, 103, 'picture', '', '04.jpg', 4),
(567, 103, 'picture', '', '05.jpg', 5),
(568, 103, 'picture', '', '06.gif', 6),
(569, 104, 'picture', '', '01.jpg', 1),
(570, 104, 'picture', '', '02.jpg', 2),
(571, 104, 'picture', '', '03.jpg', 3),
(572, 104, 'picture', '', '04.jpg', 4),
(573, 104, 'picture', '', '05.jpg', 5),
(574, 104, 'picture', '', '06.jpg', 6),
(575, 104, 'picture', '', '07.jpg', 7),
(576, 105, 'picture', '', '1.jpg', 1),
(577, 105, 'picture', '', '2.jpg', 2),
(578, 105, 'picture', '', '3.jpg', 3),
(579, 105, 'picture', '', '4.jpg', 4),
(580, 105, 'picture', '', '5.jpg', 5),
(581, 105, 'picture', '', '6.jpg', 6),
(582, 105, 'picture', '', '7.jpg', 7),
(583, 105, 'picture', '', '8.jpg', 8),
(584, 105, 'picture', '', '9.jpg', 9),
(585, 105, 'picture', '', '10.jpg', 10);

-- --------------------------------------------------------

--
-- Table structure for table `m_company`
--

CREATE TABLE IF NOT EXISTS `m_company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `m_company`
--

INSERT INTO `m_company` (`id`, `email`) VALUES
(1, 'info@mydm.me');

-- --------------------------------------------------------

--
-- Table structure for table `m_user`
--

CREATE TABLE IF NOT EXISTS `m_user` (
  `username` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `company_id` int(11) NOT NULL,
  `email` varchar(80) NOT NULL,
  `name` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `user_type` varchar(20) NOT NULL,
  `status` varchar(15) NOT NULL DEFAULT 'Active',
  `last_access_time` datetime NOT NULL,
  `updated_time` datetime NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `m_user`
--

INSERT INTO `m_user` (`username`, `password`, `company_id`, `email`, `name`, `surname`, `user_type`, `status`, `last_access_time`, `updated_time`) VALUES
('admin', 'fe01ce2a7fbac8fafaed7c982a04e229', 1, 'ttoonn112@gmail.com', 'Administrator', '', 'admin', 'Active', '2017-08-24 13:47:43', '2013-07-30 12:54:43'),
('admin2', 'b95f379f6ae245614d2f949801524317', 1, 'test@gmail.com', 'Administrator', '', 'admin', 'Active', '2014-07-01 18:24:26', '2013-07-30 12:54:43');

-- --------------------------------------------------------

--
-- Table structure for table `sto_blog`
--

CREATE TABLE IF NOT EXISTS `sto_blog` (
  `blog_id` int(11) NOT NULL AUTO_INCREMENT,
  `blog_title` varchar(200) CHARACTER SET utf8 NOT NULL,
  `blog_content` varchar(6000) CHARACTER SET utf8 NOT NULL,
  `blog_thumb_img` varchar(300) CHARACTER SET utf8 NOT NULL,
  `blog_information` varchar(500) CHARACTER SET utf8 DEFAULT NULL,
  `blog_status` varchar(40) NOT NULL,
  `blog_type` varchar(100) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`blog_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=tis620 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `sto_blog`
--

INSERT INTO `sto_blog` (`blog_id`, `blog_title`, `blog_content`, `blog_thumb_img`, `blog_information`, `blog_status`, `blog_type`) VALUES
(9, 'Give your home a life', '<p>&nbsp;Our pattern can bring thid wood house fun and colorful.</p>\r\n', '20160802100941mydm-inspiration.jpg', ' Our pattern can bring thid wood house fun and colorful.', 'active', 'inspiring design'),
(10, 'MYDM is coming to town', '<p>Patterns and details in every small thing are our indulgence. We dedicate to make every item and every detail with heart. Get inspired by our delicate handcraft patterns.</p>\r\n\r\n<p><img alt="" src="http://mydm.me/store/admin/library/responsive_filemanager/source/collection08.jpg?1470644315866" style="height:922px; width:1382px" /></p>\r\n\r\n<p><strong>PATTERNS &amp; INSPIRATION OF THE COLLECTION</strong></p>\r\n\r\n<p>From our background of designer\r\nand home maker, plus our love of\r\nhandcraft, we combine these two\r\ninto a perfect blend, reflecting\r\nin our work of functional and\r\ninspring home and style items for\r\neveryday use.</p>\r\n<p>This collection “Cut and Paint”\r\nportrays our passion in handcraft,\r\npattern, painting, paper work,\r\nscreening, and cutting. With the\r\nlively colour combination, “Cut\r\nand Paint” collection is designed\r\nto inspire you,</p>\r\n', '20160802100833mydm-journal.jpg', 'Because details matter, and handcraft is the best.We cut, we paint, we brush, we screen.', 'active', 'press');

-- --------------------------------------------------------

--
-- Table structure for table `sto_blog_tags`
--

CREATE TABLE IF NOT EXISTS `sto_blog_tags` (
  `blog_id` int(11) NOT NULL,
  `blog_tag_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  KEY `index_blog_id` (`blog_id`)
) ENGINE=InnoDB DEFAULT CHARSET=tis620;

--
-- Dumping data for table `sto_blog_tags`
--

INSERT INTO `sto_blog_tags` (`blog_id`, `blog_tag_name`) VALUES
(10, 'Design'),
(10, 'MYDM'),
(10, 'inspiration'),
(9, 'Design'),
(9, 'Texture');

-- --------------------------------------------------------

--
-- Table structure for table `sto_care_icon`
--

CREATE TABLE IF NOT EXISTS `sto_care_icon` (
  `p_id` int(11) NOT NULL,
  `p_icon_id` int(11) NOT NULL,
  KEY `index_p_icon_id` (`p_icon_id`)
) ENGINE=InnoDB DEFAULT CHARSET=tis620;

--
-- Dumping data for table `sto_care_icon`
--

INSERT INTO `sto_care_icon` (`p_id`, `p_icon_id`) VALUES
(16, 1),
(16, 2),
(16, 3),
(17, 1),
(17, 2),
(17, 3),
(15, 1),
(15, 2),
(15, 3),
(6, 1),
(6, 2),
(6, 3),
(7, 1),
(7, 2),
(7, 3);

-- --------------------------------------------------------

--
-- Table structure for table `sto_category`
--

CREATE TABLE IF NOT EXISTS `sto_category` (
  `p_cate_id` int(11) NOT NULL,
  `p_cate_name` varchar(300) NOT NULL,
  PRIMARY KEY (`p_cate_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sto_category`
--

INSERT INTO `sto_category` (`p_cate_id`, `p_cate_name`) VALUES
(1, 'Home & Living'),
(2, 'Wear'),
(3, 'Fabric');

-- --------------------------------------------------------

--
-- Table structure for table `sto_fav_list`
--

CREATE TABLE IF NOT EXISTS `sto_fav_list` (
  `fav_id` int(11) NOT NULL AUTO_INCREMENT,
  `u_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  PRIMARY KEY (`fav_id`),
  KEY `u_id` (`u_id`),
  KEY `p_id` (`p_id`)
) ENGINE=InnoDB DEFAULT CHARSET=tis620 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sto_icon_refer`
--

CREATE TABLE IF NOT EXISTS `sto_icon_refer` (
  `p_icon_id` int(11) NOT NULL AUTO_INCREMENT,
  `p_icon_img` varchar(500) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`p_icon_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=tis620 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `sto_icon_refer`
--

INSERT INTO `sto_icon_refer` (`p_icon_id`, `p_icon_img`) VALUES
(1, 'care-icon1.png'),
(2, 'care-icon2.png'),
(3, 'care-icon3.png'),
(4, 'care-icon4.png');

-- --------------------------------------------------------

--
-- Table structure for table `sto_pattern`
--

CREATE TABLE IF NOT EXISTS `sto_pattern` (
  `p_pattern_id` int(11) NOT NULL,
  `p_pattern_name` varchar(300) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`p_pattern_id`)
) ENGINE=InnoDB DEFAULT CHARSET=tis620;

--
-- Dumping data for table `sto_pattern`
--

INSERT INTO `sto_pattern` (`p_pattern_id`, `p_pattern_name`) VALUES
(1, 'Paint & Point'),
(2, 'Dash & Tear'),
(3, 'Brush & Brushing');

-- --------------------------------------------------------

--
-- Table structure for table `sto_products`
--

CREATE TABLE IF NOT EXISTS `sto_products` (
  `p_id` int(11) NOT NULL AUTO_INCREMENT,
  `seq` int(11) DEFAULT NULL,
  `p_name` varchar(500) NOT NULL,
  `p_title` varchar(500) CHARACTER SET utf16 DEFAULT NULL,
  `p_code` varchar(50) NOT NULL,
  `p_description` varchar(500) DEFAULT NULL,
  `p_information` varchar(500) DEFAULT NULL,
  `p_material` varchar(500) DEFAULT NULL,
  `p_cate_id` int(11) DEFAULT NULL,
  `p_pattern_id` int(11) DEFAULT NULL,
  `p_price` double NOT NULL,
  `p_quantity` int(11) NOT NULL,
  `p_thumb_image` varchar(500) NOT NULL,
  `p_ref1_id` int(11) DEFAULT NULL,
  `p_ref2_id` int(11) DEFAULT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`p_id`),
  KEY `index_p_cate_id` (`p_cate_id`),
  KEY `p_pattern_id` (`p_pattern_id`),
  KEY `index_p_ref1` (`p_ref1_id`),
  KEY `index_p_red2` (`p_ref2_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `sto_products`
--

INSERT INTO `sto_products` (`p_id`, `seq`, `p_name`, `p_title`, `p_code`, `p_description`, `p_information`, `p_material`, `p_cate_id`, `p_pattern_id`, `p_price`, `p_quantity`, `p_thumb_image`, `p_ref1_id`, `p_ref2_id`, `time_stamp`) VALUES
(6, 13, 'Apron', '“ Cooking in style is a must. ”', 'CA003', 'Cooking in style is a must for modern mom/ homemaker/single ladies who cook! Whoever you are, just don’t go to your kitchen without nice apron. Why? A well designed apron will bring you creativity in whatever you are cooking. If you want a deliciously unique meal, put on our Cut and Paint apron first.', '<p>Item no: CA003<br />\r\nSize: 56 x 82 cm</p>\r\n', 'It’s 100% linen and leather stripe with handcraft pattern, with 3 patterns\r\nto choose and mix.', 1, 3, 61, 0, '20160930140521ca003.jpg', NULL, NULL, '2016-09-30 07:05:21'),
(7, 15, 'Square Pillow Case', '“Comfy is not enough for your couch, pattern it up! ”', 'CP001', 'A couch is the first thing your guests will see when enter your house and the first thing you think of when you’re tired. I know it’s comfy, but it looks sad and plain. So just colour it up with our cool Cut and Paint pillow case. And your guests will be WOW and your tiresome will fly away.', '<p>Item no: CP001<br />\r\nSize: 50 x 50 cm</p>\r\n', 'It’s 100% linen with handcraft pattern, with 3 patterns to choose and mix.', 2, 1, 33, 0, '20161004145935cp001.jpg', NULL, NULL, '2016-10-04 07:59:35'),
(8, 14, 'Cushion Case', '“Lean on something cool, Me! ”', 'CC002', 'Sometimes (most of the time, actually) we need something special to lean on, something to vibrate our life, starting from our living room. Here we go, Cut and Paint cushion, a graphic warm cushion to not only decorate your couch, but lift up your spirit.', '<p>Item no: CC002<br />\r\nSize: 30 x 60 cm</p>\r\n', 'It’s 100% linen with handcraft pattern, with 3 patterns to choose and mix.', 1, 2, 33, 0, '20161004175641cc002.jpg', NULL, NULL, '2016-10-04 10:56:41'),
(9, 12, 'Pot Holder', '“ Be careful! The Pot is hot, so as its holder! ”', 'CH001', 'Hot pot, hot plate or hot bowl are cool when they’re on hotter holder. Small hot piece can change the ambience of your kitchen or dining table. If you spend so much time in your kitchen, you won’t get bore if you got this hot Cut and Paint pot holder.', '<p>Item no: CH001<br />\r\nSize: 19 x 19 cm</p>\r\n', 'It’s 100% linen with handcraft pattern, with 3 patterns to choose and mix.', 1, 1, 17, 0, '20161005070245ch001.jpg', NULL, NULL, '2016-10-05 00:02:45'),
(10, 11, 'Glove', '“ Something better than your wedding ring in the kitchen? Our glove. ”', 'CG002', 'A wedding ring does no good in the kitchen, but our glove doesn’t. Cool design glove not just protect your hand with its cushion, but also give you a happy cooking time. Just look at its colourful Cut and Paint pattern, you can’t stop smiling (but don’t forget to cook, someone is waiting for a meal).', '<p>Item no: CG002<br />\r\nSize: 16 x 28 cm</p>\r\n', 'It’s 100% linen and synthetic fiber with handcraft pattern, with 3 patterns to choose and mix.', 1, 2, 30, 0, '20161005075216cg002.jpg', NULL, NULL, '2016-10-05 00:52:16'),
(11, 10, 'Table Runner', '“ U know that design increases your appetite? Try our table runner then. ”', 'CR003', 'Style your table with our Cut and Paint table runner and it will lift up your mood and of course your appetite. When you are in good dining mood, love will be shared, stories will be told, care will be shown, and that’s just a perfect dining time.', '<p>Item no: CR003<br />\r\nSize: 258 x 35 cm</p>\r\n', 'It’s 100% linen with handcraft pattern, with 3 patterns to choose and mix.', 1, 3, 97, 0, '20161005174441cr003.jpg', NULL, NULL, '2016-10-05 10:44:41'),
(12, 9, 'Placemat', '“ When you plates need a good company. ”', 'CM001', 'The secret for perfect dining is you and your plates got a good company. I know you got yours, so now take one for your plates. The Cut and Paint placemat that can light up your plain white plates, they will keep smiling without you knowing.', '<p>Item no: CM001<br />\r\nSize: 32 x 47 cm</p>\r\n', 'It’s 100% linen with handcraft pattern, with 3 patterns to choose and mix.', 1, 1, 21, 0, '20161008123510cm001.jpg', NULL, NULL, '2016-10-08 05:35:10'),
(13, 8, 'Coaster', '“ Accompany your mug with random pattern. ”', 'cc004', 'Get the whole lot of our Cut and Paint coaster and amuse yourself and your mug each day with its random pattern, a good way to start your day. Even a small piece of detail can make you smile, and your coffee or tea will taste load better.', '<p>Item no: CC004<br />\r\nSize: 9 x 9 cm</p>\r\n', 'It’s 100% linen with handcraft pattern, with 3 patterns to choose and mix.', 1, 2, 9, 0, '20161009115328cc004.jpg', NULL, NULL, '2016-10-09 04:53:28'),
(14, 7, 'Tote Bag', '“ Throw everything in here, chin up and go out. ”', 'CT001', 'What a lady wants more than a lively functional tote bag! A well-made bag, so neat in every detail with strip leather and inside pocket, can make your day. It will match your cloth, lift up your style and keep everything in one piece. So just grab Cut and Paint tote bag, go out and have a good time.', '<p>Item no: CT001<br />\r\nSize: 43 x 46 cm</p>\r\n', 'It’s 100% linen and leather with handcraft pattern, with 3 patterns to choose and mix.', 1, 1, 83, 0, '20161009231902ct001.jpg', NULL, NULL, '2016-10-09 16:19:02'),
(15, 6, 'Drawstring Bag', '“ It’s time your back needs a lavish back up. ”', 'CD001', 'When you need to draw attention to your back, give it a good back up. Our Cut and Paint drawstring bag, with linen in the front and silver leather on the bag, is not just cool in its look, but very functional in its use. When you put on your sneakers but still need something lavish, take this.', '<p>Item no: CD002<br />\r\nSize: 33 x 44 cm</p>\r\n', 'It’s 100% linen and leather with handcraft pattern, with 3 patterns to choose and mix.', 1, 2, 125, 0, '20161010002937cd001.jpg', NULL, NULL, '2016-10-09 17:29:37'),
(16, 5, 'Coin Purse', '“ Even a coin needs a good place to sleep in. ”', 'CU003', 'Japanese said taking good care of your money (physically) and it will grow. So put your coins in a nice and well-designed place. Our Cut and Paint purse is uniquely designed, from a rectangle cloth folded into triangle purse. Have fun keeping your coin and be surprise when they grow.', '<p>Item no: CU003<br />\r\nSize: 9.5 x 9 cm</p>\r\n', 'It’s 100% linen with handcraft pattern, with 3 patterns to choose and mix.', 1, 3, 10, 0, '20161010003818cu003.jpg', NULL, NULL, '2016-10-09 17:38:18'),
(17, 4, 'Cosmetic Bag', '“ Makeup can change your life, so as the bag. ”', 'CE001', 'Makeup needs inspiration, but inspiration can’t be found in a mundane place. So get start with your cosmetic bag, let our Cut and Paint bag inspire your look. Dark blue eyes with red lips or fancy your face with pink and green eye shadow, you choose.', '', 'It’s 100% linen with handcraft pattern, with 3 patterns to choose and mix.', 1, 3, 18, 0, '20161010011743ce001.jpg', NULL, NULL, '2016-10-09 18:17:43');

-- --------------------------------------------------------

--
-- Table structure for table `sto_product_collection`
--

CREATE TABLE IF NOT EXISTS `sto_product_collection` (
  `collect_id` int(11) NOT NULL AUTO_INCREMENT,
  `p_id` int(11) NOT NULL,
  `type` varchar(50) CHARACTER SET utf8 NOT NULL,
  `p_img` varchar(500) CHARACTER SET utf8 NOT NULL,
  `p_img_show` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `seq` int(11) NOT NULL,
  PRIMARY KEY (`collect_id`),
  KEY `p_id` (`p_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=tis620 AUTO_INCREMENT=74 ;

--
-- Dumping data for table `sto_product_collection`
--

INSERT INTO `sto_product_collection` (`collect_id`, `p_id`, `type`, `p_img`, `p_img_show`, `seq`) VALUES
(40, 8, 'picture', '01.jpg', '01.jpg', 1),
(41, 6, 'picture', '01.jpg', '01.jpg', 1),
(42, 9, 'picture', '01.jpg', '01.jpg', 1),
(43, 10, 'picture', '01.jpg', '01.jpg', 1),
(44, 11, 'picture', '01.jpg', '01.jpg', 1),
(53, 12, 'picture', '01.jpg', '01.jpg', 1),
(61, 13, 'picture', '01.jpg', '01.jpg', 1),
(62, 14, 'picture', '01.jpg', '01.jpg', 1),
(63, 15, 'picture', '01.jpg', '01.jpg', 1),
(64, 16, 'picture', '01.jpg', '01.jpg', 1),
(65, 17, 'picture', '01.jpg', '01.jpg', 1),
(66, 12, 'picture', '02.jpg', '02.jpg', 2),
(68, 7, 'picture', '01.jpg', '01.jpg', 1),
(69, 7, 'picture', '02.jpg', '02.jpg', 2),
(70, 7, 'picture', '03.jpg', '03.jpg', 3),
(71, 7, 'picture', '04.jpg', '04.jpg', 4),
(72, 7, 'picture', '05.jpg', '05.jpg', 5),
(73, 7, 'picture', '06.jpg', '06.jpg', 6);

-- --------------------------------------------------------

--
-- Table structure for table `sto_product_descrip_img`
--

CREATE TABLE IF NOT EXISTS `sto_product_descrip_img` (
  `p_id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `p_img` varchar(500) NOT NULL,
  `seq` int(11) NOT NULL,
  KEY `p_id` (`p_id`)
) ENGINE=InnoDB DEFAULT CHARSET=tis620;

--
-- Dumping data for table `sto_product_descrip_img`
--

INSERT INTO `sto_product_descrip_img` (`p_id`, `type`, `p_img`, `seq`) VALUES
(7, 'picture', '01.jpg', 1),
(7, 'picture', '02.jpg', 2),
(14, 'picture', '01.jpg', 1),
(12, 'picture', '01.jpg', 1),
(15, 'picture', '01.jpg', 1),
(13, 'picture', '01.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sto_product_link`
--

CREATE TABLE IF NOT EXISTS `sto_product_link` (
  `p_head_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  KEY `p_head_id` (`p_head_id`),
  KEY `p_id` (`p_id`)
) ENGINE=InnoDB DEFAULT CHARSET=tis620;

-- --------------------------------------------------------

--
-- Table structure for table `sto_purchased`
--

CREATE TABLE IF NOT EXISTS `sto_purchased` (
  `u_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `transaction_id` varchar(200) DEFAULT NULL,
  `purchased_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  KEY `u_id` (`u_id`),
  KEY `p_id` (`p_id`)
) ENGINE=InnoDB DEFAULT CHARSET=tis620;

-- --------------------------------------------------------

--
-- Table structure for table `sto_user`
--

CREATE TABLE IF NOT EXISTS `sto_user` (
  `u_id` int(11) NOT NULL AUTO_INCREMENT,
  `u_name` varchar(100) NOT NULL,
  `u_email` varchar(100) NOT NULL,
  `u_login` varchar(50) NOT NULL,
  `u_password` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `usertype` varchar(50) NOT NULL,
  `u_country` varchar(50) NOT NULL,
  `u_zipcode` varchar(20) NOT NULL,
  `u_address` varchar(100) NOT NULL,
  `last_access_time` datetime NOT NULL,
  PRIMARY KEY (`u_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `sto_user`
--

INSERT INTO `sto_user` (`u_id`, `u_name`, `u_email`, `u_login`, `u_password`, `status`, `usertype`, `u_country`, `u_zipcode`, `u_address`, `last_access_time`) VALUES
(1, 'peekung', 'peekung114@gmail.com', 'navapon.t', 'a7c3026022b0c0544eb06b753b1551e0', 'Active', 'user', 'Thailand', '11111', 'assume asdfgasd', '2017-03-29 11:26:52'),
(2, 'test', 'test', 'test1', '81dc9bdb52d04dc20036dbd8313ed055', 'Active', 'user', 'Thailand', '1234', '1234', '2016-07-30 21:08:07'),
(3, 'Test', 'Test@gmail.com', 'test1', 'c06db68e819be6ec3d26c6038d8e8d1f', 'Active', 'user', 'Thailand', '10160', '231f กฟหก กฟหกฟห ฟหกฟหก', '2016-07-30 21:08:07'),
(4, 'DAVID BACKHAM', 'peekung114@gmail.com', 'devid', '656abb61a789b19b0f9502b3d00982eb', 'Active', 'user', 'Thailand', '10160', 'Hello world this is my addr', '2016-08-14 22:48:34'),
(5, 'Petertester', 'oudluck@hotmail.com', 'Petertester', 'f552b9e8f043a821f6c6ada1c90d3a64', 'Active', 'user', 'Thailand', '10160', 'Bangkhae, Bangkok', '2016-08-23 15:53:51'),
(6, 'user1', 'user1@gmail.com', 'user1', '24c9e15e52afc47c225b757e7bee1f9d', 'Active', 'user', 'Taiwan', '10600', 'asdasdasdasd11a6a2d6s26as2d0asas/asd6asdasf1as3', '2016-08-25 19:09:27'),
(7, 'Subhawita Klunson', 'phai.subhawita@gmail.com', 'phaicotton', '467837462c957f1a7149554cfb4546f6', 'Active', 'user', 'Thailand', '10260', '13 Sukhumvit 85\r\nBangjak', '2017-01-11 12:24:17'),
(8, 'Subhawita Klunson', 'phai.subhawita@gmail.com', 'phaicotton', 'd41d8cd98f00b204e9800998ecf8427e', 'Active', 'user', 'Thailand', '10260', '13 Sukhumvit 85\r\nBangjak', '2017-01-11 12:24:26'),
(9, '', '', '', 'd41d8cd98f00b204e9800998ecf8427e', 'Active', 'user', '- please select -', '', '', '2017-03-04 12:38:56'),
(10, 'aa', 'aaa', 'aaa', 'b59c67bf196a4758191e42f76670ceba', 'Active', 'user', 'Albania', '1111', '11111', '2017-01-19 11:14:31'),
(11, '1', '1', '1111', 'b59c67bf196a4758191e42f76670ceba', 'Active', 'user', 'Albania', '1111', '1111', '2017-01-19 11:16:50'),
(12, '', '', '', 'd41d8cd98f00b204e9800998ecf8427e', 'Active', 'user', '- please select -', '', '', '2017-03-04 13:05:20'),
(13, 'ฟหกฟหก', '', '', 'd41d8cd98f00b204e9800998ecf8427e', 'Active', 'user', '- please select -', '', '', '2017-03-19 22:14:16'),
(14, 'a', 'a', 'a', 'd41d8cd98f00b204e9800998ecf8427e', 'Active', 'user', 'Algeria', '', 'asd', '2017-03-19 22:36:28'),
(15, 'Peter', 'oudluck@gmail.com', 'didihamann', 'f552b9e8f043a821f6c6ada1c90d3a64', 'Active', 'user', 'Thailand', '10160', '85 ฺBangkhae', '2017-03-29 11:32:32'),
(16, 'kan', 'i', 'i', '6786f3c62fbf9021694f6e51cc07fe3c', 'Active', 'user', 'Afganistan', '1010', '111', '2017-04-19 10:11:09');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sto_blog_tags`
--
ALTER TABLE `sto_blog_tags`
  ADD CONSTRAINT `sto_blog_tags_ibfk_1` FOREIGN KEY (`blog_id`) REFERENCES `sto_blog` (`blog_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sto_care_icon`
--
ALTER TABLE `sto_care_icon`
  ADD CONSTRAINT `sto_care_icon_ibfk_1` FOREIGN KEY (`p_icon_id`) REFERENCES `sto_icon_refer` (`p_icon_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sto_fav_list`
--
ALTER TABLE `sto_fav_list`
  ADD CONSTRAINT `sto_fav_list_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `sto_user` (`u_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sto_fav_list_ibfk_2` FOREIGN KEY (`p_id`) REFERENCES `sto_products` (`p_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sto_products`
--
ALTER TABLE `sto_products`
  ADD CONSTRAINT `sto_products_ibfk_1` FOREIGN KEY (`p_pattern_id`) REFERENCES `sto_pattern` (`p_pattern_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `sto_products_ibfk_2` FOREIGN KEY (`p_cate_id`) REFERENCES `sto_category` (`p_cate_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `sto_products_ibfk_7` FOREIGN KEY (`p_ref1_id`) REFERENCES `sto_products` (`p_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `sto_products_ibfk_8` FOREIGN KEY (`p_ref2_id`) REFERENCES `sto_products` (`p_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `sto_product_collection`
--
ALTER TABLE `sto_product_collection`
  ADD CONSTRAINT `sto_product_collection_ibfk_1` FOREIGN KEY (`p_id`) REFERENCES `sto_products` (`p_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sto_product_descrip_img`
--
ALTER TABLE `sto_product_descrip_img`
  ADD CONSTRAINT `sto_product_descrip_img_ibfk_1` FOREIGN KEY (`p_id`) REFERENCES `sto_products` (`p_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sto_product_link`
--
ALTER TABLE `sto_product_link`
  ADD CONSTRAINT `sto_product_link_ibfk_1` FOREIGN KEY (`p_head_id`) REFERENCES `sto_products` (`p_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sto_product_link_ibfk_2` FOREIGN KEY (`p_id`) REFERENCES `sto_products` (`p_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sto_purchased`
--
ALTER TABLE `sto_purchased`
  ADD CONSTRAINT `sto_purchased_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `sto_user` (`u_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `sto_purchased_ibfk_3` FOREIGN KEY (`p_id`) REFERENCES `sto_products` (`p_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
