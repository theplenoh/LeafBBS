<?php
require_once "common.php";
$page_title = "List";

require_once $path."db_connect.php";

if (!isset($_GET['page_num']) || $_GET['page_num'] < 0)
    $page_num = 1;
else
    $page_num = $_GET['page_num'];

$page_size = 10;
$page_scale = 5;

$result_count = mysqli_query($conn, "SELECT COUNT(*) FROM {$board_name};");
$result_row = mysqli_fetch_row($result_count);
$total = $result_row[0];

$page_max = ceil($total / $page_size);
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
<p class="page-info">
Total number of posts: <?=$total?><br>
Page info: <?=$page_num?> / <?=$page_max?>
</p>
<table class="list">
    <tr>
        <th class="no">No.</th>
        <th class="title">Title</th>
        <th class="posted-by">Posted by</th>
        <th class="date">Date</th>
        <th class="views">Views</th>
    </tr>
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

    $query = "SELECT * FROM ${board_name} ORDER BY thread DESC LIMIT {$offset}, {$page_size}";
    $result = mysqli_query($conn, $query);

    $postIdx = $total - $offset;
    while($row=mysqli_fetch_array($result))
    {
?>
    <tr>
        <td class="no">
            <?=$postIdx?>
        </td>
        <td class="title">
            <span style="margin-left: <?php if ($row['depth'] > 0) echo $row['depth']*7;?>px;">
                <?php if ($row['depth'] > 0) echo "└";?><a href="<?=$path?>view.php?post_id=<?=$row['postID']?>&amp;page_num=<?=$page_num?>"><?=strip_tags($row['title'], '<b><i>');?></a>
            </span>
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
        $postIdx--;
    }
}
mysqli_close($conn);
?>
</table>
<p class="pagination">
<?php
if ($block > 0)
{
    $prev_block = ($block - 1) * $page_scale + 1;
    echo "<a href=\"list.php?page_num={$prev_block}\">[&laquo;]</a>";
}
else
{
    echo "[&laquo;]";
}

if ($page_max > 1 && $offset != 0 && $page_num > 1)
{
    $prev_page = $page_num - 1;
    echo "<a href=\"list.php?page_num={$prev_page}\">[&lsaquo;]</a>";
}
else
{
    echo "[&lsaquo;]";
}

$start_page = $block * $page_scale + 1;
for($i = 1; $i <= $page_scale && $start_page <= $page_max; $i++, $start_page++)
{
    if ($start_page == $page_num)
        echo "[{$start_page}]";
    else
        echo "<a href=\"list.php?page_num={$start_page}\">[{$start_page}]</a>";
}

if ($page_max > $page_num)
{
    $next_page = $page_num + 1;
    echo "<a href=\"list.php?page_num={$next_page}\">[&rsaquo;]</a>";
}
else
{
    echo "[&rsaquo;]";
}

if ($page_max > ($block + 1) * $page_scale)
{
    $next_block = ($block + 1) * $page_scale + 1;
    echo "<a href=\"list.php?page_num={$next_block}\">[&raquo;]</a>";
}
else
{
    echo "[&raquo;]";
}
?>
</p>
<p>
    <a href="<?=$path?>compose.php">Post</a>
</p>
</div>
</body>
</html>
