<?php
function print_header()
{
   echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">';
   echo '<html><head>';
   echo '<title>NCAA Final Four Draft Pool</title>';
   echo '<link href="./style.css" rel="stylesheet" type="text/css">';
   echo '<script src="js/jquery.js" type="text/javascript"></script>';
   echo '<script src="js/moment.min.js" type="text/javascript"></script>';
   echo '<script src="js/combodate.js" type="text/javascript"></script>';
   echo '</head>';
}
function print_footer()
{
   echo '</html>';
}
function set_timezone()
{
   date_default_timezone_set ( "America/Chicago" );
}
function print_sub_menu()
{
   echo '<form action = "" method = "post">';
   echo '<tr><td class="submenu">';
   if ($_SESSION['status']=='LIVE')
   {
      if (!isset($_SESSION['user']))
      {
         echo '<button ' . isBtnSelected ( 'login' ) . 'name="login">Login</button>';
      }
      else
      {
         echo '<button ' . isBtnSelected ( 'logout' ) . 'name="logout">Logout</button>';
      }
      if (isset($_SESSION['activepool']))
      {
        echo ' | <button ' . isBtnSelected ( 'rules' ) . 'name="rules">Rules</button>';
        echo ' | <button ' . isBtnSelected ( 'bracket' ) . 'name="bracket">Bracket</button>';
        echo ' | <button ' . isBtnSelected ( 'results' ) . 'name="results">Results</button>';
        echo ' | <button ' . isBtnSelected ( 'rosters' ) . 'name="rosters">Rosters</button>';
        if ($_SESSION['admin'])
        {
           echo ' | <button ' . isBtnSelected ( 'admin' ) . 'name="admin">Admin</button>';
        }
        if ($_SESSION['page'] == 'admin')
        {
           echo '<tr><td class="submenu">';
           echo '<button ' . isBtnSelected ( 'adminsetlive' ) . 'name="adminsetlive">Set LIVE</button>';
           echo ' | <button ' . isBtnSelected ( 'adminsetdraft' ) . 'name="adminsetdraft">Set DRAFT</button>';
           echo ' | <button ' . isBtnSelected ( 'adminsetpre' ) . 'name="adminsetpre">Set PREDRAFT</button>';
           echo ' | <button ' . isBtnSelected ( 'adminentergame' ) . 'name="adminentergame">Enter Game</button>';
           echo ' | <button ' . isBtnSelected ( 'adminchangepass' ) . 'name="adminchangepass">Change Password</button>';
        }
        else if ($_SESSION['page'] == 'results')
        {
           echo '<tr><td class="submenu">';
           echo '<button ' . isBtnSelected ( 'leader' ) . 'name="leader">Leaderboard</button>';
           echo ' | <button ' . isBtnSelected ( 'playerresults' ) . 'name="playerresults">Player Results</button>';
           echo ' | <button ' . isBtnSelected ( 'teamresults' ) . 'name="teamresults">Team Results</button>';
           echo ' | <button ' . isBtnSelected ( 'stats' ) . 'name="stats">Other Results</button>';
        }
        else
        {
            print(" | <button " . isBtnSelected ( "pools" ) . "name=\"pools\">Select a Pool</button>");
           echo '<tr><td class="nonmenu">&nbsp;';
        }
     } else {
     if (isset($_SESSION['user']))
     {
         print(" | <button " . isBtnSelected ( "pools" ) . "name=\"pools\">Select a Pool</button>");
     }
    }
      echo '</td></tr>';
      if ($_SESSION['page'] == 'admin' && $_SESSION['subpage']=='adminentergame')
      {
         echo '<tr><td class="submenu">';
         echo '<input type="text" name="game_id"><input type="submit" name="enter_game" value="Submit">';
      }
      else
      {
         echo '<tr><td class="nonmenu">&nbsp;';
      }
   }
   elseif ($_SESSION['status']=='PREDRAFT')
   {
    if (!isset($_SESSION['user'])){
        echo '<button ' . isBtnSelected ( 'register' ) . 'name="register">Register/Log In</button>';
    } else {
        print("<button " . isBtnSelected ( "pools" ) . "name=\"pools\">Pools</button>");
        print(" | <button " . isBtnSelected ( "logout" ) . "name=\"logout\">Logout</button>");
    }
      echo ' | <button ' . isBtnSelected ( 'rules' ) . 'name="rules">Rules</button>';
      echo ' | <button ' . isBtnSelected ( 'teams' ) . 'name="teams">Top Teams</button>';
      echo ' | <button ' . isBtnSelected ( 'players' ) . 'name="players">Top Players</button>';
      echo ' | <button ' . isBtnSelected ( 'teamplayers' ) . 'name="teamplayers">Top Teams\' Players</button>';
      echo ' | <button ' . isBtnSelected ( 'res2000' ) . 'name="res2000">Results from 2000</button>';
      echo ' | <button ' . isBtnSelected ( 'res2001' ) . 'name="res2001">Results from 2001</button>';
      if ($_SESSION['admin'])
      {
         echo ' | <button ' . isBtnSelected ( 'admin' ) . 'name="admin">Admin</button>';
      }
      if ($_SESSION['page'] == 'admin')
      {
         echo '<tr><td class="submenu">';
         echo '<button ' . isBtnSelected ( 'adminsetlive' ) . 'name="adminsetlive">Set LIVE</button>';
         echo ' | <button ' . isBtnSelected ( 'adminsetdraft' ) . 'name="adminsetdraft">Set DRAFT</button>';
         echo ' | <button ' . isBtnSelected ( 'adminsetpre' ) . 'name="adminsetpre">Set PREDRAFT</button>';
      }
      else
      {
         echo '<tr><td class="nonmenu">&nbsp;';
      }
   }
   elseif ($_SESSION['status']=='DRAFT')
   {
      if (!isset($_SESSION['user']))
      {
         echo '<button ' . isBtnSelected ( 'login' ) . 'name="login">Login</button>';
      }
      else
      {
         echo '<button ' . isBtnSelected ( 'logout' ) . 'name="logout">Logout</button>('.$_SESSION['username'].')';
      }
      if (isset($_SESSION['activepool']))
      {
        print(" | <button " . isBtnSelected ( "pools" ) . "name=\"pools\">Pools</button>(".$_SESSION['activepoolname'].")");
        echo ' | <button ' . isBtnSelected ( 'rules' ) . 'name="rules">Rules</button>';
        echo ' | <button ' . isBtnSelected ( 'teamdraft' ) . 'name="teamdraft">Team Draft</button>';
        echo ' | <button ' . isBtnSelected ( 'playerdraft' ) . 'name="playerdraft">Player Draft</button>';
        echo ' | <button ' . isBtnSelected ( 'draft' ) . 'name="draft">Draft Order</button>';
        echo ' | <button ' . isBtnSelected ( 'rosters' ) . 'name="rosters">Rosters</button>';
      } else {
        if (isset($_SESSION['user']))
        {
            print(" | <button " . isBtnSelected ( "pools" ) . "name=\"pools\">Select a Pool</button>");
        }
      }
      if ($_SESSION['admin'])
      {
         echo ' | <button ' . isBtnSelected ( 'admin' ) . 'name="admin">Admin</button>';
      }
      echo '</td></tr>';
      if ($_SESSION['page'] == 'playerdraft')
      {
         echo '<tr><td class="submenu">';
         echo '<button ' . isBtnSelected ( 'playertopscore_sub' ) . 'name="playertopscore_sub">Top Overall Scorers</button>';
         echo ' | <button ' . isBtnSelected ( 'playertopseed_sub' ) . 'name="playertopseed_sub">Top Scorers by Seed</button>';
         echo ' | <button ' . isBtnSelected ( 'playernamesearch_sub' ) . 'name="playernamesearch_sub">Search by Name</button>';
      }
      elseif ($_SESSION['page'] == 'admin')
      {
         echo '<tr><td class="submenu">';
         echo '<button ' . isBtnSelected ( 'adminsetlive' ) . 'name="adminsetlive">Set LIVE</button>';
         echo ' | <button ' . isBtnSelected ( 'adminsetdraft' ) . 'name="adminsetdraft">Set DRAFT</button>';
         echo ' | <button ' . isBtnSelected ( 'adminsetpre' ) . 'name="adminsetpre">Set PREDRAFT</button>';
         echo ' | <button ' . isBtnSelected ( 'adminsetprnd' ) . 'name="adminsetprnd">Set Player Round</button>';
         echo ' | <button ' . isBtnSelected ( 'adminsettrnd' ) . 'name="adminsettrnd">Set Team Round</button>';
      }
      else
      {
         echo '<tr><td class="nonmenu">&nbsp;';
      }
      echo '</td></tr>';
      if ($_SESSION['page'] == 'playerdraft' && $_SESSION['subpage']=='playernamesearch_sub')
      {
         echo '<tr><td class="submenu">';
         echo '<input type="text" name="player_search"><input type="submit" name="player_name_search" value="Search">';
      }
      elseif ($_SESSION['page'] == 'playerdraft' && $_SESSION['subpage']=='playertopseed_sub')
      {
         echo '<tr><td class="submenu">';
         echo '<button ' . isBtnSelected ( 't12' ) . 'name="t12">1-2</button>';
         echo ' | <button ' . isBtnSelected ( 't34' ) . 'name="t34">3-4</button>';
         echo ' | <button ' . isBtnSelected ( 't56' ) . 'name="t56">5-6</button>';
         echo ' | <button ' . isBtnSelected ( 't78' ) . 'name="t78">7-8</button>';
      }
      elseif ($_SESSION['page'] == 'admin' && $_SESSION['subpage']=='adminsetprnd')
      {
         echo '<tr><td class="submenu">';
         echo '<input type="text" name="pround"><input type="submit" name="set_player_round" value="Submit">';
      }
      elseif ($_SESSION['page'] == 'admin' && $_SESSION['subpage']=='adminsettrnd')
      {
         echo '<tr><td class="submenu">';
         echo '<input type="text" name="tround"><input type="submit" name="set_team_round" value="Submit">';
      }
      else
      {
         echo '<tr><td class="nonmenu">&nbsp;';
      }
      echo '</td></tr>';
      echo '</form>';
   }
}
function print_sub_menu_nitrambo()
{
   print('<form action = "" method = "post">');
   print('<tr><td class="submenu">');
   print('<button name="setregion">Set Regions</button>');
   print(' | <button name="setbracket">Set Bracket</button>');
   print(' | <button name="setfirstfour">Set First Four</button>');
   print(' | <button name="scoregame">Score Game</button>');
   print('</td></tr>');
   print('</form>');
}
function isBtnSelected($page)
{
   if ($page == $_SESSION ['page'])
   {
      return 'class="selected" ';
   }
   if ($page == $_SESSION ['subpage'])
   {
      return 'class="selected" ';
   }
   if ($page == $_SESSION ['subsubpage'])
   {
      return 'class="selected" ';
   }
   return '';
}
function print_logon()
{
   if (empty ( $_SESSION ['user'] ))
   {
      print_logon_form ();
   }
   else
   {
      echo 'Welcome, <span class="person">' . $_SESSION ['family_name'] . '</span><br>';
      echo '<form action = "" method = "post"><button name="account">My Account</button><br>';
      echo '<button name="logout">Logout</button><form>';
   }
}
function print_logon_form()
{
   echo '<h3><font color="red">'.$_SESSION['error'].'</font>'.$_SESSION['message'].'</h3>';
   echo '<form action = "" method = "post">';
   echo '<table><tr><td align="left">Username:</td><td><input type = "text" name = "username"></td></tr>';
   echo '<tr><td align="left">Password:</td><td><input type = "password" name = "password"></td></tr></table>';
   echo '<input type="submit" name="loginform" value="Log In"><form>';
}
function print_region_form()
{
   echo '<h3><font color="red">'.$_SESSION['error'].'</font>'.$_SESSION['message'].'</h3>';
   echo '<form action = "" method = "post">';
   echo '<table><tr><td align="left">Top Left</td><td>Top Right</td></tr>';
   echo '<tr><td align="left"><input type = "text" name = "topleft"></td><td align="topleft"><input type = "text" name = "topright"></td></tr>';
   echo '<tr><td align="left">Bottom Left</td><td>Bottom Right</td></tr>';
   echo '<tr><td align="left"><input type = "text" name = "bottomleft"></td><td align="left"><input type = "text" name = "bottomright"></td></tr></table>';
   echo '<input type="submit" name="regionform" value="Set Regions"><form>';
}
function print_bracket_form($link)
{
   echo '<h3><font color="red">'.$_SESSION['error'].'</font>'.$_SESSION['message'].'</h3>';
   if ($_SESSION['subpage']!='enter_teams')
   {
    echo '<form action = "" method = "post">';
    echo '<table border="1"><tr><td valign="top">Select Game Id: ';
    echo '<select name="bracket_pos">';
    for ($i=1;$i<33;$i++)
    {
       echo '<option value='.$i.'>'.$i.'</option>';
    }
    echo '<option value=65>65</option>';
    echo '<option value=66>66</option>';
    echo '<option value=67>67</option>';
    echo '<option value=68>68</option>';
    print("</select></td></tr></table>");
    print('<input type="submit" name="bracketform" value="Enter Teams"><form>');
    } else {
        $sql="select bracket_pos from bracket where game_id=".$_POST['bracket_pos']." order by bracket_pos";
        $data = mysqli_query ( $link, $sql );
        $i = 0;
        while ( list ( $b ) = mysqli_fetch_row ( $data ) )
        {
            $bracket[$i++]=$b;
        }
        $sql = "select school,team_id from team order by school asc";
        $data = mysqli_query ( $link, $sql );
        $s="";
        while ( list ( $school,$team_id ) = mysqli_fetch_row ( $data ) )
        {
            $s=$s.'<option value='.$team_id.'>'.$school.'</option>';
        }
        $s=$s.'<option value=-999>First Four winner</option>';
        echo '<form action = "" method = "post">';
        echo '<table border="1"><tr><td valign="top">';
        print("Bracket Position ".$bracket[0].": ");
        print('<select name="team0">');
        print($s);
        print("</select></td><td>Seed: ");
        print('<select name="seed0">');
        for ($i=1;$i<17;$i++)
        {
           echo '<option value='.$i.'>'.$i.'</option>';
        }
        print('</select></td><td>');
        print("Bracket Position ".$bracket[1].": ");
        print('<select name="team1">');
        print($s);
        print("</select></td><td>Seed: ");
        print('<select name="seed1">');
        for ($i=1;$i<17;$i++)
        {
           echo '<option value='.$i.'>'.$i.'</option>';
        }
        print('</select></td><td>');
        print("<input type='hidden' name='bracket_pos1'  value='".$bracket[1]."'/>");
        print("<input type='hidden' name='bracket_pos0'  value='".$bracket[0]."'/>");
        print('<input type="submit" name="bracketcommit" value="Commit to Bracket"></td></td><form>');
    }
}
function print_firstfour_form()
{
   print('<h3><font color="red">'.$_SESSION['error'].'</font>'.$_SESSION['message'].'</h3>');
   print('<form action = "" method = "post">');
   print('<table><tr><td align="left">Winner of Game 65: </td><td><input type = "text" name = "game65"></td></tr>');
   print('<table><tr><td align="left">Winner of Game 66: </td><td><input type = "text" name = "game66"></td></tr>');
   print('<table><tr><td align="left">Winner of Game 67: </td><td><input type = "text" name = "game67"></td></tr>');
   print('<table><tr><td align="left">Winner of Game 68: </td><td><input type = "text" name = "game68"></td></tr>');
   print('<input type="submit" name="firstfourform" value="Set First Four"><form>');
}
function choosegame($link)
{
    if ($_SESSION['subpage']!="enterscores")
    {
        print('<form action = "" method = "post">');
        print('<input type="text" name="game_id"><input type="submit" name="enter_game_nitrambo" value="Submit"></form>');
    } else {
        enter_game($_POST['game_id'],$link);
    }
}
function register_account($link)
{
   echo '<h3><font color="red">'.$_SESSION['error'].'</font>'.$_SESSION['message'].'</h3>';
   print("<table><tr><td>");
   echo '<h2>Register</h2>';
   echo '<form action = "" method = "post">';
   echo '<table border="0"><tr>';
   echo '<td width="175px"><b>Username</b></td>';
   echo '<td width="175px"><input type="text" name="username" size="45"></td></tr>';
   echo '<tr><td width="175px"><b>Password</b></td>';
   echo '<td width="175px"><input type="password" name="passwd1" size="45"></td></tr>';
   echo '<tr><td width="175px"><b>Retype Password</b></td>';
   echo '<td width="175px"><input type="password" name="passwd2" size="45"></td></tr>';
   echo '<tr><td width="175px"><b>Name</b></td>';
   echo '<td width="175px"><input type="text" name="teamname" size="45"></td></tr>';
   echo '<tr><td width="175px"><b>Email</b></td>';
   echo '<td width="175px"><input type="text" name="email" size="45"></td>';
   echo '</tr></table>';
   echo '<input type="submit" name="registernewuser" value="Register"></form>';
   print("</td><td valign=\"top\"><h2>Log In</h2>");
   print_logon_form();
   print("</td></tr></table>");
}
function process_forms($link)
{
   $_SESSION['page']='';
   $_SESSION['subpage']='';
   $_SESSION['subsubpage']='';
   $_SESSION['error']='';
   $_SESSION['message']='';
   if (!isset($_SESSION['admin']))
   {
      $_SESSION['admin']='';
   }

   //get key-value pairs
	$sql = "select v from keyValue where k='status'";
	$result = mysqli_query($link,$sql);
	list($status) = mysqli_fetch_row($result);
	$_SESSION['status'] = $status;
    if (isset($_SESSION['user']))
    {
        $active_t_id = array_intersect_key($_POST, array_flip(preg_grep('/^t_id/', array_keys($_POST))));
        if ($active_t_id) {
         $_SESSION['activepool']=substr(key($active_t_id),4);
        }
        if (isset($_SESSION['activepool']))
        {
            $sql = "select name from tourneyOwnerYear where year_id=2024 and tourney_id=".$_SESSION['activepool'];
            $result = mysqli_query($link,$sql);
            list($status) = mysqli_fetch_row($result);
            $_SESSION['activepoolname'] = $status;
            $sql = "select playerRound from tourneyOwnerYear where year_id=2024 and tourney_id=".$_SESSION['activepool'];
            $result = mysqli_query($link,$sql);
            list($status) = mysqli_fetch_row($result);
            $_SESSION['currentPlayerRound'] = $status;
            $sql = "select teamRound from tourneyOwnerYear where year_id=2024 and tourney_id=".$_SESSION['activepool'];
            $result = mysqli_query($link,$sql);
            list($status) = mysqli_fetch_row($result);
            $_SESSION['currentTeamRound'] = $status;
            $sql = "select team_order from draft where draft_pos=".$_SESSION['currentTeamRound']." and tourney_id=".$_SESSION['activepool'];
            print($sql);
            $result = mysqli_query($link,$sql);
            list($status) = mysqli_fetch_row($result);
            $_SESSION['currentroundteam'] = $status;
            $sql = "select player_order from draft where draft_pos=".$_SESSION['currentPlayerRound']." and tourney_id=".$_SESSION['activepool'];
            $result = mysqli_query($link,$sql);
            list($status) = mysqli_fetch_row($result);
            $_SESSION['currentroundplayer'] = $status;
            $sql = "select entry_id from entry where login_id=".$_SESSION['user']." and tourney_id=".$_SESSION['activepool'];
            $result = mysqli_query($link,$sql);
            list($status) = mysqli_fetch_row($result);
            $_SESSION['entry'] = $status;
        }
    }

    print_r($_SESSION);
    print_r($_POST);
	set_page();

    if (isset($_POST['regionform']))
    {
        //print_r($_POST);
        //print_r($_SESSION);
        $sql = "update region set directional='".$_POST['topleft']."' where year_id=2024 and position=0";
        print($sql);
        if (! mysqli_query ( $link, $sql ))
        {
            print("error");
           $_SESSION ['error'] = 'something happened';
        }
        $sql = "update region set directional='".$_POST['topright']."' where year_id=2024 and position=1";
        if (! mysqli_query ( $link, $sql ))
        {
           $_SESSION ['error'] = 'something happened';
        }
        $sql = "update region set directional='".$_POST['bottomleft']."' where year_id=2024 and position=2";
        if (! mysqli_query ( $link, $sql ))
        {
           $_SESSION ['error'] = 'something happened';
        }
        $sql = "update region set directional='".$_POST['bottomright']."' where year_id=2024 and position=3";
        if (! mysqli_query ( $link, $sql ))
        {
           $_SESSION ['error'] = 'something happened';
        }
    }
	if (isset($_POST['bracketcommit']))
    {
        //print_r($_SESSION);
        //print_r($_POST);
        if ($_POST['team0']!=-999)
        {
            $sql="insert into teamstatsYear (team_id,year_id,seed) values(".$_POST['team0'].",2024,".$_POST['seed0'].")";
            print($sql);
            if (! mysqli_query ( $link, $sql ))
            {
               $_SESSION ['error'] = 'something happened';
            }
            $sql="insert into teamGame (year_id,team_id,bracket_pos) values(2024,".$_POST['team0'].",".$_POST['bracket_pos0'].")";
            print($sql);
            if (! mysqli_query ( $link, $sql ))
            {
               $_SESSION ['error'] = 'something happened';
            }
        }
        if ($_POST['team1']!=-999)
        {
            $sql="insert into teamstatsYear (team_id,year_id,seed) values(".$_POST['team1'].",2024,".$_POST['seed1'].")";
            print($sql);
            if (! mysqli_query ( $link, $sql ))
            {
               $_SESSION ['error'] = 'something happened';
            }
            $sql="insert into teamGame (year_id,team_id,bracket_pos) values(2024,".$_POST['team1'].",".$_POST['bracket_pos1'].")";
            print($sql);
            if (! mysqli_query ( $link, $sql ))
            {
               $_SESSION ['error'] = 'something happened';
            }
        }
    }
	if (isset($_POST['firstfourform']))
	{
        $sql="update bracket set next_pos=".$_POST['game65']." where game_id=65";
        print($sql);
        if (! mysqli_query ( $link, $sql ))
        {
           $_SESSION ['error'] = 'something happened';
        }
        $sql="update bracket set next_pos=".$_POST['game66']." where game_id=66";
        print($sql);
        if (! mysqli_query ( $link, $sql ))
        {
           $_SESSION ['error'] = 'something happened';
        }
        $sql="update bracket set next_pos=".$_POST['game67']." where game_id=67";
        print($sql);
        if (! mysqli_query ( $link, $sql ))
        {
           $_SESSION ['error'] = 'something happened';
        }
        $sql="update bracket set next_pos=".$_POST['game68']." where game_id=68";
        print($sql);
        if (! mysqli_query ( $link, $sql ))
        {
           $_SESSION ['error'] = 'something happened';
        }
    }
    if (isset($_POST['enter_game_nitrambo']))
    {
        $_SESSION['subpage']="enterscores";
    }
	if (isset($_POST['loginform']))
	{
        //print_r($_POST);
		$myusername = mysqli_real_escape_string($link,$_POST['username']);
		$mypassword = mysqli_real_escape_string($link,$_POST['password']);
		$sql = "select login_id,name,username,is_admin,password from _login where username='".$myusername."'";
        print($sql);
		//logger($link,$sql);
		$result = mysqli_query($link,$sql);
		list($user,$name,$username,$is_admin,$hashed) = mysqli_fetch_row($result);

		if(password_verify($mypassword,$hashed))
		{
			$_SESSION['user']=$user;
			$_SESSION['username']=$username;
			$_SESSION['name']=$name;
			$_SESSION['admin']=$is_admin;
			$_SESSION['page'] = 'rules';
			logit("logging in");
            // look for tournaments
            $sql = "select tourney_id from tourneyOwnerYear where login_id=".$_SESSION['user'];
            $result = mysqli_query($link,$sql);
            list($tourney) = mysqli_fetch_row($result);
            $_SESSION['poolowner']=$tourney;
            // will look for tournaments that we don't own
            $sql = "select e.entry_id from entry e join tourneyOwnerYear t on e.tourney_id=t.tourney_id and t.login_id!=".$_SESSION['user']." and e.login_id=".$_SESSION['user'];
            $result = mysqli_query($link,$sql);
            list($entry) = mysqli_fetch_row($result);
            $_SESSION['poolentry']=$entry;
        }
		else
		{
			$_SESSION['error'] = "Your Login Name or Password is invalid ".$sql;
			$_SESSION['page'] = 'login';
		}
	}
   if (isset ( $_POST ['logout'] ))
   {
        foreach ($_SESSION as $x=>$y)
        {
            unset($_SESSION[$x]);
        }
        $sql = "select v from keyValue where k='status'";
        $result = mysqli_query($link,$sql);
        list($status) = mysqli_fetch_row($result);
        $_SESSION['status'] = $status;
   }
   if (isset ( $_POST ['registernewuser'] ))
   {
      $_SESSION ['error'] = '';
      $_SESSION ['message'] = '';
      $_SESSION ['page'] = 'register';
      //print_r($_POST);
      //print_r($_SESSION);
      if ($_POST ['passwd1'] == "" || $_POST ['passwd2'] == "")
      {
         $_SESSION ['error'] = 'Password cannot be blank';
         return;
      }
      // check for matching new passwords
      if (mysqli_real_escape_string ( $link, $_POST ['passwd1'] ) != mysqli_real_escape_string ( $link, $_POST ['passwd2'] ))
      {
         $_SESSION ['error'] = 'Passwords do not match';
         return;
      }
      // change password
      $sql = 'insert into _login (username,name,email,password) value ("'.$_POST ['username'].'","'.$_POST ['teamname'].'","'.$_POST ['email'].'","'.password_hash ( $_POST ['passwd1'], PASSWORD_DEFAULT ).'")';
      print($sql);
      if (! mysqli_query ( $link, $sql ))
      {
         $_SESSION ['error'] = 'something happened';
         //print_r($_SESSION);
      }
      $_SESSION ['message'] = 'User '.$_POST['username'].' successfully created';
   }
   if (isset ( $_POST ['draft_team'] ))
   {
      $dupe = 0;
      // $h is the cleaned value of $_POST["hash"]
      $h = $_POST['hash'];

      if(isset($_SESSION["hash"]) && is_array($_SESSION["hash"]))
      {
         if( in_array($h,$_SESSION["hash"]) )
         {
            // duplicate form submission
            /* REDIRECT SOMEWHERE HERE, PREFERABLY WITH SOME SORT OF MESSAGE! */
            $dupe = 1;
            $_SESSION['page'] = 'rosters';
            $_SESSION['error'] = 'duplicate caught';
         }
         else
         {
            // add this hash to the array
            if(sizeof($_SESSION["hash"]) > 32){ array_shift($_SESSION["hash"]); }
            array_push($_SESSION["hash"],$h);
         }
      }
      else
      {
         // create a hash array and add this hash
         $_SESSION["hash"] = array($h);
      }
      $sql = "select teamRound from tourneyOwnerYear where year_id=2024 and tourney_id=".$_SESSION['activepool'];
      $result = mysqli_query($link,$sql);
      list($status) = mysqli_fetch_row($result);
      if ($dupe==0&&$_SESSION['currentTeamRound'] == $status)
      {
         $_SESSION ['error'] = $_POST['hash'];
         $_SESSION ['message'] = 'You selected ' . $_POST['team_id'];
         $_SESSION['page'] = 'rosters';
         print_r($_SESSION);
         // insert into userTeam
         $sql = "insert into ownerTeam (owner_id,team_id,draft) value (".$_SESSION ['entry'].",".$_POST ['team_id'].",".$_SESSION ['currentTeamRound'].")";
         print($sql);
         if (! mysqli_query ( $link, $sql ))
         {
            $_SESSION ['error'] = 'something happened';
         }
         // increment draft counter
         $newround=$status+1;
         $sql = "update tourneyOwnerYear set teamRound=".$newround." where tourney_id=".$_SESSION['activepool'];
         print($sql);
         if (! mysqli_query ( $link, $sql ))
         {
            $_SESSION ['error'] = 'something happened';
         }
         // email pool
         $subj = 'Draft Pool - Team Update';
         print($subj);
         $msg = 'In round '.ceil($newround/8).', '.$_SESSION['username'].' selected '.get_school($_POST ['team_id'], $link).'. '.get_next_team_draft($newround,$link).' is on the clock.';
         print($subj);
         print($msg);
         send_group_mail($subj, $msg, $link);
      }
      else
      {
         if ($dupe==0)
         {
            $_SESSION ['error'] = 'Wait.';
            $_SESSION ['message'] = '';
            $_SESSION['page'] = 'rosters';
         }
      }
   }
   if (isset ( $_POST ['draft_player'] ))
   {
         $dupe = 0;
      // $h is the cleaned value of $_POST["hash"]
      $h = $_POST['hash'];

      if(isset($_SESSION["hash"]) && is_array($_SESSION["hash"]))
      {
         if( in_array($h,$_SESSION["hash"]) )
         {
            // duplicate form submission
            /* REDIRECT SOMEWHERE HERE, PREFERABLY WITH SOME SORT OF MESSAGE! */
            $dupe = 1;
            $_SESSION['page'] = 'rosters';
            $_SESSION['error'] = 'duplicate caught';
         }
         else
         {
            // add this hash to the array
            if(sizeof($_SESSION["hash"]) > 32){ array_shift($_SESSION["hash"]); }
            array_push($_SESSION["hash"],$h);
         }
      }
      else
      {
         // create a hash array and add this hash
         $_SESSION["hash"] = array($h);
      }
      $sql = "select playerRound from tourneyOwnerYear where year_id=2024 and tourney_id=".$_SESSION['activepool'];
      print($sql);
      $result = mysqli_query($link,$sql);
      list($status) = mysqli_fetch_row($result);
      if ($dupe==0 && $_SESSION['currentPlayerRound'] == $status)
      {
         $_SESSION['page'] = 'rosters';
         // insert into userTeam
         $sql = "insert into ownerPlayer (owner_id,player_id,draft) value (".$_SESSION ['entry'].",".$_POST ['player_id'].",".$_SESSION ['currentPlayerRound'].")";
         print($sql);
         if (! mysqli_query ( $link, $sql ))
         {
            $_SESSION ['error'] = 'something happened';
         }
         // increment draft counter
         $newround=$status+1;
         $sql = "update tourneyOwnerYear set playerRound=".$newround." where tourney_id=".$_SESSION['activepool'];
         print($sql);
         if (! mysqli_query ( $link, $sql ))
         {
            $_SESSION ['error'] = 'something happened';
         }
         // email pool
         $subj = 'Draft Pool - Player Update';
         //print($subj);
         //print(get_player_name($_POST ['player_id'], $link));
         //print(get_player_school($_POST ['player_id'], $link));
         //print(get_next_player_draft($newround,$link));
         $msg = 'In round '.ceil($newround/8).', '.$_SESSION['username'].' selected '.get_player_name($_POST ['player_id'], $link).' of '.get_player_school($_POST ['player_id'], $link).'. '.get_next_player_draft($newround,$link).' is on the clock.';
         //print($msg);
         send_group_mail($subj, $msg, $link);
         //print("made it???");
      }
      else
      {
         if ($dupe==0)
         {
            $_SESSION ['error'] = 'Wait.';
            $_SESSION ['message'] = '';
            $_SESSION['page'] = 'rosters';
         }
      }
   }
   if (isset ( $_POST ['updatepassword'] ))
   {
      $_SESSION ['error'] = '';
      $_SESSION ['message'] = '';
      // check for matching password old
      $sql = "select passcode from user where username='" . $_SESSION ['username'] . "'";
      logger ( $link, $sql );
      $result = mysqli_query ( $link, $sql );
      list ( $hashed ) = mysqli_fetch_row ( $result );

      if (! password_verify ( mysqli_real_escape_string ( $link, $_POST ['orig_pwd'] ), $hashed ))
      {
         $_SESSION ['error'] = 'Old password does not match';
         return;
      }
      if ($_POST ['new_pwd'] == "")
      {
         $_SESSION ['error'] = 'New password cannot be blank';
         return;
      }
      // check for matching new passwords
      if (mysqli_real_escape_string ( $link, $_POST ['new_pwd'] ) != mysqli_real_escape_string ( $link, $_POST ['new_pwd1'] ))
      {
         $_SESSION ['error'] = 'New passwords do not match';
         return;
      }
      // change password
      $sql = 'update user set passcode="' . password_hash ( $_POST ['new_pwd1'], PASSWORD_DEFAULT ) . '" where user_id=' . $_SESSION ['user'];
      logger ( $link, $sql );
      $data = mysqli_query ( $link, $sql );
      if (! mysqli_query ( $link, $sql ))
      {
         logger ( $link, "Error updating record: " . mysqli_error ( $link ) );
      }
      $_SESSION ['message'] = 'Password successfully updated';
   }
   if (isset($_POST['submit_game']))
   {
    //print_r($_POST);
    //print_r($_SESSION);
      $team_id=$_POST['team_id'];
      $tpts=$_POST['tpts'];
      $bpos=$_POST['b_pos'];
      $npos=$_POST['n_pos'];
      $player_id=[];
      if (isset($_POST['bp_pos']))
      {
         $bppos=$_POST['bp_pos'];
         $player_id=$_POST['player_id'];
         $ppts=$_POST['ppts'];
      }
      $team1=$team_id[0];
      $team1b=$bpos[0];
      $team1pts=$tpts[0];
      $team2=$team_id[1];
      $team2b=$bpos[1];
      $team2pts=$tpts[1];
      $next=$npos[0];
      if ($team1pts>$team2pts)
      {
        $sql="insert into teamGame (year_id,team_id,bracket_pos) values(2024,".$team1.",".$next.")";
         $data = mysqli_query ( $link, $sql );
         $sql="update teamGame set points=".$team1pts.",winner=1 where year_id=2024 and bracket_pos=".$team1b." and team_id=".$team1;
         $data = mysqli_query ( $link, $sql );
         $sql="update teamGame set points=".$team2pts.",winner=0 where year_id=2024 and bracket_pos=".$team2b." and team_id=".$team2;
         $data = mysqli_query ( $link, $sql );
        }
      else
      {
        $sql="insert into teamGame (year_id,team_id,bracket_pos) values(2024,".$team2.",".$next.")";
        print($sql);
        $data = mysqli_query ( $link, $sql );
        $sql="update teamGame set points=".$team1pts.",winner=0 where year_id=2024 and bracket_pos=".$team1b." and team_id=".$team1;
        print($sql);
        $data = mysqli_query ( $link, $sql );
        $sql="update teamGame set points=".$team2pts.",winner=1 where year_id=2024 and bracket_pos=".$team2b." and team_id=".$team2;
        print($sql);
        $data = mysqli_query ( $link, $sql );
     }
      $data = mysqli_query ( $link, $sql );
      for ($i=0; $i<count($player_id); $i++)
      {
         $sql = 'insert into playerGame (year_id,player_id,bracket_pos,points) values (2024,'.$player_id[$i].','.$bppos[$i].','.$ppts[$i].')';
         print($sql);
         $data = mysqli_query ( $link, $sql );
      }
      update_user_points($link);
      $_SESSION['page'] = 'bracket';
   }
   if (isset ( $_POST ['set_team_round'] ))
   {
      $sql = 'update keyValue set v="' . $_POST ['tround']. '" where k="currentTeamRound"';
      $data = mysqli_query ( $link, $sql );
      $_SESSION['page'] = 'draft';
      $_SESSION['currentTeamRound'] = $_POST ['tround'];
   }
   if (isset ( $_POST ['set_player_round'] ))
   {
      $sql = 'update keyValue set v="' . $_POST ['pround']. '" where k="currentPlayerRound"';
      $data = mysqli_query ( $link, $sql );
      $_SESSION['page'] = 'draft';
      $_SESSION['currentPlayerRound'] = $_POST ['pround'];
   }
   if (isset ( $_POST ['enter_game'] ))
   {
      $_SESSION['page'] = 'admin';
      $_SESSION['subsubpage'] = 'enter_game';
   }
   if (isset ( $_POST ['change_pass'] ))
   {
      $_SESSION['page'] = 'admin';
      $_SESSION['subsubpage'] = 'change_pass';
   }
   if (isset ( $_POST ['change_pass'] ))
   {
      update_password($_POST['user_id'],$_POST['newpass'],$link);
//      echo 'xxx '.$_POST['user_id'].' yyy '.$_POST['newpass'];
      //$_SESSION ['page'] = 'rules';
   }
   if (isset($_POST['createpool']))
   {
    if ($_POST ['passwd1'] == "" || $_POST ['passwd2'] == "")
    {
       $_SESSION ['error'] = 'Password cannot be blank';
       return;
    }
    // check for matching new passwords
    if (mysqli_real_escape_string ( $link, $_POST ['passwd1'] ) != mysqli_real_escape_string ( $link, $_POST ['passwd2'] ))
    {
       $_SESSION ['error'] = 'Passwords do not match';
       return;
    }
    // create new tournament
    $sql = 'insert into tourneyOwnerYear (login_id,name,year_id,password) value ('.$_SESSION ['user'].',"'.$_POST ['poolname'].'",2024,"'.password_hash ( $_POST ['passwd1'], PASSWORD_DEFAULT ).'")';
    print($sql);
    if (! mysqli_query ( $link, $sql ))
    {
       $_SESSION ['error'] = 'something happened';
       //print_r($_SESSION);
    }
    $_SESSION['poolowner'] = mysqli_insert_id($link);
    $sql = "insert into entry (login_id,tourney_id,name) values (".$_SESSION ['user'].",".$_SESSION['poolowner'].",\"".$_POST['poolname']." Entry\")";
    print($sql);
    if (! mysqli_query ( $link, $sql ))
    {
       $_SESSION ['error'] = 'something happened';
       //print_r($_SESSION);
    }
   }
   if (isset($_POST['joinpool']))
   {
    //print_r($_POST);
    $mypassword = mysqli_real_escape_string($link,$_POST['passwd1']);
    print($mypassword);
    $sql = "select tourney_id,name,password from tourneyOwnerYear where name=\"".$_POST['poolname']."\"";
    print($sql);
    // //logger($link,$sql);
    $result = mysqli_query($link,$sql);
    list($tourney,$name,$hashed) = mysqli_fetch_row($result);
    print($hashed);

    if(password_verify($mypassword,$hashed))
    {
        $sql = "insert into entry (login_id,tourney_id,name) values (".$_SESSION ['user'].",".$tourney.",\"".$_SESSION['username']." Entry\")";
        print($sql);
        if (! mysqli_query ( $link, $sql ))
        {
            $_SESSION ['error'] = 'something happened';
            //print_r($_SESSION);
        }
        $_SESSION['poolentry'] = mysqli_insert_id($link);
    } else {
        $_SESSION ['error'] = 'Passwords do not match';
        return;
    }
   }
}
function set_page()
{
   if (isset($_POST['bracketform']))
   {
    $_SESSION['page']='setbracket';
    $_SESSION['subpage']='enter_teams';
   }
   if (isset($_POST['setregion']))
   {
      $_SESSION['page']='setregion';
   }
   if (isset($_POST['setbracket']))
   {
      $_SESSION['page']='setbracket';
   }
   if (isset($_POST['setfirstfour']))
   {
      $_SESSION['page']='setfirstfour';
   }
   if (isset($_POST['scoregame']))
   {
      $_SESSION['page']='scoregame';
   }
   if (isset($_POST['enter_game_nitrambo']))
   {
    //print_r($_POST);
    $_SESSION['page']='scoregame';
    $_SESSION['subpage']='enterscores';
   }
   if (isset($_POST['pools']))
   {
    $_SESSION['page']='pools';
    //print_r($_POST);
    //print_r($_SESSION);
   }
   if (isset ( $_POST ['admin'] ))
   {
      $_SESSION ['page'] = 'admin';
   }
   if (isset ( $_POST ['bracket'] ))
   {
      $_SESSION ['page'] = 'bracket';
      //header("Location: /NCAAFFDraftPool/dev");
   }
   if (isset ( $_POST ['register'] ))
   {
      $_SESSION ['page'] = 'register';
   }
   if (isset ( $_POST ['rules'] ))
   {
      $_SESSION ['page'] = 'rules';
      //header("Location: /NCAAFFDraftPool/dev");
   }
   if (isset ( $_POST ['stats'] ))
   {
      logit("heading to stats");
      $_SESSION ['page'] = 'results';
      $_SESSION ['subpage'] = 'stats';
      //header("Location: /NCAAFFDraftPool/dev");
   }
   if (isset ( $_POST ['leader'] ))
   {
      logit("heading to leader");
   	  $_SESSION ['page'] = 'results';
      $_SESSION ['subpage'] = 'leader';
      //header("Location: /NCAAFFDraftPool/dev");
   }
   if (isset ( $_POST ['results'] ))
   {
      logit("heading to results");
   	  $_SESSION ['page'] = 'results';
      //header("Location: /NCAAFFDraftPool/dev");
   }
   if (isset ( $_POST ['playerresults'] ))
   {
      logit("heading to playerresults");
   	  $_SESSION ['page'] = 'results';
      $_SESSION ['subpage'] = 'playerresults';
      //header("Location: /NCAAFFDraftPool/dev");
   }
   if (isset ( $_POST ['teamresults'] ))
   {
      $_SESSION ['page'] = 'results';
      $_SESSION ['subpage'] = 'teamresults';
      //header("Location: /NCAAFFDraftPool/dev");
   }
   if (isset ( $_POST ['teams'] ))
   {
      $_SESSION ['page'] = 'teams';
   }
   if (isset ( $_POST ['players'] ))
   {
      $_SESSION ['page'] = 'players';
   }
   if (isset ( $_POST ['teamplayers'] ))
   {
      $_SESSION ['page'] = 'teamplayers';
   }
   if (isset ( $_POST ['res2001'] ))
   {
      $_SESSION ['page'] = 'res2001';
   }
   if (isset ( $_POST ['res2000'] ))
   {
      $_SESSION ['page'] = 'res2000';
   }
   if (isset ( $_POST ['login'] ))
   {
      $_SESSION ['page'] = 'login';
   }
   if (isset ( $_POST ['rosters'] ))
   {
      $_SESSION ['page'] = 'rosters';
      //header("Location: /NCAAFFDraftPool/dev");
   }
   if (isset ( $_POST ['teamdraft'] ) )
   {
      if (isset($_SESSION['user']))
      {
         $_SESSION ['page'] = 'teamdraft';
      }
      else
      {
         $_SESSION['message'] = "Please login";
         $_SESSION ['page'] = 'rules';
      }
   }
   if (isset ( $_POST ['playerdraft'] ))
   {
      if (isset($_SESSION['user']))
      {
         $_SESSION ['page'] = 'playerdraft';
      }
      else
      {
         $_SESSION['message'] = "Please login";
         $_SESSION ['page'] = 'rules';
      }
   }
   if (isset($_POST['playertopscore_sub']))
   {
      $_SESSION ['page'] = 'playerdraft';
      $_SESSION['subpage'] = 'playertopscore_sub';
   }
   if (isset($_POST['playertopseed_sub']))
   {
      $_SESSION ['page'] = 'playerdraft';
      $_SESSION['subpage'] = 'playertopseed_sub';
   }
   if (isset($_POST['playernamesearch_sub']))
   {
      $_SESSION ['page'] = 'playerdraft';
      $_SESSION['subpage'] = 'playernamesearch_sub';
   }
   if (isset($_POST['t12']))
   {
      $_SESSION ['page'] = 'playerdraft';
      $_SESSION['subpage'] = 'playertopseed_sub';
      $_SESSION['subsubpage']='t12';
   }
   if (isset($_POST['t34']))
   {
      $_SESSION ['page'] = 'playerdraft';
      $_SESSION['subpage'] = 'playertopseed_sub';
      $_SESSION['subsubpage']='t34';
   }
   if (isset($_POST['t56']))
   {
      $_SESSION ['page'] = 'playerdraft';
      $_SESSION['subpage'] = 'playertopseed_sub';
      $_SESSION['subsubpage']='t56';
   }
   if (isset($_POST['t78']))
   {
      $_SESSION ['page'] = 'playerdraft';
      $_SESSION['subpage'] = 'playertopseed_sub';
      $_SESSION['subsubpage']='t78';
   }
   if (isset($_POST['player_name_search']))
   {
      $_SESSION ['page'] = 'playerdraft';
      $_SESSION['subpage'] = 'playernamesearch_sub';
      $_SESSION['subsubpage']='player_name_search';
   }
   if (isset($_POST['adminsettrnd']))
   {
      $_SESSION ['page'] = 'admin';
      $_SESSION['subpage'] = 'adminsettrnd';
   }
   if (isset($_POST['adminsetprnd']))
   {
      $_SESSION ['page'] = 'admin';
      $_SESSION['subpage'] = 'adminsetprnd';
   }
   if (isset($_POST['adminentergame']))
   {
      $_SESSION ['page'] = 'admin';
      $_SESSION['subpage'] = 'adminentergame';
   }
   if (isset($_POST['adminchangepass']))
   {
      $_SESSION ['page'] = 'admin';
      $_SESSION['subpage'] = 'adminchangepass';
   }
   if (isset ( $_POST ['draft'] ))
   {
      $_SESSION ['page'] = 'draft';
   }
   if (isset ( $_POST ['adminsetlive'] ))
   {
      $_SESSION['status'] = 'LIVE';
      $_SESSION ['page'] = 'setstatus';
   }
   if (isset ( $_POST ['adminsetdraft'] ))
   {
      $_SESSION['status'] = 'DRAFT';
      $_SESSION ['page'] = 'setstatus';
   }
   if (isset ( $_POST ['adminsetpre'] ))
   {
      $_SESSION['status'] = 'PREDRAFT';
      $_SESSION ['page'] = 'setstatus';
   }
}
function print_blank()
{
   echo '<h3><font color="red">'.$_SESSION['error'].'</font>'.$_SESSION['message'].'</h3>';
   echo '<br><br><br><br><br><br><br><br><br><br><br><br><br>';
   echo '<br><br><br><br><br><br><br><br><br><br><br><br><br>';
}
function get_player_name($id,$link)
{
   $sql = "select name from player where player_id=".$id;
   $data = mysqli_query ( $link, $sql );
   list ($name ) = mysqli_fetch_row ( $data );
   return $name;
}
function get_player_school($id,$link)
{
   $school='';
   if ($id!='')
   {
      $sql = "select school from player p join team t on p.team_id=t.team_id where player_id=".$id;
      $data = mysqli_query ( $link, $sql );
      list ($school ) = mysqli_fetch_row ( $data );
   }
   return $school;
}
function get_school($id,$link)
{
   $sql = "select school from team where team_id=".$id;
   $data = mysqli_query ( $link, $sql );
   list ($school ) = mysqli_fetch_row ( $data );
   return $school;
}
function update_password($uid,$pass,$link)
{
   $sql = 'update user set password="'.password_hash($pass, PASSWORD_DEFAULT).'" where user_id='.$uid;
   if (! mysqli_query ( $link, $sql ))
   {
      $_SESSION ['error'] = 'something happened '.$sql;
   }
   $_SESSION ['message'] = 'User '.$uid.' successfully updated';
}
function logit($string)
{
	if (empty ( $_SESSION ['user'] ))
	{
		$message=$_SESSION['SID'].' - '.$_SESSION['status'].' - anon(-99) - '.$string;
	}
	else
	{
		$message=$_SESSION["hash"].' - '.$_SESSION['SID'].' - '.$_SESSION['status'].' - '.$_SESSION['username'].'('.$_SESSION['user'].')- '.$string;
	}
	error_log($message);
}
?>