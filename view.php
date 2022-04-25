<?php
include_once "common.php";
$page_title = "View post";

require_once $path."db_connect.php";

$postID = $_GET['id'];

if (!isset($_GET['no']) || $_GET['no'] < 0)
    $no = 0;
else
    $no = $_GET['no'];

// Update 'views'
$query = "UPDATE {$board_name} SET views=views+1 WHERE postID={$postID}";
$result = mysqli_query($conn, $query);

// Retreive post info
$query = "SELECT * FROM {$board_name} WHERE postID={$postID}";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_array($result);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="<?=$charset?>">
    <title><?=$page_title?> :: <?=$site_title?></title>

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
<pre><?=strip_tags($row['content'])?></pre>

<p>
<a href="<?=$path?>list.php?no=<?=$no?>">List</a>
<a href="<?=$path?>reply.php?id=<?=$postID?>">Reply</a>
<a href="<?=$path?>compose.php">Post New</a>
<a href="<?=$path?>edit.php?id=<?=$id?>">Edit</a>
<a href="<?=$path?>pre_del.php?id=<?=$id?>">Delete</a>
</p>

<table class="list">
<?php
$query = "SELECT postID, name, title FROM {$board_name} WHERE thread > {$row['thread']} ORDER BY thread ASC LIMIT 1";
$result = mysqli_query($conn, $query);
$prev_id = mysqli_fetch_array($result);

if ($prev_id['postID']) // If a prev post exists
{
?>
<tr>
    <th>Prev</th>
    <td class="title"><a href="<?=$path?>view.php?id=<?=$prev_id['postID']?>"><?=$prev_id['title']?></a></td>
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
    <td class="title"><a href="<?=$path?>view.php?id=<?=$next_id['postID']?>"><?=$next_id['title']?></a></td>
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
        <th>No.</th>
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
            <?=$row['postID']?>
        </td>
        <td class="title">
            <span style="margin-left: <?php if ($row['depth'] > 0) echo $row['depth']*7;?>px;">
                <?php if ($row['depth'] > 0) echo "└ ";?><a href="<?=$path?>view.php?id=<?=$row['postID']?>&amp;no=<?=$no?>"><?=strip_tags($row['title'], '<b><i>');?></a>
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
