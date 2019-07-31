<?php
function print_bracket($link)
{
    $sql = "select shortname,tY.seed,points from bracket b join team t on b.team_id=t.team_id left join (select tG.bracket_pos,points,tG.year_id from teamGame tG) as a on a.year_id=b.year_id and a.bracket_pos=b.bracket_pos left join teamstatsYear tY on tY.year_id=b.year_id and tY.team_id=b.team_id where b.year_id=2017 order by b.bracket_pos";
   //logger($link,$sql);
   $result = mysqli_query($link,$sql);
   $i=0;
   while (list($name,$s,$p)=mysqli_fetch_row($result))
   {
      $school[$i]=$name;
      if ($s=="")
      {
          $score[$i]=$p;
          $score[$i]="&nbsp;";
          $seed[$i++] = "";
      }
      else
      {
         $score[$i]=$p;
         $seed[$i++]='('.$s.')';
         //$seed[$i++] = "";
      }
   }
   $i=0;
   echo '<table class="bracket">';
   echo '<tr><td class="bracket_head" colspan="2">Round of 64</td><td class="bracket_head" colspan=2>Round of 32</td><td class="bracket_head"colspan="2">Sweet Sixteen</td><td class="bracket_head"colspan="2">Elite Eight</td><td class="bracket_head"colspan="2">Final Four</td><td class="bracket_head"colspan="2">Championship</td><td class="bracket_head"colspan="2">Final Four</td><td class="bracket_head"colspan="2">Elite Eight</td><td class="bracket_head"colspan="2">Sweet Sixteen</td><td class="bracket_head"colspan="2">Round of 32</td><td class="bracket_head"colspan="2">Round of 64</td></tr>';
   echo '<tr><td class="region" colspan="8">East</td><td colspan=6></td><td class="region"colspan="8">South</td></tr>';

   echo '<tr><td colspan=22></td></tr>';

   echo '<tr><td class="score">'.$score[$i].'</td><td class="team_left">'.$school[$i].$seed[$i].'</td>';
   $i++;
   echo '<td colspan=18></td>';
   echo '<td class="team_right">'.$school[$i].$seed[$i].'</td><td class="score">'.$score[$i].'</td></tr>';
   $i++;

   echo '<tr><td colspan=22></td></tr>';

   echo '<tr><td class="score">'.$score[$i].'</td><td class="team_left">'.$school[$i].$seed[$i].'</td>';
   $i++;
   echo '<td class="score">'.$score[$i].'</td><td class="team_left">'.$school[$i].$seed[$i].'</td>';
   $i++;
   echo '<td colspan=4></td><td colspan=6 rowspan=9></td><td colspan=4></td>';
   echo '<td class="team_right">'.$school[$i].$seed[$i].'</td><td class="score">'.$score[$i].'</td>';
   $i++;
   echo '<td class="team_right">'.$school[$i].$seed[$i].'</td><td class="score">'.$score[$i].'</td></tr>';
   $i++;

   echo '<tr><td colspan=8></td><td colspan=8></td></tr>';

   echo '<tr><td class="score">'.$score[$i].'</td><td class="team_left">'.$school[$i].$seed[$i].'</td>';
   $i++;
   echo '<td class="score">'.$score[$i].'</td><td class="team_left">'.$school[$i].$seed[$i].'</td>';
   $i++;
   echo '<td colspan=4></td><td colspan=4></td>';
   echo '<td class="team_right">'.$school[$i].$seed[$i].'</td><td class="score">'.$score[$i].'</td>';
   $i++;
   echo '<td class="team_right">'.$school[$i].$seed[$i].'</td><td class="score">'.$score[$i].'</td></tr>';
   $i++;
    
   echo '<tr><td colspan=8></td><td colspan=8></td></tr>';

   echo '<tr><td class="score">'.$score[$i].'</td><td class="team_left">'.$school[$i].$seed[$i].'</td>';
   $i++;
   echo '<td colspan=2></td><td class="score">'.$score[$i].'</td><td class="team_left">'.$school[$i].$seed[$i].'</td>';
   $i++;
   echo '<td colspan=2></td><td colspan=2></td>';
   echo '<td class="team_right">'.$school[$i].$seed[$i].'</td><td class="score">'.$score[$i].'</td>';
   $i++;
   echo '<td colspan=2></td><td class="team_right">'.$school[$i].$seed[$i].'</td><td class="score">'.$score[$i].'</td></tr>';
   $i++;

   echo '<tr><td colspan=8></td><td colspan=8></td></tr>';

   echo '<tr><td class="score">'.$score[$i].'</td><td class="team_left">'.$school[$i].$seed[$i].'</td>';
   $i++;
   echo '<td colspan=2></td><td class="score">'.$score[$i].'</td><td class="team_left">'.$school[$i].$seed[$i].'</td>';
   $i++;
   echo '<td colspan=2></td><td colspan=2></td>';
   echo '<td class="team_right">'.$school[$i].$seed[$i].'</td><td class="score">'.$score[$i].'</td><td colspan=2></td>';
   $i++;
   echo '<td class="team_right">'.$school[$i].$seed[$i].'</td><td class="score">'.$score[$i].'</td></tr>';
   $i++;
    
   echo '<tr><td colspan=2></td><td colspan=2></td></tr>';

   echo '<tr><td class="score">'.$score[$i].'</td><td class="team_left">'.$school[$i].$seed[$i].'</td>';
   $i++;
   echo '<td class="score">'.$score[$i].'</td><td class="team_left">'.$school[$i].$seed[$i].'</td>';
   $i++;
   echo '<td colspan=4></td><td colspan=4></td>';
   echo '<td class="team_right">'.$school[$i].$seed[$i].'</td><td class="score">'.$score[$i].'</td>';
   $i++;
   echo '<td class="team_right">'.$school[$i].$seed[$i].'</td><td class="score">'.$score[$i].'</td></tr>';
   $i++;
    
   echo '<tr><td colspan=22></td></tr>';

   echo '<tr><td class="score">'.$score[$i].'</td><td class="team_left">'.$school[$i].$seed[$i].'</td>';
   $i++;
   echo '<td class="score">'.$score[$i].'</td><td class="team_left">'.$school[$i].$seed[$i].'</td>';
   $i++;
   echo '<td colspan=14></td>';
   echo '<td class="team_right">'.$school[$i].$seed[$i].'</td><td class="score">'.$score[$i].'</td>';
   $i++;
   echo '<td class="team_right">'.$school[$i].$seed[$i].'</td><td class="score">'.$score[$i].'</td></tr>';
   $i++;
    
   echo '<tr><td colspan=22></td></tr>';

   echo '<tr><td class="score">'.$score[$i].'</td><td class="team_left">'.$school[$i].$seed[$i].'</td>';
   $i++;
   echo '<td colspan=4></td>';
   echo '<td class="score">'.$score[$i].'</td><td class="team_left">'.$school[$i].$seed[$i].'</td>';
   $i++;
   echo '<td colspan=6></td>';
   echo '<td class="team_right">'.$school[$i].$seed[$i].'</td><td class="score">'.$score[$i].'</td>';
   $i++;
   echo '<td colspan=4></td>';
   echo '<td class="team_right">'.$school[$i].$seed[$i].'</td><td class="score">'.$score[$i].'</td></tr>';
   $i++;
    
   echo '<tr><td colspan=22></td></tr>';

   echo '<tr><td class="score">'.$score[$i].'</td><td class="team_left">'.$school[$i].$seed[$i].'</td>';
   $i++;
   echo '<td colspan=4></td>';
   echo '<td class="score">'.$score[$i].'</td><td class="team_left">'.$school[$i].$seed[$i].'</td>';
   $i++;
   echo '<td colspan=6></td>';
   echo '<td class="team_right">'.$school[$i].$seed[$i].'</td><td class="score">'.$score[$i].'</td>';
   $i++;
   echo '<td colspan=4></td>';
   echo '<td class="team_right">'.$school[$i].$seed[$i].'</td><td class="score">'.$score[$i].'</td></tr>';
   $i++;
    
   echo '<tr><td colspan=22></td></tr>';

   echo '<tr><td class="score">'.$score[$i].'</td><td class="team_left">'.$school[$i].$seed[$i].'</td>';
   $i++;
   echo '<td class="score">'.$score[$i].'</td><td class="team_left">'.$school[$i].$seed[$i].'</td>';
   $i++;
   echo '<td colspan=14></td>';
   echo '<td class="team_right">'.$school[$i].$seed[$i].'</td><td class="score">'.$score[$i].'</td>';
   $i++;
   echo '<td class="team_right">'.$school[$i].$seed[$i].'</td><td class="score">'.$score[$i].'</td></tr>';
   $i++;
    
   echo '<tr><td colspan=22></td></tr>';

   echo '<tr><td class="score">'.$score[$i].'</td><td class="team_left">'.$school[$i].$seed[$i].'</td>';
   $i++;
   echo '<td class="score">'.$score[$i].'</td><td class="team_left">'.$school[$i].$seed[$i].'</td>';
   $i++;
   echo '<td colspan=14></td>';
   echo '<td class="team_right">'.$school[$i].$seed[$i].'</td><td class="score">'.$score[$i].'</td>';
   $i++;
   echo '<td class="team_right">'.$school[$i].$seed[$i].'</td><td class="score">'.$score[$i].'</td></tr>';
   $i++;
    
   echo '<tr><td colspan=22></td></tr>';

   echo '<tr><td class="score">'.$score[$i].'</td><td class="team_left">'.$school[$i].$seed[$i].'</td>';
   $i++;
   echo '<td colspan=2></td>';
   echo '<td class="score">'.$score[$i].'</td><td class="team_left">'.$school[$i].$seed[$i].'</td>';
   $i++;
   echo '<td colspan=10></td>';
   echo '<td class="team_right">'.$school[$i].$seed[$i].'</td><td class="score">'.$score[$i].'</td>';
   $i++;
   echo '<td colspan=2></td>';
   echo '<td class="team_right">'.$school[$i].$seed[$i].'</td><td class="score">'.$score[$i].'</td></tr>';
   $i++;
    
   echo '<tr><td colspan=22></td></tr>';

   echo '<tr><td class="score">'.$score[$i].'</td><td class="team_left">'.$school[$i].$seed[$i].'</td>';
   $i++;
   echo '<td colspan=2></td>';
   echo '<td class="score">'.$score[$i].'</td><td class="team_left">'.$school[$i].$seed[$i].'</td>';
   $i++;
   echo '<td colspan=10></td>';
   echo '<td class="team_right">'.$school[$i].$seed[$i].'</td><td class="score">'.$score[$i].'</td>';
   $i++;
   echo '<td colspan=2></td>';
   echo '<td class="team_right">'.$school[$i].$seed[$i].'</td><td class="score">'.$score[$i].'</td></tr>';
   $i++;
    
   echo '<tr><td colspan=22></td></tr>';

   echo '<tr><td class="score">'.$score[$i].'</td><td class="team_left">'.$school[$i].$seed[$i].'</td>';
   $i++;
   echo '<td class="score">'.$score[$i].'</td><td class="team_left">'.$school[$i].$seed[$i].'</td>';
   $i++;
   echo '<td colspan=14></td>';
   echo '<td class="team_right">'.$school[$i].$seed[$i].'</td><td class="score">'.$score[$i].'</td>';
   $i++;
   echo '<td class="team_right">'.$school[$i].$seed[$i].'</td><td class="score">'.$score[$i].'</td></tr>';
   $i++;
    
   echo '<tr><td colspan=22></td></tr>';

   echo '<tr><td class="score">'.$score[$i].'</td><td class="team_left">'.$school[$i].$seed[$i].'</td>';
   $i++;
   echo '<td class="score">'.$score[$i].'</td><td class="team_left">'.$school[$i].$seed[$i].'</td>';
   $i++;
   echo '<td colspan=14></td>';
   echo '<td class="team_right">'.$school[$i].$seed[$i].'</td><td class="score">'.$score[$i].'</td>';
   $i++;
   echo '<td class="team_right">'.$school[$i].$seed[$i].'</td><td class="score">'.$score[$i].'</td></tr>';
   $i++;
    
   echo '<tr><td colspan=22></td></tr>';

   echo '<tr><td class="score">'.$score[$i].'</td><td class="team_left">'.$school[$i].$seed[$i].'</td>';
   $i++;
   echo '<td colspan=6></td>';
   echo '<td class="score">'.$score[$i].'</td><td class="team_left">'.$school[$i].$seed[$i].'</td>';
   $i++;
   echo '<td colspan=2></td>';
   echo '<td class="team_right">'.$school[$i].$seed[$i].'</td><td class="score">'.$score[$i].'</td>';
   $i++;
   echo '<td colspan=6></td>';
   echo '<td class="team_right">'.$school[$i].$seed[$i].'</td><td class="score">'.$score[$i].'</td></tr>';
   $i++;
    
   echo '<tr><td colspan=22></td></tr>';

   echo '<tr><td class="score">'.$score[$i].'</td><td class="team_left">'.$school[$i].$seed[$i].'</td>';
   $i++;
   echo '<td colspan=6></td>';
   echo '<td class="score">'.$score[$i].'</td><td class="team_left">'.$school[$i].$seed[$i].'</td>';
   $i++;
   echo '<td colspan=2></td>';
   echo '<td class="team_right">'.$school[$i].$seed[$i].'</td><td class="score">'.$score[$i].'</td>';
   $i++;
   echo '<td colspan=6></td>';
   echo '<td class="team_right">'.$school[$i].$seed[$i].'</td><td class="score">'.$score[$i].'</td></tr>';
   $i++;
    
   echo '<tr><td colspan=22></td></tr>';

   echo '<tr><td class="score">'.$score[$i].'</td><td class="team_left">'.$school[$i].$seed[$i].'</td>';
   $i++;
   echo '<td class="score">'.$score[$i].'</td><td class="team_left">'.$school[$i].$seed[$i].'</td>';
   $i++;
   echo '<td colspan=14></td>';
   echo '<td class="team_right">'.$school[$i].$seed[$i].'</td><td class="score">'.$score[$i].'</td>';
   $i++;
   echo '<td class="team_right">'.$school[$i].$seed[$i].'</td><td class="score">'.$score[$i].'</td></tr>';
   $i++;
    
   echo '<tr><td colspan=22></td></tr>';

   echo '<tr><td class="score">'.$score[$i].'</td><td class="team_left">'.$school[$i].$seed[$i].'</td>';
   $i++;
   echo '<td class="score">'.$score[$i].'</td><td class="team_left">'.$school[$i].$seed[$i].'</td>';
   $i++;
   echo '<td colspan=14></td>';
   echo '<td class="team_right">'.$school[$i].$seed[$i].'</td><td class="score">'.$score[$i].'</td>';
   $i++;
   echo '<td class="team_right">'.$school[$i].$seed[$i].'</td><td class="score">'.$score[$i].'</td></tr>';
   $i++;
    
   echo '<tr><td colspan=22></td></tr>';

   echo '<tr><td class="score">'.$score[$i].'</td><td class="team_left">'.$school[$i].$seed[$i].'</td>';
   $i++;
   echo '<td colspan=2></td>';
   echo '<td class="score">'.$score[$i].'</td><td class="team_left">'.$school[$i].$seed[$i].'</td>';
   $i++;
   echo '<td colspan=4></td>';
   echo '<td class="score">'.$score[$i].'</td><td class="team_left">'.$school[$i].$seed[$i].'</td>';
   $i++;
   echo '<td colspan=4></td>';
   echo '<td class="team_right">'.$school[$i].$seed[$i].'</td><td class="score">'.$score[$i].'</td>';
   $i++;
   echo '<td colspan=2></td>';
   echo '<td class="team_right">'.$school[$i].$seed[$i].'</td><td class="score">'.$score[$i].'</td></tr>';
   $i++;
    
   echo '<tr><td colspan=22></td></tr>';

   echo '<tr><td class="score">'.$score[$i].'</td><td class="team_left">'.$school[$i].$seed[$i].'</td>';
   $i++;
   echo '<td colspan=2></td>';
   echo '<td class="score">'.$score[$i].'</td><td class="team_left">'.$school[$i].$seed[$i].'</td>';
   $i++;
   echo '<td colspan=4></td>';
   echo '<td class="score">'.$score[$i].'</td><td class="team_left">'.$school[$i].$seed[$i].'</td>';
   $i++;
   echo '<td colspan=4></td>';
   echo '<td class="team_right">'.$school[$i].$seed[$i].'</td><td class="score">'.$score[$i].'</td>';
   $i++;
   echo '<td colspan=2></td>';
   echo '<td class="team_right">'.$school[$i].$seed[$i].'</td><td class="score">'.$score[$i].'</td></tr>';
   $i++;
    
   echo '<tr><td colspan=22></td></tr>';

   echo '<tr><td class="score">'.$score[$i].'</td><td class="team_left">'.$school[$i].$seed[$i].'</td>';
   $i++;
   echo '<td class="score">'.$score[$i].'</td><td class="team_left">'.$school[$i].$seed[$i].'</td>';
   $i++;
   echo '<td colspan=14></td>';
   echo '<td class="team_right">'.$school[$i].$seed[$i].'</td><td class="score">'.$score[$i].'</td>';
   $i++;
   echo '<td class="team_right">'.$school[$i].$seed[$i].'</td><td class="score">'.$score[$i].'</td></tr>';
   $i++;
    
   echo '<tr><td colspan=22></td></tr>';

   echo '<tr><td class="score">'.$score[$i].'</td><td class="team_left">'.$school[$i].$seed[$i].'</td>';
   $i++;
   echo '<td class="score">'.$score[$i].'</td><td class="team_left">'.$school[$i].$seed[$i].'</td>';
   $i++;
   echo '<td colspan=14></td>';
   echo '<td class="team_right">'.$school[$i].$seed[$i].'</td><td class="score">'.$score[$i].'</td>';
   $i++;
   echo '<td class="team_right">'.$school[$i].$seed[$i].'</td><td class="score">'.$score[$i].'</td></tr>';
   $i++;
    
   echo '<tr><td colspan=22></td></tr>';

   echo '<tr><td class="score">'.$score[$i].'</td><td class="team_left">'.$school[$i].$seed[$i].'</td>';
   $i++;
   echo '<td colspan=4></td>';
   echo '<td class="score">'.$score[$i].'</td><td class="team_left">'.$school[$i].$seed[$i].'</td>';
   $i++;
   echo '<td colspan=6></td>';
   echo '<td class="team_right">'.$school[$i].$seed[$i].'</td><td class="score">'.$score[$i].'</td>';
   $i++;
   echo '<td colspan=4></td>';
   echo '<td class="team_right">'.$school[$i].$seed[$i].'</td><td class="score">'.$score[$i].'</td></tr>';
   $i++;
    
   echo '<tr><td colspan=22></td></tr>';

   echo '<tr><td class="score">'.$score[$i].'</td><td class="team_left">'.$school[$i].$seed[$i].'</td>';
   $i++;
   echo '<td colspan=4></td>';
   echo '<td class="score">'.$score[$i].'</td><td class="team_left">'.$school[$i].$seed[$i].'</td>';
   $i++;
   echo '<td colspan=2></td>';
   echo '<td colspan=2 class="team_left">'.$school[$i].$seed[$i].'</td><td colspan=2></td>';
   $i++;
   echo '<td class="team_right">'.$school[$i].$seed[$i].'</td><td class="score">'.$score[$i].'</td>';
   echo '<td colspan=4></td>';
   $i++;
   echo '<td class="team_right">'.$school[$i].$seed[$i].'</td><td class="score">'.$score[$i].'</td></tr>';
   $i++;
    
   echo '<tr><td colspan=22></td></tr>';

   echo '<tr><td class="score">'.$score[$i].'</td><td class="team_left">'.$school[$i].$seed[$i].'</td>';
   $i++;
   echo '<td class="score">'.$score[$i].'</td><td class="team_left">'.$school[$i].$seed[$i].'</td>';
   $i++;
   echo '<td colspan=14></td>';
   echo '<td class="team_right">'.$school[$i].$seed[$i].'</td><td class="score">'.$score[$i].'</td>';
   $i++;
   echo '<td class="team_right">'.$school[$i].$seed[$i].'</td><td class="score">'.$score[$i].'</td></tr>';
   $i++;
    
   echo '<tr><td colspan=22></td></tr>';

   echo '<tr><td class="score">'.$score[$i].'</td><td class="team_left">'.$school[$i].$seed[$i].'</td>';
   $i++;
   echo '<td class="score">'.$score[$i].'</td><td class="team_left">'.$school[$i].$seed[$i].'</td>';
   $i++;
   echo '<td colspan=5></td>';
   echo '<td colspan=4 rowspan=12></td>';
   echo '<td colspan=5></td>';
   echo '<td class="team_right">'.$school[$i].$seed[$i].'</td><td class="score">'.$score[$i].'</td>';
   $i++;
   echo '<td class="team_right">'.$school[$i].$seed[$i].'</td><td class="score">'.$score[$i].'</td></tr>';
   $i++;
    
   echo '<tr><td colspan=9></td><td colspan=9></td></tr>';

   echo '<tr><td class="score">'.$score[$i].'</td><td class="team_left">'.$school[$i].$seed[$i].'</td>';
   $i++;
   echo '<td colspan=2></td>';
   echo '<td class="score">'.$score[$i].'</td><td class="team_left">'.$school[$i].$seed[$i].'</td>';
   $i++;
   echo '<td colspan=10></td>';
   echo '<td class="team_right">'.$school[$i].$seed[$i].'</td><td class="score">'.$score[$i].'</td>';
   $i++;
   echo '<td colspan=2></td>';
   echo '<td class="team_right">'.$school[$i].$seed[$i].'</td><td class="score">'.$score[$i].'</td></tr>';
   $i++;
    
   echo '<tr><td colspan=9></td><td colspan=9></td></tr>';

   echo '<tr><td class="score">'.$score[$i].'</td><td class="team_left">'.$school[$i].$seed[$i].'</td>';
   $i++;
   echo '<td colspan=2></td>';
   echo '<td class="score">'.$score[$i].'</td><td class="team_left">'.$school[$i].$seed[$i].'</td>';
   $i++;
   echo '<td colspan=10></td>';
   echo '<td class="team_right">'.$school[$i].$seed[$i].'</td><td class="score">'.$score[$i].'</td>';
   $i++;
   echo '<td colspan=2></td>';
   echo '<td class="team_right">'.$school[$i].$seed[$i].'</td><td class="score">'.$score[$i].'</td></tr>';
   $i++;
    
   echo '<tr><td colspan=9></td><td colspan=9></td></tr>';

   echo '<tr><td class="score">'.$score[$i].'</td><td class="team_left">'.$school[$i].$seed[$i].'</td>';
   $i++;
   echo '<td class="score">'.$score[$i].'</td><td class="team_left">'.$school[$i].$seed[$i].'</td>';
   $i++;
   echo '<td colspan=14></td>';
   echo '<td class="team_right">'.$school[$i].$seed[$i].'</td><td class="score">'.$score[$i].'</td>';
   $i++;
   echo '<td class="team_right">'.$school[$i].$seed[$i].'</td><td class="score">'.$score[$i].'</td></tr>';
   $i++;
    
   echo '<tr><td colspan=9></td><td colspan=9></td></tr>';

   echo '<tr><td class="score">'.$score[$i].'</td><td class="team_left">'.$school[$i].$seed[$i].'</td>';
   $i++;
   echo '<td class="score">'.$score[$i].'</td><td class="team_left">'.$school[$i].$seed[$i].'</td>';
   $i++;
   echo '<td colspan=14></td>';
   echo '<td class="team_right">'.$school[$i].$seed[$i].'</td><td class="score">'.$score[$i].'</td>';
   $i++;
   echo '<td class="team_right">'.$school[$i].$seed[$i].'</td><td class="score">'.$score[$i].'</td></tr>';
   $i++;
    
   echo '<tr><td colspan=9></td><td colspan=9></td></tr>';

   echo '<tr><td class="score">'.$score[$i].'</td><td class="team_left">'.$school[$i].$seed[$i].'</td>';
   $i++;
   echo '<td colspan=18></td>';
   echo '<td class="team_right">'.$school[$i].$seed[$i].'</td><td class="score">'.$score[$i].'</td></tr>';
   $i++;
    
   echo '<tr><td colspan=22></td></tr>

<tr><td class="region" colspan="8">West</td><td colspan=6></td><td class="region"colspan="8">Midwest</td></tr>
<tr><td colspan=22></td></tr>
<tr><td colspan=22 class="bracket_head">First Four</td></tr>
<tr><td colspan=22></td></tr>
<tr>
<td colspan=2></td>
<td class="score">'.$score[$i].'</td>
<td class="team_left">'.$school[$i].$seed[$i++].'</td>
<td colspan=2></td>
<td class="score">'.$score[$i].'</td>
<td class="team_left">'.$school[$i].$seed[$i++].'</td>
<td colspan=6></td>
<td class="team_right">'.$school[$i].$seed[$i].'</td>
<td class="score">'.$score[$i++].'</td>
<td colspan=2></td>
<td class="team_right">'.$school[$i].$seed[$i].'</td>
<td class="score">'.$score[$i++].'</td>
<td colspan=2></td>
</tr>
<tr>
<td colspan=2></td>
<td class="score">'.$score[$i].'</td>
<td class="team_left">'.$school[$i].$seed[$i++].'</td>
<td colspan=2></td>
<td class="score">'.$score[$i].'</td>
<td class="team_left">'.$school[$i].$seed[$i++].'</td>
<td colspan=6></td>
<td class="team_right">'.$school[$i].$seed[$i].'</td>
<td class="score">'.$score[$i++].'</td>
<td colspan=2></td>
<td class="team_right">'.$school[$i].$seed[$i].'</td>
<td class="score">'.$score[$i++].'</td>
<td colspan=2></td>
</tr>

</table>';
}
?>