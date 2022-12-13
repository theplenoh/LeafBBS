<?php
require_once "common.php";

require_once $path."db_connect.php";

if (!isset($_GET['page_num']) || $_GET['page_num'] < 0)
    $page_num = 1;
else
    $page_num = $_GET['page_num'];

$page_size = 10;
$page_scale = 5;

$result_count = mysqli_query($conn, "SELECT COUNT(*) FROM {$board_name};");
$total = mysqli_fetch_row($result_count)[0];

$page_max = ceil($total / $page_size);
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
<div id="leaf">
<h1><?=$board_title?></h1>
<p class="page-info">
Total number of posts: <?=$total?><br>
Page info: <?=$page_num?> / <?=$page_max?>
</p>
<main>
<table class="post-list">
<caption class="sr-only">List of postings</caption>
<thead>
    <tr>
        <th class="no" scope="col">No.</th>
        <th class="title" scope="col">Title</th>
        <th class="posted-by" scope="col">Posted by</th>
        <th class="date" scope="col">Date</th>
        <th class="views" scope="col">Views</th>
    </tr>
</thead>
<tbody>
<?php
if ($total <= 0)
{
?>
    <tr>
        <td colspan="5">There are no posts.</td>
    </tr>
<?php
}
else
{
    $offset = ($page_num - 1) * $page_size;
    $block = floor(($page_num - 1) / $page_scale);

    $query = "SELECT * FROM {$board_name} ORDER BY thread DESC LIMIT {$offset}, {$page_size}";
    $result = mysqli_query($conn, $query);

    $post_idx = $total - $offset;
    while($row=mysqli_fetch_array($result))
    {
?>
    <tr>
        <td class="no">
            <?=$post_idx?>
        </td>
        <td class="title">
            <span <?php if ($row['depth'] > 0) { echo "class=\"reply\""; } ?>style="margin-left: <?php if ($row['depth'] > 0) { echo ($row['depth']*7).'px; '; } else { echo '0px; '; } ?>"><a href="<?=$path?>view.php?post_id=<?=$row['postID']?>&amp;page_num=<?=$page_num?>"><?=strip_tags($row['title'], '<b><i>');?></a></span>
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
        $offset++;
        $post_idx--;
    }
}
mysqli_close($conn);
?>
</tbody>
</table>
</main>
<p class="pagination">
<?php $prev_block = ($block - 1) * $page_scale + 1; ?>
    <a href="<?=($block > 0)? "?page_num={$prev_block}":"javascript:;"?>">&laquo;</a>
<?php $prev_page = $page_num - 1; ?>
    <a href="<?=($page_max > 1 && $offset != 0 && $page_num && $page_num > 1)? "?page_num={$prev_page}":"javascript:;"?>">&lsaquo;</a>
<?php
    $start_page = $block * $page_scale + 1;
    for($i=1; $i<=$page_scale && $start_page<=$page_max; $i++, $start_page++)
    {
?>
    <a <?=($start_page == $page_num)? "class=\"active\" ":""?>href="<?=($start_page == $page_num)? "javascript:;":"?page_num={$start_page}"?>"><?=$start_page?></a>
<?php
    }
?>
<?php $next_page = $page_num + 1; ?>
    <a href="<?=($page_max > $page_num)? "?page_num={$next_page}":"javascript:;"?>">&rsaquo;</a>
<?php $next_block = ($block + 1) * $page_scale + 1; ?>
    <a href="<?=($page_max > ($block + 1)*$page_scale)? "?page_num={$next_block}":"javascript:;"?>">&raquo;</a>
</p>
<p class="buttons">
    <a class="btn" href="<?=$path?>compose.php">Post</a>
</p>
</div>
</body>
</html>
