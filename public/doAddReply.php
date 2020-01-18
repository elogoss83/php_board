<?php
$reply = $_REQUEST['reply'];
$cid = $_REQUEST['cid'];
$id = $_REQUEST['id'];

    $DBLink = mysqli_connect("localhost", "root", "", "board_prj") or die ("DB CONNECTION ERROR");
        
    $sql = "
    insert into board_reply
    set 
    reply = '{$reply}',
    contentId = {$cid},
    userNO = {$id},
    replyDatetime = now();
    ";
    mysqli_query($DBLink, $sql);
    
    header("Location: /detail.php?id={$id}&cid={$cid}");


?>