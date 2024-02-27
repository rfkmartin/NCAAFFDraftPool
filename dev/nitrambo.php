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
include("results.php");
set_timezone ();
process_forms ( $link );
include ("body_nitrambo.php");
print_header ();
print_body ( $link );
print_footer ();
?>