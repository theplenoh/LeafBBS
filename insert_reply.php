<?php
require_once "common.php";

if (empty($_POST['name'])) error_message("There was no name value passed.");
if (empty($_POST['password'])) error_message("There was no password value passed.");
if (empty($_POST['title'])) error_message("There was no title value passed.");
if (empty($_POST['content'])) error_message("There was no content value passed.");

require_once $path."db_connect.php";

$parent_thread = $_POST['parent_thread'];
$parent_depth = $_POST['parent_depth'];
$posted_by = sanitize($_POST['name']);
$password = sanitize($_POST['password']);
$email = sanitize($_POST['email']);
$title = sanitize($_POST['title']);
$ip_addr = $_SERVER['REMOTE_ADDR'];
$content = sanitize($_POST['content']);

$prev_parent_thread = ceil($parent_thread/1000)*1000 - 1000;

$query = "UPDATE {$board_name} SET thread=thread - 1 WHERE thread > {$prev_parent_thread} and thread < {$parent_thread}";
$update_thread = mysqli_query($conn, $query);

$query = "INSERT INTO {$board_name} (thread, depth, name, password, email, title, views, datetime, ipaddr, content) ";
$query.= "VALUES ('".($parent_thread-1)."'";
$query.= ",'".($parent_depth+1)."','{$posted_by}','{$password}','{$email}','{$title}', 0, UNIX_TIMESTAMP(), '{$ip_addr}', '{$content}')";
//$result = mysqli_query($conn, $query);
if (mysqli_query($conn, $query))
{
}
else
{
    echo mysqli_error($conn);
}

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
