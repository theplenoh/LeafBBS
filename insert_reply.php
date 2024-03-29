<?php
require_once "common.php";

require_once $path."db_connect.php";

$parent_thread = $_POST['parent_thread'];
$parent_depth = $_POST['parent_depth'];
$posted_by = sanitize($_POST['name']);
$password = sanitize($_POST['password']);
$email = sanitize($_POST['email']);
$title = sanitize($_POST['title']);
$content = sanitize($_POST['content']);
$ip_addr = $_SERVER['REMOTE_ADDR'];

if (empty($posted_by)) error_message("There was no name value passed.");
if (empty($password)) error_message("There was no password value passed.");
if (empty($title)) error_message("There was no title value passed.");
if (empty($content)) error_message("There was no content value passed.");

$prev_parent_thread = ceil($parent_thread/1000)*1000 - 1000;

$query = "UPDATE {$board_name} SET thread=thread - 1 WHERE thread > {$prev_parent_thread} and thread < {$parent_thread}";
$update_thread = mysqli_query($conn, $query);

$query = "INSERT INTO {$board_name} (thread, depth, name, password, email, title, views, datetime, ipaddr, content) ";
$query.= "VALUES ('".($parent_thread-1)."'";
$query.= ",'".($parent_depth+1)."','{$posted_by}','{$password}','{$email}','{$title}', 0, UNIX_TIMESTAMP(), '{$ip_addr}', '{$content}')";

mysqli_query($conn, $query) or error_message("Failed to save the reply in the database.");

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
