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
      
      $sql = 'select p.name,t.school,p.player_id from userplayer up join user u on u.user_id=up.user_id join player p on p.player_id=up.player_id join team t on p.team_id=t.team_id where u.user_id='.$user_id.' order by up.draft';
      $data1 = mysqli_query ( $link, $sql );
      $tot=array_fill(0,8,0);
      while (list($pname,$school,$pid)=mysqli_fetch_row ( $data1 ))
      {
         echo '<tr><td>'.$pname.'('.$school.')</td>';
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
      
      $sql = 'select t.school,seed,t.team_id from userteam ut join user u on u.user_id=ut.user_id join team t on ut.team_id=t.team_id where u.user_id='.$user_id.' order by ut.draft';
      $data1 = mysqli_query ( $link, $sql );
      $tot=array_fill(0,8,0);
      while (list($school,$seed,$tid)=mysqli_fetch_row ( $data1 ))
      {
         echo '<tr><td>'.$school.'('.$seed.')</td>';
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
?>