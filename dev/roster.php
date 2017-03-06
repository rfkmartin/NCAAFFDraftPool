<?php
function print_roster($link)
{
   $sql = "select name,ceil((t.draft+1)/8) as round,school from user u left join userTeam t on u.user_id=t.user_id left join team m on t.team_id=m.team_id order by u.user_id,t.draft";
   $data = mysqli_query ( $link, $sql );
   echo '<table border="1"><tr><td>Name</td><td>Round</td><td>School</td></tr>';
   while ( list ( $name,$round,$school) = mysqli_fetch_row ( $data ) )
   {
      echo '<tr><td>' . $name . '</td><td>' . $round . '</td><td>' . $school . '</td></tr>';
   }
   echo '</table><br><br>';
   $sql = "select u.name,ceil((t.draft+1)/8) as round,p.name from user u left join userPlayer t on u.user_id=t.user_id left join player p on p.player_id=t.player_id order by u.user_id,t.draft";
   $data = mysqli_query ( $link, $sql );
   echo '<table border="1"><tr><td>Name</td><td>Round</td><td>Player</td></tr>';
   while ( list ( $name,$round,$player) = mysqli_fetch_row ( $data ) )
   {
      echo '<tr><td>' . $name . '</td><td>' . $round . '</td><td>' . $player . '</td></tr>';
   }
   echo '</table>';    
}
?>