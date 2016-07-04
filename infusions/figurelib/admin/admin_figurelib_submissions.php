<?php
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright (C) PHP-Fusion Inc
| https://www.php-fusion.co.uk/
+--------------------------------------------------------+
| Filename: figurelib_submissions.php based on weblinks_submissions.php
| Author: PHP-Fusion Development Team
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
	//error_reporting(E_ALL);
	//Formularinhalte prüfen
	//print_r ($_POST);
	//GET-Parameter prüfen
	//print_r ($_GET);
/*--------------------------------------------------------*/

	$result = dbquery("SELECT
			fi.figure_id, fi.figure_datestamp, fi.figure_title, tu.user_id, tu.user_name, tu.user_avatar, tu.user_status
			FROM ".DB_FIGURE_ITEMS." fi
			LEFT JOIN ".DB_USERS." tu ON fi.figure_submitter=tu.user_id
			WHERE figure_freigabe='0' order by figure_datestamp desc
			");
	$rows = dbrows($result);
	if ($rows > 0) {
		// ['figs_0021'] = "There are currently %s pending for your review.";
		echo "<div class='well'>".sprintf($locale['figs_0021'], format_word($rows, $locale['fmt_submission']))."</div>\n";
		echo "<table class='table table-striped'>\n";
		echo "<tr>\n";
		
		// ['figs_0013'] = "Submission Subject for Review";
		// ['cifg_0012'] = "Category";
		// ['cifg_0010'] = "Manufacturer"; 
		// ['cifg_0011'] = "Scale";		
		// ['figs_0014'] = "Submission Author";
		// ['figs_0015'] = "Submission Time";
        // ['cifg_0004'] = "Figure Id";
		
		echo "<th>".$locale['figs_0013']."</th>";
		echo "<th>".$locale['cifg_0012']."</th>";
		echo "<th>".$locale['cifg_0010']."</th>";
		echo "<th>".$locale['cifg_0011']."</th>";
		echo "<th>".$locale['figs_0014']."</th>";
		echo "<th>".$locale['figs_0015']."</th>";
		echo "<th>".$locale['cifg_0004']."</th>";
			
		echo "</tr>\n";
		echo "<tbody>\n";
	while ($data = dbarray($result)) {
					
			echo "<tr>\n";			
			echo "<td><a href='".FUSION_SELF.$aidlink."&amp;section=figurelib_form&amp;action=edit&amp;figure_id=".$data['figure_id']."'>".$data['figure_title']."</a></td>\n";
			
			$category = dbquery("
				SELECT 
						fc.figure_cat_id,
						fc.figure_cat_name,
						fi.figure_cat
					FROM ".DB_FIGURE_CATS." fc
					INNER JOIN ".DB_FIGURE_ITEMS." fi ON fc.figure_cat_id = fi.figure_cat
					");				
			while($datacategory = dbarray($category)){
			echo "<td>".$datacategory['figure_cat_name']."</td>\n";
			}	
			
			$manufacturer = dbquery("
				SELECT 
						fm.figure_manufacturer_id,
						fm.figure_manufacturer_name,
						fi.figure_manufacturer
					FROM ".DB_FIGURE_MANUFACTURERS." fm
					INNER JOIN ".DB_FIGURE_ITEMS." fi ON fm.figure_manufacturer_id = fi.figure_manufacturer
					");						
			while($datamanufacturer = dbarray($manufacturer)){
				
					echo "<td>".$datamanufacturer['figure_manufacturer_name']."</td>\n";
			}
			
			$scale = dbquery("
				SELECT 
						fs.figure_scale_id,
						fs.figure_scale_name,
						fi.figure_scale
					FROM ".DB_FIGURE_SCALES." fs
					INNER JOIN ".DB_FIGURE_ITEMS." fi ON fs.figure_scale_id = fi.figure_scale
					");				
			while($datascale = dbarray($scale)){
			echo "<td>".$datascale['figure_scale_name']."</td>\n";
			}	
			
			
			
			
					echo "<td>".profile_link($data['user_id'], $data['user_name'], $data['user_status'])."</td>\n";
					echo "<td>".timer($data['figure_datestamp'])."</td>\n";
					echo "<td>".$data['figure_id']."</td>\n";
					echo "</tr>\n";
	}	
					echo "</tbody>\n</table>\n";
	} else {
		
		// ['figs_0017'] = "There are currently no Figure submisisons";
		echo "<div class='well text-center m-t-20'>".$locale['figs_0017']."</div>\n";
	}
