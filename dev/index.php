<?php
session_start ();
$_SESSION ['SID'] = session_id ();
require_once ("login.php");
include ("utils.php");
include ("past.php");
include ("bracket.php");
include ("draft.php");
include("roster.php");
include("mail.php");
include("admin.php");
set_timezone ();
process_forms ( $link );
include ("body.php");
print_header ();
print_body ( $link );
print_footer ();
?>