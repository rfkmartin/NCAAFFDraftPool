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
   $sql = "select login_id,name from entry where tourney_id=".$_SESSION['activepool']." order by name";
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
      
      $sql = "select p.name,t.school,p.player_id,w.active from ownerPlayer op join entry e on op.owner_id=e.entry_id join _login l on l.login_id=e.login_id join player p on p.player_id=op.player_id join team t on p.team_id=t.team_id join (select min(winner) as active,team_id from teamGame tg group by team_id) w on w.team_id=t.team_id where l.login_id=".$user_id." order by op.draft";
      //select p.name,t.school,p.player_id,w.active from userplayer up join user u on u.user_id=up.user_id join player p on p.player_id=up.player_id join team t on p.team_id=t.team_id join (select min(winner) as active,team_id from teamgame tg group by team_id) w on w.team_id=t.team_id where u.user_id='.$user_id.' order by up.draft';
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
   $sql = "select login_id,name from entry where tourney_id=".$_SESSION['activepool']." order by name";
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
      
      $sql = "select t.school,tY.seed,t.team_id,w.active as active from ownerTeam ot join teamstatsYear tY on tY.team_id=ot.team_id join entry e on ot.owner_id=e.entry_id join _login l on l.login_id=e.login_id join team t on ot.team_id=t.team_id join (select min(winner) as active,team_id from teamGame tg where points>0 group by team_id) w on w.team_id=t.team_id where l.login_id=".$user_id." order by ot.draft";
      //select t.school,seed,t.team_id,w.active as active from userteam ut join user u on u.user_id=ut.user_id join team t on ut.team_id=t.team_id join (select min(winner) as active,team_id from teamgame tg group by team_id) w on w.team_id=t.team_id where u.user_id='.$user_id.' order by ut.draft';
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
   $sql = 'select points from playerGame pg join bracket b on pg.bracket_pos=b.bracket_pos where player_id='.$player_id.' and round='.$round;
   $data = mysqli_query ( $link, $sql );
   $pts=0;
   list($pts)=mysqli_fetch_row($data);
   return $pts;
}
function get_team_win($round,$team_id,$link)
{
   $sql = 'select winner from teamGame tg join bracket b on tg.bracket_pos=b.bracket_pos where tg.team_id='.$team_id.' and round='.$round;
   $data = mysqli_query ( $link, $sql );
   $pts=0;
   list($pts)=mysqli_fetch_row($data);
   return $pts;
}
function get_max_pts($link)
{
   $sql = 'select place,points from place p join category c on c.category_id=p.category_id join points pt on pt.points_id=p.points_id where p.category_id=4 order by place;';
   $data = mysqli_query ( $link, $sql );
   $pts1=array(0,0,0,0,0,0,0,0);
   while (list($place,$points)=mysqli_fetch_row($data))
   {
      $pts1[$place-1]=$points;
   }

   $sql = 'select sum(maxpts) as teammax,team_name from (select maxpts,team_name,u.user_id from userplayer up join (select max(points) as maxpts,player_id from playergame group by player_id) as m on up.player_id=m.player_id join user u on up.user_id=u.user_id join player p on p.player_id=up.player_id order by u.user_id) as g group by g.user_id order by teammax desc';
   $data = mysqli_query ( $link, $sql );
   echo '<table width="75%" border="1">';
   echo '<tr><td class="roster">Team High Game Points</td><td class="roster">Team</td><td class="roster">Score</td></tr>';
   $i=0;
   $max=999;
   $place=0;
   $counts=array(0,0,0,0,0,0,0,0);
   while (list($pts,$team_name)=mysqli_fetch_row($data))
   {
      if ($pts<$max) {
         $place=$i+1;
         $max=$pts;
      }
      $counts[$place-1]++;
      $pts_arr[$i]=$pts;
      $team_name_arr[$i]=$team_name;
      $place_arr[$i]=$place;
      $i++;
   }
   $scores = score_it($counts,$place_arr,$pts1);
   for ($i=0;$i<8;$i++) {
      echo '<tr><td>'.$pts_arr[$i].'</td><td>'.$team_name_arr[$i].'</td><td>';
      if ($scores[$i]>0)
      {
         echo $scores[$i];
      }
      echo '</td></tr>';
   }
   echo '</table>';   
}
function get_total_pts($link)
{
   $sql = 'select place,points from place p join category c on c.category_id=p.category_id join points pt on pt.points_id=p.points_id where p.category_id=4 order by place;';
   $data = mysqli_query ( $link, $sql );
   $pts1=array(0,0,0,0,0,0,0,0);
   while (list($place,$points)=mysqli_fetch_row($data))
   {
      $pts1[$place-1]=$points;
   }
   $sql = 'select sum(points) as teampts,team_name from playergame pg join userplayer up on pg.player_id=up.player_id join user u on up.user_id=u.user_id group by u.user_id order by teampts desc';
   $data = mysqli_query ( $link, $sql );
   echo '<table width="90%" border="1">';
   echo '<tr><td class="roster">Team Total Points</td><td class="roster">Team</td><td class="roster">Score</td></tr>';
   $i=0;
   $max=999;
   $place=0;
   $counts=array(0,0,0,0,0,0,0,0);
   while (list($pts,$team_name)=mysqli_fetch_row($data))
   {
      if ($pts<$max) {
         $place=$i+1;
         $max=$pts;
      }
      $counts[$place-1]++;
      $pts_arr[$i]=$pts;
      $team_name_arr[$i]=$team_name;
      $place_arr[$i]=$place;
      $i++;
   }
   $scores = score_it($counts,$place_arr,$pts1);
   for ($i=0;$i<8;$i++) {
      echo '<tr><td>'.$pts_arr[$i].'</td><td>'.$team_name_arr[$i].'</td><td>';
      if ($scores[$i]>0)
      {
         echo $scores[$i];
      }
      echo '</td></tr>';
   }
   echo '</table>';
}
function print_other_stats($link)
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
   $sql = 'select place,points from place p join category c on c.category_id=p.category_id join points pt on pt.points_id=p.points_id where p.category_id=4 order by place;';
   $data = mysqli_query ( $link, $sql );
   $pts1=array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
   while (list($place,$points)=mysqli_fetch_row($data))
   {
      $pts1[$place-1]=$points;
   }
   
   $sql = 'select sum(points) as playerpts,p.name,team_name,w.active as active from playergame pg join player p on pg.player_id=p.player_id join userplayer up on pg.player_id=up.player_id join user u on up.user_id=u.user_id join (select min(winner) as active,team_id from teamgame tg group by team_id) w on w.team_id=p.team_id group by up.player_id order by playerpts desc limit 20';
   $data = mysqli_query ( $link, $sql );
   echo '<table width="75%" border="1">';
   echo '<tr><td class="roster">Individual Player Points</td><td class="roster">Team</td><td class="roster">Owner</td><td class="roster">Score</td></tr>';
   $i=0;
   $max=999;
   $place=0;
   $counts=array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
   while (list($pts,$player_name,$team_name,$active)=mysqli_fetch_row($data)) {
      if ($pts<$max) {
         $place=$i+1;
         $max=$pts;
      }
      $counts[$place-1]++;
      $pts_arr[$i]=$pts;
      $player_name_arr[$i]=$player_name;
      $team_name_arr[$i]=$team_name;
      $place_arr[$i]=$place;
      $active_arr[$i]=$active;
      $i++;
   }
   $scores = score_it($counts,$place_arr,$pts1);
   for ($i=0;$i<20;$i++) {
      echo '<tr><td>'.$pts_arr[$i].'</td><td';
      if ($active_arr[$i]==0)
      {
         echo ' class="out"';
      }
      echo '>'.$player_name_arr[$i].'</td><td';
      if ($active_arr[$i]==0)
      {
         echo ' class="out"';
      }
      echo '>'.$team_name_arr[$i].'</td><td>';
      if ($scores[$i]>0)
      {
         echo $scores[$i];
      }
      echo '</td></tr>';
   }
   echo '</table>';
}
function print_player_hi_points($link)
{
   $sql = 'select place,points from place p join category c on c.category_id=p.category_id join points pt on pt.points_id=p.points_id where p.category_id=4 order by place;';
   $data = mysqli_query ( $link, $sql );
   $pts1=array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
   while (list($place,$points)=mysqli_fetch_row($data))
   {
      $pts1[$place-1]=$points;
   }
    
   $sql = 'select max(points) as playerpts,p.name,team_name,w.active as active from playergame pg join player p on pg.player_id=p.player_id join userplayer up on pg.player_id=up.player_id join user u on up.user_id=u.user_id join (select min(winner) as active,team_id from teamgame tg group by team_id) w on w.team_id=p.team_id group by pg.player_id order by playerpts desc limit 20';
   $data = mysqli_query ( $link, $sql );
   echo '<table width="75%" border="1">';
   echo '<tr><td class="roster">Individual Player High Game</td><td class="roster">Team</td><td class="roster">Owner</td><td class="roster">Score</td></tr>';
   //migrate this to other tables
   $i=0;
   $max=999;
   $place=0;
   $counts=array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
   while (list($pts,$player_name,$team_name,$active)=mysqli_fetch_row($data)) {
      if ($pts<$max) {
         $place=$i+1;
         $max=$pts;
      }
      $counts[$place-1]++;
      $pts_arr[$i]=$pts;
      $player_name_arr[$i]=$player_name;
      $team_name_arr[$i]=$team_name;
      $place_arr[$i]=$place;
      $active_arr[$i]=$active;
      $i++;
   }
   $scores = score_it($counts,$place_arr,$pts1);
   for ($i=0;$i<20;$i++) {
      echo '<tr><td>'.$pts_arr[$i].'</td><td';
      if ($active_arr[$i]==0)
      {
         echo ' class="out"';
      }
      echo '>'.$player_name_arr[$i].'</td><td>'.$team_name_arr[$i].'</td><td>';
      if ($scores[$i]>0)
      {
         echo $scores[$i];
      }
      echo '</td></tr>';
   }
   echo '</table>';
}
function highest_seed($link)
{
   echo '<table width="67%"><tr><td class="results" colspan="2">Lowest Advancing Seed</td></tr>';
   echo '<tr><td class="results" width="50%">Round of 64</td><td class="results">Round of 32</td></tr><tr valign="top">';
   for ($i=2;$i<4;$i++)
   {
      echo '<td><table width="100%"><tr><td class="roster">Team</td><td class="roster">Seed</td><td class="roster">Owner</td></tr>';
      $sql = 'select seed from bracket b join teamgame tg on b.bracket_pos=tg.bracket_pos join team t on t.team_id=tg.team_id where round='.$i.' and winner=1 order by seed desc';
      $data = mysqli_query($link,$sql);
      list($seed)=mysqli_fetch_row($data);
      $sql = 'select school,seed,round,team_name from teamgame tg join userteam ut on tg.team_id=ut.team_id join team t on ut.team_id=t.team_id join bracket b on tg.bracket_pos=b.bracket_pos join user u on u.user_id=ut.user_id where winner=1 and round='.$i.' and seed='.$seed;
      $data = mysqli_query ( $link, $sql );
      while (list($school,$seed,$round,$team_name)=mysqli_fetch_row($data))
      {
         echo '<tr valign="top"><td>'.$school.'</td><td>'.$seed.'</td><td>'.$team_name.'</tr>';
      }
      echo '</table></td>';
   }
   echo '</tr></table>';
}
function update_user_points($link)
{
	logit("updating results");
   // clear previous results
   $pts1=array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
   $sql = 'update results set points=0';
   // hard code for 2018 lowest seeds advancing
   $data = mysqli_query ( $link, $sql );
   $sql = 'update results set points=50 where user_id=4 and category_id=1';
   $data = mysqli_query ( $link, $sql );
   $sql = 'update results set points=50 where user_id=5 and category_id=2';
   $data = mysqli_query ( $link, $sql );

   $sql = 'select place,points from place p join category c on c.category_id=p.category_id join points pt on pt.points_id=p.points_id where p.category_id=4 order by place';
   $data = mysqli_query ( $link, $sql );
   while (list($place,$points)=mysqli_fetch_row($data))
   {

      $pts1[$place-1]=$points;
   }
   // Team Total Points
   $sql = 'select sum(points) as teampts,team_name,up.user_id from playerGame pg join userplayer up on pg.player_id=up.player_id join user u on up.user_id=u.user_id group by u.user_id order by teampts desc';
   $data = mysqli_query ( $link, $sql );
   $i=0;
   $max=999;
   $place=0;
   $counts=array(0,0,0,0,0,0,0,0);
   while (list($pts,$team_name,$user_id)=mysqli_fetch_row($data))
   {
      if ($pts<$max) {
         $place=$i+1;
         $max=$pts;
      }
      $counts[$place-1]++;
      $pts_arr[$i]=$pts;
      $uid_arr[$i]=$user_id;
      $team_name_arr[$i]=$team_name;
      $place_arr[$i]=$place;
      $i++;
   }
   $scores = score_it($counts,$place_arr,$pts1);
   $i=0;
   for ($i=0;$i<8;$i++)
   {
      $sql1 = 'update results set points=points+'.$scores[$i].' where user_id='.($uid_arr[$i]-1).' and category_id=3';
      $data1 = mysqli_query ( $link, $sql1 );
   }

   // Team Total Individual Game Highs
   $sql   = 'select sum(maxpts) as teammax,team_name,g.user_id from (select maxpts,team_name,u.user_id from userplayer up join (select max(points) as maxpts,player_id from playergame group by player_id) as m on up.player_id=m.player_id join user u on up.user_id=u.user_id join player p on p.player_id=up.player_id order by u.user_id) as g group by g.user_id order by teammax desc';
   $data = mysqli_query ( $link, $sql );
   $i=0;
   $max=999;
   $place=0;
   $counts=array(0,0,0,0,0,0,0,0);
   while (list($pts,$team_name,$user_id)=mysqli_fetch_row($data))
   {
      if ($pts<$max) {
         $place=$i+1;
         $max=$pts;
      }
      $counts[$place-1]++;
      $pts_arr[$i]=$pts;
      $uid_arr[$i]=$user_id;
      $team_name_arr[$i]=$team_name;
      $place_arr[$i]=$place;
      $i++;
   }
   $scores = score_it($counts,$place_arr,$pts1);
   $i=0;
   for ($i=0;$i<8;$i++)
   {
      $sql1 = 'update results set points=points+'.$scores[$i].' where user_id='.($uid_arr[$i]-1).' and category_id=4';
      $data1 = mysqli_query ( $link, $sql1 );
   }

   // Individual Tournament Points
   $sql = 'select sum(points) as playerpts,up.user_id from playergame pg join player p on pg.player_id=p.player_id join userplayer up on pg.player_id=up.player_id join user u on up.user_id=u.user_id join (select min(winner) as active,team_id from teamgame tg group by team_id) w on w.team_id=p.team_id group by up.player_id order by playerpts desc limit 20';
   $data = mysqli_query ( $link, $sql );
   $i=0;
   $max=999;
   $place=0;
   $counts=array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
   while (list($pts,$user_id)=mysqli_fetch_row($data)) {
      if ($pts<$max) {
         $place=$i+1;
         $max=$pts;
      }
      $counts[$place-1]++;
      $pts_arr[$i]=$pts;
      $uid_arr[$i]=$user_id;
      $place_arr[$i]=$place;
      $i++;
   }
   $scores = score_it($counts,$place_arr,$pts1);
   for ($i=0;$i<8;$i++)
   {
      $sql1 = 'update results set points=points+'.$scores[$i].' where user_id='.($uid_arr[$i]-1).' and category_id=5';
      $data1 = mysqli_query ( $link, $sql1 );
   }


   // Individual Game High
   $sql = 'select max(points) as playerpts,up.user_id from playergame pg join player p on pg.player_id=p.player_id join userplayer up on pg.player_id=up.player_id join user u on up.user_id=u.user_id join (select min(winner) as active,team_id from teamgame tg group by team_id) w on w.team_id=p.team_id group by pg.player_id order by playerpts desc limit 20';
   $data = mysqli_query ( $link, $sql );
   $i=0;
   $max=999;
   $place=0;
   $counts=array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
   while (list($pts,$user_id)=mysqli_fetch_row($data)) {
      if ($pts<$max) {
         $place=$i+1;
         $max=$pts;
      }
      $counts[$place-1]++;
      $pts_arr[$i]=$pts;
      $uid_arr[$i]=$user_id;
      $place_arr[$i]=$place;
      $i++;
   }
   $scores = score_it($counts,$place_arr,$pts1);
   for ($i=0;$i<8;$i++)
   {
      $sql1 = 'update results set points=points+'.$scores[$i].' where user_id='.($uid_arr[$i]-1).' and category_id=6';
      $data1 = mysqli_query ( $link, $sql1 );
   }
}
function print_pool_results($link)
{
   echo '<table width="67%"><tr><td class="results">Team</td><td class="results">Initial Points</td><td class="results">Team Draft Cost</td><td class="results">Team Draft Winnings</td><td class="results">Net</td></tr>';
   for ($i=0;$i<8;$i++)
   {
      $sql = 'select team_name from user where user_id='.($i+1);
      $data = mysqli_query ( $link, $sql );
      list($team)=mysqli_fetch_row($data);
      $sql = 'select sum(80-(seed-1)*5) from userteam ut join team t on ut.team_id=t.team_id where user_id='.($i+1);
      $data = mysqli_query ( $link, $sql );
      list($cost)=mysqli_fetch_row($data);
      $sql = 'select 43*sum(winner) from teamgame tg join bracket b on tg.bracket_pos=b.bracket_pos join userteam ut on tg.team_id=ut.team_id where round>=2 and user_id='.($i+1);
      $data = mysqli_query ( $link, $sql );
      list($winnings)=mysqli_fetch_row($data);
      $net[$i] = 300-$cost+$winnings;
      echo '<tr><td align="center">'.$team.'</td><td align="center">300</td><td align="center">'.$cost.'</td><td align="center">'.$winnings.'</td><td align="center">'.$net[$i].'</td><tr>';
   }
   echo '</table><br>';
   echo '<table width="67%"><tr><td class="results">Team</td><td class="results">Team Total Points</td><td class="results">Team Total Individual Game Highs</td><td class="results">Individual Tournament Points</td><td class="results">Individual Game High</td><td class="results">Net</td></tr>';
   for ($i=0;$i<8;$i++)
   {
      $sql = 'select team_name from user where user_id='.($i+1);
      $data = mysqli_query ( $link, $sql );
      list($team)=mysqli_fetch_row($data);
      echo '<tr><td align="center">'.$team.'</td>';
      $sql = 'select points from results where category_id between 3 and 6 and user_id='.$i;
      $data = mysqli_query ( $link, $sql );
      $net1[$i]=0;
      while(list($pts)=mysqli_fetch_row($data))
      {
         echo '<td align="center">'.$pts.'</td>';
         $net1[$i]+=$pts;
      }
      echo '<td align="center">'.$net1[$i].'</td><tr>';
   }
   echo '</table><br>';
   echo '<table width="67%">';
   echo '<tr><td rowspan="2" class="results">Team</td><td colspan="7" class="results">Most Teams Advancing</td></tr>';
   echo '<tr><td class="results">Round of 64</td><td class="results">Round of 32</td><td class="results">Sweet Sixteen</td><td class="results">Elite Eight</td><td class="results">Final Four</td><td class="results">Championship</td><td class="results">Net</td></tr>';
   //$sql = 'select user_id from (select round,user_id,sum(winner) as sum from teamgame tg join bracket b on tg.bracket_pos=b.bracket_pos join userteam ut on ut.team_id=tg.team_id where round > 1 group by round,user_id order by round asc,sum desc) a group by round';
   $sql = 'select round,user_id,sum(winner) as sum from teamgame tg join bracket b on tg.bracket_pos=b.bracket_pos join userteam ut on ut.team_id=tg.team_id where round > 1 group by round,user_id order by round asc,sum desc';
   $data = mysqli_query ( $link, $sql );
   $i=0;
   $max=array(0,0,0,0,0,0,0);
   $winners=array(0,0,0,0,0,0,0);
   while(list($rnd,$uid,$wins)=mysqli_fetch_row($data))
   {
      if ($wins>=$max[$rnd-1]) {
         $winners[$rnd-1]++;
         $max[$rnd-1]=$wins;
         $temp[$uid][$rnd-1]=$wins;
      } else {
         $temp[$uid][$rnd-1]=0;
      }
   }
   $rnds=$i;
   for ($i=0;$i<8;$i++)
   {
      $sql = 'select team_name from user where user_id='.($i+1);
      $data = mysqli_query ( $link, $sql );
      list($team)=mysqli_fetch_row($data);
      echo '<tr><td align="center">'.$team.'</td>';
      $net2[$i]=0;
      for ($j=1;$j<=6;$j++)
      {
         if (isset($temp[$i+1][$j])&&$temp[$i+1][$j]>0)
         {
            $pts = floor(50/$winners[$j]);
            echo '<td align="center">'.$pts.'</td>';
            $net2[$i]+=$pts;
         }
         else
         {
            echo '<td></td>';
         }
      }
      echo '<td>'.$net2[$i].'</td></tr>';
   }
   echo '</table><br>';
   echo '<table width="67%"><tr><td rowspan="2" class="results">Team</td><td colspan="2" class="results">Lowest Advancing Seed</td><td class="results"></td><td class="results"></td></tr>';
   echo '<tr><td class="results">Round of 64</td><td class="results">Round of 32</td><td class="results">MVP</td><td class="results">Net</td></tr>';
   for ($i=0;$i<8;$i++)
   {
      $sql = 'select team_name from user where user_id='.($i+1);
      $data = mysqli_query ( $link, $sql );
      list($team)=mysqli_fetch_row($data);
      echo '<tr><td align="center">'.$team.'</td>';
      $sql = 'select points from results where (category_id < 3 or category_id > 7) and user_id='.$i;
      $data = mysqli_query ( $link, $sql );
      $net3[$i]=0;
      while(list($pts)=mysqli_fetch_row($data))
      {
         echo '<td align="center">'.$pts.'</td>';
         $net3[$i]+=$pts;
      }
      echo '<td align="center">'.$net3[$i].'</td><tr>';
   }
   echo '</table><br>';
   echo '<table width="67%"><tr><td class="results">Team</td><td class="results">Team Points</td><td class="results">Player Points</td><td class="results">Bracket Points</td><td class="results">Other</td><td class="results">Net</td></tr>';
   for ($i=0;$i<8;$i++)
   {
      $sql = 'select team_name from user where user_id='.($i+1);
      $data = mysqli_query ( $link, $sql );
      list($team)=mysqli_fetch_row($data);
      echo '<tr><td align="center">'.$team.'</td>';
      echo '<td align="center">'.$net[$i].'</td><td align="center">'.$net1[$i].'</td><td align="center">'.$net2[$i].'</td><td align="center">'.$net3[$i].'</td>';
      $sum = $net[$i]+$net1[$i]+$net2[$i]+$net3[$i];
      echo '<td align="center">'.$sum.'</td><tr>';
   }
   echo '</table><br>';
}
function score_it($counts,$place,$pts1) {
   for($i=0;$i<count($place);$i++) {
      if ($counts[$i] != 0) {
         $sum=0;
         for ($k=0;$k<$counts[$i];$k++) {
            $sum+=$pts1[$k+$place[$i]-1];
         }
         $result[$i] = floor($sum /$counts[$i]);
         //$result[$i] = $sum /$counts[$i];
         } else {
         $result[$i] = $result[$i-1];
      }
   }
   //print_r($counts);
   //print_r($place);
   //print_r($result);
   return $result;
}
?>