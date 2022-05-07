<?php
require_once "common.php";

require_once $path."db_connect.php";

$posted_by = sanitize($_POST['name']);
$password = sanitize($_POST['password']);
$email = sanitize($_POST['email']);
$title = sanitize($_POST['title']);
$content = filter(sanitize($_POST['content']));
$ip_addr = $_SERVER[REMOTE_ADDR];

// Get the value of max_thread
$query = "SELECT max(thread) FROM {$board_name}";
$max_thread_result = mysqli_query($conn, $query);
$max_thread_fetch = mysqli_fetch_row($max_thread_result);
$max_thread = ceil($max_thread_fetch[0]/1000)*1000 + 1000;

$query = "INSERT INTO {$board_name} (thread, depth, name, password, email, title, views, datetime, ipaddr, content) ";
$query.= "VALUES ({$max_thread}, 0, '{$posted_by}', '{$password}', '{$email}', '{$title}', 0, UNIX_TIMESTAMP(), '{$ip_addr}', '{$content}')";
//$result = mysqli_query($conn, $query);
if (mysqli_query($conn, $query)) {
    echo "Successfully submitted!";
}
else {
    echo mysqli_error($conn);
}

// MySQL connection close
mysqli_close($conn);

$success = true;
?>
<script>
if (<?=$success?>) {
    alert("Successfully submitted!");
    location.href="<?=$path?>list.php";
}
</script>
