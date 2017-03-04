<?php
require_once ("login.php");
function generate_draft($link)
{
   // initialize
   for ($i=0;$i<8;$i++)
   {
      $draft[$i]=$i;
   }
   //shuffle
   for ($i=1;$i<7;$i++)
   {
      $j=rand($i,7);
      $temp=$draft[$j];
      $draft[$j]=$draft[$i-1];
      $draft[$i-1]=$temp;
   }
   //insert
   for ($i=0;$i<64;$i+=16)
   {
      for ($j=0;$j<8;$j++)
      {
         $idx = $i + $j;
         $sql = 'insert into draft (draft_pos,player_order,team_order) values ('.$idx.','.$draft[$j].','.$draft[7-$j].')';
         if (! mysqli_query ( $link, $sql ))
         {
            echo 'something happened';
         }
         $drft[$i+$j][0]=$draft[$j];
         $drft[$i+$j][1]=$draft[7-$j];
      }
      for ($j=0;$j<8;$j++)
      {
         $idx = 8 + $i + $j;
         $sql = 'insert into draft (draft_pos,player_order,team_order) values ('.$idx.','.$draft[7-$j].','.$draft[$j].')';
         if (! mysqli_query ( $link, $sql ))
         {
            echo 'something happened';
         }
         $drft[8+$i+$j][1]=$draft[$j];
         $drft[8+$i+$j][0]=$draft[7-$j];
      }
   }
}
function print_draft_order($link)
{
   // is draft set?
   $sql = "select count(*) from draft";
   $data = mysqli_query ( $link, $sql );
   list($rounds) = mysqli_fetch_row($data);
   if ($rounds == 0)
   {
      generate_draft($link);
   }
   // get order
   $sql = "select d.draft_pos,u.team_name as team, a.team_name as teamplayer from draft d join user u on d.player_order=u.user_id join (select draft_pos,team_name from draft d join user u on d.team_order=u.user_id) as a on a.draft_pos=d.draft_pos";
   $data = mysqli_query ( $link, $sql );
   echo '<table border="1"><tr><td>Round</td><td>Player Draft</td><td>Team Draft</td></tr>';
   $i = 0;
   while ( list ( $round,$team,$player ) = mysqli_fetch_row ( $data ) )
   {
      $rnd = $i+1;
      echo '<tr><td>' . $rnd .'</td><td';
      if ($i<$_SESSION['currentPlayerRound'])
      {
         echo ' class="pastround"';
      }
         if ($i==$_SESSION['currentPlayerRound'])
      {
         echo ' class="currentround"';
      }
      echo '>' . $team . '</td><td';
      if ($i<$_SESSION['currentTeamRound'])
      {
         echo ' class="pastround"';
      }
         if ($i==$_SESSION['currentTeamRound'])
      {
         echo ' class="currentround"';
      }
      echo '>' . $player . '</td></tr>';
      $i++;
   }
   echo '</table>';
}
function print_team_draft_form($link)
{
   $sql = "select school,seed,t.team_id from bracket b join team t on b.team_id=t.team_id where round<=2 order by seed,t.region desc";
   $data = mysqli_query ( $link, $sql );
   echo '<form action = "" method = "post">';
   echo '<table border="1"><tr><td>Select</td><td>Seed</td><td>School</td></tr>';
   $i = 1;
   while ( list ( $school,$seed,$team_id ) = mysqli_fetch_row ( $data ) )
   {
      echo '<tr><td><input type="radio" name="team_id" value='.$team_id.'></td><td>' . $school . '</td><td>' . $seed . '</td></tr>';
   }
   echo '<td align="center" colspan=3><input type="submit" name="draft_team" value="Select"></td></tr>';
   echo '</table>';
    
}
?>