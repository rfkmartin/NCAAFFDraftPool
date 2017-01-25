<?php
function print_body($link)
{
	// move to constants or as session var
	$SHOW_MONTHS=24;
	echo '<body>';
	echo '<table border="0" align="left" cellpadding="0" cellspacing="0" id="main_table" class="main_table">';
	echo '  <tr>';
	echo '  <td align="left" valign="top" colspan="2">';
	print_banner();
 	echo '    </td></tr>';
 	echo '    <tr><td width="18%" valign="top" align="left">';
   echo 'login<br>register';
//  	if (empty($_SESSION['page'])||$_SESSION['page']=="")
//  	{
//       echo print_events($link,'next');
//  		echo '<br>';
//  	}
//  	elseif ($_SESSION['page']=="families")
//  	{
//       echo family_table($link);
//  		echo '<br>';
//  	}
//  	elseif ($_SESSION['page']=="next")
//  	{
//       echo print_events($link,'next');
//       echo '<br>';
//  	}
//  	elseif ($_SESSION['page']=="RSVP")
//  	{
//       echo print_events($link,'next');
//       echo '<table><tr align="center"><td valign="top">';
//       echo add_attendance($link);
//       echo '</td><td width="30%"></td><td valign="top">';
//       echo bringing($link);
//       echo '</td></tr></table>';
//  	}
//  	elseif ($_SESSION['page']=="managefam")
//  	{
//  		echo '<table><tr align="center"><td>';
//  		echo family_addnew($link);
//  		echo '</td></tr><tr><td>';
//  		echo member_addnew($link);
//  		echo '</td></tr></table>';
//  	}
//  	elseif ($_SESSION['page']=="manageev")
//    {
//       $sql = "select * from (select e.event_id,f.family_id,f.name,d.month,d.day,d.year,str_to_date(concat(concat(month,'/',greatest(day,1)),'/',year),'%m/%d/%Y') dt from date d join event e on d.date_id=e.date_id join family f on f.family_id=e.family_id where e.cancel=0) as a where a.dt>curdate() and a.family_id=".$_SESSION['family_id'].' limit 1';
//       logger($link,$sql);
//       $data = mysqli_query($link,$sql);
//       if (mysqli_num_rows($data)<1)
//       {
//          echo '<h3>You have no upcoming events</h3>';
//       }
//       else
//       {
//          echo print_events($link,'nextfam');
//          echo '<table><tr align="center"><td>';
//          echo set_event($link);
//          echo '</td></tr><tr><td align="center">';
//          echo add_food_to_event($link);
//          echo '</td></tr></table>';
//  		}
//  	}
//  	elseif ($_SESSION['page']=="upcoming")
//  	{
//       echo print_events($link,'upcoming');
//  	}
//  	elseif ($_SESSION['page']=="selectev")
//  	{
//       echo select_event($link);
//  	}
//  	elseif ($_SESSION['page']=="account")
//  	{
//       echo update_account($link);
//  	}
 	echo '    </td>';
 	echo '    <td align="center" bgcolor="#F6B332">';
   print_rules();
 	print_top_n_teams(20,$link);
 	print_top_n_players(20,$link);
 	echo '</td></tr></table>';
 	echo '</body>';
}
function print_banner()
{
	echo '<table width="100%" border="0" cellspacing="0" cellpadding="0">';
	echo '<tr><td width="25%"><img src="../images/Logo2017.png" alt="2017 NCAA Final Four Draft Pool"></td>';
   echo '<td valign="middle" align="center">Draft Pool</td>';
	echo '</tr>';
	echo '</table>';
}
function print_rules()
{
   echo '<table COLS=1 WIDTH="75%" >
   <tr bgcolor="#F36C3E">
   <td><font size=4>
   <center>Participants are given a draft position. Regular draft positions
   will be used for the team draft and reverse draft positions will used for
   the player draft. A round robin draft is used meaning that if the order
   is 1-8 in Round One, the order will be 8-1 in Round Two. This alternates
   for all eight rounds.</center><p>
   </td></tr>

   <tr>
   <td>
   <center><table COLS=1 WIDTH="75%" >
   <tr BGCOLOR="#F36C3E">
   <td><font size=+2><b>Team Draft</b></font></td>
   </tr>

   <tr>
   <td>
   <center>The cost of a team is inversely proportional to their seed; the
   higher the seed, the lower the cost. For each win, a team earns $4.30.
   The price breakdown is as follows:</center>
   <hr width=75%>
   <center><table COLS=4 WIDTH="40%" >
   <tr>
   <td>Seed</td>

   <td>Cost</td>

   <td>Seed</td>

   <td>Cost</td>
   </tr>

   <tr>
   <td>1</td>

   <td>$8.00</td>

   <td>9</td>

   <td>$4.00</td>
   </tr>

   <tr>
   <td>2</td>

   <td>$7.50</td>

   <td>10</td>

   <td>$3.50</td>
   </tr>

   <tr>
   <td>3</td>

   <td>$7.00</td>

   <td>11</td>

   <td>$3.00</td>
   </tr>

   <tr>
   <td>4</td>

   <td>$6.50</td>

   <td>12</td>

   <td>$2.50</td>
   </tr>

   <tr>
   <td>5</td>

   <td>$6.00</td>

   <td>13</td>

   <td>$2.00</td>
   </tr>

   <tr>
   <td>6</td>

   <td>$5.50</td>

   <td>14</td>

   <td>$1.50</td>
   </tr>

   <tr>
   <td>7</td>

   <td>$5.00</td>

   <td>15</td>

   <td>$1.00</td>
   </tr>

   <tr>
   <td>8</td>

   <td>$4.50</td>

   <td>16</td>

   <td>$0.50</td>
   </tr>
   </table></center>
   </td>
   </tr>
   </table></center>
   </td>
   </tr>

   <tr>
   <td></td>
   </tr>

   <tr>
   <td>
   <center><table COLS=1 WIDTH="75%" >
   <tr BGCOLOR="#F36C3E">
   <td><font size=+2><b>Player Draft</b></font></td>
   </tr>

   <tr>
   <td>
   <center>The cost of the player draft is $1 per round.
   <br>Money is awarded for the following categories:</center>

   <p><br>
   <center><table BORDER COLS=1 WIDTH="85%" >
   <tr ALIGN=CENTER>
   <td>Highest drafters combined total points for all games</td>
   </tr>

   <tr ALIGN=CENTER>
   <td>Highest individuals total points for all games</td>
   </tr>

   <tr ALIGN=CENTER>
   <td>Individual high single game points</td>
   </tr>

   <tr ALIGN=CENTER>
   <td>Best total of each players high game.</td>
   </tr>
   </table></center>

   <center>
   <p>The payout is as follows: 1st place $6.40, 2nd place $4.80, 3rd $3.20,
   4th $1.60</center></td>
   </tr>
   </table></center>
   </td>
   </tr>

   <tr>
   <td>
   <center><table COLS=1 WIDTH="75%" >
   <tr BGCOLOR="#F36C3E">
   <td><font size=+2><b>Bonus Categories</b></font></td>
   </tr>

   <tr>
   <td>
   <center>Fixed Cost of $10.00 per person. Total of $80 in the pot.</center><p>

   <center><table BORDER COLS=1 WIDTH="85%" >
   <tr>
   <td>
   <center>Drafter of worst team to advance in each of the 1st two rounds
   <br>($5 per round)</center>
   </td>
   </tr>

   <tr>
   <td>
   <center>The Drafter with the most teams at the end of each Round
   <br>($5 per round)</center>
   </td>
   </tr>

   <tr>
   <td>
   <center>Drafter of player who receives MVP(or if player was not drafted
         then the owner of the team for which the MVP played)
         <br>$10.00</center>
         </td>
         </tr>

         <tr>
         <td>
         <center>Brackets- each player will fill out the entire 63 game bracket.
         <br>1st place $15.00, 2nd Place $7.50, 3rd Place $4.50 and 4th place $3.00</center>
         </td>
         </tr>
         </table></center>
         </td>
         </tr>
         </table></center>
         </td>
         </tr>
         </table>';
}
function print_top_n_teams($n,$link)
{
   $sql = "select school,wins,losses,conference from team order by wins/(wins+losses) desc limit ".$n;
   $data = mysqli_query($link,$sql);
   echo '<table border="1"><tr><td>Team</td><td>Record</td><td>Conference</td></tr>';
   while (list($team,$wins,$losses,$conference)=mysqli_fetch_row($data)) {
      echo '<tr><td>'.$team.'</td><td>'.$wins.'-'.$losses.'</td><td>'.$conference.'</td></tr>';
   }
   echo '</table>';
}
function print_top_n_players($n,$link)
{
   $sql = "select name,ppg,school,conference from player p join team t on p.team_id=t.team_id order by ppg desc limit ".$n;
   $data = mysqli_query($link,$sql);
   echo '<table border="1"><tr><td>Name</td><td>Team</td><td>Pts/Gm</td><td>Conference</td></tr>';
   while (list($name,$ppg,$team,$conference)=mysqli_fetch_row($data)) {
      echo '<tr><td>'.$name.'</td><td>'.$team.'</td><td>'.$ppg.'</td><td>'.$conference.'</td></tr>';
   }
   echo '</table>';
}?>