<?php

header('Content-type: text/html; charset=utf-8');
$servername = getenv('IP');
$username = getenv('C9_USER');
$password = "";
$database = "music";
$dbport = 3306;
$db = new mysqli($servername, $username, $password, $database, $dbport);
$result  = mysqli_query($db, "select m.music_no, m.music_nm, s.singer_nm, m.music_like
                            from MUSIC as m, SINGER_INFO as s
                            where m.singer_no = s.singer_no;");

echo"
<html>
    <head>
        <title>유저 메인페이지</title>
        <meta charset = 'utf-8'>
    </head>
    <body>
        <br><br><br><br>
        <center><h1>여기서 유저는 음악들의 목록을 볼 수 있습니다.</h1></center>
        <!--
        @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
        @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
        @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
        -->
        <br>
        <form name ='TRM' method='post' action='user_main.php'></center> <!--입력한 값은 input_prog.php로 넘어갑니다.-->
            <h3>보유 음악데이터</h3>
            <table width='1000' border = 1>
                <tr>
                    <th></th>
                    <th width='37%'>곡명</th>
                    <th width='40%'>가수</th>
                    <th width='20%'>좋아요</th>
                </tr>
";

while($row = mysqli_fetch_array($result)){
    $like_count = $row[music_like];
    if($like_count == null) $like_count = 0; 
    echo "<tr>";
    echo "<td style='text-align:center;'>
              <input type='checkbox' name='Music[]' value='".$row[music_no]."' />
            </td>";
    echo "<td>". $row[music_nm]."</td>";
    echo "<td>". $row[singer_nm]."</td>";
    echo "<td>". $like_count."</td></tr>";
}

echo"
            
            <button type='submit' name='LIKE_BUTTON' value='LIKE' style='margin:1 1;'>LIKE</button>
            <button type='submit' name='ADD_BUTTON' value='ADD' style='margin:1 1;'>ADD MY_ALBUM</button>
            <button type='submit' name='MY_ALBUM' value='MY_ALBUM' style='margin:1 1;'>MY_ALBUM</button>
            <button type='submit' name='DETAIL' value='DETAIL' style='margin:1 1;'>DETAIL</button>
        </form>
        <form name ='TRM' method='post' action='user_main_search.php'>
            <input type='text' name='SEARCH' size='20' style='margin:1 1 1 425;'>
            <button type='submit' name='SEARCH_BUTTON' value='SEARCH_BUTTON' style='margin:1 1;'>SEARCH</button>
        </form>
    </body>
</html>
";

?>