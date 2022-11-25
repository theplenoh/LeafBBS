<?php
require_once "common.php";

require_once $path."db_connect.php";

$postID = $_GET['post_id'];

$result = mysqli_query($conn, "SELECT * FROM {$board_name} WHERE postID={$postID}");
$row = mysqli_fetch_array($result);
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
    <h2>Edit a Post</h2>
    <form action="<?=$path?>edit.php?post_id=<?=$postID?>" method="post">
    <dl>
        <dt><label for="posted-by">Posted by</label></dt>
        <dd>
            <input type="text" name="name" id="posted-by" maxlength="6" value="<?=$row['name']?>">
        </dd>
        <dt><label for="password">Password</label></dt>
        <dd>
            <div class="warning">
                <small>The password must be correct in order to successfully edit this positng.</small>
            </div>
            <input type="password" name="password" id="password" maxlength="16">
        </dd>
        <dt><label for="email">E-Mail</label></dt>
        <dd>
            <input type="text" name="email" id="email" maxlength="30" value="<?=$row['email']?>">
        </dd>
        <dt><label for="title">Title</label></dt>
        <dd>
            <input type="text" name="title" id="title" maxlength="35" value="<?=$row['title']?>">
        </dd>
        <dt><label for="content">Content<label></dt>
        <dd>
            <textarea name="content" id="content"><?=$row['content']?></textarea>
        </dd>
    </dl>
    <p class="buttons">
        <input class="btn" type="submit" value="Submit">
        <a class="btn" href="<?=$path?>view.php?post_id=<?=$postID?>">Cancel</a>
    </p>
    </form>
</main>
</div>
</body>
</html>
