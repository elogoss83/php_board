<?php
$id = $_REQUEST['id'];
$cid = $_REQUEST['cid'];

    $DBLink = mysqli_connect("localhost", "root", "", "board_prj") or die ("DB CONNECTION ERROR");

    $sql = "
    select * from board_content where contentId = {$cid};
    ";
    $sql2 ="
    update board_content set contentCnt = contentCnt+1 where contentId = {$cid};
    ";
    $sql3 ="
    SELECT * FROM board_reply WHERE contentId = {$cid};
    ";
    $sql4 ="
    SELECT count(*) c FROM board_reply WHERE contentId = {$cid};
    ";
    
    $rs = mysqli_query($DBLink, $sql);
    $rs2 = mysqli_query($DBLink, $sql2);
    $rs3 = mysqli_query($DBLink, $sql3);
    $rs4 = mysqli_query($DBLink, $sql4);
    
    $row = mysqli_fetch_assoc($rs);
    while($rp = mysqli_fetch_assoc($rs3)){
        $rps[] = $rp;
    }
    $rcnt = mysqli_fetch_assoc($rs4);

function fn($i){
    global $DBLink;
    global $row;
    $sql = "
    select nickName from user_info where userNO = {$i};
    ";
    $rs = mysqli_query($DBLink, $sql);
    $nm = mysqli_fetch_assoc($rs);
    $nm = $nm['nickName'];
return $nm;
}

function idCheck(){
    global $id;
    global $row;
    if ($id == $row['userNO']){
        return true;
    }
    else{
        return false;
    }
}
function ridChk($i){
    global $id;
    global $rps;
    if ($id == $rps[$i]['userNO']){
        return true;
    }
    else{
        return false;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="doUpdate.php">
    <table border = "1">
        <tr>
            <td>게시물번호</td>
            <input type="hidden" name="cid" value="<?=$cid?>">
            <input type="hidden" name="id" value="<?=$id?>">
            <td><?=$row['contentNo']?></td>
        </tr>
        <tr>
            <td>작성자</td>
            <td><?= fn($row['userNO']) ?></td>
        </tr>
        <tr>
            <td>조회수</td>
            <td><?=$row['contentCnt']?></td>
        </tr>
        <tr>
            <td>수정날짜</td>
            <td><?=$row['contentDatetime']?></td>
        </tr>
        <tr>
            <td>제목</td>
            <?php if (idCheck()){ ?>
            <td><input type="text" name="title" value="<?=$row['title']?>"></td><?php } else {?>
            <td><?=$row['title']?> <?php }?>
            
        </tr>
        <tr>
            <td>내용</td>
            <?php if (idCheck()){ ?>
                <td><input type="text" name="content" value="<?=$row['content']?>"></td><?php } else {?>
            <td><?=$row['content']?> <?php }?>
            
        </tr>
    </table>
<input type="button" onclick="location.href = 'list.php?id=<?=$id?>'" value="목록">
<input type="<?php if(idCheck()){echo "submit";}else{echo "hidden";}?>" value="수정">
<input type="<?php if(idCheck()){echo "button";}else{echo "hidden";}?>" onclick="location.href = 'doDelete.php?id=<?=$id?>&cid=<?=$cid?>'" value="삭제">
</form>
<div>

<?php for ($t=0; $t<$rcnt['c']; $t++){ ?>
    <div>
        <?=fn($rps[$t]['userNO'])?> : <?=$rps[$t]['reply']?> [<?=$rps[$t]['replyDatetime']?>]
        <?php if (ridChk($t)){?>
        <input type="button" onclick="location.href = 'replyDelete.php?id=<?=$id?>&cid=<?=$cid?>&rid=<?=$rps[$t]['replyId']?>'" value="삭제">
        <?php } ?>
    </div>
<?php } ?>

    <form action="doAddReply.php">
    <?=fn($id)?> : <input type="text" name="reply" value="">
    <input type="hidden" name="cid" value="<?=$cid?>">
    <input type="hidden" name="id" value="<?=$id?>">
    <input type="submit" value="댓글등록">
    </form>

</div>
</body>
</html>