<?php
require_once "common.php";

require_once $path."db_connect.php";

$post_id = $_GET['post_id'];

if (!isset($_GET['page_num']) || $_GET['page_num'] < 0)
    $page_num = 1;
else
    $page_num = $_GET['page_num'];

// Update 'views'
if(!isset($_COOKIE["{$board_name}_views"])) // There is no cookie set
{
    setcookie("{$board_name}_views", $_SERVER['REMOTE_ADDR'].",".$post_id, time()+60, "/");

    $query = "UPDATE {$board_name} SET views=views+1 WHERE postID={$post_id}";
    $result = mysqli_query($conn, $query);
}
else // The cookie is set
{
    $visited_posts = explode(",", $_COOKIE["{$board_name}_views"]);
    array_shift($visited_posts);

    if(!in_array($post_id, $visited_posts)) // The cookie is set but the post has never been viewed
    {
        $cookie_value = $_COOKIE["{$board_name}_views"];
        $cookie_value .=",".$post_id;
        setcookie("{$board_name}_views", $cookie_value, time()+60, "/");

        $query = "UPDATE {$board_name} SET views=views+1 WHERE postID={$post_id}";
        $result = mysqli_query($conn, $query);
    }
}


// Retrieve post info
$query = "SELECT * FROM {$board_name} WHERE postID={$post_id}";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_array($result);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="<?=$charset?>">
    <title><?=$board_title?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="<?=$path?>themes/<?=$theme_name?>/style.css">
</head>

<body>
<div id="leaf" class="page-view">
<h1><?=$board_title?></h1>
<main>
<h2>View a Post</h2>
<dl>
    <dt>Posted by</dt>
    <dd class="posted-by"><?=$row['name']?></dd>

<?php
if ($row['email']!="")
{
?>
    <dt>E-mail</dt>
    <dd class="email">
        <a href="mailto:<?=$row['email']?>"><?=$row['email']?></a>
    </dd>
<?php
}
?>

    <dt>Date/Time</dt>
    <dd class="date-time"><?=date("Y-m-d H:i", $row['datetime'])?></dd>

    <dt>Views</dt>
    <dd class="views"><?=$row['views']?></dd>
</dl>
<article>
    <h1 class="title"><?=strip_tags($row['title'])?></h1>
    <p><?=filter($row['content'])?></p>
</article>
</main>

<section class="buttons">
    <a class="btn" href="<?=$path?>list.php?page_num=<?=$page_num?>">List</a>
    <a class="btn" href="<?=$path?>reply.php?post_id=<?=$post_id?>">Reply</a>
    <a class="btn" href="<?=$path?>compose.php">Post New</a>
    <a class="btn" href="<?=$path?>pre_edit.php?post_id=<?=$post_id?>">Edit</a>
    <a class="btn" href="<?=$path?>pre_del.php?post_id=<?=$post_id?>">Delete</a>
</section>

<section class="prevnext-posts">
    <h2 class="sr-only">Prev/Next Post(s)</h2>
    <table class="list">
<?php
$query = "SELECT postID, name, title FROM {$board_name} WHERE thread > {$row['thread']} ORDER BY thread ASC LIMIT 1";
$result = mysqli_query($conn, $query);
$prev_id = mysqli_fetch_array($result);

if (isset($prev_id['postID'])) // If a prev post exists
{
?>
        <tr>
            <th>Prev</th>
            <td class="title"><a href="<?=$path?>view.php?post_id=<?=$prev_id['postID']?>"><?=$prev_id['title']?></a></td>
            <td class="name"><?=$prev_id['name']?></td>
        </tr>
<?php
}
?>
<?php
$query = "SELECT postID, name, title FROM {$board_name} WHERE thread < {$row['thread']} ORDER BY thread DESC LIMIT 1";
$result = mysqli_query($conn, $query);
$next_id = mysqli_fetch_array($result);

if (isset($next_id['postID']))
{
?>
        <tr>
            <th>Next</th>
            <td class="title"><a href="<?=$path?>view.php?post_id=<?=$next_id['postID']?>"><?=$next_id['title']?></a></td>
            <td class="name"><?=$next_id['name']?></td>
        </tr>
<?php
}
?>
    </table>
</section>

<section class="thread">
    <h2 class="sr-only">Thread and the Related Post(s)</h2>
<?php
$thread_end = ceil($row['thread']/1000)*1000;
$thread_start = $thread_end - 1000;

$query = "SELECT * FROM {$board_name} WHERE thread <= {$thread_end} and thread > {$thread_start} ORDER BY thread DESC";
$result = mysqli_query($conn, $query);
?>
    <table class="list">
        <thead>
            <tr>
                <th>Thread</th>
                <th>Title</th>
                <th>Posted by</th>
                <th>Date</th>
                <th>Views</th>
            </tr>
        </thead>
        <tbody>
<?php
while($row = mysqli_fetch_array($result))
{
?>
            <tr>
                <td class="no">
                    <?=($row['depth']==0)?"Orig.":"-"?>
                </td>
                <td class="title">
                    <span <?php if ($row['depth'] > 0) { echo "class=\"reply\" "; } ?>style="margin-left: <?php if ($row['depth'] > 0) { echo ($row['depth']*7).'px; '; } else { echo '0px; '; } ?>"><a href="<?=$path?>view.php?post_id=<?=$row['postID']?>&amp;page_num=<?=$page_num?>"><?=strip_tags($row['title'], '<b><i>');?></a></span>
                </td>
                <td class="posted-by">
<?php
if ($row['email']!="")
{
?>
                    <a href="mailto:<?=$row['email']?>"><?=$row['name']?></a>
<?php
}
else
{
?>
            <?=$row['name']?>
<?php
}
?>
                </td>
                <td class="date">
                    <span><?=date("Y-m-d", $row['datetime'])?></span>
                </td>
                <td class="views">
                    <span><?=$row['views']?></span>
                </td>
            </tr>
<?php
}
mysqli_close($conn);
?>
        </tbody>
    </table>
</section>
</div>
</body>
</html>
