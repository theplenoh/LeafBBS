<?php
require_once "common.php";

require_once $path."db_connect.php";

// Get the value of max_thread
$query = "SELECT max(thread) FROM {$board_name}";
$max_thread_result = mysqli_query($conn, $query);
$max_thread_fetch = mysqli_fetch_row($max_thread_result);
$max_thread = ceil($max_thread_fetch[0]/1000)*1000 + 1000;

$query = "INSERT INTO {$board_name} (thread, depth, name, password, email, title, views, datetime, ipaddr, content) ";
$query.= "VALUES ({$max_thread}, 0, '{$_POST[name]}', '{$_POST[password]}', '{$_POST[email]}', '{$_POST[title]}', 0, UNIX_TIMESTAMP(), '{$_SERVER[REMOTE_ADDR]}', '{$_POST[content]}')";
$result = mysqli_query($conn, $query);

// MySQL connection close
mysqli_close($conn);

$success = true;
?>
<script>
if (<?=$success?>) {
    alert("Successfully submitted!");
    window.location.href="<?=$path?>list.php";
}
</script>
