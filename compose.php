<?php
require_once "common.php";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="<?=$charset?>">
    <title><?=$board_title?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="<?=$path?>themes/<?=$theme_name?>/style.css">
    <script type="text/javascript" src="<?=$path?>leafbbs.js"></script>
</head>

<body>
<div id="leaf">
<h1><?=$board_title?></h1>
<main>
    <h2>Compose</h2>
    <form id="form" action="<?=$path?>insert.php" method="post">
    <dl>
        <dt><label for="name">Name</label></dt>
        <dd>
            <input type="text" name="name" id="name" maxlength="6">
        </dd>
        <dt><label for="password">Password</label></dt>
        <dd>
            <div class="warning">
                <small>
                Enter a temporary password.<br>
                (Needed later for editing/deleting this post)
                </small>
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
    <p class="buttons">
        <button class="btn" type="submit">Post</button>
        <a href="<?=$path?>list.php" class="btn">List</a>
    </p>
    </form>
</main>
</div>
<script>
var form = document.getElementById("form");
form.onsubmit = function() {
    return checkInputs(form);
};
</script>
</body>
</html>
