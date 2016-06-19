<?php

	error_reporting(E_ALL);
	// Formularinhalte prüfen
	print_r ($_POST);
	// GET-Parameter prüfen
	print_r ($_GET);
	// Sessions prüfen
	print_r ($_SESSION);
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright (C) 2002 - 2011 Nick Jones
| http://www.php-fusion.co.uk/
+--------------------------------------------------------+
| Filename: figure.php
| Author: Khalid545
| URL: http://khalidb.co.cc/
| E-Mail: khalidd545@gmail.com
| 
| Modification: Catzenjaeger
| URL: www.aliencollectors.com
| E-Mail: admin@aliencollectors.com
| 
| Original file: downloads.php By Nick Jones (Digitanium)
+--------------------------------------------------------+
| This program is released as free software under the
| Affero GPL license. You can redistribute it and/or
| modify it under the terms of this license which you
| can read by viewing the included agpl.txt or online
| at www.gnu.org/licenses/agpl.html. Removal of this
| copyright header is strictly prohibited without
| written permission from the original author(s).
+--------------------------------------------------------*/
require_once "../../maincore.php";
require_once THEMES."templates/header.php";
include "infusion_db.php";

//////////////////////////////////////////////////////////////////////
//////////CLICKCOUNTER FÜR FIGUR//////////////////////////////////////
//////////////////////////////////////////////////////////////////////
			
			if (isset($_GET['figure_id']) && isnum($_GET['figure_id'])) {
			$res = 0;
			//$data = dbarray(dbquery("SELECT figure_clickcount FROM ".DB_FIGURE_ITEMS." WHERE figure_id='".intval($_GET['figure_id'])."'"));
			//$data = dbarray(dbquery("SELECT figure_clickcount, figure_cat_access FROM ".DB_FIGURE_ITEMS." WHERE figure_id='".intval($_GET['figure_id'])."'"));
			
			$data = dbarray(dbquery("SELECT f.figure_clickcount, fc.figure_cat_access FROM ".DB_FIGURE_ITEMS." AS f LEFT JOIN ".DB_FIGURE_CATS." AS fc ON f.figure_cat=fc.figure_cat_id WHERE f.figure_id='".intval($_GET['figure_id'])."'"));
			if (checkgroup($data['figure_cat_access'])) {
				$res = 1;	
				dbquery("UPDATE ".DB_FIGURE_ITEMS." SET figure_clickcount=figure_clickcount+1 WHERE figure_id='".intval($_GET['figure_id'])."'");
				//redirect($data['figure_url']);
			} else {
			redirect(FUSION_SELF);
			}
				}
//////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////		
//////////////////////////////////////////////////////////////////////	
add_to_title($locale['global_200'].$locale['INF_TITLE']);

$name = array(); $parents = array();
$result = dbquery("SELECT figure_cat_id, figure_cat_name, figure_cat_parent FROM ".DB_PREFIX."figure_cats");
if (dbrows($result)) {
	while ($data = dbarray($result)) {
		$name[$data['figure_cat_id']] = $data['figure_cat_name'];
		$parents[$data['figure_cat_id']] = $data['figure_cat_parent'];
	}
}

if (isset($_GET['figure_id']) && isnum($_GET['figure_id'])) {

			
		$result = dbquery(
				"SELECT ta.*, tu.user_id, tu.user_name, tu.user_status FROM ".DB_FIGURE_ITEMS." ta
				LEFT JOIN ".DB_USERS." tu ON ta.figure_title=tu.user_id
				LEFT JOIN ".DB_FIGURE_CATS." tc ON ta.figure_cat=tc.figure_cat_id	
				WHERE figure_id='".$_GET['figure_id']."'"
		);	
		if (dbrows($result)) {
			$data = dbarray($result);
		
				
	
			opentable($locale['INF_TITLE'].$locale['global_201'].$data['figure_title']);

				add_to_title($locale['global_201'].$data['figure_title']);
	
			$new = "";
				if ($data['figure_datestamp'] + 604800 > time() + ($settings['timeoffset'] * 3600)) {
					$new = "<span class='small'>".$locale['figure_410']."</span>";
				}
			//////////////////////////////////////////////////////////////////////////////////////////////
			// TABELLE ANFANG ////////////////////////////////////////////////////////////////////////////
			//////////////////////////////////////////////////////////////////////////////////////////////
			echo "<center><table class='tbl-border' width='100%'>\n";
			
			//////////////////////////////////////////////////////////////////////////////////////////////
			// 9 MINIBILDER A 3 X 3 BILDER  //////////////////////////////////////////////////////////////
			//////////////////////////////////////////////////////////////////////////////////////////////
		
					  echo "<tr>\n";
					  
						// COVERBILD
						echo "<td align='center' class='tbl-border tbl1' rowspan='3'><a href='".($data['figure_image'] ? IMAGES_FIGURE.$data['figure_image'] : INFUSIONS.$inf_folder."/images/default.png")."'  height='100%' width='100%' alt='".$data['figure_title']."'><img src='".($data['figure_image'] ? IMAGES_FIGURE.$data['figure_image'] : INFUSIONS.$inf_folder."/images/default.png")."'  height='100%' width='400px' alt='".$data['figure_title']."' /></a>\n";
						// THUMB 1
						echo "<td align='center' class='tbl-border tbl1'><a href='".($data['figure_image'] ? IMAGES_FIGURE.$data['figure_image'] : INFUSIONS.$inf_folder."/images/default.png")."'  height='100%' width='100%' alt='".$data['figure_title']."'><img src='".($data['figure_image'] ? IMAGES_FIGURE.$data['figure_image'] : INFUSIONS.$inf_folder."/images/default.png")."'  height='100%' width='50px' alt='".$data['figure_title']."' /></a></td>\n";
						// THUMB 2
						echo "<td align='center' class='tbl-border tbl1'><a href='".($data['figure_image'] ? IMAGES_FIGURE.$data['figure_image'] : INFUSIONS.$inf_folder."/images/default.png")."'  height='100%' width='100%' alt='".$data['figure_title']."'><img src='".($data['figure_image'] ? IMAGES_FIGURE.$data['figure_image'] : INFUSIONS.$inf_folder."/images/default.png")."'  height='100%' width='50px' alt='".$data['figure_title']."' /></a></td>\n";
						// THUMB 3
						echo "<td align='center' class='tbl-border tbl1'><a href='".($data['figure_image'] ? IMAGES_FIGURE.$data['figure_image'] : INFUSIONS.$inf_folder."/images/default.png")."'  height='100%' width='100%' alt='".$data['figure_title']."'><img src='".($data['figure_image'] ? IMAGES_FIGURE.$data['figure_image'] : INFUSIONS.$inf_folder."/images/default.png")."'  height='100%' width='50px' alt='".$data['figure_title']."' /></a></td>\n";
					  
					  echo "</tr>\n";
					  echo "<tr>\n";
						// THUMB 4
						echo "<td align='center' class='tbl-border tbl1'><a href='".($data['figure_image'] ? IMAGES_FIGURE.$data['figure_image'] : INFUSIONS.$inf_folder."/images/default.png")."'  height='100%' width='100%' alt='".$data['figure_title']."'><img src='".($data['figure_image'] ? IMAGES_FIGURE.$data['figure_image'] : INFUSIONS.$inf_folder."/images/default.png")."'  height='100%' width='50px' alt='".$data['figure_title']."' /></a></td>\n";
						// THUMB 5
						echo "<td align='center' class='tbl-border tbl1'><a href='".($data['figure_image'] ? IMAGES_FIGURE.$data['figure_image'] : INFUSIONS.$inf_folder."/images/default.png")."'  height='100%' width='100%' alt='".$data['figure_title']."'><img src='".($data['figure_image'] ? IMAGES_FIGURE.$data['figure_image'] : INFUSIONS.$inf_folder."/images/default.png")."'  height='100%' width='50px' alt='".$data['figure_title']."' /></a></td>\n";
						// THUMB 6
						echo "<td align='center' class='tbl-border tbl1'><a href='".($data['figure_image'] ? IMAGES_FIGURE.$data['figure_image'] : INFUSIONS.$inf_folder."/images/default.png")."'  height='100%' width='100%' alt='".$data['figure_title']."'><img src='".($data['figure_image'] ? IMAGES_FIGURE.$data['figure_image'] : INFUSIONS.$inf_folder."/images/default.png")."'  height='100%' width='50px' alt='".$data['figure_title']."' /></a></td>\n";
					  
					  echo "</tr>\n";
					  echo "<tr>\n";
						// THUMB 7
						echo "<td align='center' class='tbl-border tbl1'><a href='".($data['figure_image'] ? IMAGES_FIGURE.$data['figure_image'] : INFUSIONS.$inf_folder."/images/default.png")."'  height='100%' width='100%' alt='".$data['figure_title']."'><img src='".($data['figure_image'] ? IMAGES_FIGURE.$data['figure_image'] : INFUSIONS.$inf_folder."/images/default.png")."'  height='100%' width='50px' alt='".$data['figure_title']."' /></a></td>\n";
						// THUMB 8
						echo "<td align='center' class='tbl-border tbl1'><a href='".($data['figure_image'] ? IMAGES_FIGURE.$data['figure_image'] : INFUSIONS.$inf_folder."/images/default.png")."'  height='100%' width='100%' alt='".$data['figure_title']."'><img src='".($data['figure_image'] ? IMAGES_FIGURE.$data['figure_image'] : INFUSIONS.$inf_folder."/images/default.png")."'  height='100%' width='50px' alt='".$data['figure_title']."' /></a></td>\n";
						// THUMB 9
						echo "<td align='center' class='tbl-border tbl1'><a href='".($data['figure_image'] ? IMAGES_FIGURE.$data['figure_image'] : INFUSIONS.$inf_folder."/images/default.png")."'  height='100%' width='100%' alt='".$data['figure_title']."'><img src='".($data['figure_image'] ? IMAGES_FIGURE.$data['figure_image'] : INFUSIONS.$inf_folder."/images/default.png")."'  height='100%' width='50px' alt='".$data['figure_title']."' /></a></td>\n";
					 
					 echo "</tr>\n";
			// ZEILE FÜR I'M LOOKING FOR THIS FIGURE | I HAVE THIS FIGURE | I SELL THIS FIGURE | BUY THIS FIGURE		 
			echo "<tr><td align='center' class='tbl-border tbl1' colspan='4' width='100%'>\n";		 
			echo "<a href='x' target='_blank'>I'M LOOKING FOR THIS FIGURE</a> | <a href='x' target='_blank'>I HAVE THIS FIGURE</a> | <a href='x' target='_blank'>I SELL THIS FIGURE</a> | <a href='x' target='_blank'>BUY THIS FIGURE</a>";			
			
			echo "</td></tr>\n";
				
			//ZEILE SOCIALMEDIA BUTTONS SHARING BUTTONS - über komplette Breite der Tabelle						
			echo "<tr><td class='tbl-border tbl1' colspan='4' width='100%'>\n";
						if ($asettings['social_sharing']) {
							echo "<div style='text-align:center'>\n";
							$link = $settings['siteurl'].str_replace("../","",INFUSIONS).$inf_folder."/figure.php?figure_id=".$_GET['figure_id'];
							echo "<a href='http://www.facebook.com/share.php?u=".$link."' target='_blank'><img alt='Facebook' src='".INFUSIONS.$inf_folder."/images/facebook.png' border='0'></a>&nbsp;\n";
							echo "<a href='http://twitter.com/share?url=".$link."' target='_blank'><img alt='Twitter' src='".INFUSIONS.$inf_folder."/images/twitter.png' border='0'></a>&nbsp;\n";
							echo "<a href='http://digg.com/submit?url=".$link."' target='_blank'><img alt='Digg' src='".INFUSIONS.$inf_folder."/images/digg.png' border='0'></a>&nbsp;\n";
							echo "<a href='http://reddit.com/submit?url=".$link."' target='_blank'><img alt='Reddit' src='".INFUSIONS.$inf_folder."/images/reddit.png' border='0'></a>&nbsp;\n";
							echo "<a href='http://del.icio.us/post?url=".$link."' target='_blank'><img alt='Del.icio.us' src='".INFUSIONS.$inf_folder."/images/delicious.png' border='0'></a>&nbsp;\n";
							echo "</div>\n";
						}
					echo "</td></tr>\n";
			echo "</table>";	
			closetable();
			
/*	///////////////////////////////////////////////////////////////
	// AFFILIATE PANEL  ///////////////////////////////////////////
	///////////////////////////////////////////////////////////////							
	opentable($locale['affiliate'].$data['figure_title']."&nbsp;".$datamanufacturer['figure_manufacturer_name']."&nbsp;</b> (<b>".cat_parents($data['figure_cat'])."</b>)");	


		// CSS 
		echo "<style type='text/css'>
		<!--
		table {
		  border-collapse: collapse;
		  border: 1px solid #eeeeee;
		}
		-->
		</style>\n";			
			
			echo "<table style='cellspacing:10px; cellpadding:10px;' class='table' width='100%'>\n";
		
			 // ERSTE ZEILE ESHOP (PRIORITÄT 1)		 
			 if ($data['figure_eshop'] == "") { 
						} else { 
						echo "<tr><td style='text-align:center; vertical-align:middle;' colspan='4'><a href='".$data['figure_eshop']."'</a>".trimlink($data['figure_eshop'],15)."</td></tr>\n"; }	
			 
			// ZWEITE ZEILE AFFILIATE (PRIORITÄT 2)			 
			 if ($data['figure_affiliate_1']  ||  $data['figure_affiliate_2'] ||  $data['figure_affiliate_3'] || $data['figure_affiliate_4'] != "") { 
			 
				 echo "<tr>\n";
				 echo "<colgroup><col width='25%'><col width='25%'><col width='25%'><col width='25%'></colgroup>\n"; 
				 echo "<td style='text-align:center; vertical-align:middle;'>	\n";	 
						if ($data['figure_affiliate_1'] == "") { echo "".$locale['figure_033']."";
							} else { echo "<a href='".$data['figure_affiliate_1']."'</a>".trimlink($data['figure_affiliate_1'],15)."</td>\n"; }		 
				 echo "<td align='center'>\n";	 
						if ($data['figure_affiliate_2'] == "") { echo "".$locale['figure_033']."";
							} else { echo "<a href='".$data['figure_affiliate_2']."'</a>".trimlink($data['figure_affiliate_2'],15)."</td>\n"; }	
				 echo "<td align='center'>\n";	 
						if ($data['figure_affiliate_3'] == "") { echo "".$locale['figure_033']."";
							} else { echo "<a href='".$data['figure_affiliate_3']."'</a>".trimlink($data['figure_affiliate_3'],15)."</td>\n"; }	
				 echo "<td align='center'>\n";	 
						if ($data['figure_affiliate_4'] == "") { echo "".$locale['figure_033']."";
							} else { echo "<a href='".$data['figure_affiliate_4']."'</a>".trimlink($data['figure_affiliate_4'],15)."</td>\n"; }	
				 echo "</tr>\n";
			 } else { 
			 }
			 
			// DRIITE ZEILE AFFILIATE (PRIORITÄT 2)		 
			if ($data['figure_affiliate_5']  ||  $data['figure_affiliate_6'] ||  $data['figure_affiliate_7'] || $data['figure_affiliate_8'] != "") { 
			 
				 echo "<tr>\n";
				 echo "<colgroup><col width='25%'><col width='25%'><col width='25%'><col width='25%'></colgroup>\n"; 
				 echo "<td style='text-align:center; vertical-align:middle;'>	\n";	 
						if ($data['figure_affiliate_5'] == "") { echo "".$locale['figure_033']."";
							} else { echo "<a href='".$data['figure_affiliate_5']."'</a>".trimlink($data['figure_affiliate_5'],15)."</td>\n"; }		 
				 echo "<td align='center'>\n";	 
						if ($data['figure_affiliate_6'] == "") { echo "".$locale['figure_033']."";
							} else { echo "<a href='".$data['figure_affiliate_6']."'</a>".trimlink($data['figure_affiliate_6'],15)."</td>\n"; }	
				 echo "<td align='center'>\n";	 
						if ($data['figure_affiliate_7'] == "") { echo "".$locale['figure_033']."";
							} else { echo "<a href='".$data['figure_affiliate_7']."'</a>".trimlink($data['figure_affiliate_7'],15)."</td>\n"; }	
				 echo "<td align='center'>\n";	 
						if ($data['figure_affiliate_8'] == "") { echo "".$locale['figure_033']."";
							} else { echo "<a href='".$data['figure_affiliate_8']."'</a>".trimlink($data['figure_affiliate_8'],15)."</td>\n"; }	
				 echo "</tr>\n";
			 } else { 
			 }
			
			// VIERTE ZEILE AMAZON COM CA UK DE		
			 echo "<tr>\n";
			 echo "<colgroup><col width='25%'><col width='25%'><col width='25%'><col width='25%'></colgroup>\n"; 
			 echo "<td style='text-align:center; vertical-align:middle;'>	\n";	 
					if ($data['figure_amazon_com'] == "") { echo "".$locale['figure_031a']."";
						} else { echo "<a href='".$data['figure_amazon_com']."'</a>".trimlink($data['figure_amazon_com'],15)."</td>\n"; }		 
			 echo "<td align='center'>\n";	 
					if ($data['figure_amazon_ca'] == "") { echo "".$locale['figure_032a']."";
						} else { echo "<a href='".$data['figure_amazon_ca']."'</a>".trimlink($data['figure_amazon_ca'],15)."</td>\n"; }	
			 echo "<td align='center'>\n";	 
			 		if ($data['figure_amazon_uk'] == "") { echo "".$locale['figure_026a']."";
						} else { echo "<a href='".$data['figure_amazon_uk']."'</a>".trimlink($data['figure_amazon_uk'],15)."</td>\n"; }	
			 echo "<td align='center'>\n";	 
			 		if ($data['figure_amazon_de'] == "") { echo "".$locale['figure_025a']."";
						} else { echo "<a href='".$data['figure_amazon_de']."'</a>".trimlink($data['figure_amazon_de'],15)."</td>\n"; }	
			 echo "</tr>\n";
			 	 		 
			 // FÜNFTE ZEILE AMAZON JP FR ES IT
			 echo "<tr>\n";
			 echo "<colgroup><col width='25%'><col width='25%'><col width='25%'><col width='25%'></colgroup>\n"; 
			 echo "<td style='text-align:center; vertical-align:middle;'>	\n";
					if ($data['figure_amazon_jp'] == "") { echo "".$locale['figure_030a']."";
						} else { echo "<a href='".$data['figure_amazon_jp']."'</a>".trimlink($data['figure_amazon_jp'],15)."</td>\n"; }	
			 echo "<td align='center'>\n";
					if ($data['figure_amazon_fr'] == "") { echo "".$locale['figure_027a']."";
						} else { echo "<a href='".$data['figure_amazon_fr']."'</a>".trimlink($data['figure_amazon_fr'],15)."</td>\n"; }	
			 echo "<td align='center'>\n";
			 		if ($data['figure_amazon_es'] == "") { echo "".$locale['figure_028a']."";
						} else { echo "<a href='".$data['figure_amazon_es']."'</a>".trimlink($data['figure_amazon_es'],15)."</td>\n"; }	
			 echo "<td align='center'>\n";
			 		if ($data['figure_amazon_it'] == "") { echo "".$locale['figure_029a']."";
						} else { echo "<a href='".$data['figure_amazon_it']."'</a>".trimlink($data['figure_amazon_it'],15)."</td>\n"; }	
			 echo "</tr>\n";			
			 echo "</table>\n";	
		closetable();			
*/		
	///////////////////////////////////////////////////////////////
	// FIGURE DATA  ///////////////////////////////////////////
	///////////////////////////////////////////////////////////////		
		
		opentable($locale['figuredata'].$data['figure_title']."&nbsp;&nbsp;".$new."</b> (<b>".cat_parents($data['figure_cat'])."</b>)");	
			

		// LEERZEILE
			echo "<table class='tbl-border' width='100%'>\n";			
			echo "<tr>";	
			echo "<colgroup><col width='50%'><col width='50%'></colgroup>\n"; 
					echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl2'>&nbsp;</td>\n";
					echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl2'>&nbsp;</td>\n";
			echo "<tr>";	
			echo "</table>\n";
			
			// AB HIER DIE FIGUREN DATEN / ZEILEN
			//ZEILE 1 - Variant	/ Scale	
			echo "<table class='tbl-border' width='100%'>\n";			
			echo "<tr>";	
			echo "<colgroup><col width='20%'><col width='30%'><col width='20%'><col width='30%'></colgroup>\n"; 			
			echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl2'><b>".$locale['figure_441'].":</b></td>\n";
			echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl3'>".($data['figure_variant'] ? $data['figure_variant'] : "-")."</td>\n";
			
			$resultscale = dbquery("SELECT * FROM ".DB_FIGURE_ITEMS." JOIN ".DB_FIGURE_SCALES." ON figure_scale = figure_scale_id WHERE figure_id='".$_GET['figure_id']."'");
			if (dbrows($resultscale)) {
			while ($datascale = dbarray($resultscale)) {
					echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl2'><b>".$locale['figure_442'].":</b></td>\n";
					echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl3'>".$datascale['figure_scale_name']."</td>\n";
				}
			} 		
			echo "<tr>";	
			echo "</table>\n";

			//ZEILE 2 - Manufacturer / Weight
			echo "<table class='tbl-border' width='100%'>\n";			
			echo "<tr>";	
			echo "<colgroup><col width='20%'><col width='30%'><col width='20%'><col width='30%'></colgroup>\n";			
		
			$resultmanufacturer = dbquery("SELECT * FROM ".DB_FIGURE_ITEMS." JOIN ".DB_FIGURE_MANUFACTURERS." ON figure_manufacturer = figure_manufacturer_id WHERE figure_id='".$_GET['figure_id']."'");
			if (dbrows($resultmanufacturer)) {
			while ($datamanufacturer = dbarray($resultmanufacturer)) {
					echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl2'><b>".$locale['figure_417'].":</b></td>\n";
					echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl3'>".$datamanufacturer['figure_manufacturer_name']."</td>\n";
				}
			} 	
					echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl2'><b>".$locale['figure_443'].":</b></td>\n";
					echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl3'>".($data['figure_weight'] ? $data['figure_weight'] : "-")."</td>\n";		
			echo "<tr>";	
			echo "</table>\n";
			
			//ZEILE 3 - Sub-Manufacturer (inaktive glöscht) / Height
			echo "<table class='tbl-border' width='100%'>\n";			
			echo "<tr>";	
			echo "<colgroup><col width='20%'><col width='30%'><col width='20%'><col width='30%'></colgroup>\n"; 
					echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl2'><b>&nbsp;</b></td>\n";
					echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl2'>&nbsp;</td>\n";
					
			$resultheight = dbquery("SELECT * FROM ".DB_FIGURE_ITEMS." JOIN ".DB_FIGURE_MEASUREMENTS." ON figure_height = figure_measurements_id WHERE figure_id='".$_GET['figure_id']."'");
			if (dbrows($resultheight)) {
			while ($dataheight = dbarray($resultheight)) {
					echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl2'><b>".$locale['figure_444'].":</b></td>\n";
					echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl3'>".$dataheight['figure_measurements_inch']."</td>\n";
				}
			} 									
			echo "<tr>";	
			echo "</table>\n";
			
			//ZEILE 4 - Artists / Width
			echo "<table class='tbl-border' width='100%'>\n";			
			echo "<tr>";	
			echo "<colgroup><col width='20%'><col width='30%'><col width='20%'><col width='30%'></colgroup>\n"; 			
					echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl2'><b>".$locale['figure_452'].":</b></td>\n";
					echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl3'>".($data['figure_artists'] ? $data['figure_artists'] : "-")."</td>\n";
					
			$resultwidth = dbquery("SELECT * FROM ".DB_FIGURE_ITEMS." JOIN ".DB_FIGURE_MEASUREMENTS." ON figure_width = figure_measurements_id WHERE figure_id='".$_GET['figure_id']."'");
			if (dbrows($resultwidth)) {
			while ($datawidth = dbarray($resultwidth)) {
					echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl2'><b>".$locale['figure_445'].":</b></td>\n";
					echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl3'>".$datawidth['figure_measurements_inch']."</td>\n";
				}
			} 						
			echo "<tr>";	
			echo "</table>\n";
			
			//ZEILE 5 - Country		Depth
			echo "<table class='tbl-border' width='100%'>\n";			
			echo "<tr>";	
			echo "<colgroup><col width='20%'><col width='30%'><col width='20%'><col width='30%'></colgroup>\n"; 			
					echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl2'><b>".$locale['figure_436'].":</b></td>\n";
					echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl3'>".($data['figure_country'] ? $data['figure_country'] : "-")."</td>\n";
			$resultdepth = dbquery("SELECT * FROM ".DB_FIGURE_ITEMS." JOIN ".DB_FIGURE_MEASUREMENTS." ON figure_depth = figure_measurements_id WHERE figure_id='".$_GET['figure_id']."'");
			if (dbrows($resultdepth)) {
			while ($datadepth = dbarray($resultdepth)) {
					echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl2'><b>".$locale['figure_446'].":</b></td>\n";
					echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl3'>".$datadepth['figure_measurements_inch']."</td>\n";
				}
			} 			
			echo "<tr>";	
			echo "</table>\n";
			
			//LEERZEILE
			echo "<table class='tbl-border' width='100%'>\n";			
			echo "<tr>";	
			echo "<colgroup><col width='20%'><col width='30%'><col width='20%'><col width='30%'></colgroup>\n"; 
					echo "<td class='tbl2'>&nbsp;</td>\n";
					echo "<td class='tbl2'>&nbsp;</td>\n";
					echo "<td class='tbl2'>&nbsp;</td>\n";
					echo "<td class='tbl2'>&nbsp;</td>\n";		
			echo "<tr>";	
			echo "</table>\n";
			
			//ZEILE 6 - Brand / Material	
			
			echo "<table class='tbl-border' width='100%'>\n";			
			echo "<tr>";	
			echo "<colgroup><col width='20%'><col width='30%'><col width='20%'><col width='30%'></colgroup>\n"; 
			echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl2'><b>".$locale['figure_438'].":</b></td>\n";
			$resultbrand = dbquery("SELECT * FROM ".DB_FIGURE_ITEMS." JOIN ".DB_FIGURE_BRANDS." ON figure_brand = figure_brand_id WHERE figure_id='".$_GET['figure_id']."'");
			if (dbrows($resultbrand)) {
				while ($databrand = dbarray($resultbrand)) {	
					echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl3'>".$databrand['figure_brand_name']."</td>\n";
				}
			} 		
			$resultmaterial = dbquery("SELECT * FROM ".DB_FIGURE_ITEMS." JOIN ".DB_FIGURE_MATERIALS." ON figure_material = figure_material_id WHERE figure_id='".$_GET['figure_id']."'");
			if (dbrows($resultmaterial)) {
				while ($datamaterial = dbarray($resultmaterial)) {						
					echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl2'><b>".$locale['figure_447'].":</b></td>\n";
					echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl3'>".$datamaterial['figure_material_name']."</td>\n";
				}
			} 	
			echo "<tr>";	
			echo "</table>\n";
			
			//ZEILE 7 - Series / Articulations Points
			echo "<table class='tbl-border' width='100%'>\n";			
			echo "<tr>";	
			echo "<colgroup><col width='20%'><col width='30%'><col width='20%'><col width='30%'></colgroup>\n"; 			
				echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl2'><b>".$locale['figure_439'].":</b></td>\n";
				echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl3'>".($data['figure_series'] ? $data['figure_series'] : "-")."</td>\n";
			
			$resultpoa = dbquery("SELECT * FROM ".DB_FIGURE_ITEMS." JOIN ".DB_FIGURE_POAS." ON figure_poa = figure_poa_id WHERE figure_id='".$_GET['figure_id']."'");
			if (dbrows($resultpoa)) {
			while ($datapoa = dbarray($resultpoa)) {
					echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl2'><b>".$locale['figure_455'].":</b></td>\n";
					echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl3'>".$datapoa['figure_poa_name']."</td>\n";
				}
			} 								
			echo "<tr>";	
			echo "</table>\n";
			
			//ZEILE 8 - Release Date / Packaging
			echo "<table class='tbl-border' width='100%'>\n";			
			echo "<tr>";	
			echo "<colgroup><col width='20%'><col width='30%'><col width='20%'><col width='30%'></colgroup>\n"; 			
				
		$resultyear = dbquery("SELECT * FROM ".DB_FIGURE_ITEMS." JOIN ".DB_FIGURE_YEARS." ON figure_pubdate = figure_year_id WHERE figure_id='".$_GET['figure_id']."'");
		if (dbrows($resultyear)) {
		while ($datayear = dbarray($resultyear)) {
					echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl2'><b>".$locale['figure_419'].":</b></td>\n";
					echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl3'>".$datayear['figure_year']."</td>\n";
			}
		} 											
		$resultpackaging = dbquery("SELECT * FROM ".DB_FIGURE_ITEMS." JOIN ".DB_FIGURE_PACKAGINGS." ON figure_packaging = figure_packaging_id WHERE figure_id='".$_GET['figure_id']."'");
		if (dbrows($resultpackaging)) {
		while ($datapackaging = dbarray($resultpackaging)) {
				echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl2'><b>".$locale['figure_448'].":</b></td>\n";
				echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl3'>".$datapackaging['figure_packaging_name']."</td>\n";	
			}
		} 		
			echo "<tr>";	
			echo "</table>\n";
			
			//LEERZEILE
			echo "<table class='tbl-border' width='100%'>\n";			
			echo "<tr>";	
			echo "<colgroup><col width='20%'><col width='30%'><col width='20%'><col width='30%'></colgroup>\n"; 
					echo "<td class='tbl2'>&nbsp;</td>\n";
					echo "<td class='tbl2'>&nbsp;</td>\n";
					echo "<td class='tbl2'>&nbsp;</td>\n";
					echo "<td class='tbl2'>&nbsp;</td>\n";		
			echo "<tr>";	
			echo "</table>\n";
			
			//ZEILE 9 - MSRP (Price by Release)	/ Used Price	
			echo "<table class='tbl-border' width='100%'>\n";			
			echo "<tr>";	
			echo "<colgroup><col width='20%'><col width='30%'><col width='20%'><col width='30%'></colgroup>\n"; 			
					echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl2' style='width:100px;padding:6px'><b>".$locale['figure_449'].":</b></td>\n";
					echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl3'>".($data['figure_retailprice'] ? $data['figure_retailprice'] : "-")."</td>\n";
					echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl2' style='width:100px;padding:6px'><b>".$locale['figure_456'].":</b></td>\n";
					echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl3'>".($data['figure_usedprice'] ? $data['figure_usedprice'] : "-")."</td>\n";
			echo "<tr>";	
			echo "</table>\n";	

			//ZEILE 10 - Limited Edition YES/NO / Edition Size
			echo "<table class='tbl-border' width='100%'>\n";			
			echo "<tr>";	
			echo "<colgroup><col width='20%'><col width='30%'><col width='20%'><col width='30%'></colgroup>\n"; 

			$resultlimitation = dbquery("SELECT * FROM ".DB_FIGURE_ITEMS." JOIN ".DB_FIGURE_LIMITATIONS." ON figure_limitation = figure_limitation_id WHERE figure_id='".$_GET['figure_id']."'");
			if (dbrows($resultlimitation)) {
			while ($datalimitation = dbarray($resultlimitation)) {
					echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl2'><b>".$locale['figure_450'].":</b></td>\n";
					echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl3'>".$datalimitation['figure_limitation_name']."</td>\n";
				}
			} 	
				echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl2' style='width:100px;padding:6px'><b>".$locale['figure_451'].":</b></td>\n";
				echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl3'>".($data['figure_editionsize'] ? $data['figure_editionsize'] : "-")."</td>\n";
			echo "<tr>";	
			echo "</table>\n";	
			
			//LEERZEILE
			echo "<table class='tbl-border' width='100%'>\n";			
			echo "<tr>";	
			echo "<colgroup><col width='20%'><col width='30%'><col width='20%'><col width='30%'></colgroup>\n"; 
					echo "<td class='tbl2'>&nbsp;</td>\n";
					echo "<td class='tbl2'>&nbsp;</td>\n";
					echo "<td class='tbl2'>&nbsp;</td>\n";
					echo "<td class='tbl2'>&nbsp;</td>\n";		
			echo "<tr>";	
			echo "</table>\n";

			//ZEILE 11 - Accessories / 
			echo "<table class='tbl-border' width='100%'>\n";			
			echo "<tr>";	
			echo "<colgroup><col width='20%'><col width='80%'></colgroup>\n"; 			
					echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl2'><b>".$locale['figure_457'].":</b></td>\n";
					echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl3'>".($data['figure_accessories'] ? $data['figure_accessories'] : "-")."</td>\n";	
			echo "</tr>";		
			echo "<tr>";		
		if ($data['figure_description']) {
					echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl2'><b>".$locale['figure_423'].":</b></td>\n";
					echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl3'>".nl2br(parseubb(parsesmileys($data['figure_description'])))."</td>";
				}					
			echo "</tr>";	
			echo "</table>\n";	
		
		// LEERZEILE
			echo "<table class='tbl-border' width='100%'>\n";			
			echo "<tr>";	
			echo "<colgroup><col width='50%'><col width='50%'></colgroup>\n"; 
					echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl2'>&nbsp;</td>\n";
					echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl2'>&nbsp;</td>\n";
			echo "<tr>";	
			echo "</table>\n";			
			
				closetable();		
	///////////////////////////////////////////////////////////////
	// RELATED FIGURES  ///////////////////////////////////////////
	///////////////////////////////////////////////////////////////	
				if ($asettings['related']) {
					opentable($locale['figure_425']);
					//$result3 = dbquery("SELECT ta.figure_id, ta.figure_title, ta.figure_datestamp, ta.figure_count, tac.figure_cat_id, tac.figure_cat_name, tac.figure_cat_access FROM ".DB_FIGURE_ITEMS." ta INNER JOIN ".DB_FIGURE_CATS." tac ON ta.figure_cat=tac.figure_cat_id WHERE MATCH (figure_title) AGAINST ('".$data['figure_title']."' IN BOOLEAN MODE) AND figure_id != ".$data['figure_id']." ".(iSUPERADMIN ? "" : "AND ".groupaccess('figure_cat_access'))." ORDER BY RAND() LIMIT 5");
					
					// ta.figure_count, ENTFERNT
					$result3 = dbquery("SELECT ta.figure_id, ta.figure_title, ta.figure_datestamp, tac.figure_cat_id, tac.figure_cat_name, tac.figure_cat_access FROM ".DB_FIGURE_ITEMS." ta INNER JOIN ".DB_FIGURE_CATS." tac ON ta.figure_cat=tac.figure_cat_id WHERE MATCH (figure_title) AGAINST ('".$data['figure_title']."' IN BOOLEAN MODE) AND figure_id != ".$data['figure_id']." ".(iSUPERADMIN ? "" : "AND ".groupaccess('figure_cat_access'))." ORDER BY RAND() LIMIT 5");
				
					echo "<table width='100%' cellspacing='1' cellpadding='0' class='tbl-border'>\n";
					echo "<tbody><tr>\n";
					echo "<th class='tbl2' align='' width='50%'>".$locale['figure_411']."</th>\n";
					//echo "<th class='tbl2' align='' width='1%'>".$locale['figure_417']."</th>\n";
					echo "<th class='tbl2' align='' width='25%'>".$locale['figure_413']."</th>\n";
					echo "<th class='tbl2' align='' width='25%'>".$locale['figure_418']."</th>\n";
					echo "</tr>\n";
					if (dbrows($result3)) {
						$i = 0;
						while ($data3 = dbarray($result3)) {
							$drating = dbarray(dbquery("SELECT SUM(rating_vote) sum_rating, COUNT(rating_item_id) count_votes FROM ".DB_RATINGS." WHERE rating_item_id='".$data3['figure_id']."' AND rating_type='B'"));
							$num_votes = $drating['count_votes'];
							$rating = ($num_votes > 0 ? str_repeat("<img src='".INFUSIONS.$inf_folder."/images/star.png'>",ceil($drating['sum_rating']/$num_votes)) : "-");
							$cell_color = ($i % 2 == 0 ? "tbl1" : "tbl2"); $i++;
							echo "<tr>\n";
							echo "<td class='$cell_color' width='50%'><a href='figure.php?figure_id=".$data3['figure_id']."' title='".$data3['figure_title']."'>".$data3['figure_title']."</a></td>\n";
							//echo "<td class='$cell_color' align=''>test".$datamanufacturer['figure_manufacturer_name']."".$resultmanufacturer."</td>\n";
							echo "<td class='$cell_color' width='25%' align=''>".$data3['figure_cat_name']."</td>\n";
							echo "<td class='$cell_color' width='25%' align=''>".$rating."</td>\n";
							echo "</tr>\n";
						}
					} else echo "<tr><td class='tbl1' colspan='4' width='33%' align=''>".$locale['figure_426']."</td></tr>";
					echo "</tbody></table>\n";
					closetable();
				}	

				
				//opentable();
				include INCLUDES."comments_include.php";				
				if ($data['figure_allow_comments']) { showcomments("BO", DB_FIGURE_ITEMS, "figure_id", $_GET['figure_id'], FUSION_SELF."?figure_id=".$data['figure_id']); }
				
				//closetable();
				opentable($locale['ratings']);
				include INCLUDES."ratings_include.php";
				if ($data['figure_allow_ratings']) { showratings("B", $_GET['figure_id'], FUSION_SELF."?figure_id=".$_GET['figure_id']); }	
				closetable();				
			} else {
				redirect(FUSION_SELF);
			}
	
	}
if (!isset($_GET['cat_id']) || !isnum($_GET['cat_id'])) {
opentable($locale['INF_TITLE']);
	echo "<!--pre_figure_idx-->\n";
	// AUSKOMMENTIERT DA ID 1 NICHT DARGESTELT WERDEN SOLL (ID 1 = CHOOSE ONE)
	//$result = dbquery("SELECT figure_cat_id, figure_cat_name, figure_cat_description, figure_cat_items FROM ".DB_FIGURE_CATS." WHERE ".groupaccess('figure_cat_access')." AND figure_cat_parent='0' ORDER BY figure_cat_name");
	
	$result = dbquery("SELECT figure_cat_id, figure_cat_name, figure_cat_description, figure_cat_items FROM ".DB_FIGURE_CATS." WHERE figure_cat_parent='0' AND figure_cat_id >'1' ORDER BY figure_cat_name");
	
	$rows = dbrows($result);
	if ($rows) {
		$counter = 0; $columns = 2;
		echo "<table cellpadding='0' cellspacing='0' width='100%'>\n<tr>\n";
		while ($data = dbarray($result)) {
			if ($counter != 0 && ($counter % $columns == 0)) { echo "</tr>\n<tr>\n"; }
			echo "<td valign='top' width='50%' class='tbl figure_idx_cat_name'><!--figure_idx_cat_name--><a href='".FUSION_SELF."?cat_id=".$data['figure_cat_id']."'>".$data['figure_cat_name']."</a> (".$data['figure_cat_items'].")";
			if ($data['figure_cat_description'] != "") { echo "<br />\n<span class='small'>".nl2br(parseubb(parsesmileys($data['figure_cat_description'])))."</span>"; }
			if ($asettings['subcats']) {
				$result2 = dbquery("SELECT figure_cat_id, figure_cat_name, figure_cat_items FROM ".DB_FIGURE_CATS." WHERE figure_cat_parent='".$data['figure_cat_id']."' ORDER BY figure_cat_name");
				if (dbrows($result2) != 0) {
					echo "<br /><strong>".$locale['figure_427'].": </strong>";
					$i = 0;
					while ($data2 = dbarray($result2)) {
						echo ($i!=0 ? $locale['comma']:"")."<a href='".FUSION_SELF."?cat_id=".$data2['figure_cat_id']."'>".$data2['figure_cat_name']."</a> (".$data2['figure_cat_items'].")";
						$i++;
					}
				}
			}
			echo "</td>\n";
			$counter++;
		}
		echo "</tr>\n</table>\n";
	} else {
		echo "<div style='text-align:center'><br />\n".$locale['figure_430']."<br /><br />\n</div>\n";
	}
	echo "<!--sub_figure_idx-->";
closetable();

} else {
	$res = 0;
	$result = dbquery("SELECT figure_cat_id, figure_cat_name, figure_cat_sorting, figure_cat_access, figure_cat_items FROM ".DB_FIGURE_CATS." WHERE figure_cat_id='".$_GET['cat_id']."'");
	if (dbrows($result) != 0) {
		$cdata = dbarray($result);
		if (checkgroup($cdata['figure_cat_access'])) {
			$res = 1;
			add_to_title($locale['global_201'].cat_parents($cdata['figure_cat_id'], "c"));
			opentable($locale['INF_TITLE'].": ".cat_parents($cdata['figure_cat_id'], "c"));
			if ($asettings['subcats']) {
				$result2 = dbquery("SELECT figure_cat_id, figure_cat_name, figure_cat_description, figure_cat_items FROM ".DB_FIGURE_CATS." WHERE  figure_cat_parent='".$cdata['figure_cat_id']."' ORDER BY figure_cat_name");
				if (dbrows($result2) != 0) {
					echo "<table width='100%' style='margin:auto' cellpadding='0' cellspacing='1' class='tbl-border'>\n<tbody>\n";
					echo "<tr><td colspan='2' class='tbl2'>".$locale['figure_427']."</td></tr>";
					$counter = 0; $columns = 2;
					while ($data2 = dbarray($result2)) {
						if ($counter != 0 && ($counter % $columns == 0)) { echo "</tr>\n<tr>\n"; }
						echo "<td valign='top' width='50%' class='tbl figure_idx_cat_name'><!--figure_idx_cat_name--><a href='".FUSION_SELF."?cat_id=".$data2['figure_cat_id']."'>".$data2['figure_cat_name']."</a> (".$data2['figure_cat_items'].")";
						if ($data2['figure_cat_description'] != "") { echo "<br />\n<span class='small'>".nl2br(parseubb(parsesmileys($data2['figure_cat_description'])))."</span>"; }
						echo "</td>\n";
						$counter++;
					}
					echo "</tbody>\n</table>\n<br />\n";
				}
			}
			echo "<!--pre_figure_cat-->";
			$rows = $cdata['figure_cat_items'];
			if (!isset($_GET['rowstart']) || !isnum($_GET['rowstart'])) { $_GET['rowstart'] = 0; }
			if ($rows != 0) {
				$result = dbquery("SELECT * FROM ".DB_FIGURE_ITEMS." WHERE figure_cat='".$_GET['cat_id']."' ORDER BY ".$cdata['figure_cat_sorting']." LIMIT ".$_GET['rowstart'].",".$asettings['figure_per_page']);
				$numrows = dbrows($result); $i = 0;


				if ($asettings['display']) {
					
///////////////////////////////////////////////////////////////////////
////////////// TABELLENANSICHT  ///////////////////////////////////////	
///////////////////////////////////////////////////////////////////////


echo "<b>Tabelleansicht</b>\n";

/*					
					
					
					echo "<table width='100%' style='margin:auto' cellpadding='0' cellspacing='1' class='tbl-border'>\n<tbody>\n";
					echo "<tr>\n<td class='tbl2'>".$locale['figure_411']."</td>\n";
					//MANUFACTURER 417
					echo "<td align='' class='tbl2'>".$locale['figure_417']."</td>\n";
					//echo "<td align='' class='tbl2'>".$locale['figure_417']."</td>\n";
					//echo "<td align='' class='tbl2'>".$locale['figure_424']."</td>\n";
					//echo "<td align='' class='tbl2'>".$locale['figure_412']."</td>\n";
					echo "<td align='' class='tbl2'>".$locale['figure_418']."</td>\n</tr>\n";
					while ($data = dbarray($result)) {
						$cell_color = ($i % 2 == 0 ? "tbl1" : "tbl2"); $i++;
						if ($data['figure_datestamp'] + 604800 > time() + ($settings['timeoffset'] * 3600)) {
							$new = " <span class='small'>".$locale['figure_410']."</span>";
						} else {
							$new = "";
						}
						echo "<tr>\n<td class='$cell_color'>$new <a href='".FUSION_SELF."?figure_id=".$data['figure_id']."'><strong>".$data['figure_title']."</strong></a>\n</td>\n";	
						//echo "<td align='' class='$cell_color'>".($data['figure_author'] ? $data['figure_author'] : "-")."\n</td>\n";
						//echo "<td align='' class='$cell_color'><a href='".FUSION_SELF."?figure_id=".$data['figure_id']."&amp;action=download'><img src='".INFUSIONS.$inf_folder."/images/download.png' alt='".$locale['figure_416']."' border='0' /></a>\n</td>\n";
						
			$resultmanufacturer = dbquery("SELECT * FROM ".DB_FIGURE_ITEMS." JOIN ".DB_FIGURE_MANUFACTURERS." ON figure_manufacturer = figure_manufacturer_id WHERE figure_id=".$data['figure_id']." ");
			if (dbrows($resultmanufacturer)) {
			while ($datamanufacturer = dbarray($resultmanufacturer)) {
														
						echo "<td align='' class='$cell_color'>".$datamanufacturer['figure_manufacturer_name']."\n</td>\n";
				}
			}	
						//echo "<td align='' class='$cell_color'>".$data['figure_count']."\n</td>\n";
						$drating = dbarray(dbquery("SELECT SUM(rating_vote) sum_rating, COUNT(rating_item_id) count_votes FROM ".DB_RATINGS." WHERE rating_item_id='".$data['figure_id']."' AND rating_type='B'"));
						$num_votes = $drating['count_votes'];
						$rating = ($num_votes > 0 ? str_repeat("<img src='".INFUSIONS.$inf_folder."/images/star.png'>",ceil($drating['sum_rating']/$num_votes)) : "-");
						echo "<td align='' class='$cell_color'>".$rating."\n</td>\n</tr>\n";
					}
					echo "</tbody>\n</table>\n";
*/					
					
				} else {
					
/////////////////////////////////////////////////////////////////////////////////					
/////////  GALLERIEANSICHT   ////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////

echo "<b>Gallerieansicht</b>\n";
/*					
					echo "<table style='text-align:center;' cellpadding='0' cellspacing='1' width='100%'>\n<tr>\n";
					while ($data = dbarray($result)) {
						if ($i != 0 && ($i % $asettings['figure_per_line'] == 0)) { echo "</tr>\n<tr>\n"; }
						echo "<td style='text-align:center;' class=''>\n";
						echo "<a href='".FUSION_SELF."?figure_id=".$data['figure_id']."' class=''>\n<img src='".($data['figure_image'] ? IMAGES_FIGURE.$data['figure_image'] : INFUSIONS.$inf_folder."/images/default.png")."' alt='".trimlink($data['figure_title'],15)."' title='".trimlink($data['figure_title'],15)."' style='border:0px;max-height:100px;max-width:100px' />";
						echo "<br /><br />\n";					
			
					//JOIN TABELLE MANUFACTURER UM DEN NAMEN IN KLARTEXT DARZUSTELLEN			
						$resultmanufacturer = dbquery("SELECT * FROM ".DB_FIGURE_ITEMS." JOIN ".DB_FIGURE_MANUFACTURERS." ON figure_manufacturer = figure_manufacturer_id WHERE figure_id=".$data['figure_id']." ");
							if (dbrows($resultmanufacturer)) {
							while ($datamanufacturer = dbarray($resultmanufacturer)) {

						echo "<strong>".$locale['figure_453']."".trimlink($datamanufacturer['figure_manufacturer_name'],15)."".$locale['figure_454']." <br>".trimlink($data['figure_title'],15)."</strong></a><br />\n";
								}
							}					
						echo "<span class='small'>\n";
						echo $locale['figure_414'].": ".showdate("shortdate", $data['figure_datestamp'])."<br />\n";
						$drating = dbarray(dbquery("SELECT SUM(rating_vote) sum_rating, COUNT(rating_item_id) count_votes FROM ".DB_RATINGS." WHERE rating_item_id='".$data['figure_id']."' AND rating_type='B'"));
						$num_votes = $drating['count_votes'];
						$rating = ($num_votes > 0 ? str_repeat("<img src='".INFUSIONS.$inf_folder."/images/star.png'>",ceil($drating['sum_rating']/$num_votes)) : "-");
						echo $locale['figure_418'].": ".$rating."<br />\n";
						$comments = dbcount("(comment_id)", DB_COMMENTS, "comment_type='BO' AND comment_item_id='".$data['figure_id']."'");
						echo $locale['figure_420'].": ".$comments."</span><br />\n";
						echo $locale['clickcount'].": ".$data['figure_clickcount']."</span><br />\n";
						echo "</td>\n";
						$i++;
					}
					echo "</tr>\n</table>\n";
					
*/					
					
				}
				closetable();
				if ($rows > $asettings['figure_per_page']) { echo "<div align='center' style=';margin-top:5px;'>\n".makepagenav($_GET['rowstart'], $asettings['figure_per_page'], $rows, 3, FUSION_SELF."?cat_id=".$_GET['cat_id']."&amp;")."\n</div>\n"; }
			} else {
				echo "<div style='text-align:center'><br />".$locale['figure_431']."<br /><br /></div>\n";
				echo "<!--sub_figure_cat-->";
				closetable();
			}
		}
	}
	if ($res == 0) { redirect(FUSION_SELF); }
}

function cat_parents($id, $type="f") {
	global $parents, $name;
	if ($type=="b") $parent = "<a href='".FUSION_SELF."?cat_id=".$id."' title='".$name[$id]."'>".$name[$id]."</a>";
	else $parent = $name[$id];
	if ($parents[$id]==0) return $parent;
	else return cat_parents($parents[$id], $type)." &raquo; ".$parent;
}

require_once THEMES."templates/footer.php";

///////////////////////////////////
function menu_subcats($id, $name, $level) {
	global $figure_cat;
	$list = "<option value='".$id."'>".str_repeat("&nbsp;&nbsp;&nbsp;&nbsp;",$level-1)." ".$name."</option>\n";
	$sresult[$id] = dbquery("SELECT figure_cat_id, figure_cat_name FROM ".DB_FIGURE_CATS." WHERE figure_cat_parent='".$id."' ORDER BY figure_cat_name");
	if (dbrows($sresult[$id]) != 0) {
		while ($sdata[$id] = dbarray($sresult[$id])) {
			$list .= menu_subcats($sdata[$id]['figure_cat_id'], $sdata[$id]['figure_cat_name'], $level+1);
		}
	}
	return $list;
}
///////////////////////////////////
function menu_submanufacturers($id, $name, $level) {
	global $figure_manufacturer;
	$list = "<option value='".$id."'>".str_repeat("&nbsp;&nbsp;&nbsp;&nbsp;",$level-1)." ".$name."</option>\n";
	$manufacturerresult[$id] = dbquery("SELECT figure_manufacturer_id, figure_manufacturer_name FROM ".DB_FIGURE_MANUFACTURERS." WHERE figure_manufacturer_parent='".$id."' ORDER BY figure_manufacturer_name");
	if (dbrows($manufacturerresult[$id]) != 0) {
		while ($manufacturerdata[$id] = dbarray($manufacturerresult[$id])) {
			$list .= menu_submanufacturers($manufacturerdata[$id]['figure_manufacturer_id'], $manufacturerdata[$id]['figure_manufacturer_name'], $level+1);
		}
	}
	return $list;
}
///////////////////////////////////
function menu_subbrands($id, $name, $level) {
	global $figure_brand;
	$list = "<option value='".$id."'>".str_repeat("&nbsp;&nbsp;&nbsp;&nbsp;",$level-1)." ".$name."</option>\n";
	$brandresult[$id] = dbquery("SELECT figure_brand_id, figure_brand_name FROM ".DB_FIGURE_BRANDS." WHERE figure_brand_parent='".$id."' ORDER BY figure_brand_name");
	if (dbrows($brandresult[$id]) != 0) {
		while ($branddata[$id] = dbarray($brandresult[$id])) {
			$list .= menu_subbrands($branddata[$id]['figure_brand_id'], $branddata[$id]['figure_brand_name'], $level+1);
		}
	}
	return $list;
}

///////////////////////////////////
function menu_submaterials($id, $name, $level) {
	global $figure_material;
	$list = "<option value='".$id."'>".str_repeat("&nbsp;&nbsp;&nbsp;&nbsp;",$level-1)." ".$name."</option>\n";
	$materialresult[$id] = dbquery("SELECT figure_material_id, figure_material_name FROM ".DB_FIGURE_MATERIALS." WHERE figure_material_parent='".$id."' ORDER BY figure_material_name");
	if (dbrows($materialresult[$id]) != 0) {
		while ($materialdata[$id] = dbarray($materialresult[$id])) {
			$list .= menu_submaterials($materialdata[$id]['figure_material_id'], $materialdata[$id]['figure_material_name'], $level+1);
		}
	}
	return $list;
}

///////////////////////////////////
function menu_subpackagings($id, $name, $level) {
	global $figure_packaging;
	$list = "<option value='".$id."'>".str_repeat("&nbsp;&nbsp;&nbsp;&nbsp;",$level-1)." ".$name."</option>\n";
	$packagingresult[$id] = dbquery("SELECT figure_packaging_id, figure_packaging_name FROM ".DB_FIGURE_PACKAGINGS." WHERE figure_packaging_parent='".$id."' ORDER BY figure_packaging_name");
	if (dbrows($packagingresult[$id]) != 0) {
		while ($packagingdata[$id] = dbarray($packagingresult[$id])) {
			$list .= menu_subpackagings($packagingdata[$id]['figure_packaging_id'], $packagingdata[$id]['figure_packaging_name'], $level+1);
		}
	}
	return $list;
}

?>