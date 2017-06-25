<?php

?>

<html>
    <head>
        <title>로그인</title>
        <meta charset = "utf-8">
    </head>
    
    <body>
        <br><br><br><br>
        <center>홍진우의 음악세상 ~ ㅎㅎ</center>
        <br>
        <form name ='TRM' method='post' action='login.php'</center> <!--입력한 값은 input_prog.php로 넘어갑니다.-->
            <table width='600' border = 1 style="margin: 0 auto;">
                <tr>
                    <td width='20%'><center>EMAIL</center></center></td>
                    <td width ='80%'><input type ='text' name='EMAIL' size='20'></td>
                </tr>
                <tr>
                    <td width='20%'><center>PASSWORD</center></td>
                    <td width ='80%'><input type='text' name='PASSWORD' size='20'</td>
                </tr>
            </table>     
            <input type='button' value='로그인' onclick='submit();' style="margin:0 auto; display:block;">  <!-- 버튼부분. 클릭했을 때 submit 실행-->
        </form>
        
        <form action="join_form.php" method="post">
                <center>회원가입을 아직 하지 않으셨다면?</center>
                <button name="join_button" value="1" style="margin:0 auto; display:block;">회원가입</button>
        </form>
    </body>
</html>