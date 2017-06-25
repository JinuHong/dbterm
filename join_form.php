<?php

?>

<!DOCTYPE html>
<html>
    <head>
        <title>회원가입</title>
        <meta charset = "utf-8">
    </head>
    
    <body>
        <br><br><br><br>
        <center>아래 정보를 입력해주시길 바랍니다.</center>
        <br>
        
        <form name ='TRM' method='post' action='join.php'</center> <!--입력한 값은 input_prog.php로 넘어갑니다.-->
            <table width='600' border = 1 style="margin: 0 auto;">
                <tr>
                    <td width='20%'><center>회원구분</center></td>
                    <td width='80'>
                        <input type='radio' name='Div_Combo' value='1' checked="checked">유저      <!--라디오버튼의 이름은 Radio 입니다. 기억해두세요.-->
                        <input type='radio' name='Div_Combo' value='2'>관리자
                    </td>
                </tr>
                <tr>
                    <td width='20%'><center>EMAIL</center></center></td>
                    <td width ='80%'><input type ='text' name='EMAIL' size='20'></td>
                </tr>
                <tr>
                    <td width='20%'><center>PASSWORD</center></td>
                    <td width ='80%'><input type='text' name='PASSWORD' size='20'</td>
                </tr>
                <tr>
                    <td width='20%'><center>PASSWORD(RE)</center></td>
                    <td width='80'><input type='text' name='PASSWORD2' size='25'</td>
                </tr>
                <tr>
                    <td width='20%'><center>닉네임</center></td>
                    <td width='80'><input type='text' name='NICK' size='20'</td>
                </tr>
                <tr>
                    <td width='20%'><center>이름</center></td>
                    <td width='80'><input type='text' name='NAME' size='20'</td>
                </tr>
                <tr>
                    <td width='20%'><center>음악취향</center></td>
                    <td>
                        <select name="Music_Combo">  <!--셀렉트박스의 이름은 Combo 입니다. 기억해두세요.-->
                            <option selected>메뉴선택</option>
                            <option value=1>발라드</option>
                            <option value=2>랩</option>
                            <option value=3>힙합</option>
                            <option value=4>댄스</option>
                            <option value=5>인다</option>
                         </select>
                     </td>
                </tr>
            </table>     
            <input type='button' value='제출' onclick='submit();' style="margin:0 auto; display:block;">  <!-- 버튼부분. 클릭했을 때 submit 실행-->
    </body>
</html>