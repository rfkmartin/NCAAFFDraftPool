<?php
function set_status($status,$link)
{
   $sql = 'update keyValue set v="'.$status.'" where k="status"';
   echo $sql;
   $data = mysqli_query ( $link, $sql );
   header("Location: index.php");
}
?>