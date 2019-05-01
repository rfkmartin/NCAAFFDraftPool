<?php
function print_header()
{
   echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">';
   echo '<html><head>';
   echo '<title>NCAA Final Four Draft Pool</title>';
   echo '<link href="/NCAAFFDraftPool/dev/style.css" rel="stylesheet" type="text/css">';
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
         echo '<tr><td class="nonmenu">&nbsp;';
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
      echo '<button ' . isBtnSelected ( 'register' ) . 'name="register">Register</button>';
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
         echo '<button ' . isBtnSelected ( 'logout' ) . 'name="logout">Logout</button>';
      }
      echo ' | <button ' . isBtnSelected ( 'rules' ) . 'name="rules">Rules</button>';
      echo ' | <button ' . isBtnSelected ( 'teamdraft' ) . 'name="teamdraft">Team Draft</button>';
      echo ' | <button ' . isBtnSelected ( 'playerdraft' ) . 'name="playerdraft">Player Draft</button>';
      echo ' | <button ' . isBtnSelected ( 'draft' ) . 'name="draft">Draft Order</button>';
      echo ' | <button ' . isBtnSelected ( 'rosters' ) . 'name="rosters">Rosters</button>';
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
function register_account($link)
{
   echo '<h3><font color="red">'.$_SESSION['error'].'</font>'.$_SESSION['message'].'</h3>';
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
   echo '<input type="submit" name="registernewuser" value="Register">';
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
	$sql = "select v from keyValue where k='currentPlayerRound'";
	$result = mysqli_query($link,$sql);
	list($status) = mysqli_fetch_row($result);
	$_SESSION['currentPlayerRound'] = $status;
	$sql = "select v from keyValue where k='currentTeamRound'";
	$result = mysqli_query($link,$sql);
	list($status) = mysqli_fetch_row($result);
	$_SESSION['currentTeamRound'] = $status;
	$sql = "select team_order from draft where draft_pos=".$_SESSION['currentTeamRound'];
	$result = mysqli_query($link,$sql);
	list($status) = mysqli_fetch_row($result);
	$_SESSION['currentroundteam'] = $status;
	$sql = "select player_order from draft where draft_pos=".$_SESSION['currentPlayerRound'];
	$result = mysqli_query($link,$sql);
	list($status) = mysqli_fetch_row($result);
	$_SESSION['currentroundplayer'] = $status;

	set_page();

	if (isset($_POST['loginform']))
	{
		$myusername = mysqli_real_escape_string($link,$_POST['username']);
		$mypassword = mysqli_real_escape_string($link,$_POST['password']);
		$sql = "select user_id,name,team_name,is_admin,password from user where name='".$myusername."'";
		//logger($link,$sql);
		$result = mysqli_query($link,$sql);
		list($user,$name,$team_name,$is_admin,$hashed) = mysqli_fetch_row($result);

		if(password_verify($mypassword,$hashed))
		{
			$_SESSION['user']=$user;
			$_SESSION['username']=$name;
			$_SESSION['teamname']=$team_name;
			$_SESSION['admin']=$is_admin;
			$_SESSION['page'] = 'rules';
			logit("logging in");
		}
		else
		{
			$_SESSION['error'] = "Your Login Name or Password is invalid ".$sql;
			$_SESSION['page'] = 'login';
		}
	}
   if (isset ( $_POST ['logout'] ))
   {
      $_SESSION ['admin'] = 0;
      unset ( $_SESSION ['user'] );
   }
   if (isset ( $_POST ['registernewuser'] ))
   {
      $_SESSION ['error'] = '';
      $_SESSION ['message'] = '';
      $_SESSION ['page'] = 'register';
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
      $sql = 'insert into user (name,team_name,email,password) value ("'.$_POST ['username'].'","'.$_POST ['teamname'].'","'.$_POST ['email'].'","'.password_hash ( $_POST ['passwd1'], PASSWORD_DEFAULT ).'")';
      if (! mysqli_query ( $link, $sql ))
      {
         $_SESSION ['error'] = 'something happened';
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
      $sql = "select v from keyValue where k='currentTeamRound'";
      $result = mysqli_query($link,$sql);
      list($status) = mysqli_fetch_row($result);
      if ($dupe==0&&$_SESSION['currentTeamRound'] == $status)
      {
         $_SESSION ['error'] = $_POST['hash'];
         $_SESSION ['message'] = 'You selected ' . $_POST['team_id'];
         $_SESSION['page'] = 'rosters';
         // insert into userTeam
         $sql = "insert into userTeam (user_id,team_id,draft) value (".$_SESSION ['user'].",".$_POST ['team_id'].",".$_SESSION ['currentTeamRound'].")";
         if (! mysqli_query ( $link, $sql ))
         {
            $_SESSION ['error'] = 'something happened';
         }
         // increment draft counter
         $newround=$_SESSION['currentTeamRound']+1;
         $sql = "update keyValue set v='".$newround."' where k='currentTeamRound'";
         if (! mysqli_query ( $link, $sql ))
         {
            $_SESSION ['error'] = 'something happened';
         }
         // email pool
         $subj = 'Draft Pool - Team Update';
         $msg = 'In round '.ceil($newround/8).', '.$_SESSION['teamname'].' selected '.get_school($_POST ['team_id'], $link).'. '.get_next_team_draft($newround,$link).' is on the clock.';
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
      $sql = "select v from keyValue where k='currentPlayerRound'";
      $result = mysqli_query($link,$sql);
      list($status) = mysqli_fetch_row($result);
      if ($dupe==0 && $_SESSION['currentPlayerRound'] == $status)
      {
         $_SESSION['page'] = 'rosters';
         // insert into userTeam
         $sql = "insert into userPlayer (user_id,player_id,draft) value (".$_SESSION ['user'].",".$_POST ['player_id'].",".$_SESSION ['currentPlayerRound'].")";
         if (! mysqli_query ( $link, $sql ))
         {
            $_SESSION ['error'] = 'something happened';
         }
         // increment draft counter
         $newround=$_SESSION['currentPlayerRound']+1;
         $sql = "update keyValue set v='".$newround."' where k='currentPlayerRound'";
         if (! mysqli_query ( $link, $sql ))
         {
            $_SESSION ['error'] = 'something happened';
         }
         // email pool
         $subj = 'Draft Pool - Player Update';
         $msg = 'In round '.ceil($newround/8).', '.$_SESSION['teamname'].' selected '.get_player_name($_POST ['player_id'], $link).' of '.get_player_school($_POST ['player_id'], $link).'. '.get_next_player_draft($newround,$link).' is on the clock.';
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
      $tmw1=',0';$tmw2=',0';
      if ($team1pts>$team2pts)
      {
         $sql = 'update bracket set team_id='.$team1.' where bracket_pos='.$next;
         //echo $sql;
         $data = mysqli_query ( $link, $sql );
         $tmw1=',1';
      }
      else
      {
         $sql = 'update bracket set team_id='.$team2.' where bracket_pos='.$next;
         //echo $sql;
         $data = mysqli_query ( $link, $sql );
         $tmw2=',1';
      }
      $sql = 'insert into teamgame (team_id,bracket_pos,points,winner) values ('.$team1.','.$team1b.','.$team1pts.$tmw1.')';
      //echo $sql;
      $data = mysqli_query ( $link, $sql );
      $sql = 'insert into teamgame (team_id,bracket_pos,points,winner) values ('.$team2.','.$team2b.','.$team2pts.$tmw2.')';
      //echo $sql;
      $data = mysqli_query ( $link, $sql );
      for ($i=0; $i<count($player_id); $i++)
      {
         $sql = 'insert into playergame (player_id,bracket_pos,points) values ('.$player_id[$i].','.$bppos[$i].','.$ppts[$i].')';
         //echo $sql;
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
}
function set_page()
{
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