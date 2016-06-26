<?php
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright (C) PHP-Fusion Inc
| https://www.php-fusion.co.uk/
+--------------------------------------------------------+
| Filename: figurelib/templates/template_clickcounter.php
| Author: Catzenjaeger
|
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


// ******************************************************************************************			
// CLICKCOUNTER 
// ******************************************************************************************
			if (isset($_GET['figure_id']) && isnum($_GET['figure_id'])) {$res = 0;			
				$data = dbarray(dbquery("SELECT f.figure_clickcount FROM ".DB_FIGURE_ITEMS." AS f LEFT JOIN ".DB_FIGURE_CATS." AS fc ON f.figure_cat=fc.figure_cat_id WHERE f.figure_id='".intval($_GET['figure_id'])."'"));
			
			if (isset($_GET['figure_id']) && isnum($_GET['figure_id'])) {$res = 1;	
				dbquery("UPDATE ".DB_FIGURE_ITEMS." SET figure_clickcount=figure_clickcount+1 WHERE figure_id='".intval($_GET['figure_id'])."'");
			} else {redirect(FUSION_SELF); }
			}		
// ******************************************************************************************			
// ******************************************************************************************
