<?php
    $id = $_REQUEST['id'];
    $DBLink = mysqli_connect("localhost", "root", "", "board_prj") or die ("DB CONNECTION ERROR");

    $sql = "
    select * from board_type t;
    ";

    $rs = mysqli_query($DBLink, $sql);
    
    while ($bt = mysqli_fetch_assoc($rs)){
        $bts[] = $bt;
    }

    function bc($i){
        global $DBLink;
        $sql = "
        select * 
        from board_content c 
        join user_info i 
        on c.userNO = i.userNo
        where c.boardType = {$i};
        ";
        
        $rs = mysqli_query($DBLink, $sql);
        while ($row = mysqli_fetch_assoc($rs)){
            $rows[] = $row;
        }
        return $rows;
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
<?php for($i = 0 ; $i < count($bts); $i++) { ?>
    <table border = "1">
    <h2><?=$bts[$i]['boardName']?></h1>
    <?php $tmp = bc($i+1) ?>
        <tr>
            <th>순번</th>
            <th>작성자</th>
            <th>제목</th>
            <th>등록일</th>
            <th>조회수</th>
        </tr>
        <?php for ($t = 0; $t < count($tmp); $t++) {?>
        <tr>
            <td><?=$tmp[$t]['contentNo']?></td>
            <td><?=$tmp[$t]['nickName']?></td>
            <td><a href="detail.php?id=<?=$id?>&cid=<?=$tmp[$t]['contentId']?>"><?=$tmp[$t]['title']?></a></td>
            <td><?=$tmp[$t]['contentDatetime']?></td>
            <td><?=$tmp[$t]['contentCnt']?></td>
        </tr>
        <?php }?>
        <button type = "button" onclick="location.href = 'form.php?boardType=<?=$bts[$i]['boardType']?>&id=<?=$id?>'">글쓰기</button>
    </table>
<?php } ?>
</body>
</html>