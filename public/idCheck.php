<?php
$id = $_REQUEST['id'];
$pass = $_REQUEST['pass'];

    $DBLink = mysqli_connect("localhost", "root", "", "board_prj") or die ("DB CONNECTION ERROR");

    $sql = "
    select * from user_info where userId = '{$id}';
    ";
    
    $rs = mysqli_query($DBLink, $sql);
    $row = mysqli_fetch_assoc($rs);
    
    
    if ($row['userId']==null){
        echo '<script>
        alert("아이디를 확인해 주세요");
        window.location = "main.html";
        </script>';
    }
    else if ($row['pass']!=$pass){
        echo '<script>
        alert("비밀번호를 확인해 주세요");
        window.location = "main.html";
        </script>';
    }
    else{
        echo "<script>
        alert('환영합니다.');
        window.location = 'list.php?id='+'{$row['userNO']}';
        </script>";
    }

?>
