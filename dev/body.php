<?php
function print_body($link)
{
	// move to constants or as session var
	echo '<body>';
	echo '<table border="0" align="center" width="80%" cellpadding="0" cellspacing="0" id="main_table" class="main_table">';
	echo '<tr>';
	echo '<td align="left" valign="top">';
	print_banner();
	echo '<form action = "" method = "post">';
	echo '<tr><td class="submenu">';
   echo '<button name="register">Register</button>';
   echo ' | <button name="rules">Rules</button>';
   echo ' | <button name="teams">Top Teams</button>';
   echo ' | <button name="players">Top Players</button>';
   echo ' | <button name="res2000">Results from 2000</button>';
   echo ' | <button name="res2001">Results from 2001</button>';
   echo '</td></tr>';
   echo '</form>';
   echo '<tr><td class="nonmenu">&nbsp;</td></tr>';
   echo '<tr><td class="nonmenu">&nbsp;';
   //print_r($_SESSION);
   //print_r($_POST);
   echo '</td></tr>';
   echo '<tr><td align="center" bgcolor="#B4A87E">';
   if (empty($_SESSION['page'])||$_SESSION['page']=="")
   {
      echo '';
   }
   elseif ($_SESSION['page']=="register")
  	{
      echo '<h2>Hold your horses</h2>';
  		echo '<br>';
  	}
  	elseif ($_SESSION['page']=="rules")
  	{
  	   print_rules();
  	   echo '<br>';
  	}
  	elseif ($_SESSION['page']=="teams")
  	{
  	   print_top_n_teams(64,$link);
  	   echo '<br>';
  	}
  	elseif ($_SESSION['page']=="players")
  	{
  	   print_top_n_players(64,$link);
  	   echo '<br>';
  	}
  	elseif ($_SESSION['page']=="res2000")
  	{
  	   print2000();
  	   echo '<br>';
  	}
  	elseif ($_SESSION['page']=="res2001")
  	{
  	   print2001();
  	   echo '<br>';
  	}
  	
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
 	echo '</td></tr></table>';
 	echo '</body>';
}
function print_banner()
{
	echo '<table width="100%" border="0" cellspacing="0" cellpadding="0">';
	echo '<tr><td width="25%" align="center"><img src="../images/Logo2017.png" alt="2017 NCAA Final Four Draft Pool"></td>';
	echo '</table>';
}
function print_rules()
{
   echo '<table class="rulestable"><tr><td class="rulesheader">Basics</td></tr>';
   echo '<tr><td>Players and teams are selected based on a snake draft. Draft order is reversed between the two. Each player starts with 300 pts and that value is affected by the following rules.';
   echo '</td></tr></table>';

   echo '<table class="rulestable"><tr><td class="rulesheader">Team Draft</td></tr>';
   echo '<tr><td>The cost of a team is inversely proportional to their seed; the higher the seed, the lower the cost. During the draft, you will go into negative points so don\'t be alarmed. For each win, a team earns 43 pts. The price breakdown is as follows:';
   echo '<table class="subrulestable" border="1"><tr><td>Seed</td><td>Cost</td><td>Seed</td><td>Cost</td></tr>';
   echo '<tr><td>1</td><td>80</td><td>9</td><td>40</td></tr>';
   echo '<tr><td>2</td><td>75</td><td>10</td><td>35</td></tr>';
   echo '<tr><td>3</td><td>70</td><td>11</td><td>30</td></tr>';
   echo '<tr><td>4</td><td>65</td><td>12</td><td>25</td></tr>';
   echo '<tr><td>5</td><td>60</td><td>13</td><td>20</td></tr>';
   echo '<tr><td>6</td><td>55</td><td>14</td><td>15</td></tr>';
   echo '<tr><td>7</td><td>50</td><td>15</td><td>10</td></tr>';
   echo '<tr><td>8</td><td>45</td><td>16</td><td>5</td></tr></table></tr></td></table>';
    
   echo '<table class="rulestable"><tr><td class="rulesheader">Player Draft</td></tr>';
   echo '<tr><td>Points awarded for the following categories:';

   echo '<table class="subrulestable" border="1"><tr><td>Highest drafters combined total points for all games</td></tr>';
   echo '<tr><td>Highest individuals total points for all games</td></tr>';
   echo '<tr><td>Individual high single game points</td></tr>';
   echo '<tr><td>Best total of each players high game</td></tr></table>';

   echo 'The payout for each category is as follows: 1st place 64pts, 2nd place 48, 3rd 32, 4th 16</td></tr></table>';

   echo '<table class="rulestable"><tr><td class="rulesheader">Bonus Categories</td></tr>';

   echo '<tr><td><table class="subrulestable" border="1"><tr><td>Drafter of worst team to advance in each of the 1st two rounds(5pts/round)</td></tr>';
   echo '<tr><td>The Drafter with the most teams at the end of each round(5pts/round)</td></tr>';
   echo '<tr><td>Drafter of player who receives MVP(or if player was not drafted then the owner of the team for which the MVP played)(10pts)</td></tr>';
   echo '<tr><td>Brackets- each player will fill out the entire 63 game bracket.<br>1st place 150, 2nd Place 75, 3rd Place 45, 4th place 30</td></tr></table>';
   echo '</td></tr></table>';

   echo '<table class="rulestable"><tr><td class="rulesheader">Play-In Games</td></tr>';
   
   echo '<tr><td><ul>At least 4 teams from the play-in rounds will be drafted. Wins from any of those teams will only count from the Round of 64 onward</ul>';
   echo '<ul>If a player is drafted from any of these teams, only their best game among the play-in game and first round will count.</ul>';
   echo '</td></tr></table>';
   }
function print_top_n_teams($n,$link)
{
   $sql = "select v from keyValue where k='playerUpdateDTM'";
   $data = mysqli_query($link,$sql);
   while (list($updated)=mysqli_fetch_row($data)) {
      echo '<b>Top '.$n.' Teams</b><small>(last updated: '.$updated.')</small><br>';
   }
   $sql = "select school,wins,losses,conference,name,max(ppg) from player p inner join (select max(ppg) as maxppg,team_id from player group by team_id) p1 on p.team_id=p1.team_id and p.ppg=p1.maxppg join team t on t.team_id=p.team_id group by p.team_id order by wins/(wins+losses) desc limit ".$n;
   $data = mysqli_query($link,$sql);
   echo '<table border="1"><tr><td>Team</td><td>Record</td><td>Conference</td><td>Leading Scorer</td><td>Pts/Gm</td></tr>';
   while (list($team,$wins,$losses,$conference,$name,$ppg)=mysqli_fetch_row($data)) {
      echo '<tr><td>'.$team.'</td><td>'.$wins.'-'.$losses.'</td><td>'.$conference.'</td><td>'.$name.'</td><td>'.$ppg.'</td></tr>';
   }
   echo '</table>';
}
function print_top_n_players($n,$link)
{
   $sql = "select v from keyValue where k='playerUpdateDTM'";
   $data = mysqli_query($link,$sql);
   while (list($updated)=mysqli_fetch_row($data)) {
      echo '<b>Top '.$n.' Scorers</b><small>(last updated: '.$updated.')</small><br>';
   }
   $sql = "select name,ppg,school,conference from player p join team t on p.team_id=t.team_id order by ppg desc limit ".$n;
   $data = mysqli_query($link,$sql);
   echo '<table border="1"><tr><td>Name</td><td>Team</td><td>Pts/Gm</td><td>Conference</td></tr>';
   while (list($name,$ppg,$team,$conference)=mysqli_fetch_row($data)) {
      echo '<tr><td>'.$name.'</td><td>'.$team.'</td><td>'.$ppg.'</td><td>'.$conference.'</td></tr>';
   }
   echo '</table>';
}?>