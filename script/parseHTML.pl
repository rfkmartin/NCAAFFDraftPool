#!/usr/bin/perl

#https://www.cyberciti.biz/faq/how-to-access-mysql-database-using-perl/
use DBI;
my $dsn = "DBI:mysql:ncaa:192.168.10.52";
my $username = "root";
my $password = '';

# connect to MySQL database
my %attr = ( PrintError=>0,  # turn off error reporting via warn()
             RaiseError=>1);   # turn on error reporting via die()

my $dbh  = DBI->connect($dsn,$username,$password, \%attr);
$query=$dbh->prepare("select team_id,school from team");
$rv=$query->execute();
while (@result = $query->fetchrow_array())
{
   $teamid=$result[0];
   $school=$result[1];
   $file = "../data/team".$teamid.".html";
   open FILE, '<', $file or die;
   $record=0;
   while (<FILE>)
   {
      # <title>Auburn Tigers 2016-17 Statistics - Team and Player Stats - Men's College Basketball - ESPN</title>
      if (/<title>$school ([a-zA-Z ]*) 2016.*<\/title>/)
      {
         $mascot=$1;
      }
      if (/Game Statistics/)
      {
         $record=1;
      }
      if (/Season Statistics/)
      {
         $record=0;
      }
      # <div class="sub-title">10-5, 12th in Southeastern Conference
      if (/<div class=\"sub-title\">([0-9]*)-([0-9]*), [0-9]*[a-z]* in (.*)<\/div></)
      {
         $wins=$1; $losses=$2; $conference=$3;
      }
      #visitor=
      if ($record&&/tr class=\"evenrow player-[0-9]*-[0-9]*\"><td><a href=\"http[\S]*\">([a-zA-Z \-']*)<\/a>/)
      {
         #tr class="oddrow player-41-3132483"><td><a href="http://www.espn.com/mens-colleg</a></td><td align="right">16</td><td align="right">20.7</td><td align="right"class="sortcell">12.1</td>
         @data = $_ =~ /tr class=\"evenrow player-[0-9]*-[0-9]*\"><td><a href=\"http[\S]*\">([a-zA-Z \-'\.\.]*)<\/a><\/td><td align=\"right\">([0-9]*)<\/td><td align=\"right\">([0-9]*\.[0-9]*)<\/td><td align=\"right\"class=\"sortcell\">([0-9]*\.[0-9]*)<\/td>/g;
         for ($i = 0; $i < scalar( @data ); $i+=4 )
         {
            $sql = "insert into player(name,team_id,gp,mpg,ppg) values (?,?,?,?,?)";
            #$sql = "insert into player(name,team_id,gp,mpg,ppg) values (\"$data[$i]\",$teamid,$data[$i+1],$data[$i+2],$data[$i+3]);";
            #print $sql."\n";
            $insert=$dbh->prepare($sql);
            $rv=$insert->execute($data[$i],$teamid,$data[$i+1],$data[$i+2],$data[$i+3]);
         }
      }
      #<tr class="oddrow player-41-4066250"><td><a href="http://www.espn.com/mens-college-basketball/player/_/id/4066250/mustapha-heron">Mustapha Heron</a></td><td align="right">15</td><td align="right">27.5</td><td align="right"class="sortcell">16.2</td><td align="right">6.3</td><td align="right">1.2</td><td align="right">0.9</td><td align="right">0.3</td><td align="right">2.9</td><td align="right">.442</td><td align="right">.786</td><td align="right">.407</td></tr>
      if ($record&&/tr class=\"oddrow player-[0-9]*-[0-9]*\"><td><a href=\"http[\S]*\">([a-zA-Z \-'\.]*)<\/a/)
      {
         @data = $_ =~ /tr class=\"oddrow player-[0-9]*-[0-9]*\"><td><a href=\"http[\S]*\">([a-zA-Z \-'\.]*)<\/a><\/td><td align=\"right\">([0-9]*)<\/td><td align=\"right\">([0-9]*\.[0-9]*)<\/td><td align=\"right\"class=\"sortcell\">([0-9]*\.[0-9]*)<\/td>/g;
         for ($i = 0; $i < scalar( @data ); $i+=4 )
         {
            $sql = "insert into player(name,team_id,gp,mpg,ppg) values (?,?,?,?,?)";
            #$sql = "insert into player(name,team_id,gp,mpg,ppg) values (\"$data[$i]\",$teamid,$data[$i+1],$data[$i+2],$data[$i+3]);";
            #print $sql."\n";

            $insert=$dbh->prepare($sql);
            $rv=$insert->execute($data[$i],$teamid,$data[$i+1],$data[$i+2],$data[$i+3]);
         }
      }
   }
   $sql = "update team set wins=?,losses=?,mascot=?,conference=? where team_id=?";
   $insert=$dbh->prepare($sql);
   $rv=$insert->execute($wins,$losses,$mascot,$conference,$teamid);
}
$sql = "update keyValue set v=? where k='playerUpdateDTM'";
$insert=$dbh->prepare($sql);
$rv=$insert->execute(scalar(localtime(time)));
