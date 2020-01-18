<?php
$cid = $_REQUEST['cid'];
$id = $_REQUEST['id'];
$rid = $_REQUEST['rid'];

    $DBLink = mysqli_connect("localhost", "root", "", "board_prj") or die ("DB CONNECTION ERROR");

    $sql = "
    delete from board_reply where replyId = {$rid};
    ";

    mysqli_query($DBLink, $sql);
    header("Location: /detail.php?id=$id&cid=$cid");


?>
