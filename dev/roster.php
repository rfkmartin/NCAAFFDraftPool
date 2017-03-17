<?php
function print_roster1($link)
{
   $sql = "select team_name,ceil((t.draft+1)/8) as round,school,seed from user u left join userTeam t on u.user_id=t.user_id left join team m on t.team_id=m.team_id where u.user_id<8 order by u.user_id,t.draft";
   $data = mysqli_query ( $link, $sql );
   echo '<table border="1"><tr><td>Name</td><td>Round</td><td>School</td></tr>';
   while ( list ( $name,$round,$school,$seed) = mysqli_fetch_row ( $data ) )
   {
      if ($seed!='')
      {
         $seed='('.$seed.')';
      }
      echo '<tr><td>' . $name . '</td><td>' . $round . '</td><td>' . $school . $seed.'</td></tr>';
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
function print_roster($link)
{
   echo '<table border="0"><tr><td></td><td></td></tr>';
   $sql = "select user_id,team_name from user where user_id<8";
   $data = mysqli_query ( $link, $sql );
   $odd=0;
   while (list($user_id,$teamname)=mysqli_fetch_row ( $data ))
   {
      if ($odd==0)
      {
         echo '<tr><td><table width="100%" border="1">';
      }
      else
      {
         echo '<td><table width="100%" border="1">';
      }
      echo '<tr><td class="roster" colspan="3">'.$teamname.'</td></tr>';
      echo '<tr><td class="rosterhd">Round</td><td class="rosterhd">School</td><td class="rosterhd">Player</td></tr>';
      for ($a=0;$a<8;$a++)
      {
         $i=8*$a;
         $j=$a*8+7;
         $sql1 = 'select team_name,school,seed from user u join userTeam t on u.user_id=t.user_id join team m on t.team_id=m.team_id where u.user_id='.$user_id.' and t.draft between '.$i.' and '.$j;
         $data1 = mysqli_query ( $link, $sql1 );
         if (!(list($team_name,$school,$seed)=mysqli_fetch_row($data1)))
         {
            $team_name='';
            $school='';
            $seed='';
         }
         if ($seed!='')
         {
            $seed='('.$seed.')';
         }
         $sql2 = 'select p.name,p.player_id from user u join userPlayer t on u.user_id=t.user_id join player p on p.player_id=t.player_id  where u.user_id='.$user_id.' and t.draft between '.$i.' and '.$j;
         $data2 = mysqli_query ( $link, $sql2 );
         if (!(list($player_name,$player_id)=mysqli_fetch_row($data2)))
         {
            $player_name='';
            $player_id='';
         }
         if ($player_id!='')
         {
            $player_id='('.get_player_school($player_id, $link).')';
         }
         echo '<tr><td>'.($a+1).'</td><td>' . $school .$seed.'</td><td>' . $player_name . $player_id.'</td></tr>';
      }
      if ($odd==0)
      {
         echo '</table></td>';
         $odd=1-$odd;
      }
      else
      {
         echo '</table></td></tr>';
         $odd=1-$odd;
      }
   }
//    $sql = "select team_name,ceil((t.draft+1)/8) as round,school,seed from user u left join userTeam t on u.user_id=t.user_id left join team m on t.team_id=m.team_id where u.user_id<8 order by u.user_id,t.draft";
//    $data = mysqli_query ( $link, $sql );
//    echo '<table border="1"><tr><td>Name</td><td>Round</td><td>School</td></tr>';
//    while ( list ( $name,$round,$school,$seed) = mysqli_fetch_row ( $data ) )
//    {
//       echo '<tr><td>' . $name . '</td><td>' . $round . '</td><td>' . $school . '('.$seed.')</td></tr>';
//    }
//    echo '</table><br><br>';
//    $sql = "select u.team_name,ceil((t.draft+1)/8) as round,p.name,p.player_id from user u left join userPlayer t on u.user_id=t.user_id left join player p on p.player_id=t.player_id  where u.user_id<8 order by u.user_id,t.draft";
//    $data = mysqli_query ( $link, $sql );
//    echo '<table border="1"><tr><td>Name</td><td>Round</td><td>Player</td></tr>';
//    while ( list ( $name,$round,$player,$player_id) = mysqli_fetch_row ( $data ) )
//    {
//       echo '<tr><td>' . $name . '</td><td>' . $round . '</td><td>' . $player . '('.get_player_school($player_id, $link).')</td></tr>';
//    }
   echo '</table>';    
}
?>