<?php
function print_player_results($link)
{
   $sql = "select round from round order by round_id";
   $data = mysqli_query ( $link, $sql );
   $i=0;
   while (list($round[$i])=mysqli_fetch_row($data))
   {
      $i++;
   }
   $sql = "select user_id,team_name from user where user_id<8 order by team_name";
   $data = mysqli_query ( $link, $sql );
   while (list($user_id,$teamname)=mysqli_fetch_row ( $data ))
   {
      echo '<table width="90%" border="1">';
      echo '<tr><td class="roster" colspan="8">Roster for '.$teamname.'</td></tr>';
      echo '<tr><td width="31%">Player</td>';
      for ($j=1;$j<7;$j++)
      {
         echo '<td width="10%">'.$round[$j].'</td>';
      }
      echo '<td width="9%">Total</td></tr>';
      
      $sql = 'select p.name,t.school,p.player_id,w.active from userplayer up join user u on u.user_id=up.user_id join player p on p.player_id=up.player_id join team t on p.team_id=t.team_id join (select min(winner) as active,team_id from teamgame tg group by team_id) w on w.team_id=t.team_id where u.user_id='.$user_id.' order by up.draft';
      $data1 = mysqli_query ( $link, $sql );
      $tot=array_fill(0,8,0);
      while (list($pname,$school,$pid,$active)=mysqli_fetch_row ( $data1 ))
      {
         echo '<tr><td';
         if ($active==0)
         {
            echo ' class="out"';
         }
         echo '>'.$pname.'('.$school.')</td>';
         $k=0;
         for ($j=1;$j<7;$j++)
         {
            $pts=get_player_pts($j+1, $pid, $link);
            echo '<td>'.$pts.'</td>';
            $k+=$pts;
            $tot[$j-1]+=$pts;
         }
         $tot[$j]+=$k;
         echo '<td>'.$k.'</td></tr>';
      }
      echo '<tr><td>Totals</td>';
      for ($j=1;$j<7;$j++)
      {
         echo '<td>'.$tot[$j-1].'</td>';
      }
      echo '<td>'.$tot[$j].'</td></tr>';
      
      echo '<br>';
   }
}
function print_team_results($link)
{
   $sql = "select round from round order by round_id";
   $data = mysqli_query ( $link, $sql );
   $i=0;
   while (list($round[$i])=mysqli_fetch_row($data))
   {
      $i++;
   }
   $sql = "select user_id,team_name from user where user_id<8 order by team_name";
   $data = mysqli_query ( $link, $sql );
   while (list($user_id,$teamname)=mysqli_fetch_row ( $data ))
   {
      echo '<table width="90%" border="1">';
      echo '<tr><td class="roster" colspan="9">Team Roster for '.$teamname.'</td></tr>';
      echo '<tr><td width="25%">Team</td>';
      echo '<td width="6%">Cost</td>';
      for ($j=1;$j<7;$j++)
      {
         echo '<td width="10%">'.$round[$j].'</td>';
      }
      echo '<td width="9%">Total</td></tr>';
      
      $sql = 'select t.school,seed,t.team_id,w.active as active from userteam ut join user u on u.user_id=ut.user_id join team t on ut.team_id=t.team_id join (select min(winner) as active,team_id from teamgame tg group by team_id) w on w.team_id=t.team_id where u.user_id='.$user_id.' order by ut.draft';
      $data1 = mysqli_query ( $link, $sql );
      $tot=array_fill(0,8,0);
      while (list($school,$seed,$tid,$active)=mysqli_fetch_row ( $data1 ))
      {
         echo '<tr><td';
         if ($active==0)
         {
            echo ' class="out"';
         }
         echo '>'.$school.'('.$seed.')</td>';
         $cost=80-($seed-1)*5;
         $tot[0]+=$cost;
         echo '<td>'.$cost.'</td>';
         $k=0;
         for ($j=1;$j<7;$j++)
         {
            $pts=43*get_team_win($j+1, $tid, $link);
            if ($pts==0)
            {
               echo '<td>-</td>';
            }
            else
            {
               echo '<td>'.$pts.'</td>';
            }
            $k+=$pts;
            $tot[$j]+=$pts;
         }
         $tot[$j]+=$k;
         echo '<td>'.$k.'</td></tr>';
      }
      echo '<tr><td>Totals</td>';
      for ($j=0;$j<7;$j++)
      {
         echo '<td>'.$tot[$j].'</td>';
      }
      echo '<td>'.$tot[$j].'</td></tr>';
      
      echo '<br>';
   }
}
function get_player_pts($round,$player_id,$link)
{
   $sql = 'select points from playergame pg join bracket b on pg.bracket_pos=b.bracket_pos where player_id='.$player_id.' and round='.$round;
   $data = mysqli_query ( $link, $sql );
   $pts=0;
   list($pts)=mysqli_fetch_row($data);
   return $pts;
}
function get_team_win($round,$team_id,$link)
{
   $sql = 'select winner from teamgame tg join bracket b on tg.bracket_pos=b.bracket_pos where tg.team_id='.$team_id.' and round='.$round;
   $data = mysqli_query ( $link, $sql );
   $pts=0;
   list($pts)=mysqli_fetch_row($data);
   return $pts;
}
function get_max_pts($link)
{
   $sql = 'select sum(maxpts) as teammax,team_name from (select maxpts,team_name,u.user_id from userplayer up join (select max(points) as maxpts,player_id from playergame group by player_id) as m on up.player_id=m.player_id join user u on up.user_id=u.user_id join player p on p.player_id=up.player_id order by u.user_id) as g group by g.user_id order by teammax desc';
   $data = mysqli_query ( $link, $sql );
   echo '<table width="75%" border="1">';
   echo '<tr><td class="roster">Team High Game Points</td><td class="roster">Team</td><td class="roster">Score</td></tr>';
   while (list($pts,$team_name)=mysqli_fetch_row($data))
   {
      echo '<tr><td>'.$pts.'</td><td>'.$team_name.'</td><td></td></tr>';
   }
   echo '</table>';   
}
function get_total_pts($link)
{
   $sql = 'select sum(points) as teampts,team_name from playergame pg join userplayer up on pg.player_id=up.player_id join user u on up.user_id=u.user_id group by u.user_id order by teampts desc';
   $data = mysqli_query ( $link, $sql );
   echo '<table width="90%" border="1">';
   echo '<tr><td class="roster">Team Total Points</td><td class="roster">Team</td><td class="roster">Score</td></tr>';
   while (list($pts,$team_name)=mysqli_fetch_row($data))
   {
      echo '<tr><td>'.$pts.'</td><td>'.$team_name.'</td><td></td></tr>';
   }
   echo '</table>';
}
function print_leader_board($link)
{
   echo '<table width="90%"><tr><td colspan=2 class="results">Team Points</td></tr>';
   echo '<tr><td align="center">';
   get_max_pts($link);
   echo '</td><td align="center">';
   get_total_pts($link);
   echo '</td></tr></table>';
   echo '<table width="90%"><tr><td colspan=2 class="results">Individual Points</td></tr>';
   echo '<tr><td align="center">';
   print_player_points($link);
   echo '</td><td align="center">';
   print_player_hi_points($link);
   echo '</td></tr></table>';
   highest_seed($link);
}
function print_player_points($link)
{
   $sql = 'select sum(points) as playerpts,p.name,team_name,w.active as active from playergame pg join player p on pg.player_id=p.player_id join userplayer up on pg.player_id=up.player_id join user u on up.user_id=u.user_id join (select min(winner) as active,team_id from teamgame tg group by team_id) w on w.team_id=p.team_id group by up.player_id order by playerpts desc limit 20';
   $data = mysqli_query ( $link, $sql );
   echo '<table width="75%" border="1">';
   echo '<tr><td class="roster">Individual Player Points</td><td class="roster">Team</td><td class="roster">Owner</td><td class="roster">Score</td></tr>';
   while (list($pts,$player_name,$team_name,$active)=mysqli_fetch_row($data))
   {
      echo '<tr><td>'.$pts.'</td><td';
         if ($active==0)
      {
         echo ' class="out"';
      }
      echo '>'.$player_name.'</td><td';
         if ($active==0)
      {
         echo ' class="out"';
      }
      echo '>'.$team_name.'</td><td></td></tr>';
   }
   echo '</table>';
}
function print_player_hi_points($link)
{
   $sql = 'select max(points) as playerpts,p.name,team_name,w.active as active from playergame pg join player p on pg.player_id=p.player_id join userplayer up on pg.player_id=up.player_id join user u on up.user_id=u.user_id join (select min(winner) as active,team_id from teamgame tg group by team_id) w on w.team_id=p.team_id group by pg.player_id order by playerpts desc limit 20';
   $data = mysqli_query ( $link, $sql );
   echo '<table width="75%" border="1">';
   echo '<tr><td class="roster">Individual Player High Game</td><td class="roster">Team</td><td class="roster">Owner</td><td class="roster">Score</td></tr>';
   while (list($pts,$player_name,$team_name,$active)=mysqli_fetch_row($data))
   {
      echo '<tr><td>'.$pts.'</td><td';
      if ($active==0)
      {
         echo ' class="out"';
      }
      echo '>'.$player_name.'</td><td>'.$team_name.'</td><td></td></tr>';
   }
   echo '</table>';
}
function highest_seed($link)
{
   echo '<table width="67%"><tr><td class="results" colspan="2">Lowest Advancing Seed</td></tr>';
   echo '<tr><td class="results" width="50%">Round of 64</td><td class="results">Round of 32</td></tr><tr>';
   for ($i=2;$i<4;$i++)
   {
      echo '<td><table width="100%"><tr><td class="roster">Team</td><td class="roster">Seed</td><td class="roster">Owner</td></tr>';
      $sql = 'select school,seed,round,team_name from teamgame tg join userteam ut on tg.team_id=ut.team_id join team t on ut.team_id=t.team_id join bracket b on tg.bracket_pos=b.bracket_pos join user u on u.user_id=ut.user_id where winner=1 and round='.$i.' order by seed desc limit 1';
      $data = mysqli_query ( $link, $sql );
      list($school,$seed,$round,$team_name)=mysqli_fetch_row($data);
      echo '<tr><td>'.$school.'</td><td>'.$seed.'</td><td>'.$team_name.'</tr></table></td>';
   }
   echo '</tr></table>';
}
?>