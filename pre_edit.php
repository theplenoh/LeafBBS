<?php
require_once "common.php";
$page_title = "Edit Post";

require_once $path."db_connect.php";

$postID = $_GET['id'];

$result = mysqli_query($conn, "SELECT * FROM {$board_name} WHERE postID={$postID}");
$row = mysqli_fetch_array($result);
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
<h1>Edit a Post</h1>
<form action="<?=$path?>edit.php?id=<?=$postID?>" method="post">
<dl>
    <dt><label for="posted-by">Posted by</label></dt>
    <dd>
        <input type="text" name="name" id="name" maxlength="6" value="<?=$row['name']?>">
    </dd>
    <dt><label for="password">Password</label></dt>
    <dd>
        <span class="warning">The password must be correct in order to successfulyy edit this positng.</span><br>
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
<p>
    <input type="submit" value="Submit">
    <a href="<?=$path?>list.php">List</a>
</p>
</form>
</div>
</body>
</html>
