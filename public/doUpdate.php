<?php
$id = $_REQUEST['id'];
$cid = $_REQUEST['cid'];
$title = $_REQUEST['title'];
$content = $_REQUEST['content'];

    $DBLink = mysqli_connect("localhost", "root", "", "board_prj") or die ("DB CONNECTION ERROR");

    $sql = "
    update board_content 
    set 
    content = '{$content}',
    title = '{$title}',
    contentDatetime = now()
    where contentId = {$cid};
    ";

    mysqli_query($DBLink, $sql);

    header("Location: /detail.php?id={$id}&cid={$cid}");

?>
