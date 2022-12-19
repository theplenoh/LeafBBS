<?php
require_once "common.php";
$page_title = "Reply to";

require_once $path."db_connect.php";

$postID = $_GET['post_id'];

$query = "SELECT * FROM {$board_name} WHERE postID='{$postID}'";
$parent_result = mysqli_query($conn, $query);
$parent_row = mysqli_fetch_array($parent_result);
$parent_title = "RE: ".$parent_row['title'];
$parent_content = "\n&gt;".str_replace("\n", "\n&gt;", $parent_row['content']);
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
    <h2>Reply to a Post</h2>
    <form id="form" action="<?=$path?>insert_reply.php" method="post">
    <input type="hidden" name="parent_depth" value="<?=$parent_row['depth']?>">
    <input type="hidden" name="parent_thread" value="<?=$parent_row['thread']?>">
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
                (Needed later for editiing/deleting this post)
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
            <input type="text" name="title" id="title" maxlength="23" value="<?=$parent_title?>">
        </dd>
        <dt><label for="content">Content</label></dt>
        <dd>
            <textarea name="content" id="content"><?=$parent_content?></textarea>
        </dd>
    </dl>
    <p class="buttons">
        <button class="btn" type="submit">Reply</button>
        <a class="btn" href="<?=$path?>view.php?post_id=<?=$postID?>">Cancel</a>
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
