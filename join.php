<?php
    header("Content-Type: text/html; charset=UTF-8");   //UTF-8 설정
?>

<?php
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
    $Div_Combo = $_POST["Div_Combo"];
    $PASSWORD = $_POST["PASSWORD"];
    $NICK = $_POST["NICK"];
    $NAME = $_POST["NAME"];
    $Music_Combo = $_POST["Music_Combo"];
    
    $sql = "INSERT INTO USER_INFO (email, divide, password, nick, name, prefer) VALUES ('$EMAIL', '$Div_Combo', '$PASSWORD', '$NICK', '$NAME', '$Music_Combo');";
    if($db->query($sql) == TRUE){
        echo "New record created successfully.";
    }else{
        echo "Error : ".$sql."<br>".$db->error;
    }
    
    $sql = "INSERT INTO USER_PREFER (email, bar_pre, rap_pre, hip_pre, dan_pre, in_pre) VALUES ('$EMAIL', 0, 0, 0, 0, 0)";
    if($db->query($sql) == TRUE){
        echo "New record created successfully.";
    }else{
        echo "Error : ".$sql."<br>".$db->error;
    }
    
?>