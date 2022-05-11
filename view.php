<?php
include_once "common.php";
$page_title = "View post";

require_once $path."db_connect.php";

$postID = $_GET['post_id'];

if (!isset($_GET['page_num']) || $_GET['page_num'] < 0)
    $page_num = 1;
else
    $page_num = $_GET['page_num'];

// Update 'views'
$query = "UPDATE {$board_name} SET views=views+1 WHERE postID={$postID}";
$result = mysqli_query($conn, $query);

// Retrieve post info
$query = "SELECT * FROM {$board_name} WHERE postID={$postID}";
$result = mysqli_query($conn, $query);
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
<body class="page-view">
<div id="container">
<h1><?=$page_title?> :: <?=$site_title?></h1>
<dl>
    <dt>Posted by</dt>
    <dd><?=$row['name']?></dd>

    <dt>E-Mail</dt>
    <dd><a href="mailto:<?=$row['email']?>"><?=$row['email']?></a></dd>

    <dt>Date</dt>
    <dd><?=date("Y-m-d", $row['datetime'])?></dd>

    <dt>Views</dt>
    <dd><?=$row['views']?></dd>
</dl>
<h2><?=strip_tags($row['title'])?></h2>
<p><?=filter($row['content'])?></p>

<p>
<a href="<?=$path?>list.php?page_num=<?=$page_num?>">List</a>
<a href="<?=$path?>reply.php?post_id=<?=$postID?>">Reply</a>
<a href="<?=$path?>compose.php">Post New</a>
<a href="<?=$path?>pre_edit.php?post_id=<?=$postID?>">Edit</a>
<a href="<?=$path?>pre_del.php?post_id=<?=$postID?>">Delete</a>
</p>

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

<?php
$thread_end = ceil($row['thread']/1000)*1000;
$thread_start = $thread_end - 1000;

$query = "SELECT * FROM {$board_name} WHERE thread <= {$thread_end} and thread > {$thread_start} ORDER BY thread DESC";
$result = mysqli_query($conn, $query);
?>
<table class="list">
    <tr>
        <th>Thread</th>
        <th>Title</th>
        <th>Posted by</th>
        <th>Date</th>
        <th>Views</th>
    </tr>
<?php
while($row = mysqli_fetch_array($result))
{
?>
    <tr>
        <td class="no">
            <?=($row['depth']==0)?"Orig.":"-"?>
        </td>
        <td class="title">
            <span style="margin-left: <?php if ($row['depth'] > 0) echo $row['depth']*7;?>px;">
                <?php if ($row['depth'] > 0) echo "└ ";?><a href="<?=$path?>view.php?post_id=<?=$row['postID']?>&amp;page_num=<?=$page_num?>"><?=strip_tags($row['title'], '<b><i>');?></a>
            </span>
        </td>
        <td class="posted-by">
            <a href="mailto:<?=$row['email']?>"><?=$row['name']?></a>
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
</table>
</div>
</body>
</html>
