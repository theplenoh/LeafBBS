<?php
require_once "common.php";

$posted_by = sanitize($_POST['name']);
$password = sanitize($_POST['password']);
$email = sanitize($_POST['email']);
$title = sanitize($_POST['title']);
$content = sanitize($_POST['content']);
$ip_addr = $_SERVER['REMOTE_ADDR'];

if (empty($_POST['name'])) error_message("There was no name value passed.");
if (empty($_POST['password'])) error_message("There was no password value passed.");
if (empty($_POST['title'])) error_message("There was no title value passed.");
if (empty($_POST['content'])) error_message("There was no content value passed.");

require_once $path."db_connect.php";

// Get the value of max_thread
$query = "SELECT max(thread) FROM {$board_name}";
$max_thread_result = mysqli_query($conn, $query);
$max_thread_fetch = mysqli_fetch_row($max_thread_result);
$max_thread = ceil($max_thread_fetch[0]/1000)*1000 + 1000;

$query = "INSERT INTO {$board_name} (thread, depth, name, password, email, title, views, datetime, ipaddr, content) ";
$query.= "VALUES ({$max_thread}, 0, '{$posted_by}', '{$password}', '{$email}', '{$title}', 0, UNIX_TIMESTAMP(), '{$ip_addr}', '{$content}')";

mysqli_query($conn, $query) or error_message("Failed to save the post in the database.");

// MySQL connection close
mysqli_close($conn);

$success = true;
?>
<script>
if (<?=$success?>)
{
    alert("Successfully submitted!");
    location.href="<?=$path?>list.php";
}
</script>
