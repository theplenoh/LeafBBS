<?php
require_once "common.php";

if (!isset($_POST['name'])) error_message("There was no name value passed.");
if (!isset($_POST['password'])) error_message("There was no password value passed.");
if (!isset($_POST['title'])) error_message("There was no title value passed.");
if (!isset($_POST['content'])) error_message("There was no content value passed.");

require_once $path."db_connect.php";

$postID = $_GET['post_id'];
$password = sanitize($_POST['password']);
$posted_by = sanitize($_POST['name']);
$email = sanitize($_POST['email']);
$title = sanitize($_POST['title']);
$content = sanitize($_POST['content']);

$result = mysqli_query($conn, "SELECT password FROM {$board_name} WHERE postID={$postID}");
$row = mysqli_fetch_array($result);

if ($password == $row['password'])
{
    $query = "UPDATE {$board_name} SET name='{$posted_by}', email='{$email}', title='{$title}', content='{$content}' WHERE postID={$postID}";
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
    alert("Successfully edited!");
    location.href="<?=$path?>view.php?post_id=<?=$postID?>";
}
</script>
