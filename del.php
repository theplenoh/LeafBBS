<?php
require_once "common.php";

require_once $path."db_connect.php";

$postID = $_GET['post_id'];
$password = sanitize($_POST['password']);

if (empty($password)) error_message("There was no password value passed.");

$result = mysqli_query($conn, "SELECT password FROM {$board_name} WHERE postID={$postID}");
$row = mysqli_fetch_array($result);

if ($password == $row['password'])
{
    $query = "DELETE FROM {$board_name} WHERE postID={$postID}";
    mysqli_query($conn, $query) or error_message("Failed to delete the post.");

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
