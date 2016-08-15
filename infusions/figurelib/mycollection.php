
<?php
/***************************************************************************
 *   mycollection.php for FIGURELIB                                        *
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
	
			// My figures counter
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
	
	// My newest figure
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
										<a href='".INFUSIONS."figurelib/figures.php?figure_id=".$data['figure_id']."'>".trimlink($data['figure_title'], 12)."</a>";
							
							
								}
							} else {	
						
										echo $locale['mc_0010'];
							}
echo "</div>";
closeside();
				global $userdata;
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
					$locale['CLFP_017']= "MY COLLECTION";
					$locale['CLFP_018']= "IMAGE";
					$locale['yours']= "Your Figures";		
				
	// PANEL OF ALL FIGURE FROM USER 
	openside($locale['yours']);
	
		global $userdata;
		$fil_settings = get_settings("figurelib"); 
		$info = array();
		$info['item'] = array();
		
		$result = dbquery("
			  SELECT
				f.figure_id,
				f.figure_freigabe,
				fuf.figure_userfigures_user_id
			  FROM ".DB_FIGURE_ITEMS." f
			  LEFT JOIN ".DB_FIGURE_USERFIGURES." fuf ON fuf.figure_userfigures_user_id=f.figure_id
			  WHERE figure_freigabe=1");	
	
	if (dbrows($result) != 0) {
		
		$cdata = dbarray($result);
		$info = $cdata;
		
		$max_rows = dbcount("(figure_userfigures_figure_id)", DB_FIGURE_USERFIGURES, "figure_userfigures_user_id='".$userdata['user_id']."'");
			$_GET['rowstart'] = isset($_GET['rowstart']) && isnum($_GET['rowstart']) && $_GET['rowstart'] <= $max_rows ? $_GET['rowstart'] : 0;
					$numrows = dbrows($result);
		$fil_settings = get_settings("figurelib");
					
			$result = dbquery("SELECT 
					tb.figure_id, 
					tb.figure_submitter, 
					tb.figure_freigabe, 
					tb.figure_pubdate, 
					tb.figure_scale, 
					tb.figure_title, 
					tb.figure_manufacturer, 
					tb.figure_brand, 
					tb.figure_datestamp, 
					tb.figure_cat, 
					tbc.figure_cat_id, 
					tbc.figure_cat_name, 
					tbu.user_id, 
					tbu.user_name, 
					tbu.user_status, 
					tbu.user_avatar, 
					tbm.figure_manufacturer_name, 
					tbb.figure_brand_name, 
					tby.figure_year_id, 
					tby.figure_year, 
					tbs.figure_scale_id, 
					tbs.figure_scale_name, 							
					fuf.figure_userfigures_figure_id, 
					fuf.figure_userfigures_user_id 
						FROM ".DB_FIGURE_ITEMS." tb
						LEFT JOIN ".DB_USERS." tbu ON tb.figure_submitter=tbu.user_id
						INNER JOIN ".DB_FIGURE_USERFIGURES." fuf ON fuf.figure_userfigures_figure_id=tb.figure_id
						INNER JOIN ".DB_FIGURE_CATS." tbc ON tb.figure_cat=tbc.figure_cat_id
						INNER JOIN ".DB_FIGURE_MANUFACTURERS." tbm ON tbm.figure_manufacturer_id = tb.figure_manufacturer
						INNER JOIN ".DB_FIGURE_BRANDS." tbb ON tbb.figure_brand_id = tb.figure_brand
						INNER JOIN ".DB_FIGURE_SCALES." tbs ON tbs.figure_scale_id = tb.figure_scale
						INNER JOIN ".DB_FIGURE_YEARS." tby ON tby.figure_year_id = tb.figure_pubdate
						".(multilang_table("FI") ? "WHERE figure_language='".LANGUAGE."' AND" : "WHERE")." tb.figure_freigabe='1' 
						AND figure_userfigures_user_id=".$userdata['user_id']."
						LIMIT ".$_GET['rowstart'].",".$fil_settings['figure_per_page']."
			");
			$numrows = dbrows($result);
			$info['figure_rows'] = $numrows;
			$fil_settings = get_settings("figurelib");
			
			$info['page_nav'] = $max_rows > $fil_settings['figure_per_page'] ? makepagenav($_GET['rowstart'], $fil_settings['figure_per_page'], $max_rows, 3, INFUSIONS."figurelib/mycollection.php?&amp;") : 0;
			//$info['page_nav'] = ($max_rows > $fil_settings['figure_per_page']) ? makepagenav($_GET['rowstart'], $fil_settings['figure_per_page'], $max_rows, 3, FUSION_SELF."?&amp;") : "";

	if (dbrows($result) > 0) {
				

				// WENN DATEN UNGLEICH = 0 DANN DARSTELLUNG DER DATEN
	 		
				echo "<hr>";				
				echo "<div class='row'>\n";					
				echo "<div class='navbar-default'>";
				echo "<div class='container-fluid'>\n";
				echo "<div class='table-responsive'>\n";
				
										
						// COLUMN 1 (image)
						echo "<div class='col-lg-1 col-md-2 col-sm-2 col-xs-2'>\n";
							echo "<div class='text-smaller text-uppercase'>".$locale['CLFP_018']."</div>\n";
						echo "</div>\n";

						// COLUMN 2 (name of figure)
						echo "<div class='col-lg-3 col-md-3 col-sm-4 col-xs-4'>\n";
							echo "<div class='text-smaller text-uppercase'>".$locale['CLFP_002']."</div>\n";
						echo "</div>\n";						
						
						// COLUMN 3 (manufacturer)
						echo "<div class='col-lg-2 col-md-3 col-sm-4 col-xs-4'>\n";
							echo "<div class='text-smaller text-uppercase'>".$locale['CLFP_003']."</div>\n";
						echo "</div>\n";
						
						// COLUMN 4 (brand)
						echo "<div class='col-lg-2 hidden-md hidden-sm hidden-xs'>\n";
							echo "<div class='text-smaller text-uppercase'>".$locale['CLFP_004']."</div>\n";
						echo "</div>\n";
						
						// COLUMN 5 (scale)
						echo "<div class='col-lg-1 col-md-2 hidden-sm hidden-xs'>\n";
							echo "<div class='text-smaller text-uppercase'>".$locale['CLFP_005']."</div>\n";
						echo "</div>\n";
						
						// COLUMN 6 (release date)
						echo "<div class='col-lg-1 col-md-2 col-sm-2 col-xs-2'>\n";
							echo "<div class='text-smaller text-uppercase'>".$locale['CLFP_006']."</div>\n";
						echo "</div>\n";
						
						// COLUMN 7 (rating)
						echo "<div class='col-lg-2 hidden-md hidden-sm hidden-xs'>\n";
							echo "<div class='text-smaller text-uppercase'>".$locale['CLFP_010']."</div>\n";
						echo "</div>\n";
						
				echo "</div>\n";
				echo "</div>\n";
				echo "</div>\n";
				echo "</div>\n";
				
				echo "<hr>";
		 
		while($data = dbarray($result)){
		
					// WHILE SCHLEIFE FÜR DAS HOLEN DES BILDES AUS ORDNER / ORDNER MUSS IN infusion.db.php deklariert sein!				
					$result2 = dbquery("SELECT
						   figure_images_image_id,
						   figure_images_image,
						   figure_images_thumb
						FROM ".DB_FIGURE_IMAGES."
						WHERE figure_images_figure_id='".$data['figure_id']."' LIMIT 0,1");
 
						if(dbrows($result2)){
				 
							while($data2 = dbarray($result2)){
									
									echo "<div class='container-fluid'>\n";
									echo "<div class='table-responsive'>\n";
									echo "<div class='row'>\n";	
									
									// COLUMN 1 (image clickable)
									echo "<div class='col-lg-1 col-md-2 col-sm-2 col-xs-2'>\n";
										echo "<div class='side-small'><a href='".INFUSIONS."figurelib/figures.php?figure_id=".$data['figure_id']."'>\n<img src='".THUMBS_FIGURES.$data2['figure_images_thumb']."' alt='".$locale['CLFP_002']." : ".$data['figure_title']."' title='".$locale['CLFP_002']." : ".$data['figure_title']."' style='border:0px;max-height:30px;max-width:30px'/></a>";
									echo "</div></div>\n";					
							}
						} else { 
									
									echo "<div class='col-lg-1 col-md-2 col-sm-2 col-xs-2'>\n";
										echo "<div class='side-small'><a href='".INFUSIONS."figurelib/figures.php?figure_id=".$data['figure_id']."'>\n<img src='".INFUSIONS.$inf_folder."/images/default.png' alt='".$locale['CLFP_002']." : ".$data['figure_title']."' title='".$locale['CLFP_002']." : ".$data['figure_title']."' style='border:0px;max-height:30px;max-width:30px'/></a>";
									echo "</div></div>\n";				
							
						}	

						// COLUMN 2 (name of figure)
						echo "<div class='col-lg-3 col-md-3 col-sm-4 col-xs-4'>\n";
							echo "<div class='side-small'><a href='".INFUSIONS."figurelib/figures.php?figure_id=".$data['figure_id']."' title='".$locale['CLFP_002']." : ".$data['figure_title']."' alt='".$locale['CLFP_002']." : ".$data['figure_title']."'>".trimlink($data['figure_title'], 10)."</a>";
						echo "</div></div>\n";	

						// COLUMN 3 (manufacturer)
						echo "<div class='col-lg-2 col-md-3 col-sm-4 col-xs-4'>\n";
							echo "<div class='side-small' title='".$locale['CLFP_003']." : ".$data['figure_manufacturer_name']."' alt='".$locale['CLFP_003']." : ".$data['figure_manufacturer_name']."'>".trimlink($data['figure_manufacturer_name'],10)."</div>\n";
						echo "</div>\n";
						
						// COLUMN 4 (brand)
						echo "<div class='col-lg-2 hidden-md hidden-sm hidden-xs'>\n";
							echo "<div class='side-small' title='".$locale['CLFP_004']." : ".$data['figure_brand_name']."' alt='".$locale['CLFP_004']." : ".$data['figure_brand_name']."'>".trimlink($data['figure_brand_name'],10)."</div>\n";
						echo "</div>\n";
						
						// COLUMN 5 (scale)
						echo "<div class='col-lg-1 col-md-2 hidden-sm hidden-xs'>\n";
							echo "<div class='side-small' title='".$locale['CLFP_005']." : ".$data['figure_scale_name']."' alt='".$locale['CLFP_005']." : ".$data['figure_scale_name']."'>".trimlink($data['figure_scale_name'],7)."</div>\n";
						echo "</div>\n";
			
					// No release date or unknown = "no data" / WENN KEIN WERT ZUM DATUM IN DB DANN ZEIGE HINWEIS "NO DATA"
						if ($data['figure_pubdate'] == "") {
							
									// COLUMN 6 (release date)
									echo "<div class='col-lg-1 col-md-2 col-sm-2 col-xs-2'>\n";
										echo "<div class='side-small' title='".$locale['CLFP_006']." : ".$locale['CLFP_008']."' alt='".$locale['CLFP_006']." : ".$locale['CLFP_008']."'>".$locale['CLFP_008']."</div>\n";
									echo "</div>\n";			
						} else {
							
									echo "<div class='col-lg-1 col-md-2 col-sm-2 col-xs-2'>\n";
										echo "<div class='side-small' title='".$locale['CLFP_006']." : ".$data['figure_year']."' alt='".$locale['CLFP_006']." : ".$data['figure_year']."'>".$data['figure_year']."</div>\n";
									echo "</div>\n";						
						} 
		
						// COLUMN 7 (rating)
						$drating = dbarray(dbquery("
						   SELECT 
								SUM(rating_vote) sum_rating, 
								COUNT(rating_item_id) count_votes 
								FROM ".DB_RATINGS." 
								WHERE rating_type='FI' 
								AND  rating_item_id='".$data['figure_id']."'
							")); 
   
						$rating = ($drating['count_votes'] > 0 ? str_repeat("<img src='".INFUSIONS.$inf_folder."/images/starsmall.png'>",ceil($drating['sum_rating']/$drating['count_votes'])) : "-");
						
						echo "<div class='col-lg-2 hidden-md hidden-sm hidden-xs'>\n";
							echo "<div class='side-small' title='".$locale['CLFP_010']."' alt='".$locale['CLFP_010']."'>".$rating."</div>\n";
						echo "</div>\n";
  				
				echo "</div>\n";
				echo "</div>\n";
				echo "</div>\n";
						
		}
				echo "<hr>\n";
				
				// PAGE NAV
				echo $info['page_nav'] ? "<div class='text-right'>".$info['page_nav']."</div>" : '';

					if (iADMIN || iSUPERADMIN) {		
										
								echo "<div class='row'>\n";	
								echo "<div class='navbar-default'>";
								echo "<div class='container-fluid'>\n";
								echo "<div class='table-responsive'>\n";
								
										// ['CLFP_016']." = "Admin"
										echo "<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>\n";
											echo "<div align='center'><a href='".INFUSIONS.'figurelib/admin.php'.$aidlink."'>".$locale['CLFP_016']."</a>				  </div></div>\n";
								echo "</div>\n";
								echo "</div>\n";
								echo "</div>\n";
								echo "</div>\n";
								echo "<hr>\n";
					}
											
		
		}
	} else {
			
						echo "<div style='text-align: center;'>".$locale['CLFP_001']."</div>"; // 001 = No figures available"
	}
		closeside();
						echo "</div>";
		
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
/*		
	error_reporting(E_ALL);
	// Formularinhalte prüfen
	echo "Formularinhalte prüfen:";
	print_r ($_POST);
	echo "<br>";
	// GET-Parameter prüfen
	echo "GET-Parameter prüfen:";
	print_r ($_GET);
	// Sessions prüfen
	print_r ($_SESSION);
	*/
	
require_once THEMES."templates/footer.php";
