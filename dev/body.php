<?php
function print_body($link)
{
   // move to constants or as session var
   echo '<body>';
   echo '<table border="0" align="center" width="95%" cellpadding="0" cellspacing="0" id="main_table" class="main_table">';
   echo '<tr>';
   echo '<td align="left" valign="top">';
   print_banner ();
   print print_sub_menu ();
   echo '<tr><td align="center" bgcolor="#B4A87E">';
   if (empty ( $_SESSION ['page'] ) || $_SESSION ['page'] == "")
   {
      print_bracket($link);
      echo '';
   }
   elseif ($_SESSION ['page'] == "register")
   {
      register_account ( $link );
      echo '<br>';
      print_bracket($link);
   }
   elseif ($_SESSION ['page'] == "login")
   {
      print_logon_form();
      echo '<br>';
   }
   elseif ($_SESSION ['page'] == "bracket")
   {
      print_bracket($link);
      echo '<br>';
   }
   elseif ($_SESSION ['page'] == "results")
   {
      if ($_SESSION['subpage']== "playerresults")
      {
         print_player_results($link);
      }
      else if ($_SESSION['subpage']== "teamresults")
      {
         print_team_results($link);
      }
      else if ($_SESSION['subpage']== "stats")
      {
         print_other_stats($link);
         echo '<br>';
      }
         else if ($_SESSION['subpage']== "leader")
      {
         print_pool_results($link);
         echo '<br>';
      }
      else
      {
         print_bracket($link);
         echo '<br>';
      }
   }
   elseif ($_SESSION ['page'] == "rules")
   {
      print_rules ();
      echo '<br>';
   }
   elseif ($_SESSION ['page'] == "teams")
   {
      print_top_n_teams ( 64, $link );
      echo '<br>';
   }
   elseif ($_SESSION ['page'] == "players")
   {
      print_top_n_players ( 64, $link );
      echo '<br>';
   }
   elseif ($_SESSION ['page'] == "teamplayers")
   {
      print_top_m_players_n_teams ( 64, 64, $link );
      echo '<br>';
   }
   elseif ($_SESSION ['page'] == "res2000")
   {
      print2000 ();
      echo '<br>';
   }
   elseif ($_SESSION ['page'] == "res2001")
   {
      print2001 ();
      echo '<br>';
   }
   elseif ($_SESSION ['page'] == "submit")
   {
      echo '<br>';
   }
   elseif ($_SESSION ['page'] == "teamdraft")
   {
      if ($_SESSION['currentroundteam']==$_SESSION['user'])
      {
         print_team_draft_form($link);
      }
      else
      {
         if ($_SESSION['currentroundplayer']==99)
         {
            $_SESSION['message'] = 'The team draft is over.';
         }
         else
         {
            $_SESSION['message'] = 'Wait.';
         }
         print_blank();
      }
      echo '<br>';
   }
   elseif ($_SESSION ['page'] == "playerdraft")
   {
      if ($_SESSION['currentroundplayer']==$_SESSION['user'])
      {
         if ($_SESSION['subpage']=='playertopscore_sub')
         {
            print_player_draft_form($link);
         }
         elseif ($_SESSION['subsubpage']=='t12'||$_SESSION['subsubpage']=='t34'||$_SESSION['subsubpage']=='t56'||$_SESSION['subsubpage']=='t78')
         {
            print_player_draftseed_form($_SESSION['subsubpage'],$link);
         }
         elseif ($_SESSION['subsubpage']=='player_name_search')
         {
            print_player_draftname_form($_POST['player_search'], $link);
         }
         else
         {
            print_blank();
         }
      }
      else
      {
         if ($_SESSION['currentroundplayer']==99)
         {
            $_SESSION['message'] = 'The player draft is over.';
         }
         else
         {
            $_SESSION['message'] = 'Wait.';
         }
         print_blank();
      }
      echo '<br>';
   }
   elseif ($_SESSION ['page'] == "draft")
   {
      print_draft_order($link);
      echo '<br>';
   }
   elseif ($_SESSION ['page'] == "setstatus")
   {
      set_status($_SESSION['status'],$link);
      echo '<br>';
   }
   elseif ($_SESSION ['page'] == "rosters")
   {
      print_roster($link);
      echo '<br>';
   }
   elseif ($_SESSION ['page'] == "admin")
   {
      if ($_SESSION['subsubpage']=='enter_game')
      {
         enter_game($_POST['game_id'], $link);
      }
      else
      {
         print_blank();
      }
      //test_mail();
      echo '<br>';
   }
   elseif ($_SESSION ['page'] == "blank")
   {
      print_blank();
      echo '<br>';
   }
   echo '</td></tr></table>';
   echo '</body>';
}
function print_banner()
{
   echo '<table width="100%" border="0" cellspacing="0" cellpadding="0">';
   echo '<tr><td width="25%" align="center"><img src="images/Logo2017.png" alt="2017 NCAA Final Four Draft Pool"></td>';
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
   echo '<tr><td><strike>Brackets- each player will fill out the entire 63 game bracket.<br>1st place 150, 2nd Place 75, 3rd Place 45, 4th place 30</strike></td></tr></table>';
   echo '</td></tr></table>';
   
   echo '<table class="rulestable"><tr><td class="rulesheader">Play-In Games</td></tr>';
   
   echo '<tr><td><ul>At least 4 teams from the play-in rounds will be drafted. Wins from any of those teams will only count from the Round of 64 onward</ul>';
   echo '<ul>If a player is drafted from any of these teams, only their best game among the play-in game and first round will count.</ul>';
   echo '</td></tr></table>';
}
function print_top_n_teams($n, $link)
{
   $sql = "select v from keyValue where k='playerUpdateDTM'";
   $data = mysqli_query ( $link, $sql );
   while ( list ( $updated ) = mysqli_fetch_row ( $data ) )
   {
      echo '<b>Top ' . $n . ' Teams</b><small>(last updated: ' . $updated . ')</small><br>';
   }
   $sql = "select school,wins,losses,conference,name,max(ppg) from player p inner join (select max(ppg) as maxppg,team_id from player group by team_id) p1 on p.team_id=p1.team_id and p.ppg=p1.maxppg join team t on t.team_id=p.team_id group by p.team_id order by wins/(wins+losses) desc limit " . $n;
   $data = mysqli_query ( $link, $sql );
   echo '<table border="1"><tr><td></td><td>Team</td><td>Record</td><td>Conference</td><td>Leading Scorer</td><td>Pts/Gm</td></tr>';
   $i = 1;
   while ( list ( $team, $wins, $losses, $conference, $name, $ppg ) = mysqli_fetch_row ( $data ) )
   {
      echo '<tr><td>' . $i ++ . '</td><td>' . $team . '</td><td>' . $wins . '-' . $losses . '</td><td>' . $conference . '</td><td>' . $name . '</td><td>' . $ppg . '</td></tr>';
   }
   echo '</table>';
}
function print_top_n_players($n, $link)
{
   $sql = "select v from keyValue where k='playerUpdateDTM'";
   $data = mysqli_query ( $link, $sql );
   while ( list ( $updated ) = mysqli_fetch_row ( $data ) )
   {
      echo '<b>Top ' . $n . ' Scorers</b><small>(last updated: ' . $updated . ')</small><br>';
   }
   $sql = "select name,ppg,school,conference from player p join team t on p.team_id=t.team_id order by ppg desc limit " . $n;
   $data = mysqli_query ( $link, $sql );
   echo '<table border="1"><tr><td></td><td>Name</td><td>Team</td><td>Pts/Gm</td><td>Conference</td></tr>';
   $i = 1;
   while ( list ( $name, $ppg, $team, $conference ) = mysqli_fetch_row ( $data ) )
   {
      echo '<tr><td>' . $i ++ . '</td><td>' . $name . '</td><td>' . $team . '</td><td>' . $ppg . '</td><td>' . $conference . '</td></tr>';
   }
   echo '</table>';
}
function print_top_m_players_n_teams($m, $n, $link)
{
   $sql = "select v from keyValue where k='playerUpdateDTM'";
   $data = mysqli_query ( $link, $sql );
   while ( list ( $updated ) = mysqli_fetch_row ( $data ) )
   {
      echo '<b>Top ' . $m . ' Scorers from Top ' . $n . ' Teams</b><small>(last updated: ' . $updated . ')</small><br>';
   }
   $sql = "select name,ppg,school,conference from player p join team t on p.team_id=t.team_id inner join (select team_id from team order by wins/(wins+losses) desc limit " . $n . ") a on a.team_id=p.team_id order by ppg desc limit " . $m;
   $data = mysqli_query ( $link, $sql );
   echo '<table border="1"><tr><td></td><td>Name</td><td>Team</td><td>Pts/Gm</td><td>Conference</td></tr>';
   $i = 1;
   while ( list ( $name, $ppg, $team, $conference ) = mysqli_fetch_row ( $data ) )
   {
      echo '<tr><td>' . $i ++ . '</td><td>' . $name . '</td><td>' . $team . '</td><td>' . $ppg . '</td><td>' . $conference . '</td></tr>';
   }
   echo '</table>';
}
?>