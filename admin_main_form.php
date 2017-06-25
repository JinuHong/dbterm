<?php
#session_start();
#$a = session_id();

?>

<html>
    <head>
        <title>관리자 메인페이지</title>
        <meta charset = "utf-8">
    </head>
    
    <body>
        <br><br><br><br>
        <center><h1>여기서 관리자는 데이터를 생성합니다.</h1></center>
        <!--
        @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
        @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
        @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
        -->
        <br>
        <form name ='TRM' method='post' action='admin_main.php'</center> <!--입력한 값은 input_prog.php로 넘어갑니다.-->
            <h3>가수 데이터 생성</h3>
            <table width='1000' border = 1>
                <tr>
                    <th width='20%'>가수명</th>
                    <th width='20%'>나이</th>
                    <th width='20%'>키</th>
                    <th width='20%'>몸무게</th>
                    <th width='20%'>대표곡</th>
                </tr>
                <tr>
                    <td width='20%'><input type='text' name='singer_nm' size='20' style="width:100%"></td>
                    <td width='20%'><input type='text' name='singer_age' size='20'style="width:100%"></td>
                    <td width='20%'><input type='text' name='singer_kg' size='20' style="width:100%"></td>
                    <td width='20%'><input type='text' name='singer_tall' size='20' style="width:100%"></td>
                    <td width='20%'><input type='text' name='pop_music' size='20' style="width:100%"></td>
                </tr>
            </table>     
            <input type='button' value='singer push' onclick='submit();' style="margin:0 auto; display:block;">
        </form>
        <!--
        @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
        @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
        @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
        -->
        <br>
        <form name ='TRM' method='post' action='admin_main.php'</center> <!--입력한 값은 input_prog.php로 넘어갑니다.-->
            <h3>작곡가 데이터 생성</h3>
            <table width='600' border = 1>
                <tr>
                    <th width='50%'>작곡가 이름</th>
                    <th width='50%'>대표곡</th>
                </tr>
                <tr>
                    <td width='50%'><input type='text' name='composer_nm' size='20' style="width:100%"></td>
                    <td width='50%'><input type='text' name='pop_music_compo' size='20' style="width:100%"></td>
                </tr>
            </table>     
            <input type='button' value='composer push' onclick='submit();' style="margin:0 auto; display:block;">
        </form>
        <!--
        @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
        @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
        @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
        -->
        <br>
        <form name ='TRM' method='post' action='admin_main.php'</center> <!--입력한 값은 input_prog.php로 넘어갑니다.-->
            <h3>앨범 데이터 생성</h3>
            <table width='600' border = 1>
                <tr>
                    <th width='50%'>가수</th>
                    <th width='50%'>몇집</th>
                </tr>
                <tr>
                    <td width='40%'><input type='text' name='album_singer' size='20' style="width:100%"></td>
                    <td width='20%'><input type='text' name='album_cnt' size='20' style="width:100%"></td>
                </tr>
            </table>     
            <input type='button' value='album push' onclick='submit();' style="margin:0 auto; display:block;">
        </form>
        <!--
        @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
        @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
        @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
        -->
        <br>
        <form name ='TRM' method='post' action='admin_main.php'</center> <!--입력한 값은 input_prog.php로 넘어갑니다.-->
            <h3>노래 데이터 생성</h3>
            <table width='1000' border = 1>
                <tr>
                    <th width='20%'>곡명</th>
                    <th width='20%'>분류</th>
                    <th width='20%'>가수</th>
                    <th width='20%'>작곡가</th>
                    <th width='20%'>앨범</th>
                </tr>
                <tr>
                    <td width='20%'><input type='text' name='music_nm' size='20' style="width:100%"></td>
                    <td width='20%'>
                        <select name="music_div" style="width:100%;">  <!--셀렉트박스의 이름은 Combo 입니다. 기억해두세요.-->
                            <option selected>메뉴선택</option>
                            <option value=1>발라드</option>
                            <option value=2>랩</option>
                            <option value=3>힙합</option>
                            <option value=4>댄스</option>
                            <option value=5>인다</option>
                        </select>
                    </td>
                    <td width='20%'><input type='text' name='mu_singer_nm' size='20' style="width:100%"></td>
                    <td width='20%'><input type='text' name='mu_composer_nm' size='20' style="width:100%"></td>
                    <td width='20%'><input type='text' name='album_no' size='20' style="width:100%"></td>
                </tr>
            </table>     
            <input type='button' value='music push' onclick='submit();' style="margin:0 auto; display:block;">
        </form>
        
        
    </body>
</html>