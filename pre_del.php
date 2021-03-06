<?php
require_once "common.php";
$page_title = "Delete Post";

require_once $path."db_connect.php";

$postID = $_GET['post_id'];
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="<?=$charset?>">
    <title><?=$page_title?> :: <?=$site_title?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="<?=$path?>styles/<?=$skin_name?>/style.css">
</head>
<body>
<div id="leaf">
<h1>Password Confirm before Deleting</h1>
<form action="<?=$path?>del.php?post_id=<?=$postID?>" method="post">
<dl>
    <dt>Password</dt>
    <dd>
        <input type="password" name="password" size="16">
    </dd>
</dl>
<p>
    <input type="submit" value="Confirm">
    <a href="<?=$path?>view.php?post_id=<?=$postID?>">Cancel</a>
</p>
</form>
</div>
</body>
</html>
