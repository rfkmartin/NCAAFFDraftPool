#!/usr/bin/perl

use DBI;
my $dsn = "DBI:mysql:mysql:localhost";
my $username = "root";
my $password = '45trOUt90';

# connect to MySQL database
my %attr = ( PrintError=>0,  # turn off error reporting via warn()
             RaiseError=>1);   # turn on error reporting via die()

my $dbh  = DBI->connect($dsn,$username,$password, \%attr);
open OFILE, ">", "populate_player_table2.sql" or die;
print OFILE "use ofp;\n";
for ($wk=8;$wk<=8;$wk++)
{
   $gamedate=0;
   $game=0;
   $pts=0;
   $file = "../data/team".$wk.".html";
   open FILE, '<', $file or die;
   #print "$wk $file\n";
   while (<FILE>)
   {
      # <title>Auburn Tigers 2016-17 Statistics - Team and Player Stats - Men's College Basketball - ESPN</title>
      if (/<title>Auburn ([\w]*) 2016.*<\/title>/)
      {
         $mascot=$1;
      }
      # <div class="sub-title">10-5, 12th in Southeastern Conference
      if (/<div class=\"sub-title\">([0-9]*)-([0-9]*), [0-9]*[a-z]* in (.*)<\/div></)
      {
         $wins=$1; $losses=$2; $conference=$3;
      }
      #visitor
      #<td style="white-space:nowrap;;  text-align:nowrap;" id="cRoad24473" class="">
      #	<input type="radio" disabled>Washington (4-12) +2.5
      #</td>
      #home
      #<td style="white-space:nowrap;" id="cRoad24473" class="winbackground">
      #	<input type="radio" checked disabled>HOUSTON (9-7) -2.5
      #</td>
      if ($game)
      {
         if (/cRoad([0-9]*)\" class=\"(.*)\"/)
         {
            $gameid=$1;
            $picked=length($2)>0?1:0;
            #print "game $gameid $picked\n";
         }
         if (/<input type=\"radio\" (.*disabled)>([\w \.]*) \([0-9\-]+\).*SPREAD'>([+-\.0-9]*)/)
         {
            $team=$2;
            $spread=$3;
            if ((uc $team) =~ $team)
            {
               $home=$team;
               $homespread=1.0*$spread;
               $homepicked=$picked;
               #print "H: $home $homespread $homepicked\n";
               if ($homespread != -$visitorspread)
               {
                  print "bad spreads\n";
                  exit;
               }
            }
            # special case: neutral site
            elsif ($v && $team =~ $team)
            {
               $home=uc $team;
               $homespread=1.0*$spread;
               $homepicked=$picked;
               $neutral=1;
               #print "H: $home $homespread $homepicked\n";
               if ($homespread != -$visitorspread)
               {
                  print "bad spreads\n";
                  exit;
               }
            }
            else
            {
               $v=1;
               $visitor=uc $team;
               $visitorspread=1.0*$spread;
               $visitorpicked=$picked;
               #print "V: $visitor $visitorspread $visitorpicked\n";
            }
            $home_venue = $neutral?0:1;
            $visitor_venue = $neutral?0:-1;
         }
         #<td style="white-space:nowrap;" class="pscore tc">
         #16-36
         #</td>
         if (/class=\"pscore tc\"/)
         {
            $score=1;
         }
         if ($score)
         {
            if (/(\d+)-(\d+)/)
            {
               $visitorscore=$1;
               $homescore=$2;
               $homewin=$homescore>$visitorscore;
               $visitorwin=!$homewin;
               if ($wk==1)
               {
                   $seasonwPrev{$home}=0;
                   $seasonlPrev{$home}=0;
                   $seasonwPrev{$visitor}=0;
                   $seasonlPrev{$visitor}=0;
               }
               $seasonw{$home} += $homewin;
               $seasonw{$visitor} += $visitorwin;
               $seasonl{$home} += !$homewin;
               $seasonl{$visitor} += !$visitorwin;
               $choice="WRONG!";
               if ($homewin == $homepicked)
               {
                $choice="RIGHT!";
               }
               # special case: tie
               if ($homescore == $visitorscore)
               {
                  $choice="RIGHT!";
                  $seasonw{$home} -= $homewin;
                  $seasonw{$visitor} -= $visitorwin;
                  $seasonl{$home}{$wk+1} -= !$homewin;
                  $seasonl{$visitor}{$wk+1} -= !$visitorwin;
               }
               $score=0;
            }
         }
         #<td class="tr" style="margin-right:2px; padding-right:2px;" ><span class='pwin'>12 Pts&nbsp;</span>
         if (/class=\'pwin\'/||/class=\'ploss\'/||/class=\'ptie\'/)
         {
            if (/([0-9]+) Pts/)
            {
               $rank=$1;
               $game=0;
               $spr="NOT COVERED!";
               $covered=0;
               if ($homescore+$homespread>$visitorscore)
               {
                  $covered=1;
                  $spr = "COVERED!";
               }
               $correct=0;
               if ($choice =~ "RIGHT!")
               {
                  $correct=1;
                  if ($homescore==$visitorscore)
                  {
                     $rank /= 2;
                  }
                  $pts += $rank;
               }
               $spread=2*$homespread;
               print OFILE "insert into game(week, season, dayofweek, home_team, visi_team, home_venue, visi_venue, home_score, visi_score, spread, home_wins, home_loss, visi_wins, visi_loss, home_pick, correct, cover_spread, rank) values ($wk, 2, \"$day\", \"$home\", \"$visitor\", $home_venue, $visitor_venue, $homescore, $visitorscore, $spread, $seasonwPrev{$home},$seasonlPrev{$home},$seasonwPrev{$visitor},$seasonlPrev{$visitor},$homepicked,$correct,$covered,$rank);\n";
               $seasonwPrev{$home}=$seasonw{$home};
               $seasonlPrev{$home}=$seasonl{$home};
               $seasonwPrev{$visitor}=$seasonw{$visitor};
               $seasonlPrev{$visitor}=$seasonl{$visitor};
               if ($homepicked)
               {
                  #print "$day: $rank: $home*** $homescore - $visitor $visitorscore $homespread $choice $spr\n";
               }
               else
               {
                  #print "$day: $rank: $home $homescore - $visitor*** $visitorscore $homespread $choice $spr\n";
               }
               $neutral = 0;
            }
         }
      }
   }
   print "$wins $losses $conference $mascot\n";
   #print "Points: $pts\n";
}
#foreach $team (keys %seasonw)
#{
#   print "$team: $seasonw{$team}-$seasonl{$team}\n";
#}
close FILE;
close OFILE;