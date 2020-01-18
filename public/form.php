<?php
$boardType = $_REQUEST['boardType'];
$id = $_REQUEST['id'];

function nicksch($i){
    $DBLink = mysqli_connect("localhost", "root", "", "board_prj") or die ("DB CONNECTION ERROR");
    $sql = "
    select nickName from user_info where userNO={$i};
    ";
    
    $rs = mysqli_query($DBLink, $sql);
    $row = mysqli_fetch_assoc($rs);
    return $row['nickName'];
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
    <form action="doAdd.php">
        <input type="hidden" name="boardType" value="<?=$boardType?>">
        <input type="hidden" name="id" value="<?=$id?>">
        작성자 : <?=nicksch($id)?></br>
        제  목 : <input type="text" name="title" value=""></br>
        내  용 : <input type="text" name="content" value=""></br>
    <input type="submit" value="등록">
    </form>
</body>
</html>