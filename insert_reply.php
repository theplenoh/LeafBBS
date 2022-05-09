<?php
require_once "common.php";

require_once $path."db_connect.php";

$parent_thread = $_POST['parent_thread'];
$parent_depth = $_POST['parent_depth'];
$posted_by = $_POST['name'];
$password = $_POST['password'];
$email = $_POST['email'];
$title = $_POST['title'];
$ip_addr = $_SERVER['REMOTE_ADDR'];
$content = $_POST['content'];

$prev_parent_thread = ceil($parent_thread/1000)*1000 - 1000;

$query = "UPDATE {$board_name} SET thread=thread - 1 WHERE thread > {$prev_parent_thread} and thread < {$parent_thread}";
$update_thread = mysqli_query($conn, $query);

$query = "INSERT INTO {$board_name} (thread, depth, name, password, email, title, views, datetime, ipaddr, content) ";
$query.= "VALUES ('".($parent_thread-1)."'";
$query.= ",'".($parent_depth+1)."','{$posted_by}','{$password}','{$email}','{$title}', 0, UNIX_TIMESTAMP(), '{$ip_addr}', '{$content}')";
//$result = mysqli_query($conn, $query);
if (mysqli_query($conn, $query))
{
    echo "Successfully submitted!";
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
