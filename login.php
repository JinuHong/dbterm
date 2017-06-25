<?php
    header('Content-type: text/html; charset=euc-kr');
    $servername = getenv('IP');
    $username = getenv('C9_USER');
    $password = "";
    $database = "music";
    $dbport = 3306;
    
    $db = new mysqli($servername, $username, $password, $database, $dbport);    // Conncection 이름
    
    if($db->connect_error){
        die("Connection Failed : " .$db->connect_error);
    }
    echo "Connected Successfully ( ". $db->host_info.")";
    
    $EMAIL = $_POST["EMAIL"];
    $PASSWORD = $_POST["PASSWORD"];
    
    $sql = "select * from USER_INFO	where email = '$EMAIL' and password = '$PASSWORD';";
    
    if($db->query($sql) == TRUE){
        echo "New record created successfully.";
    }else{
        echo "Error : ".$sql."<br>".$db->error;
    }
    
    $result_set = mysqli_query($db, $sql);
    $count = mysqli_num_rows($result_set);
    echo '$count : '.$count.'<br>';
    
    // 로그인이 됐다면 즉 count == 1이라면, Session Start
    // 로그인이 안됐다면 Alert띄워주고 다시 login_form으로 이동
    if($count == 1){
        session_start();
        $row = $db->query($sql)->fetch_assoc();
        $_SESSION['email'] = $row["email"];
        
        if($row["divide"] == 2){
            header("Location: https://dbterm-jinuhong.c9users.io/admin_main_form.php");
            exit();
        }
        else if($row["divide"] == 1){
            header("Location: https://dbterm-jinuhong.c9users.io/user_main_form.php");
            exit();
        }else{
            echo "Something Wrong!";
        }
        
    }else{
        echo ("<SCRIPT LANGUAGE='JavaScript'>
        window.alert('login failed')
        window.location.href='https://dbterm-jinuhong.c9users.io/login_form.php';
        </SCRIPT>");
    }
?>