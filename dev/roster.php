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
   echo '<table border="1"><tr><td></td><td></td></tr>';
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
      $sql1 = "select a.round,b.school,b.seed from (select player_id as round from player where player_id<9) as a left join (select school,tY.seed,ceil((1+o.draft)/8) as draft from entry e join ownerTeam o on e.entry_id=o.owner_id join team m on o.team_id=m.team_id join teamstatsYear tY on m.team_id=tY.team_id where e.login_id=".$user_id." and e.tourney_id=".$_SESSION['activepool'].") as b on a.round=b.draft";
      $data1 = mysqli_query ( $link, $sql1 );
      $count=0;
      while (list($round,$school,$seed)=mysqli_fetch_row($data1))
      {
         $rnd[$count]=$round;
         $schl[$count]='';
         $sd[$count]='';
         if ($seed!='')
         {
            $sd[$count]='('.$seed.')';
            $schl[$count]=$school;
         }
         $count=$count+1;
       }
       $sql2 = "select a.round,b.name,b.player_id from (select player_id as round from player where player_id<9) as a left join (select p.name,p.player_id,ceil((1+o.draft)/8) as draft from entry e join ownerPlayer o on e.entry_id=o.owner_id join player p on p.player_id=o.player_id where e.login_id=".$user_id." and e.tourney_id=".$_SESSION['activepool'].") as b on a.round=b.draft";
    //         'select p.name,p.player_id from user u join userPlayer t on u.user_id=t.user_id join player p on p.player_id=t.player_id  where u.user_id='.$user_ and t.draft between '.$i.' and '.$j;
        $data2 = mysqli_query ( $link, $sql2 );
        $count=0;
       while (list($round,$player_name,$player_id)=mysqli_fetch_row($data2))
       {
            $plyr_name[$count]='';
            $plyr_id[$count]='';
            if ($player_id!='')
            {
                $plyr_id[$count]="(".get_player_school($player_id, $link).")";
                $plyr_name[$count]=$player_name;
            }
            $count=$count+1;
       }
       for ($i=0;$i<8;$i++)
       {
        print("<tr><td>".$rnd[$i]."</td><td>" . $schl[$i] .$sd[$i]."</td><td>" . $plyr_name[$i] . $plyr_id[$i]."</td></tr>");
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