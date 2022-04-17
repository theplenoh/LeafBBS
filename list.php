<?php
require_once "common.php";
$page_title = "List";

require_once $path."db_connect.php";

$page_size = 10;

$page_list_size = 5;

if (!isset($_GET['no']) || $_GET['no'] < 0)
    $no = 0;
else
    $no = $_GET['no'];

$query = "SELECT * FROM ${board_name} ORDER BY thread DESC LIMIT {$no}, {$page_size}";
$result = mysqli_query($conn, $query);

$result_count = mysqli_query($conn, "SELECT COUNT(*) FROM ${board_name}");
$result_row = mysqli_fetch_row($result_count);
$total_row = $result_row[0];

if ($total_row <= 0)
    $total_row = 0;

$total_page = floor(($total_row - 1) / $page_size);

$current_page = floor($no/$page_size);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="<?=$charset?>">
    <title><?=$page_title?> :: <?=$site_title?></title>

    <link rel="stylesheet" type="text/css" href="<?=$path?>style.css">
</head>

<body class="page-list">
<div id="container">
<h1><?=$page_title?> :: <?=$site_title?></h1>
<table class="list">
    <tr>
        <th class="no">No.</th>
        <th class="title">Title</th>
        <th class="posted-by">Posted by</th>
        <th class="date">Date</th>
        <th class="views">Views</th>
    </tr>
<?php
if ($total_row <= 0)
{
?>
    <tr>
        <td colspan="5">작성된 게시글이 없습니다.</td>
    </tr>
<?php
}
else
{
    while($row=mysqli_fetch_array($result))
    {
?>
    <tr>
        <td class="no">
            <?=$row['postID']?>
        </td>
        <td class="title">
            <span style="margin-left: <?php if ($row['depth'] > 0) echo $row['depth']*7;?>px;">
                <?php if ($row['depth'] > 0) echo "└";?><a href="<?=$path?>view.php?id=<?=$row['postID']?>&amp;no=<?=$no?>"><?=strip_tags($row['title'], '<b><i>');?></a>
            </span>
        </td>
        <td class="posted-by">
            <a href="mailto:<?=$row['email']?>"><?=$row['name']?></a>
        </td>
        <td class="date">
            <span><?=date("Y-m-d", $row['wdate'])?></span>
        </td>
        <td class="views">
            <span><?=$row['views']?></span>
        </td>
    </tr>
<?php
    }
}
mysqli_close($conn);
?>
</table>
</div>
</body>
</html>
