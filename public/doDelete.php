<?php
$cid = $_REQUEST['cid'];
$id = $_REQUEST['id'];
    $DBLink = mysqli_connect("localhost", "root", "", "board_prj") or die ("DB CONNECTION ERROR");

    $sql = "
    delete from board_content where contentId = {$cid};
    ";

    mysqli_query($DBLink, $sql);
    header("Location: /list.php?id=$id");
?>
