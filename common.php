<?php
// User variable configuration
$path = "";
$charset = "utf-8";
$board_title = "Test Board";

$board_name = "leaf_board";

$theme_name = "board_default";

// Encoding
header("Content-Type: text/html; charset={$charset}");

// Display all errors
error_reporting(E_ALL);
ini_set("display_errors", 1);

// Function library
function sanitize($text)
{
    return htmlentities(addslashes($text));
}

function filter($text)
{
    // <https://stackoverflow.com/questions/4144837/auto-link-urls-in-a-string>
    $text = preg_replace('/((http|https):\/\/[\w-]+(\.[\w-]+)+([\w.,@?^=%&amp;:\/~+#-]*[\w@?^=%&amp;\/~+#-])?)/', '<a href="\1">\1</a>', $text);

    $text = str_replace("--", "&mdash;", $text);

    $text = nl2br($text);

    return $text;
}
?>
