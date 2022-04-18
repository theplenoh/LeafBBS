<?php
require_once "common.php";
$page_title = "Compose";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="<?=$charset?>">
    <title><?=$page_title?> :: <?=$site_title?></title>

    <link rel="stylesheet" type="text/css" href="<?=$path?>style.css">
</head>

<body>
<div id="container">
<h1><?=$page_title?> :: <?=$site_title?></h1>
<form action="<?=$path?>insert.php" method="post">
<dl>
    <dt><label for="name">Name</label></dt>
    <dd>
        <input type="text" name="posted-by" id="posted-by" maxlength="6">
    </dd>
    <dt><label for="passwd">Password</label></dt>
    <dd>
        <div class="warning">
            Enter a temporary password.<br>
            (Needed later for editing/deleting this post)
        </div>
        <input type="password" name="password" id="password" maxlength="8">
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
    <button onclick="window.location.href='<?=$path?>list.php'">List</button>
</p>
</form>
</div>
</body>
</html>
