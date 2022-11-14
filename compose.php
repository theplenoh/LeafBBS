<?php
require_once "common.php";
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
    <h2>Compose</h2>
    <form action="<?=$path?>insert.php" method="post">
    <dl>
        <dt><label for="name">Name</label></dt>
        <dd>
            <input type="text" name="name" id="name" maxlength="6">
        </dd>
        <dt><label for="passwd">Password</label></dt>
        <dd>
            <p class="warning">
                Enter a temporary password.<br>
                (Needed later for editing/deleting this post)
            </p>
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
    <p class="buttons">
        <button type="submit" class="btn">Post</button>
        <a href="<?=$path?>list.php" class="btn">List</a>
    </p>
    </form>
</main>
</div>
</body>
</html>
