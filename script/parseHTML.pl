#!/usr/bin/perl

#https://www.cyberciti.biz/faq/how-to-access-mysql-database-using-perl/
use DBI;
use JSON::Parse 'parse_json';
#use JSON qw( decode_json );     # From CPAN
use Data::Dumper; 
my $dsn = "DBI:mysql:ncaa1:127.0.0.1";
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
   print("opening $file ...\n");
   open FILE, '<', $file or die;
   $record=0;
   while (<FILE>)
   {
    # # nickname
    #   is shortName
	  #"standingSummary":"4th in SEC"
	  if (/"standingSummary":".* in ([a-zA-Z ]*)"/)
      {
         $conference=$1;
      }
	  if (/recordSummary":"([0-9]*)-([0-9]*)"/)
      {
         $wins=$1; $losses=$2;
      }
	  if (/"shortDisplayName":"([a-zA-Z ]*)"/) 
      {
		  $mascot = $1;
      }
      # ;window['__espnfitt__']=
	  if (/.*espnfitt__'\]=({.*});<\/script/)
	  {

		  $stats_json=parse_json($1);
          $abbrev=$stats_json->{page}->{content}->{stats}->{team}->{abbrev};
          $logo=$stats_json->{page}->{content}->{stats}->{team}->{logo};
          $mascot=$stats_json->{page}->{content}->{stats}->{team}->{shortDisplayName};
          $record=$stats_json->{page}->{content}->{stats}->{team}->{recordSummary};
          $teamColor=$stats_json->{page}->{content}->{stats}->{team}->{teamColor};
          $altColor=$stats_json->{page}->{content}->{stats}->{team}->{altColor};
          $standingSummary=$stats_json->{page}->{content}->{stats}->{team}->{standingSummary};
          $nickname=$stats_json->{page}->{content}->{stats}->{team}->{nickname};
          $location=$stats_json->{page}->{content}->{stats}->{team}->{location};
          $links=$stats_json->{page}->{content}->{stats}->{team}->{links};
          foreach my $player (@{$stats_json->{page}->{content}->{stats}->{playerStats}[0]})
		  {
			  $name=$player->{athlete}->{name};
			  $gp=$player->{statGroups}->{stats}->[0]->{displayValue};
			  $mpg=$player->{statGroups}->{stats}->[1]->{displayValue};
			  $ppg=$player->{statGroups}->{stats}->[2]->{displayValue};
            $sql = "insert into player(year_id,name,team_id,gp,mpg,ppg) values (2024,?,?,?,?,?)";
            $sql1 = "insert into player(year_id,name,team_id,gp,mpg,ppg) values (2024,$name,$teamid,$gp,$mpg,$ppg);";
            print $sql1."\n";

            $insert=$dbh->prepare($sql);
            $rv=$insert->execute($name,$teamid,$gp,$mpg,$ppg);
		  }
	  }
   }
   $sql = "update team set school=?,shortname=?,location_=?,team_color=?,wins=?,losses=?,mascot=?,conference=? where team_id=?";
   #$sql="$mascot,$abbrev,$logo";
   #print $sql."\n";
   $insert=$dbh->prepare($sql);
   $rv=$insert->execute($nickname,$abbrev,$location,$team_color,$wins,$losses,$mascot,$conference,$teamid);
}
$sql = "update keyValue set v=? where k='playerUpdateDTM'";
#$insert=$dbh->prepare($sql);
#$rv=$insert->execute(scalar(localtime(time)));
