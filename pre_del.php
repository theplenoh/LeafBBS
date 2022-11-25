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
    <title><?=$board_title?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="<?=$path?>styles/<?=$skin_name?>/style.css">
</head>
<body>
<div id="leaf">
<h1><?=$board_title?></h1>
<main>
    <h2>Password Confirm before Deleting</h2>
    <form action="<?=$path?>del.php?post_id=<?=$postID?>" method="post">
    <dl>
        <dt>Password</dt>
        <dd>
            <input type="password" name="password" size="16">
        </dd>
    </dl>
    <p class="buttons">
        <input type="submit" class="btn" value="Delete">
        <a href="<?=$path?>view.php?post_id=<?=$postID?>" class="btn">Cancel</a>
    </p>
    </form>
</main>
</div>
</body>
</html>
