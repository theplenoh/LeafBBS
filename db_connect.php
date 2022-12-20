<?php
require_once "common.php";
require_once "db_info.php";

$conn = @mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME) or die("Cannot connect to the database");
mysqli_query($conn, "SET NAMES utf8");
?>
