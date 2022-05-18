<?php
require_once "common.php";
$page_title = "Compose";
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
<h1><?=$page_title?> :: <?=$site_title?></h1>
<form action="<?=$path?>insert.php" method="post">
<dl>
    <dt><label for="name">Name</label></dt>
    <dd>
        <input type="text" name="name" id="name" maxlength="6">
    </dd>
    <dt><label for="passwd">Password</label></dt>
    <dd>
        <div class="warning">
            Enter a temporary password.<br>
            (Needed later for editing/deleting this post)
        </div>
        <input type="password" name="password" id="password" maxlength="16">
    </dd>
    <dt><label for="email">E-mail</label></dt>
    <dd>
        <input type="text" name="email" id="email" maxlength="30">
    </dd>
    <dt><label for="title">Title</label></dt>
    <dd>
        <input type="text" name="title" id="title" maxlength="23">
    </dd>
    <dt><label for="content">Content</label></dt>
    <dd>
        <textarea name="content" id="content"></textarea>
    </dd>
</dl>
<p>
    <button type="submit">Submit</button>
    <a href="<?=$path?>list.php">List</a>
</p>
</form>
</div>
</body>
</html>
