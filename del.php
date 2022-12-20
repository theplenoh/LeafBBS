<?php
require_once "common.php";

if(empty($_POST['password'])) error_message("There was no password value passed.");

require_once $path."db_connect.php";

$postID = $_GET['post_id'];
$password = $_POST['password'];

$result = mysqli_query($conn, "SELECT password FROM {$board_name} WHERE postID={$postID}");
$row = mysqli_fetch_array($result);

if ($password == $row['password'])
{
    $query = "DELETE FROM {$board_name} WHERE postID={$postID}";
    $result = mysqli_query($conn, $query);

    $success = true;
}
else
{
    error_message("Wrong password!");
}
?>
<script>
if (<?=$success?>)
{
alert("Successfully deleted!");
location.href="<?=$path?>list.php";
}
</script>
