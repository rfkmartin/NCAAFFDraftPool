<?php
require_once ("login.php");
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
print_r($drft);
?>