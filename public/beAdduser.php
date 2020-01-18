<?php
$Nickname = $_REQUEST['Nickname'];

if (strlen($Nickname)==0){
    echo '<script>
    alert("[닉네임]를 입력하세요");
    window.location = "beApply.html";
    </script>';
    
}
else {
    $DBLink = mysqli_connect("localhost", "root", "", "board_prj") or die ("DB CONNECTION ERROR");
    
        $sql = "
        insert into user_info 
        set
        Nickname = '{$Nickname}';
        ";
        mysqli_query($DBLink, $sql);

        $sql2 ="
        select userNO from user_info where nickName = '{$Nickname}' order by userNO desc limit 1;
        ";

        $rs = mysqli_query($DBLink, $sql2);
        $row = mysqli_fetch_assoc($rs);


        echo "<script>
        alert('비회원입니다.');
        window.location = 'list.php?id='+'{$row['userNO']}';
        </script>";
    }

?>

