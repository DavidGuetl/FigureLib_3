<?php
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright (C) PHP-Fusion Inc
| https://www.php-fusion.co.uk/
+--------------------------------------------------------+
| Filename: submissions.php
| Author: Frederick MC Chan
+--------------------------------------------------------+
| This program is released as free software under the
| Affero GPL license. You can redistribute it and/or
| modify it under the terms of this license which you
| can read by viewing the included agpl.txt or online
| at www.gnu.org/licenses/agpl.html. Removal of this
| copyright header is strictly prohibited without
| written permission from the original author(s).
+--------------------------------------------------------*/
require_once "maincore.php";
require_once THEMES."templates/header.php";
include LOCALE.LOCALESET."homepage.php";
add_to_title(str_replace('...', '', $locale['UM089']));
$acclevel = isset($userdata['user_level']) ? $userdata['user_level'] : 0;
$configs = array();

$modules = array(
	'n' => db_exists(DB_NEWS),
	'p' => db_exists(DB_PHOTO_ALBUMS),
	'a' => db_exists(DB_ARTICLES),
	'd' => db_exists(DB_DOWNLOADS),
	'l' => db_exists(DB_WEBLINKS),
	'b' => db_exists(DB_BLOG));
	'f' => db_exists(DB_FIGURE_ITEMS));
$sum = array_sum($modules);
if (!$sum) {
	redirect("index.php");
}

$submission_types = array(
	DB_NEWS => array('link'=>"submit.php?stype=n", 'title'=>$locale['submit_0000']),
	DB_BLOG => array('link'=>"submit.php?stype=b", 'title'=>$locale['submit_0005']),
	DB_ARTICLES => array('link'=>"submit.php?stype=a", 'title'=>$locale['submit_0001']),
	DB_DOWNLOADS => array('link'=>"submit.php?stype=d", 'title'=>$locale['submit_0002']),
	DB_PHOTOS => array('link'=>"submit.php?stype=p", 'title'=>$locale['submit_0003']),
	DB_WEBLINKS => array('link'=>"submit.php?stype=l", 'title'=>$locale['submit_0004']),
	DB_FIGURE_ITEMS => array('link'=>"submit.php?stype=f", 'title'=>$locale['submit_0006']),
);

foreach($submission_types as $db => $submit) {
	if (db_exists($db)) {
		opentable(sprintf($submit['title'], ''));
		echo "<a href='".$submit['link']."'>".sprintf($submit['title'], str_replace('...', '', $locale['UM089']))."</a>";
		closetable();
	}
}
require_once THEMES."templates/footer.php";