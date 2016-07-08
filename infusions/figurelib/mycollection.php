<?php
/***************************************************************************
 *   mycollection.php for FIGURELIB                                           *
 *                                                                         *
 *   Copyright (C) 2016 Catzenjaeger                                       *
 *   www.AlienCollectors.com                                               *
 *                                                                         *
 *   This program is free software; you can redistribute it and/or modify  *
 *   it under the terms of the GNU General Public License as published by  *
 *   the Free Software Foundation; either version 2 of the License, or     *
 *   (at your option) any later version.                                   *
 ***************************************************************************/
require_once file_exists('maincore.php') ? 'maincore.php' : __DIR__."/../../maincore.php";
include INFUSIONS."figurelib/infusion_db.php";
require_once THEMES."templates/header.php";
require_once INCLUDES."infusions_include.php";
if (!db_exists(DB_FIGURE_ITEMS)) { redirect(BASEDIR."error.php?code=404"); }

	$fil_settings = get_settings("figurelib"); 

if (iMEMBER) {

// GET GLOBAL VARIABLES
global $aidlink;
global $settings;
global $userdata;

// LANGUAGE
if (file_exists(INFUSIONS."figurelib/locale/".LOCALESET."locale_figurelib.php")) {
    include INFUSIONS."figurelib/locale/".LOCALESET."locale_figurelib.php";
} else {
    include INFUSIONS."figurelib/locale/English/locale_figurelib.php";
}

// LOCALE
$locale['mc_0001']= "My Figure Collection";
$locale['mc_0002']= "Collection Count: ";
$locale['mc_0003']= "Figures List";
$locale['mc_0004']= "Submits";
$locale['mc_0005']= "My newest figure";
$locale['mc_0006']= "My figures counter";
$locale['mc_0007']= "You have ";
$locale['mc_0008']= " figures in your collection!";
$locale['mc_0009']= "Name of your last figure: ";
$locale['mc_0010']= "You have no figures";
$locale['mc_0011']= "This feature is only available for registered members. Please Sign up ";
$locale['mc_0012']= "HERE";		
			
			//echo "<div class='well clearfix'>\n";
			//echo "<strong>".$locale['mc_0001']."</strong><br>";
			//echo "</div>\n";
	
	opentable("<strong>".$locale['mc_0001']."</strong>");
		echo "<div class='col-xs-12 col-sm-6'>\n";	
	openside($locale['mc_0006']);
				
				$count = dbcount("(figure_userfigures_id)", DB_FIGURE_USERFIGURES, "figure_userfigures_user_id='".$userdata['user_id']."'");	
				
				if ($count != 0) {
							
						echo $locale['mc_0007']. $count . $locale['mc_0008'];
						
				} else {	
						
						echo $locale['mc_0010'];
				}

				echo "</div>";
	closeside();
	
	echo "<div class='col-xs-12 col-sm-6'>\n";
	
	openside($locale['mc_0005']);

				global $userdata;
					$resultlast = dbquery(
						"SELECT f.figure_id,
								f.figure_title, 			
								f.figure_submitter, 
								f.figure_freigabe, 
								f.figure_pubdate, 
								f.figure_scale, 
								f.figure_title, 
								f.figure_manufacturer, 
								f.figure_brand, 
								f.figure_datestamp, 
								f.figure_cat, 
								fc.figure_cat_id, 
								fc.figure_cat_name, 
								fm.figure_manufacturer_name, 
								fb.figure_brand_name, 
								fy.figure_year_id, 
								fy.figure_year, 
								fs.figure_scale_id, 
								fs.figure_scale_name, 						
								fuf.figure_userfigures_figure_id, 	
								fuf.figure_userfigures_user_id 		
						FROM ".DB_FIGURE_ITEMS." f
						INNER JOIN ".DB_FIGURE_USERFIGURES." fuf ON fuf.figure_userfigures_figure_id=f.figure_id
						INNER JOIN ".DB_FIGURE_CATS." fc ON f.figure_cat=fc.figure_cat_id
						INNER JOIN ".DB_FIGURE_MANUFACTURERS." fm ON fm.figure_manufacturer_id = f.figure_manufacturer
						INNER JOIN ".DB_FIGURE_BRANDS." fb ON fb.figure_brand_id = f.figure_brand
						INNER JOIN ".DB_FIGURE_SCALES." fs ON fs.figure_scale_id = f.figure_scale
						INNER JOIN ".DB_FIGURE_YEARS." fy ON fy.figure_year_id = f.figure_pubdate
						".(multilang_table("FI") ? "WHERE figure_language='".LANGUAGE."' AND" : "WHERE")." figure_userfigures_user_id=".$userdata['user_id']."
						ORDER BY figure_datestamp DESC LIMIT 0,1 
						");
							if (dbrows($resultlast) != 0) {
								while($data = dbarray($resultlast)){
							
										echo "<td class='side-small'>".$locale['mc_0009']."
										<a href='".INFUSIONS."figurelib/figures.php?figure_id=".$data['figure_id']."'>".trimlink($data['figure_title'], 18)."</a>";
							
							
								}
							} else {	
						
										echo $locale['mc_0010'];
							}

echo "</div>";

closeside();
echo "<div class='col-xs-12 col-sm-12'>\n";

// Locale
$locale['CLFP_000']= "Alien Figures Database";
$locale['CLFP_001']= "No figures found";
$locale['CLFP_002']= "Name";
$locale['CLFP_003']= "Manufacturer";
$locale['CLFP_004']= "Brand";
$locale['CLFP_005']= "Scale";
$locale['CLFP_006']= "Year";
$locale['CLFP_007']= "Image";
$locale['CLFP_008']= "No Data";
$locale['CLFP_009']= "X";
$locale['CLFP_010']= "Rating";
$locale['CLFP_011']= "Submitter";
$locale['CLFP_012']= "Count";
$locale['CLFP_013']= "Categories";
$locale['CLFP_014']= "Submit";
$locale['CLFP_015']= "Most viewed";
$locale['CLFP_016']= "Admin";
$locale['yours']= "Your Figures";		

		// DATENBANK AUSLESEN UND DATEN BEREITSTELLEN
global $userdata;
		$result = dbquery(
			"SELECT f.figure_id, 
					f.figure_submitter, 
					f.figure_freigabe, 
					f.figure_pubdate, 
					f.figure_scale, 
					f.figure_title, 
					f.figure_manufacturer, 
					f.figure_brand, 
					f.figure_datestamp, 
					f.figure_cat, 
					fc.figure_cat_id, 
					fc.figure_cat_name, 
					fm.figure_manufacturer_name, 
					fb.figure_brand_name, 
					fy.figure_year_id, 
					fy.figure_year, 
					fs.figure_scale_id, 
					fs.figure_scale_name, 						
					fuf.figure_userfigures_figure_id, 	
					fuf.figure_userfigures_user_id 		
			FROM ".DB_FIGURE_ITEMS." f
			INNER JOIN ".DB_FIGURE_USERFIGURES." fuf ON fuf.figure_userfigures_figure_id=f.figure_id
			INNER JOIN ".DB_FIGURE_CATS." fc ON f.figure_cat=fc.figure_cat_id
			INNER JOIN ".DB_FIGURE_MANUFACTURERS." fm ON fm.figure_manufacturer_id = f.figure_manufacturer
			INNER JOIN ".DB_FIGURE_BRANDS." fb ON fb.figure_brand_id = f.figure_brand
			INNER JOIN ".DB_FIGURE_SCALES." fs ON fs.figure_scale_id = f.figure_scale
			INNER JOIN ".DB_FIGURE_YEARS." fy ON fy.figure_year_id = f.figure_pubdate
			".(multilang_table("FI") ? "WHERE figure_language='".LANGUAGE."' AND" : "WHERE")." figure_userfigures_user_id=".$userdata['user_id']."
			ORDER BY figure_datestamp DESC LIMIT 0,100
			");
	
		
		// PANEL open	
 
 openside($locale['yours']);
 	 
		if (dbrows($result) != 0) {
		 
			echo "<table cellpadding='0' cellspacing='1' class='tbl-border' style='text-align:left;width:100%; margin-bottom: 4px;'>";
			echo "
					<colgroup>
						<col width='10%'>
						<col width='20%'>
						<col width='20%'>
						<col width='20%'>
						<col width='10%'>
						<col width='10%'>
						<col width='10%'>
					</colgroup>
				";					
				
			 echo "<tr class='breadcrumb'>";
			 echo "<td><strong>Image</strong></td>";
			 echo "<td><strong>".$locale['CLFP_002']."</strong></td>";   // ['CLFP_002']= "Name";
			 echo "<td><strong>".$locale['CLFP_003']."</strong></td>";   // ['CLFP_003']= "Manufacturer";;
			 echo "<td><strong>".$locale['CLFP_004']."</strong></td>";   // ['CLFP_004']= "Brand";
			 echo "<td><strong>".$locale['CLFP_005']."</strong></td>";   // ['CLFP_005']= "Scale";
			 echo "<td><strong>".$locale['CLFP_006']."</strong></td>";   // ['CLFP_006']= "Year";
			 echo "<td><strong>".$locale['CLFP_010']."</strong></td>";   // ['CLFP_010']= "Rating";
			 echo "</tr>";
		 
		while($data = dbarray($result)){

			 echo "<tr>";
			
			// get image - attention folder must be declared in infusion.db.php 			
			$result2 = dbquery("SELECT							   
						figure_images_image_id, 	
						figure_images_figure_id, 	
						figure_images_image, 	
						figure_images_thumb 	
				FROM ".DB_FIGURE_IMAGES."
				WHERE figure_images_figure_id='".$data['figure_id']."' LIMIT 0,1");
 
			   // result?
				if(dbrows($result2)){
     
				while($data2 = dbarray($result2)){
           
					echo "<td class='side-small'><a href='".INFUSIONS."figurelib/figures.php?figure_id=".$data['figure_id']."' class=''>\n<img src='". THUMBS_FIGURES.$data2['figure_images_thumb'] ."' alt='".trimlink($data['figure_title'],100)."' title='".trimlink($data['figure_title'],50)."' style='border:0px;max-height:40px;max-width:40px' /></td>";
			}
			} else { 
					echo "<td class='side-small'><a href='".INFUSIONS."figurelib/figures.php?figure_id=".$data['figure_id']."' class=''>\n<img src='".($data2['figure_images_thumb'] ? THUMBS_FIGURES.$data2['figure_images_thumb'] : INFUSIONS.$inf_folder."/images/default.png")."' alt='".trimlink($data['figure_title'],100)."' title='".trimlink($data['figure_title'],50)."' style='border:0px;max-height:40px;max-width:40px' /></td>";
				
					}		

			echo "<td class='side-small'>
			<a href='".INFUSIONS."figurelib/figures.php?figure_id=".$data['figure_id']."'>".trimlink($data['figure_title'], 18)."</a>
			</td>";
			echo "<td class='side-small'>".trimlink($data['figure_manufacturer_name'],18)."</td>";
			echo "<td>".trimlink($data['figure_brand_name'],18)."</td>";
			echo "<td>".trimlink($data['figure_scale_name'],7)."</td>";
 
	// NO DATA
			if ($data['figure_pubdate'] == "") {
			
				echo "<td>".$locale['CLFP_008']."</td>";
			
			} else {
			
				echo "<td>".$data['figure_year']."</td>";
			
			} 

		
	// Rating
		   $drating = dbarray(dbquery("
			   SELECT 
					SUM(rating_vote) sum_rating, 
					COUNT(rating_item_id) count_votes 
					FROM ".DB_RATINGS." 
					WHERE rating_type='FI' 
					AND  rating_item_id='".$data['figure_id']."'
				")); 
   
   $rating = ($drating['count_votes'] > 0 ? str_repeat("<img src='".INFUSIONS.$inf_folder."/images/starsmall.png'>",ceil($drating['sum_rating']/$drating['count_votes'])) : "-");
			echo "<td>".$rating."</td>";
			echo "</tr>";
	
	}
			
			echo "</table>";
			
	
	} else {
			echo "<div style='text-align: center;'>".$locale['CLFP_001']."</div>"; // 001 = No figures available"
	}

	closeside();
	echo "</div>";

		$max_rows = $count;
		$_GET['rowstart'] = isset($_GET['rowstart']) && isnum($_GET['rowstart']) && $_GET['rowstart'] <= $max_rows ? $_GET['rowstart'] : 0;
		if ($max_rows != 0) {
		$fil_settings = get_settings("figurelib");
		$numrows = dbrows($result);
		$info['figure_rows'] = $numrows;
					$fil_settings = get_settings("figurelib");
					$info['page_nav'] = $max_rows > $fil_settings['figure_per_page'] ? makepagenav($_GET['rowstart'], $fil_settings['figure_per_page'], $max_rows, 3, INFUSIONS."figurelib/figures.php?figure_cat_id=".$_GET['figure_cat_id']."&amp;") : 0;
		}

} else {
	$locale['mc_0001']= "My Figure Collection";
	$locale['mc_0011']= "This feature is only available for registered members. Please Sign up ";
	$locale['mc_0012']= "HERE";
	
	openside($locale['mc_0001']);

	echo $locale['mc_0011'];
	echo "<a href='".BASEDIR."register.php'>".$locale['mc_0012']."</a>";

	closeside();



}
closetable();

//nav
	 $fil_settings = get_settings("figurelib"); 
		$max_rows = dbcount("(figure_userfigures_id)", DB_FIGURE_USERFIGURES, "figure_userfigures_user_id='".$userdata['user_id']."'");	

		$_GET['rowstart'] = isset($_GET['rowstart']) && isnum($_GET['rowstart']) && $_GET['rowstart'] <= $max_rows ? $_GET['rowstart'] : 0;
		
		if ($max_rows != 0) {
			
			$result = dbquery("SELECT * FROM ".DB_FIGURE_USERFIGURES." WHERE figure_userfigures_user_id='".$userdata['user_id']." LIMIT ".$_GET['rowstart'].",".$asettings['figure_per_page']);
			echo $result;
			$numrows = dbrows($result);
			$info['figure_rows'] = $numrows;
			$info['page_nav'] = $max_rows > $asettings['figure_per_page'] ? makepagenav($_GET['rowstart'], $asettings['figure_per_page'], $max_rows, 3, INFUSIONS."figurelib/mycollection.php?&amp;") : 0;
			echo $info['page_nav'] ? "<div class='text-right'>".$info['page_nav']."</div>" : '';
		}

print_p("Max rows found - $max_rows ");
print_p("Item per page ".$asettings['figure_per_page']);
		

require_once THEMES."templates/footer.php";
