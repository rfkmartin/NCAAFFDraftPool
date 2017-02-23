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
   echo '<button ' . isBtnSelected ( 'register' ) . 'name="register">Register</button>';
   echo ' | <button ' . isBtnSelected ( 'rules' ) . 'name="rules">Rules</button>';
   echo ' | <button ' . isBtnSelected ( 'teams' ) . 'name="teams">Top Teams</button>';
   echo ' | <button ' . isBtnSelected ( 'players' ) . 'name="players">Top Players</button>';
   echo ' | <button ' . isBtnSelected ( 'teamplayers' ) . 'name="teamplayers">Top Teams\' Players</button>';
   echo ' | <button ' . isBtnSelected ( 'res2000' ) . 'name="res2000">Results from 2000</button>';
   echo ' | <button ' . isBtnSelected ( 'res2001' ) . 'name="res2001">Results from 2001</button>';
   echo '</td></tr>';
   echo '</form>';
   echo '<tr><td class="nonmenu">&nbsp;</td></tr>';
   echo '<tr><td class="nonmenu">&nbsp;';
}
function isBtnSelected($page)
{
   if ($page == $_SESSION ['page'])
   {
      return 'class="selected" ';
   }
   elseif ($page == $_SESSION ['page'])
   {
      return 'class="selected" ';
   }
   elseif ($page == $_SESSION ['page'])
   {
      return 'class="selected" ';
   }
   elseif ($page == $_SESSION ['page'])
   {
      return 'class="selected" ';
   }
   elseif ($page == $_SESSION ['page'])
   {
      return 'class="selected" ';
   }
   elseif ($page == $_SESSION ['page'])
   {
      return 'class="selected" ';
   }
   elseif ($page == $_SESSION ['page'])
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
   echo '<form action = "" method = "post">';
   echo '<table><tr><td align="left">Username:</td><td><input type = "text" name = "username"></td></tr>';
   echo '<tr><td align="left">Password:</td><td><input type = "password" name = "password"></td></tr></table>';
   // echo 'Welcome, <span class="person">Nobody</span><br>';
   echo '<input type="submit" name="login" value="Log In"><form>';
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
   echo '<tr><td width="175px"><b>Team Name</b></td>';
   echo '<td width="175px"><input type="text" name="teamname" size="45"></td></tr>';
   echo '<tr><td width="175px"><b>Email</b></td>';
   echo '<td width="175px"><input type="text" name="email" size="45"></td>';
   echo '</tr></table>';
   echo '<input type="submit" name="registernewuser" value="Register">';
}
function process_forms($link)
{
   $_SESSION['page']='';
   $_SESSION['error']='';
   $_SESSION['message']='';
   set_page();
   // set isAdmin
   // set status
   if (isset ( $_POST ['logout'] ))
   {
      session_destroy ();
      unset ( $_SESSION ['page'] );
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
      //logger ( $link, $sql );
      if (! mysqli_query ( $link, $sql ))
      {
         //logger ( $link, "Error inserting record: " . mysqli_error ( $link ) );
         $_SESSION ['error'] = 'something happened';
      }
      $_SESSION ['message'] = 'User '.$_POST['username'].' successfully created';      
   }
   if (isset ( $_POST ['updateusername'] ))
   {
      $_SESSION ['error'] = '';
      $_SESSION ['message'] = '';
      // check for duplicate username
      $sql = 'select * from user u where u.username="' . $_POST ['username'] . '"';
      logger ( $link, $sql );
      $data = mysqli_query ( $link, $sql );
      if (mysqli_num_rows ( $data ) > 0)
      {
         $_SESSION ['error'] = 'Username already taken';
         return;
      }
      // change username
      $sql = 'update user set username="' . $_POST ['username'] . '" where user_id=' . $_SESSION ['user'];
      logger ( $link, $sql );
      $data = mysqli_query ( $link, $sql );
      if (! mysqli_query ( $link, $sql ))
      {
         logger ( $link, "Error updating record: " . mysqli_error ( $link ) );
      }
      $_SESSION ['message'] = 'Username successfully changed';
      $_SESSION ['username'] = $_POST ['username'];
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
   // add none option
   if (isset ( $_POST ['bringingfood'] ))
   {
      // clear food if changing pick
      $sql = 'update food_for_event set family_id=null,notes=null where event_id=' . $_SESSION ['event_id'] . ' and family_id=' . $_SESSION ['family_id'];
      logger ( $link, $sql );
      if (! mysqli_query ( $link, $sql ))
      {
         logger ( $link, "Error deleting record: " . mysqli_error ( $link ) );
      }
      $food_id = $_POST ['bringing'];
      if ($food_id != - 1)
      {
         $sql = 'update food_for_event set family_id=' . $_SESSION ['family_id'] . ',notes="' . $_POST ['notes'] . '" where food_id=' . $food_id . ' and event_id=' . $_SESSION ['event_id'];
         logger ( $link, $sql );
         if (! mysqli_query ( $link, $sql ))
         {
            logger ( $link, "Error inserting record: " . mysqli_error ( $link ) );
         }
      }
   }
}
function set_page()
{
   if (isset ( $_POST ['register'] ))
   {
      $_SESSION ['page'] = 'register';
   }
   if (isset ( $_POST ['rules'] ))
   {
      $_SESSION ['page'] = 'rules';
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
}
?>