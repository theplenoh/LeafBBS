<?php
require_once "common.php";
$page_title = "Delete Post";

require_once $path."db_connect.php";

$postID = $_GET['id'];
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="<?=$charset?>">
    <title><?=$page_title?> :: <?=$site_title?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="<?=$path?>style.css">
</head>
<body>
<div id="container">
<h1>Password Confirm before Deleting</h1>
<form action="<?=$path?>del.php?id=<?=$postID?>" method="post">
<dl>
    <dt>Password</dt>
    <dd>
        <input type="password" name="password" size="16">
    </dd>
</dl>
<p>
    <input type="submit" value="Confirm">
    <a href="<?=$path?>list.php">Cancel</a>
</p>
</form>
</div>
</body>
</html>
