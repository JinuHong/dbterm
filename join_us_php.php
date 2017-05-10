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
    
    
    //$sql = "select * from USERINFO;";
    
    $sql = "insert into USERINFO (email, divide, password, nick, name, prefer) 
               values ('$EMAIL', '$Div_Combo', '$PASSWORD', '$NICK', '$NAME', '$Music_Combo')";
    
    if($db->query($sql) == TRUE){
        echo "New record created successfully.";
    }else{
        echo "Error : ".$sql."<br>".$db->error;
    }
    
    //mysql_query($sql) or die (mysql_error());
    
    echo(
        "
        <html>
            <head>
                <script name=javascript>
                    location.href='http://www.innergy.co.kr/EXER/input_form.php'; 
                    self.window.alert('회원가입이 완료되었습니다!');
                </script>
            </head>
        </html>
        "
        );
    
?>