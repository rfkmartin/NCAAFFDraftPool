<?php
function print_bracket($link)
{
   $sql = "select shortname,seed from bracket b left join team t on t.team_id=b.team_id order by bracket_pos";
   //logger($link,$sql);
   $result = mysqli_query($link,$sql);
   $i=0;
   while (list($name,$s)=mysqli_fetch_row($result))
   {
      $school[$i]=$name;
      if ($s=="")
      {
         $seed[$i++] = "";
      }
      else
      {
         $seed[$i++]='('.$s.')';
      }
   }
   $i=0;
   echo '<table class="bracket">';
   echo '<tr><td class="bracket_head" colspan="2">Round of 64</td><td class="bracket_head" colspan=2>Round of 32</td><td class="bracket_head"colspan="2">Sweet Sixteen</td><td class="bracket_head"colspan="2">Elite Eight</td><td class="bracket_head"colspan="2">Final Four</td><td class="bracket_head"colspan="2">Championship</td><td class="bracket_head"colspan="2">Final Four</td><td class="bracket_head"colspan="2">Elite Eight</td><td class="bracket_head"colspan="2">Sweet Sixteen</td><td class="bracket_head"colspan="2">Round of 32</td><td class="bracket_head"colspan="2">Round of 64</td></tr>
   <tr><td class="region" colspan="8">South</td><td colspan=6></td><td class="region"colspan="8">East</td></tr>
         
<tr><td colspan=22></td></tr>

<tr>
<td class="score">69</td>
<td class="team_left">'.$school[$i].$seed[$i++].'</td>
<td colspan=18></td>
<td class="team_right">'.$school[$i].$seed[$i++].'</td>
<td class="score">95</td>
</tr>

<tr><td colspan=22></td></tr>

<tr valign=center>
<td class="score">35</td>
<td class="team_left">'.$school[$i].$seed[$i++].'</td>
<td class="score">81</td>
<td class="team_left">'.$school[$i].$seed[$i++].'</td>
<td colspan=4></td>
<td colspan=6 rowspan=9></td>
<td colspan=4></td>
<td class="team_right">'.$school[$i].$seed[$i++].'</td>
<td class="score">94</td>
<td class="team_right">'.$school[$i].$seed[$i++].'</td>
<td class="score">52</td>
</tr>

<tr><td colspan=8></td><td colspan=8></td></tr>

<tr>
<td class="score">70</td>
<td class="team_left">'.$school[$i].$seed[$i++].'</td>
<td class="score">65</td>
<td class="team_left">'.$school[$i].$seed[$i++].'</td>
<td colspan=4></td>
<td colspan=4></td>
<td class="team_right">'.$school[$i].$seed[$i++].'</td>
<td class="score">81</td>
<td class="team_right">'.$school[$i].$seed[$i++].'</td>
<td class="score">68</td>
</tr>

<tr><td colspan=8></td><td colspan=8></td></tr>

<tr>
<td class="score">82</td>
<td class="team_left">'.$school[$i].$seed[$i++].'</td>
<td colspan=2></td>
<td class="score">77</td>
<td class="team_left">'.$school[$i].$seed[$i++].'</td>
<td colspan=2></td>
<td colspan=2></td>
<td class="team_right">'.$school[$i].$seed[$i++].'</td>
<td class="score">76</td>
<td colspan=2></td>
<td class="team_right">'.$school[$i].$seed[$i++].'</td>
<td class="score">70</td>
</tr>

<tr><td colspan=8></td><td colspan=8></td></tr>

<tr>
<td class="score">85</td>
<td class="team_left">'.$school[$i].$seed[$i++].'</td>
<td colspan=2></td>
<td class="score">62</td>
<td class="team_left">'.$school[$i].$seed[$i++].'</td>
<td colspan=2></td>
<td colspan=2></td>
<td class="team_right">'.$school[$i].$seed[$i++].'</td>
<td class="score">63</td>
<td colspan=2></td>
<td class="team_right">'.$school[$i].$seed[$i++].'</td>
<td class="score">68</td>
</tr>

<tr><td colspan=2></td><td colspan=2></td></tr>

<tr>
<td class="score">86</td>
<td class="team_left">'.$school[$i].$seed[$i++].'</td>
<td class="score">85</td>
<td class="team_left">'.$school[$i].$seed[$i++].'</td>
<td colspan=4></td>
<td colspan=4></td>
<td class="team_right">'.$school[$i].$seed[$i++].'</td>
<td class="score">50</td>
<td class="team_right">'.$school[$i].$seed[$i++].'</td>
<td class="score">77</td>
</tr>

<tr><td colspan=22></td></tr>

<tr>
<td class="score">68</td>
<td class="team_left">'.$school[$i].$seed[$i++].'</td>
<td class="score">68</td>
<td class="team_left">'.$school[$i].$seed[$i++].'</td>
<td colspan=14></td>
<td class="team_right">'.$school[$i].$seed[$i++].'</td>
<td class="score">75</td>
<td class="team_right">'.$school[$i].$seed[$i++].'</td>
<td class="score">61</td>
</tr>

<tr><td colspan=22></td></tr>

<tr>
<td class="score">70</td>
<td class="team_left">'.$school[$i].$seed[$i++].'</td>
<td colspan=4></td>
<td class="score">69</td>
<td class="team_left">'.$school[$i].$seed[$i++].'</td>
<td colspan=6></td>
<td class="team_right">'.$school[$i].$seed[$i++].'</td>
<td class="score">79</td>
<td colspan=4></td>
<td class="team_right">'.$school[$i].$seed[$i++].'</td>
<td class="score">48</td>
</tr>

<tr><td colspan=22></td></tr>

<tr>
<td class="score">65</td>
<td class="team_left">'.$school[$i].$seed[$i++].'</td>
<td colspan=4></td>
<td class="score">62</td>
<td class="team_left">'.$school[$i].$seed[$i++].'</td>
<td colspan=6></td>
<td class="team_right">'.$school[$i].$seed[$i++].'</td>
<td class="score">69</td>
<td colspan=4></td>
<td class="team_right">'.$school[$i].$seed[$i++].'</td>
<td class="score">69</td>
</tr>

<tr><td colspan=22></td></tr>

<tr>
<td class="score">79</td>
<td class="team_left">'.$school[$i].$seed[$i++].'</td>
<td class="score">75</td>
<td class="team_left">'.$school[$i].$seed[$i++].'</td>
<td colspan=14></td>
<td class="team_right">'.$school[$i].$seed[$i++].'</td>
<td class="score">74</td>
<td class="team_right">'.$school[$i].$seed[$i++].'</td>
<td class="score">54</td>
</tr>

<tr><td colspan=22></td></tr>

<tr>
<td class="score">69</td>
<td class="team_left">'.$school[$i].$seed[$i++].'</td>
<td class="score">54</td>
<td class="team_left">'.$school[$i].$seed[$i++].'</td>
<td colspan=14></td>
<td class="team_right">'.$school[$i].$seed[$i++].'</td>
<td class="score">71</td>
<td class="team_right">'.$school[$i].$seed[$i++].'</td>
<td class="score">68</td>
</tr>

<tr><td colspan=22></td></tr>

<tr>
<td class="score">56</td>
<td class="team_left">'.$school[$i].$seed[$i++].'</td>
<td colspan=2></td>
<td class="score">84</td>
<td class="team_left">'.$school[$i].$seed[$i++].'</td>
<td colspan=10></td>
<td class="team_right">'.$school[$i].$seed[$i++].'</td>
<td class="score">80</td>
<td colspan=2></td>
<td class="team_right">'.$school[$i].$seed[$i++].'</td>
<td class="score">65</td>
</tr>

<tr><td colspan=22></td></tr>

<tr>
<td class="score">69</td>
<td class="team_left">'.$school[$i].$seed[$i++].'</td>
<td colspan=2></td>
<td class="score">72</td>
<td class="team_left">'.$school[$i].$seed[$i++].'</td>
<td colspan=10></td>
<td class="team_right">'.$school[$i].$seed[$i++].'</td>
<td class="score">76</td>
<td colspan=2></td>
<td class="team_right">'.$school[$i].$seed[$i++].'</td>
<td class="score">69</td>
</tr>

<tr><td colspan=22></td></tr>

<tr>
<td class="score">59</td>
<td class="team_left">'.$school[$i].$seed[$i++].'</td>
<td class="score">82</td>
<td class="team_left">'.$school[$i].$seed[$i++].'</td>
<td colspan=14></td>
<td class="team_right">'.$school[$i].$seed[$i++].'</td>
<td class="score">59</td>
<td class="team_right">'.$school[$i].$seed[$i++].'</td>
<td class="score">56</td>
</tr>

<tr><td colspan=22></td></tr>

<tr>
<td class="score">70</td>
<td class="team_left">'.$school[$i].$seed[$i++].'</td>
<td class="score">74</td>
<td class="team_left">'.$school[$i].$seed[$i++].'</td>
<td colspan=4></td>
<td colspan=6 ALIGN=center></td>
<td colspan=4></td>
<td class="team_right">'.$school[$i].$seed[$i++].'</td>
<td class="score">72</td>
<td class="team_right">'.$school[$i].$seed[$i++].'</td>
<td class="score">72</td>
</tr>

<tr><td colspan=22></td></tr>

<tr>
<td class="score">48</td>
<td class="team_left">'.$school[$i].$seed[$i++].'</td>
<td colspan=6></td>
<td class="score">61</td>
<td class="team_left">'.$school[$i].$seed[$i++].'</td>
<td colspan=2></td>
<td class="team_right">'.$school[$i].$seed[$i++].'</td>
<td class="score">95</td>
<td colspan=6></td>
<td class="team_right">'.$school[$i].$seed[$i++].'</td>
<td class="score">68</td>
</tr>

<tr><td colspan=22></td></tr>

<tr>
<td class="score">96</td>
<td class="team_left">'.$school[$i].$seed[$i++].'</td>
<td colspan=6></td>
<td class="score">80</td>
<td class="team_left">'.$school[$i].$seed[$i++].'</td>
<td colspan=2></td>
<td class="team_right">'.$school[$i].$seed[$i++].'</td>
<td class="score">84</td>
<td colspan=6></td>
<td class="team_right">'.$school[$i].$seed[$i++].'</td>
<td class="score">89</td>
</tr>

<tr><td colspan=22></td></tr>

<tr>
<td class="score">54</td>
<td class="team_left">'.$school[$i].$seed[$i++].'</td>
<td class="score">79</td>
<td class="team_left">'.$school[$i].$seed[$i++].'</td>
<td colspan=14></td>
<td class="team_right">'.$school[$i].$seed[$i++].'</td>
<td class="score">90</td>
<td class="team_right">'.$school[$i].$seed[$i++].'</td>
<td class="score">60</td>
</tr>

<tr><td colspan=22></td></tr>

<tr>
<td class="score">63</td>
<td class="team_left">'.$school[$i].$seed[$i++].'</td>
<td class="score">61</td>
<td class="team_left">'.$school[$i].$seed[$i++].'</td>
<td colspan=6></td>
<td colspan=2 align="center"></td>
<td colspan=6></td>
<td class="team_right">'.$school[$i].$seed[$i++].'</td>
<td class="score">83</td>
<td class="team_right">'.$school[$i].$seed[$i++].'</td>
<td class="score">62</td>
</tr>

<tr><td colspan=22></td></tr>

<tr>
<td class="score">70</td>
<td class="team_left">'.$school[$i].$seed[$i++].'</td>
<td colspan=2></td>
<td class="score">80</td>
<td class="team_left">'.$school[$i].$seed[$i++].'</td>
<td colspan=4></td>
<td class="score">72</td>
<td class="team_left">'.$school[$i].$seed[$i++].'</td>
<td colspan=4></td>
<td class="team_right">'.$school[$i].$seed[$i++].'</td>
<td class="score">78</td>
<td colspan=2></td>
<td class="team_right">'.$school[$i].$seed[$i++].'</td>
<td class="score">66</td>
</tr>

<tr><td colspan=22></td></tr>

<tr>
<td class="score">79</td>
<td class="team_left">'.$school[$i].$seed[$i++].'</td>
<td colspan=2></td>
<td class="score">64</td>
<td class="team_left">'.$school[$i].$seed[$i++].'</td>
<td colspan=4></td>
<td class="score">82</td>
<td class="team_left">'.$school[$i].$seed[$i++].'</td>
<td colspan=4></td>
<td class="team_right">'.$school[$i].$seed[$i++].'</td>
<td class="score">65</td>
<td colspan=2></td>
<td class="team_right">'.$school[$i].$seed[$i++].'</td>
<td class="score">84</td>
</tr>

<tr><td colspan=22></td></tr>

<tr>
<td class="score">69</td>
<td class="team_left">'.$school[$i].$seed[$i++].'</td>
<td class="score">58</td>
<td class="team_left">'.$school[$i].$seed[$i++].'</td>
<td colspan=14></td>
<td class="team_right">'.$school[$i].$seed[$i++].'</td>
<td class="score">66</td>
<td class="team_right">'.$school[$i].$seed[$i++].'</td>
<td class="score">59</td>
</tr>

<tr><td colspan=22></td></tr>

<tr>
<td class="score">99</td>
<td class="team_left">'.$school[$i].$seed[$i++].'</td>
<td class="score">87</td>
<td class="team_left">'.$school[$i].$seed[$i++].'</td>
<td colspan=14></td>
<td class="team_right">'.$school[$i].$seed[$i++].'</td>
<td class="score">43</td>
<td class="team_right">'.$school[$i].$seed[$i++].'</td>
<td class="score">73</td>
</tr>

<tr><td colspan=22></td></tr>

<tr>
<td class="score">75</td>
<td class="team_left">'.$school[$i].$seed[$i++].'</td>
<td colspan=4></td>
<td class="score">81</td>
<td class="team_left">'.$school[$i].$seed[$i++].'</td>
<td colspan=2></td>
<td colspan=2></td>
<td colspan=2></td>
<td class="team_right">'.$school[$i].$seed[$i++].'</td>
<td class="score">73</td>
<td colspan=4></td>
<td class="team_right">'.$school[$i].$seed[$i++].'</td>
<td class="score">77</td>
</tr>

<tr><td colspan=22></td></tr>

<tr>
<td class="score">83</td>
<td class="team_left">'.$school[$i].$seed[$i++].'</td>
<td colspan=4></td>
<td class="score">87</td>
<td class="team_left">'.$school[$i].$seed[$i++].'</td>
<td colspan=2></td>
<td colspan=2 class="team_left">'.$school[$i].$seed[$i++].'</td>
<td colspan=2></td>
<td class="team_right">'.$school[$i].$seed[$i++].'</td>
<td class="score">87</td>
<td colspan=4></td>
<td class="team_right">'.$school[$i].$seed[$i++].'</td>
<td class="score">49</td>
</tr>

<tr><td colspan=22></td></tr>

<tr>
<td class="score">71</td>
<td class="team_left">'.$school[$i].$seed[$i++].'</td>
<td class="score">56</td>
<td class="team_left">'.$school[$i].$seed[$i++].'</td>
<td colspan=14></td>
<td class="team_right">'.$school[$i].$seed[$i++].'</td>
<td class="score">60</td>
<td class="team_right">'.$school[$i].$seed[$i++].'</td>
<td class="score">50</td>
</tr>

<tr><td colspan=22></td></tr>

<tr>
<td class="score">72</td>
<td class="team_left">'.$school[$i].$seed[$i++].'</td>
<td class="score">59</td>
<td class="team_left">'.$school[$i].$seed[$i++].'</td>
<td colspan=5></td>
<td colspan=4 rowspan=12></td>
<td colspan=5></td>
<td class="team_right">'.$school[$i].$seed[$i++].'</td>
<td class="score">79</td>
<td class="team_right">'.$school[$i].$seed[$i++].'</td>
<td class="score">83</td>
</tr>

<tr><td colspan=9></td><td colspan=9></td></tr>

<tr>
<td class="score">70</td>
<td class="team_left">'.$school[$i].$seed[$i++].'</td>
<td colspan=2></td>
<td class="score">56</td>
<td class="team_left">'.$school[$i].$seed[$i++].'</td>
<td colspan=3></td>
<td colspan=3></td>
<td class="team_right">'.$school[$i].$seed[$i++].'</td>
<td class="score">76</td>
<td colspan=2></td>
<td class="team_right">'.$school[$i].$seed[$i++].'</td>
<td class="score">80</td>
</tr>

<tr><td colspan=9></td><td colspan=9></td></tr>

<tr>
<td class="score">63</td>
<td class="team_left">'.$school[$i].$seed[$i++].'</td>
<td colspan=2></td>
<td class="score">66</td>
<td class="team_left">'.$school[$i].$seed[$i++].'</td>
<td colspan=3></td>
<td colspan=3></td>
<td class="team_right">'.$school[$i].$seed[$i++].'</td>
<td class="score">66</td>
<td colspan=2></td>
<td class="team_right">'.$school[$i].$seed[$i++].'</td>
<td class="score">61</td>
</tr>

<tr><td colspan=9></td><td colspan=9></td></tr>

<tr>
<td class="score">79</td>
<td class="team_left">'.$school[$i].$seed[$i++].'</td>
<td class="score">52</td>
<td class="team_left">'.$school[$i].$seed[$i++].'</td>
<td colspan=5></td>
<td colspan=5></td>
<td class="team_right">'.$school[$i].$seed[$i++].'</td>
<td class="score">76</td>
<td class="team_right">'.$school[$i].$seed[$i++].'</td>
<td class="score">63</td>
</tr>

<tr><td colspan=9></td><td colspan=9></td></tr>

<tr>
<td class="score">101</td>
<td class="team_left">'.$school[$i].$seed[$i++].'</td>
<td class="score">73</td>
<td class="team_left">'.$school[$i].$seed[$i++].'</td>
<td colspan=5></td>
<td colspan=5></td>
<td class="team_right">'.$school[$i].$seed[$i++].'</td>
<td class="score">57</td>
<td class="team_right">'.$school[$i].$seed[$i++].'</td>
<td class="score">57</td>
</tr>

<tr><td colspan=9></td><td colspan=9></td></tr>

<tr>
<td class="score">76</td>
<td class="team_left">'.$school[$i].$seed[$i++].'</td>
<td colspan=7></td>
<td colspan=7></td>
<td class="team_right">'.$school[$i].$seed[$i++].'</td>
<td class="score">58</td>
</tr>

<tr><td colspan=22></td></tr>

<tr><td class="region" colspan="8">Midwest</td><td colspan=6></td><td class="region"colspan="8">West</td></tr>
<tr><td colspan=22></td></tr>
<tr><td colspan=22 class="bracket_head">First Four</td></tr>
<tr><td colspan=22></td></tr>
<tr>
<td colspan=2></td>
<td class="score">100</td>
<td class="team_left">'.$school[$i].$seed[$i++].'</td>
<td colspan=2></td>
<td class="score">100</td>
<td class="team_left">'.$school[$i].$seed[$i++].'</td>
<td colspan=6></td>
<td class="team_right">'.$school[$i].$seed[$i++].'</td>
<td class="score">100</td>
<td colspan=2></td>
<td class="team_right">'.$school[$i].$seed[$i++].'</td>
<td class="score">58</td>
<td colspan=2></td>
</tr>
<tr>
<td colspan=2></td>
<td class="score">100</td>
<td class="team_left">'.$school[$i].$seed[$i++].'</td>
<td colspan=2></td>
<td class="score">100</td>
<td class="team_left">'.$school[$i].$seed[$i++].'</td>
<td colspan=6></td>
<td class="team_right">'.$school[$i].$seed[$i++].'</td>
<td class="score">100</td>
<td colspan=2></td>
<td class="team_right">'.$school[$i].$seed[$i++].'</td>
<td class="score">58</td>
<td colspan=2></td>
</tr>

</table>';
}
?>