<?php
function set_status($status,$link)
{
   $sql = 'update keyValue set v="'.$status.'" where k="status"';
   echo $sql;
   $data = mysqli_query ( $link, $sql );
   header("Location: index.php");
}
function enter_game($game_id,$link)
{
   echo '<form action = "" method = "post">';
   $sql = 'select bracket_pos,next_pos,b.team_id,school from bracket b join team t on b.team_id=t.team_id where game_id='.$game_id;
   $data = mysqli_query ( $link, $sql );
   echo '<table border="1"><tr><td>';
   $i=0;
   while (list($b_pos,$n_pos,$team_id,$school)=mysqli_fetch_row($data))
   {
      $sql = 'select p.player_id,name from userplayer u join player p on p.player_id=u.player_id where team_id='.$team_id;
      echo '<table border="1"><tr><td>'.$school.'</td><td><input type="text" name="tm'.$i.'pts"><input type="hidden" name="team1_id" value="'.$team_id.'"></td></tr>';
      $data1 = mysqli_query ( $link, $sql );
      while (list($player_id,$name)=mysqli_fetch_row($data1))
      {
         echo '<tr><td>'.$name.'</td><td><input type="text" name="tm1pts[]"><input type="hidden" name="player1_id[]" value="'.$player_id.'"></td></tr>';
      }
      echo '</table>';
      if ($i++==0)
      {
         echo '</td><td>';
      }
   }
   echo '</tr></table>';
}
?>