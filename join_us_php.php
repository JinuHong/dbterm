<?php
    header("Content-Type: text/html; charset=UTF-8");   //UTF-8 설정
?>

<?php
    mysql_connect("localhost", "root", "YES") or die (mysql_error());
    mysql_select_db("music");
    
    //$servername = getenv('IP');
    //$username = getenv('root');
    //$password = "vosejdi1!";
    //$database = "music";
    //$dbport = 3306;
    
    //$db = new mysqli($servername, $username, $password, $database, $dbport);    // Conncection 이름
    
    
    $Div_Combo = $_POST["Div_Combo"];
    $EMAIL = $_POST["EMAIL"];
    $PASSWORD = $_POST["PASSWORD"];
    $NICK = $_POST["NICK"];
    $NAME = $_POST["NAME"];
    $Music_Combo = $_POST["Music_Combo"];
    
    
    $sql = "insert into USERINFO (email, divide, password, nick, name, prefer) 
                values ('$EMAIL', '$Div_Combo', '$PASSWORD', '$NICK', '$NAME', '$Music_Combo')";
    mysql_query($sql) or die (mysql_error());
    
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