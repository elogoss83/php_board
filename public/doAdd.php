<?php
function mns($t){
    global $DBLink;
    $sql = "
    select max(contentNo) m 
    from board_content 
    where boardType = {$t};
    ";
    $rs = mysqli_query($DBLink, $sql);
    $mn = mysqli_fetch_assoc($rs);
    return $mn['m'] + 1;
}

$id = $_REQUEST['id'];
$boardType = $_REQUEST['boardType'];
$title = $_REQUEST['title'];
$content = $_REQUEST['content'];

    $DBLink = mysqli_connect("localhost", "root", "", "board_prj") or die ("DB CONNECTION ERROR");
        
        // while(true){
        //     $sql = "
        //     select * from user_info where nickName = '{$nickName}';
        //     ";
        //     $rs = mysqli_query($DBLink, $sql);
        //     $row = mysqli_fetch_assoc($rs);

        //     if ($row['userNO']!=null){
        //         $userNO = $row['userNO'];
        //         break;
        //     }
        //     else{
        //         $sql2 = "
        //         insert into user_info
        //         set nickName = '{$nickName}';
        //         ";
        //         mysqli_query($DBLink, $sql2);
        //     }
        // }
        $mn = mns($boardType);
        
        $sql = "
        insert into board_content
        set 
        userNO = {$id},
        boardType = {$boardType},
        title = '{$title}',
        content = '{$content}',
        contentNo = {$mn},
        contentDatetime = now();
        ";
        mysqli_query($DBLink, $sql);

        header("Location: /list.php?id={$id}");
?>

