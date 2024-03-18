<?php
function print_roster1($link)
{
   $sql = "select team_name,ceil((t.draft+1)/8) as round,school,seed from user u left join userTeam t on u.user_id=t.user_id left join team m on t.team_id=m.team_id where u.user_id<=8 order by u.user_id,t.draft";
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
   $sql = "select login_id,name from entry where tourney_id=".$_SESSION['activepool']." order by name";
   $data = mysqli_query ( $link, $sql );
   $odd=0;
   while (list($user_id,$teamname)=mysqli_fetch_row ( $data ))
   {
      if ($odd==0)
      {
         echo '<tr><td valign="top"><table width="100%" border="1">';
      }
      else
      {
         echo '<td valign="top"><table width="100%" border="1">';
      }
      echo '<tr><td class="roster" colspan="3">'.$teamname.'</td></tr>';
      echo '<tr><td class="rosterhd">Round</td><td class="rosterhd">School</td><td class="rosterhd">Player</td></tr>';
      for ($a=0;$a<8;$a++)
      {
         $i=8*$a;
         $j=$a*8+7;
         $sql1 = "select a.round,b.school,b.seed from (select player_id as round from player where player_id<9) as a left join (select school,tY.seed,o.draft from entry e join ownerTeam o on e.entry_id=o.owner_id join team m on o.team_id=m.team_id join teamstatsYear tY on m.team_id=tY.team_id where e.login_id=".$_SESSION['user'].") as b on a.round=b.draft+1";
         print($sql1);
         $data1 = mysqli_query ( $link, $sql1 );
         if (!(list($rnd,$school,$seed)=mysqli_fetch_row($data1)))
         {
            $rnd='';
            $school='';
            $seed='';
         }
         if ($seed!='')
         {
            $seed='('.$seed.')';
         }
         $sql2 = "select a.round,b.name,b.player_id from (select player_id as round from player where player_id<9) as a left join (select p.name,p.player_id,o.draft from entry e join ownerPlayer o on e.entry_id=o.owner_id join player p on p.player_id=o.player_id where e.login_id=".$_SESSION['user'].") as b on a.round=b.draft+1";
         //         'select p.name,p.player_id from user u join userPlayer t on u.user_id=t.user_id join player p on p.player_id=t.player_id  where u.user_id='.$user_ and t.draft between '.$i.' and '.$j;
         print($sql2);
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