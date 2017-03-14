<?php
function print_roster($link)
{
   $sql = "select team_name,ceil((t.draft+1)/8) as round,school,seed from user u left join userTeam t on u.user_id=t.user_id left join team m on t.team_id=m.team_id where u.user_id<8 order by u.user_id,t.draft";
   $data = mysqli_query ( $link, $sql );
   echo '<table border="1"><tr><td>Name</td><td>Round</td><td>School</td></tr>';
   while ( list ( $name,$round,$school,$seed) = mysqli_fetch_row ( $data ) )
   {
      echo '<tr><td>' . $name . '</td><td>' . $round . '</td><td>' . $school . '('.$seed.')</td></tr>';
   }
   echo '</table><br><br>';
   $sql = "select u.team_name,ceil((t.draft+1)/8) as round,p.name,p.player_id from user u left join userPlayer t on u.user_id=t.user_id left join player p on p.player_id=t.player_id  where u.user_id<8 order by u.user_id,t.draft";
   $data = mysqli_query ( $link, $sql );
   echo '<table border="1"><tr><td>Name</td><td>Round</td><td>Player</td></tr>';
   while ( list ( $name,$round,$player,$player_id) = mysqli_fetch_row ( $data ) )
   {
      echo '<tr><td>' . $name . '</td><td>' . $round . '</td><td>' . $player . '('.get_player_school($player_id, $link).')</td></tr>';
   }
   echo '</table>';    
}
?>