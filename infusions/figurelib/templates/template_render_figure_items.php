<?php

	error_reporting(E_ALL);
	// Formularinhalte prüfen
	print_r ($_POST);
	// GET-Parameter prüfen
	print_r ($_GET);
	// Sessions prüfen
	//print_r ($_SESSION);

/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright (C) PHP-Fusion Inc
| http://www.php-fusion.co.uk/
+--------------------------------------------------------+
| Filename: template/template_render_figure_items.php based on template/weblinks.php
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
if (!defined("IN_FUSION")) { die("Access Denied"); }
include INFUSIONS."figurelib/infusion_db.php";

// ******************************************************************************************			
// FIGURE
// ******************************************************************************************
if (!function_exists('render_figure_items')) {
	function render_figure_items($info) {
		global $locale;
		echo render_breadcrumbs();
	

		
		// ['cifg_0009'] = "Filter by:";
		//opentable($locale['cifg_0009']);
		
			//////////////////////////////////////////////////////////////////////////////////////////////
			// TABELLE ANFANG ////////////////////////////////////////////////////////////////////////////
			//////////////////////////////////////////////////////////////////////////////////////////////
			echo "<center><table class='tbl-border' width='100%'>\n";
			
			//////////////////////////////////////////////////////////////////////////////////////////////
			// 9 MINIBILDER A 3 X 3 BILDER  //////////////////////////////////////////////////////////////
			//////////////////////////////////////////////////////////////////////////////////////////////
		
					  echo "<tr>\n";
					  
						// COVERBILD
						//echo "<td align='center' class='tbl-border tbl1' rowspan='3'><a href='".($data['figure_image_cover'] ? IMAGES_FIGURE.$data['figure_image_cover'] : INFUSIONS.$inf_folder."/images/default.png")."'  height='100%' width='100%' alt='".$data['figure_title']."'><img src='".($data['figure_image_cover'] ? IMAGES_FIGURE.$data['figure_image_cover'] : INFUSIONS.$inf_folder."/images/default.png")."'  height='100%' width='400px' alt='".$data['figure_title']."' />COVER</a>\n";					
						echo "<td align='center' class='tbl-border tbl1' rowspan='3'><a href='".INFUSIONS."figurelib/figures.php?figure_id=".$data['figure_id']."' class=''>\n<img src='".INFUSIONS."figurelib/images/default.png"."' alt='".trimlink($data['figure_title'],50)."' title='".trimlink($data['figure_title'],100)."' style='border:0px;max-height:100%;max-width:200px' /></td>";
						
						// THUMB 1
						//echo "<td align='center' class='tbl-border tbl1'><a href='".($data['figure_image'] ? IMAGES_FIGURE.$data['figure_image'] : INFUSIONS.$inf_folder."/images/default.png")."'  height='100%' width='100%' alt='".$data['figure_title']."'><img src='".($data['figure_image'] ? IMAGES_FIGURE.$data['figure_image'] : INFUSIONS.$inf_folder."/images/default.png")."'  height='100%' width='50px' alt='".$data['figure_title']."' /></a>THUMB 1</td>\n";
						echo "<td class='side-small'><a href='".INFUSIONS."figurelib/figures.php?figure_id=".$data['figure_id']."' class=''>\n<img src='".INFUSIONS."figurelib/images/default.png"."' alt='".trimlink($data['figure_title'],50)."' title='".trimlink($data['figure_title'],100)."' style='border:0px;max-height:40px;max-width:40px' /></td>";
						
						// THUMB 2
						//echo "<td align='center' class='tbl-border tbl1'><a href='".($data['figure_image'] ? IMAGES_FIGURE.$data['figure_image'] : INFUSIONS.$inf_folder."/images/default.png")."'  height='100%' width='100%' alt='".$data['figure_title']."'><img src='".($data['figure_image'] ? IMAGES_FIGURE.$data['figure_image'] : INFUSIONS.$inf_folder."/images/default.png")."'  height='100%' width='50px' alt='".$data['figure_title']."' /></a>THUMB 2</td>\n";
						echo "<td class='side-small'><a href='".INFUSIONS."figurelib/figures.php?figure_id=".$data['figure_id']."' class=''>\n<img src='".INFUSIONS."figurelib/images/default.png"."' alt='".trimlink($data['figure_title'],50)."' title='".trimlink($data['figure_title'],100)."' style='border:0px;max-height:40px;max-width:40px' /></td>";
						
						// THUMB 3
						//echo "<td align='center' class='tbl-border tbl1'><a href='".($data['figure_image'] ? IMAGES_FIGURE.$data['figure_image'] : INFUSIONS.$inf_folder."/images/default.png")."'  height='100%' width='100%' alt='".$data['figure_title']."'><img src='".($data['figure_image'] ? IMAGES_FIGURE.$data['figure_image'] : INFUSIONS.$inf_folder."/images/default.png")."'  height='100%' width='50px' alt='".$data['figure_title']."' /></a>THUMB 3</td>\n";	
						echo "<td class='side-small'><a href='".INFUSIONS."figurelib/figures.php?figure_id=".$data['figure_id']."' class=''>\n<img src='".INFUSIONS."figurelib/images/default.png"."' alt='".trimlink($data['figure_title'],50)."' title='".trimlink($data['figure_title'],100)."' style='border:0px;max-height:40px;max-width:40px' /></td>";
					  
					  echo "</tr>\n";
					  echo "<tr>\n";
					  
						// THUMB 4
						//echo "<td align='center' class='tbl-border tbl1'><a href='".($data['figure_image'] ? IMAGES_FIGURE.$data['figure_image'] : INFUSIONS.$inf_folder."/images/default.png")."'  height='100%' width='100%' alt='".$data['figure_title']."'><img src='".($data['figure_image'] ? IMAGES_FIGURE.$data['figure_image'] : INFUSIONS.$inf_folder."/images/default.png")."'  height='100%' width='50px' alt='".$data['figure_title']."' /></a>THUMB 4</td>\n";
						echo "<td class='side-small'><a href='".INFUSIONS."figurelib/figures.php?figure_id=".$data['figure_id']."' class=''>\n<img src='".INFUSIONS."figurelib/images/default.png"."' alt='".trimlink($data['figure_title'],50)."' title='".trimlink($data['figure_title'],100)."' style='border:0px;max-height:40px;max-width:40px' /></td>";
						
						// THUMB 5
						//echo "<td align='center' class='tbl-border tbl1'><a href='".($data['figure_image'] ? IMAGES_FIGURE.$data['figure_image'] : INFUSIONS.$inf_folder."/images/default.png")."'  height='100%' width='100%' alt='".$data['figure_title']."'><img src='".($data['figure_image'] ? IMAGES_FIGURE.$data['figure_image'] : INFUSIONS.$inf_folder."/images/default.png")."'  height='100%' width='50px' alt='".$data['figure_title']."' /></a>THUMB 5</td>\n";
						echo "<td class='side-small'><a href='".INFUSIONS."figurelib/figures.php?figure_id=".$data['figure_id']."' class=''>\n<img src='".INFUSIONS."figurelib/images/default.png"."' alt='".trimlink($data['figure_title'],50)."' title='".trimlink($data['figure_title'],100)."' style='border:0px;max-height:40px;max-width:40px' /></td>";
						
						// THUMB 6
						//echo "<td align='center' class='tbl-border tbl1'><a href='".($data['figure_image'] ? IMAGES_FIGURE.$data['figure_image'] : INFUSIONS.$inf_folder."/images/default.png")."'  height='100%' width='100%' alt='".$data['figure_title']."'><img src='".($data['figure_image'] ? IMAGES_FIGURE.$data['figure_image'] : INFUSIONS.$inf_folder."/images/default.png")."'  height='100%' width='50px' alt='".$data['figure_title']."' /></a>THUMB 6</td>\n";
						echo "<td class='side-small'><a href='".INFUSIONS."figurelib/figures.php?figure_id=".$data['figure_id']."' class=''>\n<img src='".INFUSIONS."figurelib/images/default.png"."' alt='".trimlink($data['figure_title'],50)."' title='".trimlink($data['figure_title'],100)."' style='border:0px;max-height:40px;max-width:40px' /></td>";
					  
					  echo "</tr>\n";
					  echo "<tr>\n";
					  
						// THUMB 7
						//echo "<td align='center' class='tbl-border tbl1'><a href='".($data['figure_image'] ? IMAGES_FIGURE.$data['figure_image'] : INFUSIONS.$inf_folder."/images/default.png")."'  height='100%' width='100%' alt='".$data['figure_title']."'><img src='".($data['figure_image'] ? IMAGES_FIGURE.$data['figure_image'] : INFUSIONS.$inf_folder."/images/default.png")."'  height='100%' width='50px' alt='".$data['figure_title']."' /></a>THUMB 7</td>\n";
						echo "<td class='side-small'><a href='".INFUSIONS."figurelib/figures.php?figure_id=".$data['figure_id']."' class=''>\n<img src='".INFUSIONS."figurelib/images/default.png"."' alt='".trimlink($data['figure_title'],50)."' title='".trimlink($data['figure_title'],100)."' style='border:0px;max-height:40px;max-width:40px' /></td>";
						
						// THUMB 8
						//echo "<td align='center' class='tbl-border tbl1'><a href='".($data['figure_image'] ? IMAGES_FIGURE.$data['figure_image'] : INFUSIONS.$inf_folder."/images/default.png")."'  height='100%' width='100%' alt='".$data['figure_title']."'><img src='".($data['figure_image'] ? IMAGES_FIGURE.$data['figure_image'] : INFUSIONS.$inf_folder."/images/default.png")."'  height='100%' width='50px' alt='".$data['figure_title']."' /></a>THUMB 8</td>\n";
						echo "<td class='side-small'><a href='".INFUSIONS."figurelib/figures.php?figure_id=".$data['figure_id']."' class=''>\n<img src='".INFUSIONS."figurelib/images/default.png"."' alt='".trimlink($data['figure_title'],50)."' title='".trimlink($data['figure_title'],100)."' style='border:0px;max-height:40px;max-width:40px' /></td>";
						
						// THUMB 9
						//echo "<td align='center' class='tbl-border tbl1'><a href='".($data['figure_image'] ? IMAGES_FIGURE.$data['figure_image'] : INFUSIONS.$inf_folder."/images/default.png")."'  height='100%' width='100%' alt='".$data['figure_title']."'><img src='".($data['figure_image'] ? IMAGES_FIGURE.$data['figure_image'] : INFUSIONS.$inf_folder."/images/default.png")."'  height='100%' width='50px' alt='".$data['figure_title']."' /></a>THUMB 9</td>\n";
						echo "<td class='side-small'><a href='".INFUSIONS."figurelib/figures.php?figure_id=".$data['figure_id']."' class=''>\n<img src='".INFUSIONS."figurelib/images/default.png"."' alt='".trimlink($data['figure_title'],50)."' title='".trimlink($data['figure_title'],100)."' style='border:0px;max-height:40px;max-width:40px' /></td>";
					 
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
			

		
	///////////////////////////////////////////////////////////////
	// AFFILIATE PANEL  ///////////////////////////////////////////
	///////////////////////////////////////////////////////////////					
	
	
	opentable();	


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
		
	///////////////////////////////////////////////////////////////
	// FIGURE DATA  ///////////////////////////////////////////
	///////////////////////////////////////////////////////////////		

			opentable();
			if (!empty($info['item'])) {
				foreach($info['item'] as $figure_cat_id => $data) {
			

			// TITLE + KATEGORIE
			echo "<table class='tbl-border' width='100%'>\n";			
			echo "<tr>";	
			echo "<colgroup><col width='50%'><col width='50%'></colgroup>\n"; 
			echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl2'><b>".$data['figure']['name']."</b></td>\n";
			echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl2'align='right'></td>\n";
			echo "<tr>";	
			echo "</table>\n";


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
			echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl3'>".$data['figure']['variant']."</td>\n";
			echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl2'><b>".$locale['figure_442'].":</b></td>\n";
			echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl3'>".$data['figure']['scale']."</td>\n";
			echo "<tr>";	
			echo "</table>\n";

			//ZEILE 2 - Manufacturer / Weight
			echo "<table class='tbl-border' width='100%'>\n";			
			echo "<tr>";	
			echo "<colgroup><col width='20%'><col width='30%'><col width='20%'><col width='30%'></colgroup>\n";			
			echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl2'><b>".$locale['figure_417'].":</b></td>\n";
			echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl3'>".$data['figure']['manufacturer']."</td>\n";
			echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl2'><b>".$locale['figure_443'].":</b></td>\n";
			echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl3'>figure weight variable</td>\n";		
			echo "<tr>";	
			echo "</table>\n";
			
			//ZEILE 3 - Sub-Manufacturer (inaktive glöscht) / Height
			echo "<table class='tbl-border' width='100%'>\n";			
			echo "<tr>";	
			echo "<colgroup><col width='20%'><col width='30%'><col width='20%'><col width='30%'></colgroup>\n"; 
			echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl2'><b>&nbsp;</b></td>\n";
			echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl2'>&nbsp;</td>\n";
			echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl2'><b>".$locale['figure_444'].":</b></td>\n";
			echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl3'>figure height variable</td>\n";					
			echo "<tr>";	
			echo "</table>\n";
			
			//ZEILE 4 - Artists / Width
			echo "<table class='tbl-border' width='100%'>\n";			
			echo "<tr>";	
			echo "<colgroup><col width='20%'><col width='30%'><col width='20%'><col width='30%'></colgroup>\n"; 			
			echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl2'><b>".$locale['figure_452'].":</b></td>\n";
			echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl3'>figure artist variable</td>\n";
			echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl2'><b>".$locale['figure_445'].":</b></td>\n";
			echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl3'>figure vwidth variable</td>\n";				
			echo "<tr>";	
			echo "</table>\n";
			
			//ZEILE 5 - Country		Depth
			echo "<table class='tbl-border' width='100%'>\n";			
			echo "<tr>";	
			echo "<colgroup><col width='20%'><col width='30%'><col width='20%'><col width='30%'></colgroup>\n"; 			
			echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl2'><b>".$locale['figure_436'].":</b></td>\n";
			echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl3'>figure country variable</td>\n";
			echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl2'><b>".$locale['figure_446'].":</b></td>\n";
			echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl3'>figure depth variable</td>\n";
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
			echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl3'>figure brand variable</td>\n";		
			echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl2'><b>".$locale['figure_447'].":</b></td>\n";
			echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl3'>figure material variable</td>\n";
			echo "<tr>";	
			echo "</table>\n";
			
			//ZEILE 7 - Series / Articulations Points
			echo "<table class='tbl-border' width='100%'>\n";			
			echo "<tr>";	
			echo "<colgroup><col width='20%'><col width='30%'><col width='20%'><col width='30%'></colgroup>\n"; 			
			echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl2'><b>".$locale['figure_439'].":</b></td>\n";
			echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl3'>figure seriesvariable</td>\n";
			echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl2'><b>".$locale['figure_455'].":</b></td>\n";
			echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl3'>figure poa variable</td>\n";				
			echo "<tr>";	
			echo "</table>\n";
			
			//ZEILE 8 - Release Date / Packaging
			echo "<table class='tbl-border' width='100%'>\n";			
			echo "<tr>";	
			echo "<colgroup><col width='20%'><col width='30%'><col width='20%'><col width='30%'></colgroup>\n"; 			
			echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl2'><b>".$locale['figure_419'].":</b></td>\n";
			echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl3'>figure year variable</td>\n";
			echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl2'><b>".$locale['figure_448'].":</b></td>\n";
			echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl3'>figure packackung variable</td>\n";	
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
			echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl3'>figure retail price variable</td>\n";
			echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl2' style='width:100px;padding:6px'><b>".$locale['figure_456'].":</b></td>\n";
			echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl3'>figure used price variable</td>\n";
			echo "<tr>";	
			echo "</table>\n";	

			//ZEILE 10 - Limited Edition YES/NO / Edition Size
			echo "<table class='tbl-border' width='100%'>\n";			
			echo "<tr>";	
			echo "<colgroup><col width='20%'><col width='30%'><col width='20%'><col width='30%'></colgroup>\n"; 
			echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl2'><b>".$locale['figure_450'].":</b></td>\n";
			echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl3'>figure limitation variable</td>\n";
			echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl2' style='width:100px;padding:6px'><b>".$locale['figure_451'].":</b></td>\n";
			echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl3'>figure editons size variable</td>\n";
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
	
		}
	}
				closetable();	
			
	///////////////////////////////////////////////////////////////
	// RELATED FIGURES  ///////////////////////////////////////////
	///////////////////////////////////////////////////////////////	
				if ($asettings['related']) {
					opentable($locale['figure_425']);

					$result3 = dbquery("
						SELECT 
							ta.figure_id, 
							ta.figure_title, 
							ta.figure_datestamp, 
							tac.figure_cat_id, 
							tac.figure_cat_name, 
							tac.figure_cat_access 
						FROM ".DB_FIGURE_ITEMS." ta 
						INNER JOIN ".DB_FIGURE_CATS." tac ON ta.figure_cat=tac.figure_cat_id 
						WHERE MATCH (figure_title) AGAINST ('".$data['figure_title']."' IN BOOLEAN MODE) 
						AND figure_id != ".$data['figure_id']." ".(iSUPERADMIN ? "" : "AND ".groupaccess('figure_cat_access'))." 
						ORDER BY RAND() LIMIT 5");
				
					echo "<table width='100%' cellspacing='1' cellpadding='0' class='tbl-border'>\n";
					echo "<tbody><tr>\n";
					echo "<th class='tbl2' align='' width='50%'>".$locale['figure_411']."</th>\n";
					echo "<th class='tbl2' align='' width='25%'>".$locale['figure_413']."</th>\n";
					echo "<th class='tbl2' align='' width='25%'>".$locale['figure_418']."</th>\n";
					echo "</tr>\n";
					if (dbrows($result3)) {
						$i = 0;
						while ($data3 = dbarray($result3)) {
							$drating = dbarray(dbquery("SELECT SUM(rating_vote) sum_rating, COUNT(rating_item_id) count_votes FROM ".DB_RATINGS." WHERE rating_item_id='".$data3['figure_id']."' AND rating_type='FI'"));
							$num_votes = $drating['count_votes'];
							$rating = ($num_votes > 0 ? str_repeat("<img src='".INFUSIONS.$inf_folder."/images/star.png'>",ceil($drating['sum_rating']/$num_votes)) : "-");
							$cell_color = ($i % 2 == 0 ? "tbl1" : "tbl2"); $i++;
							echo "<tr>\n";
							echo "<td class='$cell_color' width='50%'><a href='figure.php?figure_id=".$data3['figure_id']."' title='".$data3['figure_title']."'>".$data3['figure_title']."</a></td>\n";
	
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
				if ($data['figure_allow_comments']) { showcomments("FI", DB_FIGURE_ITEMS, "figure_id", $_GET['figure_id'], FUSION_SELF."?figure_id=".$data['figure_id']); }
				
				//closetable();
				opentable($locale['ratings']);
				include INCLUDES."ratings_include.php";
				if ($data['figure_allow_ratings']) { showratings("FI", $_GET['figure_id'], FUSION_SELF."?figure_id=".$_GET['figure_id']); }	
				closetable();				


/*

			echo "<a href='".$data['figure']['link']."'>".$data['figure']['name']."</a><br>\n";
					if ($data['figure']['variant']) {
					echo "<span class='small'><strong>Variant: </strong>".$data['figure']['variant']."<br/></span>\n";
					} else {
					echo "<span class='small'><strong>Variant: </strong>... missing data ...<br></span>";
					}			
					echo "<span class='small'><strong>Manufacturer: </strong>".$data['figure']['manufacturer']."<br/></span>\n";
					echo "<span class='small'><strong>Brand: </strong>".$data['figure']['brand']."<br/></span>\n";
					echo "<span class='small'><strong>Scale: </strong>".$data['figure']['scale']."<br/></span>\n";
					echo "<span class='small'><strong>Release: </strong>".$data['figure']['year']."<br/></span>\n";
					if ($data['figure']['series']) {
					echo "<span class='small'><strong>Series: </strong>".$data['figure']['series']."<br/></span>\n";
					} else {
					echo "<span class='small'><strong>Series: </strong> ... missing data ...</span>";
					}
					if ($data['figure_cat_description'] != "") {
						echo "<span>".$data['figure_description']."</span>";
					}
		
*/		
		
		
		closetable();
	}
}	


// ******************************************************************************************			
// ******************************************************************************************



	/* NO FUNCTIONARY SHOW RIGHT INAGE FROM DB FIGURE_IMAGES
		
		$result2 = dbquery("SELECT
					figure_images_image_id,
					figure_images_image,
					figure_images_thumb 
					FROM ".DB_FIGURE_IMAGES." 
					WHERE figure_images_figure_id='".$data['figure_id']."' LIMIT 0,1");
		
		while($data2 = dbarray($result2)){

		// WENN KEIN BILD VORHANDEN DANN ZEIGE PLATZHALTER BILD
			if ($data2['figure_images_thumb']) {
				echo "<a href='".$data['figure']['link']."'><img src='".INFUSIONS."figurelib/images/default.png"."' alt='".trimlink($data['figure_title'],50)."' title='".trimlink($data['figure_title'],100)."' style='border:0px;max-height:100px;max-width:100px' /></a>";
			} else {  
 
				echo "<a href='".$data['figure']['link']."'>\n<img src='".($data2['figure_images_thumb'] ? THUMBS_FIGURES.$data2['figure_images_thumb'] : INFUSIONS.$inf_folder."/images/default.png")."' alt='".trimlink($data['figure_title'],100)."' title='".trimlink($data['figure_title'],50)."' style='border:0px;max-height:100px;max-width:100px' /></a>";
			}
	*/
	

		
