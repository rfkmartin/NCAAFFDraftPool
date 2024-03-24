<?php
   $db_host = '127.0.0.1'; // don't forget to change
   $db_user = 'root';
   $db_pwd = 'abc123';
   $database = 'ncaa2024';
   $link = mysqli_connect($db_host,$db_user,$db_pwd);
   if (!$link)
   {
      die("Can't connect to database");
   }
   if (!mysqli_select_db($link,$database))
   {
      die("Can't select database");
   }
?>