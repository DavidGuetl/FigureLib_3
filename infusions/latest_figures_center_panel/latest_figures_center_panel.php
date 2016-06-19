<?php
/***************************************************************************
 *   LATEST FIGURES CENTER PANEL                                           *
 *                                                                         *
 *   Copyright (C) 2016 Catzenjaeger                                       *
 *   www.aliencollectors.com                                               *
 *                                                                         *
 *   This program is free software; you can redistribute it and/or modify  *
 *   it under the terms of the GNU General Public License as published by  *
 *   the Free Software Foundation; either version 2 of the License, or     *
 *   (at your option) any later version.                                   *
 ***************************************************************************/
if (!defined("IN_FUSION")) { die("Access Denied"); }
global $aidlink;
include INFUSIONS."figurelib/infusion_db.php";
require_once INCLUDES."infusions_include.php";

// CENTER PANEL
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
$locale['lastentries']= "Last Figures";		


		// DATENBANK AUSLESEN UND DATEN BEREITSTELLEN

		$result = dbquery(
			"SELECT tb.figure_id, tb.figure_submitter, tb.figure_freigabe, tb.figure_pubdate, tb.figure_scale, tb.figure_title, tb.figure_manufacturer, tb.figure_brand, tb.figure_datestamp, tb.figure_cat, tbc.figure_cat_id, tbc.figure_cat_name, tbu.user_id, tbu.user_name, tbu.user_status, tbu.user_avatar, tbm.figure_manufacturer_name, tbb.figure_brand_name, tby.figure_year_id, tby.figure_year, tbs.figure_scale_id, tbs.figure_scale_name FROM ".DB_FIGURE_ITEMS." tb
			LEFT JOIN ".DB_USERS." tbu ON tb.figure_submitter=tbu.user_id
			INNER JOIN ".DB_FIGURE_CATS." tbc ON tb.figure_cat=tbc.figure_cat_id
			INNER JOIN ".DB_FIGURE_MANUFACTURERS." tbm ON tbm.figure_manufacturer_id = tb.figure_manufacturer
			INNER JOIN ".DB_FIGURE_BRANDS." tbb ON tbb.figure_brand_id = tb.figure_brand
			INNER JOIN ".DB_FIGURE_SCALES." tbs ON tbs.figure_scale_id = tb.figure_scale
			INNER JOIN ".DB_FIGURE_YEARS." tby ON tby.figure_year_id = tb.figure_pubdate
			".(multilang_table("FI") ? "WHERE figure_language='".LANGUAGE."' AND" : "WHERE")." tb.figure_freigabe='1' 
			ORDER BY figure_datestamp DESC LIMIT 0,10");
		
		// PANEL ÖFFNEN / ANFANG		
 
 opentable($locale['lastentries']);
 	 
		// WENN DATEN UNGLEICH = 0 DANN DARSTELLUNG DER DATEN
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
			
		// WHILE SCHLEIFE FÜR DAS HOLEN DES BILDES AUS ORDNER / ORDNER MUSS IN infusion.db.php deklariert sein!
				$result2 = dbquery("SELECT
					figure_images_image_id,
					figure_images_image,
					figure_images_thumb 
					FROM ".DB_FIGURE_IMAGES." 
					WHERE figure_images_figure_id='".$data['figure_id']."' LIMIT 0,1");
		
		while($data2 = dbarray($result2)){

		// WENN KEIN BILD VORHANDEN DANN ZEIGE PLATZHALTER BILD
			if ($data2['figure_images_thumb'] == "") {
				echo "<td class='side-small'><a href='".INFUSIONS."figurelib/figures.php?figure_id=".$data['figure_id']."' class=''>\n<img src='".INFUSIONS."figurelib/images/default.png"."' alt='".trimlink($data['figure_title'],50)."' title='".trimlink($data['figure_title'],100)."' style='border:0px;max-height:40px;max-width:40px' /></td>";
			} else {  
 
				echo "<td class='side-small'><a href='".INFUSIONS."figurelib/figures.php?figure_id=".$data['figure_id']."' class=''>\n<img src='".($data2['figure_images_thumb'] ? THUMBS_FIGURES.$data2['figure_images_thumb'] : INFUSIONS.$inf_folder."/images/default.png")."' alt='".trimlink($data['figure_title'],100)."' title='".trimlink($data['figure_title'],50)."' style='border:0px;max-height:40px;max-width:40px' /></td>";
			}
		}
			echo "<td class='side-small'>
			<a href='".INFUSIONS."figurelib/figures.php?figure_id=".$data['figure_id']."'>".trimlink($data['figure_title'], 18)."</a>
			</td>";
			echo "<td class='side-small'>".trimlink($data['figure_manufacturer_name'],18)."</td>";
			echo "<td>".trimlink($data['figure_brand_name'],18)."</td>";
			echo "<td>".trimlink($data['figure_scale_name'],7)."</td>";
 
	// WENN KEIN WERT ZUM DATUM IN DB DANN ZEIGE HINWEIS "NO DATA"
			if ($data['figure_pubdate'] == "") {
			
				echo "<td>".$locale['CLFP_008']."</td>";
			
			} else {
			
				echo "<td>".$data['figure_year']."</td>";
			
			} 

		
	// BEWERTUNG
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
			
	if (iMEMBER) {  		
			echo "<table cellpadding='0' cellspacing='1' class='breadcrumb' style='text-align:center;width:100%; margin-bottom: 4px;'>";
			echo "
					<colgroup>
						<col width='25%'>
						<col width='25%'>
						<col width='25%'>
						<col width='25%'>
					</colgroup>
				\n";
			
 
			echo "<tr>";
			// ['CLFP_009']= "Categories";
			echo "<td align='center' class='tbl2'>
						<a href='".INFUSIONS."figurelib/figures.php'><strong>".$locale['CLFP_013']."</strong></a>
					</td>\n";
			// ['CLFP_010']= "Submit";
			echo "<td align='center' class='tbl2'>
						<a href='".INFUSIONS."figurelib/submit.php'><strong>".$locale['CLFP_014']."</strong></a>
					</td>\n";
			// ['CLFP_011']= "Most viewed";
			echo "<td align='center' class='tbl2'>
						<a href='".INFUSIONS."figurelib/panels/most_clicked_figures_center_panel.php'>
						<strong>".$locale['CLFP_015']."</strong></a>
					</td>\n";
			// ['CLFP_012']= "Admin";
			echo "<td align='center' class='tbl2'>
						<a href='".INFUSIONS.'figurelib/admin.php'.$aidlink."'>
						<strong>".$locale['CLFP_016']."</strong></a>
					</td>\n";
			echo "</tr>";
			echo "</table>";
			
			}
 } else {
			echo "<div style='text-align: center;'>".$locale['CLFP_001']."</div>"; // 001 = No figures available"
 }
 
 closetable();
 