<?php
require_once ("login.php");
function generate_draft($link)
{
   // initialize
   for ($i=0;$i<8;$i++)
   {
      $draft[$i]=$i+1;
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
   $sql = 'insert into draft (draft_pos,player_order,team_order) values ('.$idx.',99,99)';
   if (! mysqli_query ( $link, $sql ))
   {
      echo 'something happened';
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
   $sql = "select school,seed,t.team_id from bracket b join team t on b.team_id=t.team_id where round<=2 and b.bracket_pos<132 and t.team_id not in (select team_id from userTeam) order by seed,t.region desc";
   $data = mysqli_query ( $link, $sql );
   echo '<form action = "" method = "post">';
   echo '<table border="1"><tr><td>Select</td><td>School</td><td>Seed</td></tr>';
   $i = 1;
   while ( list ( $school,$seed,$team_id ) = mysqli_fetch_row ( $data ) )
   {
      echo '<tr><td><input type="radio" name="team_id" value='.$team_id.'></td><td>' . $school . '</td><td>' . $seed . '</td></tr>';
   }
   echo '<td align="center" colspan=3><input type="hidden" name="hash" id="hash" value="'.microtime().'" /><input type="submit" name="draft_team" value="Select"></td></tr>';
   echo '</table>';
    
}
function print_player_draft_form($link)
{
   $sql = "select p.player_id,school,seed,p.name,ppg from bracket b join team t on b.team_id=t.team_id join player p on p.team_id=b.team_id where p.player_id not in (select player_id from userPlayer) order by ppg desc limit 45";
   $data = mysqli_query ( $link, $sql );
   echo '<form action = "" method = "post">';
   echo '<table border="1"><tr><td>Select</td><td>Player</td><td>Pts/Gm</td><td>School</td></tr>';
   while ( list ( $player_id,$school,$seed,$name,$ppg ) = mysqli_fetch_row ( $data ) )
   {
      echo '<tr><td><input type="radio" name="player_id" value='.$player_id.'></td><td>' . $name . '</td><td>' . $ppg . '</td><td>' . $school . '</td></tr>';
   }
   echo '<td align="center" colspan=4><input type="hidden" name="hash" id="hash" value="'.microtime().'" /><input type="submit" name="draft_player" value="Select"></td></tr>';
   echo '</table>';
}
function print_player_draftseed_form($sub,$link)
{
   $idx=substr($sub,1,1);
   $sql = "select p.player_id,school,seed,p.name,ppg from bracket b join team t on b.team_id=t.team_id join player p on p.team_id=b.team_id where round<=2 and seed between ".$idx++." and ".$idx." and p.player_id not in (select player_id from userPlayer) order by seed,t.team_id,ppg desc";
   $data = mysqli_query ( $link, $sql );
   echo '<form action = "" method = "post">';
   echo '<table border="1"><tr><td>Select</td><td>Player</td><td>Pts/Gm</td><td>School</td><td>Seed</td></tr>';
   while ( list ( $player_id,$school,$seed,$name,$ppg ) = mysqli_fetch_row ( $data ) )
   {
      echo '<tr><td><input type="radio" name="player_id" value='.$player_id.'></td><td>' . $name . '</td><td>' . $ppg . '</td><td>' . $school . '</td><td>' . $seed . '</td></tr>';
   }
   echo '<td align="center" colspan=5><input type="hidden" name="hash" id="hash" value="'.microtime().'" /><input type="submit" name="draft_player" value="Select"></td></tr>';
   echo '</table>';
}
function print_player_draftname_form($string,$link)
{
   $sql = "select p.player_id,school,seed,p.name,ppg from bracket b join team t on b.team_id=t.team_id join player p on p.team_id=b.team_id where round<=2 and p.name like '%".$string."%' and p.player_id not in (select player_id from userPlayer) order by seed,t.team_id,ppg desc";
   $data = mysqli_query ( $link, $sql );
   echo '<form action = "" method = "post">';
   echo '<table border="1"><tr><td>Select</td><td>Player</td><td>Pts/Gm</td><td>School</td><td>Seed</td></tr>';
   while ( list ( $player_id,$school,$seed,$name,$ppg ) = mysqli_fetch_row ( $data ) )
   {
      echo '<tr><td><input type="radio" name="player_id" value='.$player_id.'></td><td>' . $name . '</td><td>' . $ppg . '</td><td>' . $school . '</td><td>' . $seed . '</td></tr>';
   }
   echo '<td align="center" colspan=5><input type="hidden" name="hash" id="hash" value="'.microtime().'" /><input type="submit" name="draft_player" value="Select"></td></tr>';
   echo '</table>';
}
function get_next_player_draft($round,$link)
{
   $sql = "select team_name from draft d join user u on d.player_order=u.user_id where d.draft_pos=".$round;
   $data = mysqli_query ( $link, $sql );
   list ($team) = mysqli_fetch_row ( $data ) ;
   return $team;
}
function get_next_team_draft($round,$link)
{
   $sql = "select team_name from draft d join user u on d.team_order=u.user_id where d.draft_pos=".$round;
   $data = mysqli_query ( $link, $sql );
   list ($team) = mysqli_fetch_row ( $data );
   return $team;
}
?>