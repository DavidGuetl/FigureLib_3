<?php
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright © 2002 - 2011 Nick Jones
| http://www.php-fusion.co.uk/
+--------------------------------------------------------+
| Filename: infusion.php
| Author: Khalid545
| URL: http://khalidb.co.cc/
| E-Mail: khalidd545@gmail.com
| 
| Modification: Catzenjaeger
| URL: www.aliencollectors.com
| E-Mail: admin@aliencollectors.com
+--------------------------------------------------------+
| This program is released as free software under the
| Affero GPL license. You can redistribute it and/or
| modify it under the terms of this license which you
| can read by viewing the included agpl.txt or online
| at www.gnu.org/licenses/agpl.html. Removal of this
| copyright header is strictly prohibited without
| written permission from the original author(s).
+--------------------------------------------------------*/
if (!defined("IN_FUSION")) { die("Access Denied"); }
include INFUSIONS."figurelib/infusion_db.php";

// LANGUAGE
if (!defined("FIGURELIB_LOCALE")) {
    if (file_exists(INFUSIONS."figurelib/locale/".LOCALESET."locale_figurelib.php")) {
        define("FIGURELIB_LOCALE", INFUSIONS."figurelib/locale/".LOCALESET."locale_figurelib.php");
    } else {
        define("FIGURELIB_LOCALE", INFUSIONS."figurelib/locale/English/locale_figurelib.php");
    }
}

$locale = fusion_get_locale("", FIGURELIB_LOCALE);

// INFUSION GENERAL INFORMATION
$inf_title = $locale['INF_TITLE'];
$inf_description = $locale['INF_DESC'];
$inf_version = "1.00";
$inf_developer = "Catzenjaeger";
$inf_email = "info@aliencollectors.com";
$inf_weburl = "http://www.AlienCollectors.com";
$inf_folder = "figurelib";
$inf_image = "figurelib.png";

// Position these links under Content Administration
$inf_adminpanel[] = array(
	"image" => $inf_image,
	"page" => 1,
	"rights" => "FI",
	"title" => $locale['INF_TITLE'],
	"panel" => "admin.php"
);

// Multilanguage table for Administration
$inf_mlt[] = array(
"title" => $locale['INF_ADMIN'],
"rights" => "FI",
);

// Create tables

$inf_newtable[] = DB_FIGURE_CATS." (
	figure_cat_id MEDIUMINT(8) UNSIGNED NOT NULL AUTO_INCREMENT,
	figure_cat_parent MEDIUMINT(8) UNSIGNED NOT NULL DEFAULT '0',
	figure_cat_name VARCHAR(100) NOT NULL DEFAULT '',
	figure_cat_description TEXT NOT NULL,
	figure_cat_sorting VARCHAR(50) NOT NULL DEFAULT 'figure_title ASC',
	figure_cat_language VARCHAR(50) NOT NULL DEFAULT '".LANGUAGE."',
	PRIMARY KEY(figure_cat_id)
) ENGINE=MyISAM DEFAULT CHARSET=UTF8 COLLATE=utf8_unicode_ci";
/////////////////////////////////////////////////////////////////////////////////
$inf_newtable[] = DB_FIGURE_ITEMS." (
		figure_id mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
		figure_freigabe tinyint(1) unsigned NOT NULL DEFAULT '0',
		figure_submitter varchar(200) NOT NULL DEFAULT '',
		figure_cat mediumint(8) unsigned NOT NULL DEFAULT '0',
		figure_title varchar(200) NOT NULL DEFAULT '',
		figure_variant varchar(200) NOT NULL DEFAULT '',
		figure_manufacturer varchar(200) NOT NULL DEFAULT '',
		figure_artists varchar(400) NOT NULL DEFAULT '',
		figure_country varchar(200) NOT NULL DEFAULT '',
		figure_brand varchar(200) NOT NULL DEFAULT '',
		figure_series varchar(200) NOT NULL DEFAULT '',
		figure_scale varchar(200) NOT NULL DEFAULT '',
		figure_weight varchar(200) NOT NULL DEFAULT '',
		figure_height varchar(200) NOT NULL DEFAULT '',
		figure_width varchar(200) NOT NULL DEFAULT '',
		figure_depth varchar(200) NOT NULL DEFAULT '',
		figure_material varchar(200) NOT NULL DEFAULT '',
		figure_poa varchar(200) NOT NULL DEFAULT '',
		figure_packaging varchar(200) NOT NULL DEFAULT '',
		figure_pubdate varchar(200) NOT NULL DEFAULT '',
		figure_retailprice decimal(8,2) NOT NULL,
		figure_usedprice decimal(8,2) NOT NULL,
		figure_limitation varchar(200) NOT NULL DEFAULT '',
		figure_editionsize decimal(8) NOT NULL,
		figure_forum_url varchar(200) NOT NULL DEFAULT '',
		figure_affiliate_1 varchar(500) NOT NULL DEFAULT '',
		figure_affiliate_2 varchar(500) NOT NULL DEFAULT '',
		figure_affiliate_3 varchar(500) NOT NULL DEFAULT '',
		figure_affiliate_4 varchar(500) NOT NULL DEFAULT '',
		figure_affiliate_5 varchar(500) NOT NULL DEFAULT '',
		figure_affiliate_6 varchar(500) NOT NULL DEFAULT '',
		figure_affiliate_7 varchar(500) NOT NULL DEFAULT '',
		figure_affiliate_8 varchar(500) NOT NULL DEFAULT '',
		figure_affiliate_9 varchar(500) NOT NULL DEFAULT '',
		figure_affiliate_10 varchar(500) NOT NULL DEFAULT '',
		figure_eshop varchar(400) NOT NULL DEFAULT '',
		figure_amazon_de varchar(400) NOT NULL DEFAULT '',
		figure_amazon_uk varchar(400) NOT NULL DEFAULT '',
		figure_amazon_fr varchar(400) NOT NULL DEFAULT '',
		figure_amazon_es varchar(400) NOT NULL DEFAULT '',
		figure_amazon_it varchar(400) NOT NULL DEFAULT '',
		figure_amazon_jp varchar(400) NOT NULL DEFAULT '',
		figure_amazon_com varchar(400) NOT NULL DEFAULT '',
		figure_amazon_ca varchar(400) NOT NULL DEFAULT '',
		figure_accessories text NOT NULL,
		figure_description text NOT NULL,
		figure_visibility TINYINT(4) NOT NULL DEFAULT '0',		
		figure_datestamp int(10) unsigned NOT NULL DEFAULT '0',
		figure_clickcount int(10) unsigned NOT NULL DEFAULT '0',
		figure_allow_comments tinyint(1) unsigned NOT NULL DEFAULT '1',
		figure_allow_ratings tinyint(1) unsigned NOT NULL DEFAULT '1',
		figure_sorting varchar(50) NOT NULL DEFAULT '',
		figure_language VARCHAR(50) NOT NULL DEFAULT '".LANGUAGE."',
		KEY figure_datestamp (figure_datestamp),
		KEY figure_clickcount (figure_clickcount),
		PRIMARY KEY (figure_id)
	) ENGINE=MyISAM DEFAULT CHARSET=UTF8 COLLATE=utf8_unicode_ci";
/////////////////////////////////////////////////////////////////////////////////	
/*
$inf_newtable[] = DB_FIGURE_SETTINGS." (
		settings_name varchar(200) NOT NULL DEFAULT '',
		settings_value text NOT NULL
		settings_inf text NOT NULL
	) ENGINE=MyISAM DEFAULT CHARSET=UTF8 COLLATE=utf8_unicode_ci";
*/	
/////////////////////////////////////////////////////////////////////////////////
$inf_newtable[] = DB_FIGURE_MANUFACTURERS." (
		figure_manufacturer_id mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
		figure_manufacturer_name varchar(100) NOT NULL DEFAULT '',
		figure_manufacturer_description text NOT NULL,
		figure_manufacturer_parent MEDIUMINT(8) UNSIGNED NOT NULL DEFAULT '0',
		figure_manufacturer_sorting varchar(50) NOT NULL DEFAULT '',
		figure_manufacturer_language VARCHAR(50) NOT NULL DEFAULT '".LANGUAGE."',
		PRIMARY KEY (figure_manufacturer_id)
	) ENGINE=MyISAM DEFAULT CHARSET=UTF8 COLLATE=utf8_unicode_ci";
/////////////////////////////////////////////////////////////////////////////////
$inf_newtable[] = DB_FIGURE_BRANDS." (
		figure_brand_id mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
		figure_brand_name varchar(100) NOT NULL DEFAULT '',
		figure_brand_description text NOT NULL,
		figure_brand_parent MEDIUMINT(8) UNSIGNED NOT NULL DEFAULT '0',
		figure_brand_sorting varchar(50) NOT NULL DEFAULT '',
		figure_brand_language VARCHAR(50) NOT NULL DEFAULT '".LANGUAGE."',
		PRIMARY KEY (figure_brand_id)
	) ENGINE=MyISAM DEFAULT CHARSET=UTF8 COLLATE=utf8_unicode_ci";
/////////////////////////////////////////////////////////////////////////////////
$inf_newtable[] = DB_FIGURE_MATERIALS." (
		figure_material_id mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
		figure_material_name varchar(100) NOT NULL DEFAULT '',
		figure_material_description text NOT NULL,
		figure_material_parent MEDIUMINT(8) UNSIGNED NOT NULL DEFAULT '0',
		figure_material_sorting varchar(50) NOT NULL DEFAULT '',
		figure_material_language VARCHAR(50) NOT NULL DEFAULT '".LANGUAGE."',
		PRIMARY KEY (figure_material_id)
	) ENGINE=MyISAM DEFAULT CHARSET=UTF8 COLLATE=utf8_unicode_ci";
/////////////////////////////////////////////////////////////////////////////////
$inf_newtable[] = DB_FIGURE_SCALES." (
		figure_scale_id mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
		figure_scale_name varchar(100) NOT NULL DEFAULT '',
		figure_scale_description text NOT NULL,
		figure_scale_parent MEDIUMINT(8) UNSIGNED NOT NULL DEFAULT '0',
		figure_scale_sorting varchar(50) NOT NULL DEFAULT '',
		figure_scale_language VARCHAR(50) NOT NULL DEFAULT '".LANGUAGE."',
		PRIMARY KEY (figure_scale_id)
	) ENGINE=MyISAM DEFAULT CHARSET=UTF8 COLLATE=utf8_unicode_ci";
/////////////////////////////////////////////////////////////////////////////////
$inf_newtable[] = DB_FIGURE_POAS." (
		figure_poa_id mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
		figure_poa_name varchar(100) NOT NULL DEFAULT '',
		figure_poa_description text NOT NULL,
		figure_poa_parent MEDIUMINT(8) UNSIGNED NOT NULL DEFAULT '0',
		figure_poa_sorting varchar(50) NOT NULL DEFAULT '',
		figure_poa_language VARCHAR(50) NOT NULL DEFAULT '".LANGUAGE."',
		PRIMARY KEY (figure_poa_id)
	) ENGINE=MyISAM DEFAULT CHARSET=UTF8 COLLATE=utf8_unicode_ci";
/////////////////////////////////////////////////////////////////////////////////
$inf_newtable[] = DB_FIGURE_PACKAGINGS." (
		figure_packaging_id mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
		figure_packaging_name varchar(100) NOT NULL DEFAULT '',
		figure_packaging_description text NOT NULL,
		figure_packaging_parent MEDIUMINT(8) UNSIGNED NOT NULL DEFAULT '0',
		figure_packaging_sorting varchar(50) NOT NULL DEFAULT '',
		figure_packaging_language VARCHAR(50) NOT NULL DEFAULT '".LANGUAGE."',
		PRIMARY KEY (figure_packaging_id)
	) ENGINE=MyISAM DEFAULT CHARSET=UTF8 COLLATE=utf8_unicode_ci";
/////////////////////////////////////////////////////////////////////////////////
$inf_newtable[] = DB_FIGURE_LIMITATIONS." (
		figure_limitation_id mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
		figure_limitation_name varchar(100) NOT NULL DEFAULT '',
		figure_limitation_description text NOT NULL,
		figure_limitation_parent MEDIUMINT(8) UNSIGNED NOT NULL DEFAULT '0',
		figure_limitation_sorting varchar(50) NOT NULL DEFAULT '',
		figure_limitation_language VARCHAR(50) NOT NULL DEFAULT '".LANGUAGE."',
		PRIMARY KEY (figure_limitation_id)
	) ENGINE=MyISAM DEFAULT CHARSET=UTF8 COLLATE=utf8_unicode_ci";
/////////////////////////////////////////////////////////////////////////////////
$inf_newtable[] = DB_FIGURE_MEASUREMENTS." (
figure_measurements_id mediumint(8) unsigned NOT NULL AUTO_INCREMENT, 
figure_measurements_inch varchar(100) NOT NULL DEFAULT '',
figure_measurements_cm varchar(100) NOT NULL DEFAULT '',
figure_measurements_description text NOT NULL,
figure_measurements_parent MEDIUMINT(8) UNSIGNED NOT NULL DEFAULT '0',
figure_measurements_sorting varchar(50) NOT NULL DEFAULT '',
figure_measurements_language VARCHAR(50) NOT NULL DEFAULT '".LANGUAGE."',
PRIMARY KEY (figure_measurements_id)
	) ENGINE=MyISAM DEFAULT CHARSET=UTF8 COLLATE=utf8_unicode_ci";
/////////////////////////////////////////////////////////////////////////////////
$inf_newtable[] = DB_FIGURE_USERFIGURES." (
figure_userfigures_id mediumint(8) unsigned NOT NULL AUTO_INCREMENT, 
figure_userfigures_figure_id varchar(100) NOT NULL DEFAULT '',
figure_userfigures_user_id varchar(100) NOT NULL DEFAULT '',
figure_userfigures_sorting varchar(50) NOT NULL DEFAULT '',
figure_userfigures_language VARCHAR(50) NOT NULL DEFAULT '".LANGUAGE."',
PRIMARY KEY (figure_userfigures_id)
	) ENGINE=MyISAM DEFAULT CHARSET=UTF8 COLLATE=utf8_unicode_ci";
/////////////////////////////////////////////////////////////////////////////////
$inf_newtable[] = DB_FIGURE_IMAGES." (
figure_images_image_id mediumint(8) unsigned NOT NULL AUTO_INCREMENT, 
figure_images_figure_id varchar(100) NOT NULL DEFAULT '',
figure_images_image varchar(100) NOT NULL DEFAULT '',
figure_images_thumb varchar(100) NOT NULL DEFAULT '',
figure_images_sorting varchar(50) NOT NULL DEFAULT '',
figure_images_language VARCHAR(50) NOT NULL DEFAULT '".LANGUAGE."',
PRIMARY KEY (figure_images_image_id)
	) ENGINE=MyISAM DEFAULT CHARSET=UTF8 COLLATE=utf8_unicode_ci";
/////////////////////////////////////////////////////////////////////////////////
$inf_newtable[] = DB_FIGURE_YEARS." (
figure_year_id mediumint(8) unsigned NOT NULL AUTO_INCREMENT, 
figure_year varchar(100) NOT NULL DEFAULT '',
figure_year_description text NOT NULL,
figure_year_parent MEDIUMINT(8) UNSIGNED NOT NULL DEFAULT '0',
figure_year_sorting varchar(50) NOT NULL DEFAULT '',
figure_year_language VARCHAR(50) NOT NULL DEFAULT '".LANGUAGE."',
PRIMARY KEY (figure_year_id)
	) ENGINE=MyISAM DEFAULT CHARSET=UTF8 COLLATE=utf8_unicode_ci";
/////////////////////////////////////////////////////////////////////////////////

// Settings
$inf_insertdbrow[] = DB_SETTINGS_INF." (settings_name, settings_value, settings_inf) VALUES('figure_per_page', '10', 'figurelib')";
$inf_insertdbrow[] = DB_SETTINGS_INF." (settings_name, settings_value, settings_inf) VALUES('figure_per_line', '4', 'figurelib')";
$inf_insertdbrow[] = DB_SETTINGS_INF." (settings_name, settings_value, settings_inf) VALUES('figure_display', '1', 'figurelib')";
$inf_insertdbrow[] = DB_SETTINGS_INF." (settings_name, settings_value, settings_inf) VALUES('figure_submit', '1', 'figurelib')";
$inf_insertdbrow[] = DB_SETTINGS_INF." (settings_name, settings_value, settings_inf) VALUES('figure_related', '1', 'figurelib')";
$inf_insertdbrow[] = DB_SETTINGS_INF." (settings_name, settings_value, settings_inf) VALUES('figure_social_sharing', '1', 'figurelib')";
$inf_insertdbrow[] = DB_SETTINGS_INF." (settings_name, settings_value, settings_inf) VALUES('figure_thumb_ratio', '0', 'figurelib')";
$inf_insertdbrow[] = DB_SETTINGS_INF." (settings_name, settings_value, settings_inf) VALUES('figure_image_link', '1', 'figurelib')";
$inf_insertdbrow[] = DB_SETTINGS_INF." (settings_name, settings_value, settings_inf) VALUES('figure_photo_w', '800', 'figurelib')";
$inf_insertdbrow[] = DB_SETTINGS_INF." (settings_name, settings_value, settings_inf) VALUES('figure_photo_h', '600', 'figurelib')";
$inf_insertdbrow[] = DB_SETTINGS_INF." (settings_name, settings_value, settings_inf) VALUES('figure_thumb_w', '400', 'figurelib')";
$inf_insertdbrow[] = DB_SETTINGS_INF." (settings_name, settings_value, settings_inf) VALUES('figure_thumb_h', '300', 'figurelib')";
$inf_insertdbrow[] = DB_SETTINGS_INF." (settings_name, settings_value, settings_inf) VALUES('figure_photo_max_w', '1800', 'figurelib')";
$inf_insertdbrow[] = DB_SETTINGS_INF." (settings_name, settings_value, settings_inf) VALUES('figure_photo_max_h', '1600', 'figurelib')";
$inf_insertdbrow[] = DB_SETTINGS_INF." (settings_name, settings_value, settings_inf) VALUES('figure_photo_max_b', '500000', 'figurelib')";

/////////////////////////////////////////////////////////////////////////////////
//befüllen von Brand
$inf_insertdbrow[] = DB_FIGURE_BRANDS." (figure_brand_id, figure_brand_name) VALUES
(1, 'Unknown'),
(2, 'Alien (1979)'),
(3, 'Aliens (1986)'),
(4, 'Alien 3 (1992)'),
(5, 'Alien: Resurrection (1997)'),
(6, 'Alien vs. Predator (2004)'),
(7, 'Aliens vs. Predator: Requiem (2007)'),
(8, 'Prometheus (2012)'),
(9, 'Alien: Covenant (2017)')
";
/////////////////////////////////////////////////////////////////////////////////
//befüllen von Scales
$inf_insertdbrow[] = DB_FIGURE_SCALES." (figure_scale_id, figure_scale_name) VALUES 
(1, 'Unknown'),
(2, '1:1'),
(3, '1:2'),
(4, '1:3'),
(5, '1:4'),
(6, '1:5'),
(7, '1:6'),
(8, '1:9'),
(9, '1:10'),
(10, '1:12'),
(11, '1:24')
";
/////////////////////////////////////////////////////////////////////////////////
//befüllen von measurements
$inf_insertdbrow[] = DB_FIGURE_MEASUREMENTS." (figure_measurements_id, figure_measurements_inch, figure_measurements_cm) VALUES 
(1, 'Unknown',''),
(2, '01 Inch','2,54 cm'),
(3, '02 Inch','5,08 cm'),
(4, '03 Inch','7,62 cm'),
(5, '04 Inch','9,00 cm'),
(6, '05 Inch','12,70 cm'),
(7, '06 Inch','15,24 cm'),
(8, '07 Inch','17,78 cm'),
(9, '08 Inch','20,32 cm'),
(10, '09 Inch','22,86 cm'),
(11, '10 Inch','25,40 cm'),
(12, '11 Inch','27,94 cm'),
(13, '12 Inch','30,48 cm'),
(14, '13 Inch','33,02 cm'),
(15, '14 Inch','35,56 cm'),
(16, '15 Inch','38,10 cm'),
(17, '16 Inch','40,64 cm'),
(18, '17 Inch','43,18 cm'),
(19, '18 Inch','45,72 cm'),
(20, '19 Inch','48,26 cm'),
(21, '20 Inch','50,80 cm'),
(22, '21 Inch','53,34 cm'),
(23, '22 Inch','55,88 cm'),
(24, '23 Inch','58,42 cm'),
(25, '24 Inch','60,96 cm'),
(26, '25 Inch','63,50 cm'),
(27, '26 Inch','66,04 cm'),
(28, '27 Inch','68,58 cm'),
(29, '28 Inch','71,12 cm'),
(30, '29 Inch','73,66 cm'),
(31, '30 Inch','76,20 cm'),
(32, 'bigger than 30 Inch','76,20 cm')
";
/////////////////////////////////////////////////////////////////////////////////
//befüllem von years
$inf_insertdbrow[] = DB_FIGURE_YEARS." (figure_year_id, figure_year) VALUES
(1, 'Unknown'),
(2, '1970'),
(3, '1971'),
(4, '1972'),
(5, '1973'),
(6, '1974'),
(7, '1975'),
(8, '1976'),
(9, '1977'),
(10, '1978'),
(11, '1979'),
(12, '1980'),
(13, '1981'),
(14, '1982'),
(15, '1983'),
(16, '1984'),
(17, '1985'),
(18, '1986'),
(19, '1987'),
(20, '1988'),
(21, '1989'),
(22, '1990'),
(23, '1991'),
(24, '1992'),
(25, '1993'),
(26, '1994'),
(27, '1995'),
(28, '1996'),
(29, '1997'),
(30, '1998'),
(31, '1999'),
(32, '2000'),
(33, '2001'),
(34, '2002'),
(35, '2003'),
(36, '2004'),
(37, '2005'),
(38, '2006'),
(39, '2007'),
(40, '2008'),
(41, '2009'),
(42, '2010'),
(43, '2011'),
(44, '2012'),
(45, '2013'),
(46, '2014'),
(47, '2015'),
(48, '2016'),
(49, '2017'),
(50, '2018'),
(51, '2019'),
(52, '2020'),
(53, '2021'),
(54, '2022'),
(55, '2023'),
(56, '2024'),
(57, '2025'),
(58, '2026'),
(59, '2027'),
(60, '2028'),
(61, '2029'),
(62, '2030')
";
/////////////////////////////////////////////////////////////////////////////////
//befüllem von Limitation
$inf_insertdbrow[] = DB_FIGURE_LIMITATIONS." (figure_limitation_id, figure_limitation_name) VALUES
(1, 'Unknown'),
(2, 'Yes'),
(3, 'No')
";
/////////////////////////////////////////////////////////////////////////////////
//befüllem von Packaging
$inf_insertdbrow[] = DB_FIGURE_PACKAGINGS." (figure_packaging_id, figure_packaging_name) VALUES
(1, 'Unknown'),
(2, 'Bag'),
(3, 'Blister Card'),
(4, 'Box'),
(5, 'Clamshell'),
(6, 'Slip Case'),
(7, 'Window Box')
";
/////////////////////////////////////////////////////////////////////////////////
//befüllem von Point of Articulation
$inf_insertdbrow[] = DB_FIGURE_POAS." (figure_poa_id, figure_poa_name) VALUES 
(1, 'Unknown'),
(2, '01 Point of articulation'),
(3, '02 Points of articulation'),
(4, '03 Points of articulation'),
(5, '04 Points of articulation'),
(6, '05 Points of articulation'),
(7, '06 Points of articulation'),
(8, '07 Points of articulation'),
(9, '08 Points of articulation'),
(10, '09 Points of articulation'),
(11, '10 Points of articulation'),
(12, '11 Points of articulation'),
(13, '12 Points of articulation'),
(14, '13 Points of articulation'),
(15, '14 Points of articulation'),
(16, '15 Points of articulation'),
(17, '16 Points of articulation'),
(18, '17 Points of articulation'),
(19, '18 Points of articulation'),
(20, '19 Points of articulation'),
(21, '20 Points of articulation'),
(22, '21 Points of articulation'),
(23, '22 Points of articulation'),
(24, '23 Points of articulation'),
(25, '24 Points of articulation'),
(26, '25 Points of articulation'),
(27, '26 Points of articulation'),
(28, '27 Points of articulation'),
(29, '28 Points of articulation'),
(30, '29 Points of articulation'),
(31, '30 Points of articulation'),
(32, '31 Points of articulation'),
(33, '32 Points of articulation'),
(34, '33 Points of articulation'),
(35, '34 Points of articulation'),
(36, '35 Points of articulation'),
(37, '36 Points of articulation'),
(38, '37 Points of articulation'),
(39, '38 Points of articulation'),
(40, '39 Points of articulation'),
(41, '40 Points of articulation'),
(42, '41 Points of articulation'),
(43, '42 Points of articulation'),
(44, '43 Points of articulation'),
(45, '44 Points of articulation'),
(46, '45 Points of articulation'),
(47, '46 Points of articulation'),
(48, '47 Points of articulation'),
(49, '48 Points of articulation'),
(50, '49 Points of articulation'),
(51, '50 Points of articulation'),
(52, 'more than 50 Points of articulation')
";
/////////////////////////////////////////////////////////////////////////////////
//befüllem von Cats
$inf_insertdbrow[] = DB_FIGURE_CATS." (figure_cat_id, figure_cat_name, figure_cat_description, figure_cat_sorting) VALUES 
(1, 'Other/Unknown', '', 'figure_id ASC'),
(2, '1/1 Scale', '', 'figure_id ASC'),
(3, '1/2 Scale', '', 'figure_id ASC'),
(4, '1/4 Scale', '', 'figure_id ASC'),
(5, '1/6 Scale', '', 'figure_id ASC'),
(6, 'Actionfigure', '', 'figure_id ASC'),
(7, 'Bootleg', '', 'figure_id ASC'),
(8, 'Bust', '', 'figure_id ASC'),
(9, 'Diorama', '', 'figure_id ASC'),
(10, 'Garage Kit', '', 'figure_id ASC'),
(11, 'Jumbo Kenner', '', 'figure_id ASC'),
(12, 'Maquette', '', 'figure_id ASC'),
(13, 'Merchandise', '', 'figure_id ASC'),
(14, 'Mini/Trade Figure', '', 'figure_id ASC'),
(15, 'Model Kit', '', 'figure_id ASC'),
(16, 'Plush', '', 'figure_id ASC'),
(17, 'Promotion', '', 'figure_id ASC'),
(18, 'Prop Replica', '', 'figure_id ASC'),
(19, 'PVC Statue', '', 'figure_id ASC'),
(20, 'Statue', '', 'figure_id ASC')
";
/////////////////////////////////////////////////////////////////////////////////
//befüllem von Materials
$inf_insertdbrow[] = DB_FIGURE_MATERIALS." (figure_material_id, figure_material_name) VALUES
(1, 'Unknown'),
(2, 'ABS'),
(3, 'Latex'),
(4, 'Cold Cast Porcelain'),
(5, 'Cold Cast Resin'),
(6, 'Glas'),
(7, 'Ceramic'),
(8, 'Copper'),
(9, 'Gold'),
(10, 'Metal'),
(11, 'MixMedia'),
(12, 'Pewter'),
(13, 'Polyresin'),
(14, 'Polystone'),
(15, 'PVC'),
(16, 'Resin'),
(17, 'Silver'),
(18, 'Soft Vinyl'),
(19, 'Stone'),
(20, 'Tiny Metal'),
(21, 'Vinyl')
";
/////////////////////////////////////////////////////////////////////////////////
$inf_insertdbrow[] = DB_FIGURE_MANUFACTURERS." (figure_manufacturer_id, figure_manufacturer_name) VALUES
(1, 'Unknown'),
(2, 'Alien Enterprise'),
(3, 'Anatomic Monster'),
(4, 'Aoshima / Skynet'),
(5, 'AMT / ERTL'),
(6, 'Art Storm'),
(7, 'AEF Designs'),
(8, 'Attakus'),
(9, 'Bandai'),
(10, 'Billiken'),
(11, 'Black Label Modelz'),
(12, 'Black Heart Enterprise'),
(13, 'Bonapart Models '),
(14, 'CoolProps'),
(15, 'Cinemaquette '),
(16, 'Cyper Model (Thailand Recasts Ebay)'),
(17, 'Dark Horse'),
(18, 'Dewar'),
(19, 'Diamond Select'),
(20, 'Diamond Select --> Sub  Art Asylum'),
(21, 'Dimensional Designs '),
(22, 'Distortions Studios'),
(23, 'Elfin'),
(24, 'Fewture Models'),
(25, 'Franklin Mint Alien'),
(26, 'Funko / Super 7'),
(27, 'Furyu'),
(28, 'Galoob'),
(29, 'Gentle Giant'),
(30, 'GEM Reproductions'),
(31, 'Geometric Design'),
(32, 'GF9 (GaleForce9 ) (Wizkids Horrorclix)'),
(33, 'Good Smile Company'),
(34, 'Gort Japan'),
(35, 'Grey Zon Sculpture Lab'),
(36, 'Henry Alvarez'),
(37, 'Herocross'),
(38, 'Hollywood Collectibles Group'),
(39, 'Hollywood Collectors Gallery'),
(40, 'Halcyon'),
(41, 'Hallmark'),
(42, 'Heartilysir'),
(43, 'Hasbro Toys'),
(44, 'Chinese Companies OGRM Manufacturing '),
(45, 'Hiya Toys'),
(46, 'Horizon'),
(47, 'Horrorclix (Wizkids)'),
(48, 'Hot Toys'),
(49, 'Insight Collectibles'),
(50, 'Inkworks'),
(51, 'Jayco'),
(52, 'JS Resines'),
(53, 'Kaiyodo'),
(54, 'Kenner'),
(55, 'Kobyoshi Kits'),
(56, 'Konami'),
(57, 'Kotobukiya'),
(58, 'Leading Edge Games'),
(59, 'Lil Monsters'),
(60, 'Mannetron'),
(61, 'Marmit'),
(62, 'Master Replicas'),
(63, 'McFarlane'),
(64, 'Medicom Toy'),
(65, 'Mental Mischief'),
(66, 'Model Kits'),
(67, 'Model Giant'),
(68, 'Modulart'),
(69, 'Monsters.net'),
(70, 'Morbid Model'),
(71, 'Morpheus International'),
(72, 'Multiverse Studio'),
(73, 'MPC / Round2 Models'),
(74, 'Narin Naward Productions Modelmagic5'),
(75, 'Neca'),
(76, 'Nexus'),
(77, 'Ogawa Studio'),
(78, 'Oyama'),
(79, 'OZ Shop'),
(80, 'Palisades'),
(81, 'Polar Lights'),
(82, 'Prodos Games'),
(83, 'Psycho Monsterz'),
(84, 'Real'),
(85, 'Resin d etre'),
(86, 'Revengemonst (Recasts)'),
(87, 'Roswell Japan'),
(88, 'Seahorse Models'),
(89, 'Sega'),
(90, 'Sideshow Collectibles'),
(91, 'Sky W'),
(92, 'Sota'),
(93, 'Spacecraft Creation Models'),
(94, 'Super 7 / Secret Base'),
(95, 'Squareenix '),
(96, 'Star Pics'),
(97, 'Takara'),
(98, 'Takeya Takayuki'),
(99, 'The Flying Gung Brothers'),
(100, 'Time Slip'),
(101, 'Titan Books'),
(102, 'Titan Merchandise'),
(103, 'ThreeB'),
(104, 'Tsukuda Hobby'),
(105, 'TOPPS'), 
(106, 'Upper Deck'), 
(107, 'Vision2 Art Media Store'),
(108, 'Voodoo Babe'), 
(109, 'Wizart Studio'),
(110, 'Wizkids'), 
(111, 'X-Plus'),
(112, 'Yellow Pearl'), 
(113, '3dwizzard (also Wizart Studio)'),
(114, '3rd Eye Design')
";
/////////////////////////////////////////////////////////////////////////////////

// always find and loop ALL languages
$enabled_languages = makefilelist(LOCALE, ".|..", TRUE, "folders");
// Create a link for all installed languages
if (!empty($enabled_languages)) {
	foreach($enabled_languages as $language) {
		include LOCALE.$language."/setup.php";
		// add new language records
		$mlt_insertdbrow[$language][] = DB_SITE_LINKS." (link_name, link_url, link_visibility, link_position, link_window, link_order, link_language) VALUES ('".$locale['INF_TITLE']."', 'infusions/figurelib/figures.php', '0', '2', '0', '2', '".$language."')";
		$mlt_insertdbrow[$language][] = DB_SITE_LINKS." (link_name, link_url, link_visibility, link_position, link_window, link_order, link_language) VALUES ('".$locale['figure_521']."', 'infusions/figurelib/submit.php?stype=f', ".USER_LEVEL_MEMBER.", '1', '0', '15', '".$language."')";

		// drop deprecated language records
		$mlt_deldbrow[$language][] = DB_SITE_LINKS." WHERE link_url='infusions/figurelib/figures.php' AND link_language='".$language."'";
		$mlt_deldbrow[$language][] = DB_SITE_LINKS." WHERE link_url='infusions/figurelib/submit.php?stype=f' AND link_language='".$language."'";
		$mlt_deldbrow[$language][] = DB_FIGURE_CATS." WHERE figure_cat_language='".$language."'";
	}
} else {
		$inf_insertdbrow[] = DB_SITE_LINKS." (link_name, link_url, link_visibility, link_position, link_window, link_order, link_language) VALUES('".$locale['setup_3307']."', 'infusions/figurelib/figures.php', '0', '2', '0', '2', '".LANGUAGE."')";
}
/*
################################################
$enabled_languages = makefilelist(LOCALE, ".|..", TRUE, "folders");
// Create a link for all installed languages
	if (!empty($enabled_languages)) {
		foreach($enabled_languages as $language) { // these can be overriden.

					$mlt_insertdbrow[$language][] = DB_SITE_LINKS." (
						link_name, 
						link_url, 
						link_visibility, 
						link_position, 
						link_window, 
						link_order, 
						link_language
						
						) VALUES (
						
						'".$locale['INF_TITLE']."', 
						'infusions/figurelib/figures.php', 
						'0', 
						'2', 
						'0', 
						'2', 
						'".$language."'
						)";

					//WENN SUBMIT FI DANN IN CORE ÄNDERN
					$mlt_insertdbrow[$language][] = DB_SITE_LINKS." (
						link_name, 
						link_url, 
						link_visibility, 
						link_position, 
						link_window, 
						link_order, 
						link_language
						
						) VALUES (
						
						'".$locale['figure_521']."', 
						'submit.php?stype=f', 
						".USER_LEVEL_MEMBER.", 
						'1', 
						'0', 
						'14', 
						'".$language."'
						)";


					$mlt_insertdbrow[$language][] = DB_SITE_LINKS." (
						link_name, 
						link_url, 
						link_visibility, 
						link_position, 
						link_window, 
						link_order, 
						link_language
						
						) VALUES (
						
						'".$locale['figure_521']."', 
						'infusions/figurelib/submit.php', 
						".USER_LEVEL_MEMBER.", 
						'1', 
						'1', 
						'14', 
						'".$language."'
						)";


					}
				} else {
						$inf_insertdbrow[] = DB_SITE_LINKS." (
						link_name, 
						link_url, 
						link_visibility, 
						link_position, 
						link_window, 
						link_order, 
						link_language
						
						) VALUES (
						
						'".$locale['INF_TITLE']."', 
						'infusions/figurelib/figures.php', 
						'0', 
						'2', 
						'0', 
						'2', 
						'".LANGUAGE."'
						)";
	}

*/

// Automatic enable of the latest figures panel
					$inf_insertdbrow[] = DB_PANELS." (
						panel_name, 
						panel_filename, 
						panel_content, 
						panel_side, 
						panel_order, 
						panel_type, 
						panel_access, 
						panel_display, 
						panel_status, 
						panel_url_list, 
						panel_restriction

						) VALUES(

						'Latest figure panel', 
						'latest_figures_center_panel', 
						'', 
						'2', 
						'2', 
						'file', 
						'0', 
						'0', 
						'1', 
						'', 
						'0'
						)";


// Defuse cleaning	
$inf_droptable[] = DB_FIGURE_CATS;
$inf_droptable[] = DB_FIGURE_ITEMS;
//$inf_droptable[] = DB_FIGURE_SETTINGS;
$inf_droptable[] = DB_FIGURE_MANUFACTURERS;
$inf_droptable[] = DB_FIGURE_BRANDS;
$inf_droptable[] = DB_FIGURE_MATERIALS;
$inf_droptable[] = DB_FIGURE_SCALES;
$inf_droptable[] = DB_FIGURE_POAS;
$inf_droptable[] = DB_FIGURE_PACKAGINGS;
$inf_droptable[] = DB_FIGURE_LIMITATIONS;
$inf_droptable[] = DB_FIGURE_MEASUREMENTS;
$inf_droptable[] = DB_FIGURE_USERFIGURES;
$inf_droptable[] = DB_FIGURE_IMAGES;
$inf_droptable[] = DB_FIGURE_YEARS;

$inf_deldbrow[] = DB_COMMENTS." WHERE comment_type='FI'";
$inf_deldbrow[] = DB_RATINGS." WHERE rating_type='FI'";
$inf_deldbrow[] = DB_ADMIN." WHERE admin_rights='FI'";
$inf_deldbrow[] = DB_SITE_LINKS." WHERE link_url='infusions/figurelib/figures.php'";
$inf_deldbrow[] = DB_SITE_LINKS." WHERE link_url='infusions/figurelib/submit.php'";
$inf_deldbrow[] = DB_LANGUAGE_TABLES." WHERE mlt_rights='FI'";
$inf_deldbrow[] = DB_PANELS." WHERE panel_filename='latest_figures_center_panel'";
$inf_deldbrow[] = DB_SETTINGS_INF." WHERE settings_inf='figurelib'";
