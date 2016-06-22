<?php
/***************************************************************************
 *   LATEST FIGURES SUBMISSIONS PANEL                                           *
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

// LOCALE
$locale['LFS_0001']= "Figures Submissions";
$locale['LFS_0002']= "No Submissions";
$locale['LFS_0003']= "Submits";


	
	

$submits = dbcount("(submit_id)", DB_SUBMISSIONS, "submit_type='f'");	



openside($locale['LFS_0001']);

echo "<table>\n";
  echo "<tr>\n";
  echo "<colgroup><col width='50%'><col width='50%'></colgroup>";	
   // echo "<td class='small' valign='' align='center' rowspan=''><a href='".INFUSIONS."figurelib/admin/figurelib_submissions.php'><img alt='FigureLib' src='".INFUSIONS.$inf_folder."/images/figurelib.png' border='0'></a></td>\n";
		
   echo "<td class='small' valign='' align='center' rowspan=''><a href='".INFUSIONS."figurelib/admin/figurelib_submissions.php'><img alt='FigureLib' src='".BASEDIR."administration/images/figurelib.png' border='0'></a></td>\n";
	if ($submits != "") {
			
				echo " <td class='' valign='' align='center'><font color='red'>".$submits."</font> ".$locale['LFS_0003']."</td>\n";
			
			} else {
			
				echo "<td>".$locale['LFS_0002']."</td>";
			
			} 

  echo "</tr>\n";

echo "</table>\n";

closeside();
 

 