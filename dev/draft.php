<?php
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
print_r($draft);
//insert
for ($i=0;$i<64;$i+=16)
{
   for ($j=0;$j<8;$j++)
   {
      $drft[$i+$j][0]=$draft[$j];
      $drft[$i+$j][1]=$draft[7-$j];
   }
   for ($j=0;$j<8;$j++)
   {
      $drft[8+$i+$j][1]=$draft[$j];
      $drft[8+$i+$j][0]=$draft[7-$j];
   }
}
print_r($drft);
?>