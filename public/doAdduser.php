<?php
$userId = $_REQUEST['userId'];
$pass = $_REQUEST['pass'];
$userName = $_REQUEST['userName'];
$Nickname = $_REQUEST['Nickname'];

if (strlen($userId)==0){
    echo '<script>
    alert("[ID]를 입력하세요");
    window.location = "doApply.html";
    </script>';
    
}
else if (strlen($pass)==0){
    echo '<script>
    alert("[비밀번호]를 입력하세요");
    window.location = "doApply.html";
    </script>';
    
}
else if (strlen($userName)==0){
    echo '<script>
    alert("[이름]를 입력하세요");
    window.location = "doApply.html";
    </script>';
    
}
else if (strlen($Nickname)==0){
    echo '<script>
    alert("[닉네임]를 입력하세요");
    window.location = "doApply.html";
    </script>';
    
}
else {
    $DBLink = mysqli_connect("localhost", "root", "", "board_prj") or die ("DB CONNECTION ERROR");
    
    $sql = "
    select userId from user_info where userId = '{$userId}';
    ";
    $rs = mysqli_query($DBLink, $sql);
    $row = mysqli_fetch_assoc($rs);
    if ($row['userId'] != null){
        echo '<script>
        alert("[ID]가 중복입니다.");
        window.location = "doApply.html";
        </script>';
    }
    else{
        $sql = "
        insert into user_info 
        set
        userId = '{$userId}',
        pass = '{$pass}',
        userName = '{$userName}',
        Nickname = '{$Nickname}';
        ";
        mysqli_query($DBLink, $sql);
        echo '<script>
        alert("회원가입을 축하합니다.");
        window.location = "main.html";
        </script>';
    }
}



?>

