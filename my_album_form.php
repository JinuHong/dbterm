<?php

header('Content-type: text/html; charset=utf-8');
session_start();
$my_email = $_SESSION['email'];
    
$servername = getenv('IP');
$username = getenv('C9_USER');
$password = "";
$database = "music";
$dbport = 3306;
$db = new mysqli($servername, $username, $password, $database, $dbport);
$result  = mysqli_query($db, "select m.music_no, m.music_nm, s.singer_nm, m.music_like, c.composer_nm
                            from USER_ALBUM as u, MUSIC as m, SINGER_INFO as s, COMPO_INFO as c
                            where m.singer_no = s.singer_no and
                            c.composer_no = m.composer_no and
                            u.music_no = m.music_no and
                            u.email = '$my_email';");

echo"
<html>
    <head>
        <title>유저 앨범페이지</title>
        <meta charset = 'utf-8'>
    </head>
    <body>
        <br><br><br><br>
        <center><h1>여기서 유저는 본인의 앨범 목록을 볼 수 있습니다.</h1></center>
        <!--
        @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
        @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
        @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
        -->
        <br>
        <form name ='TRM' method='post' action='my_album.php'</center> <!--입력한 값은 input_prog.php로 넘어갑니다.-->
            <h3>나의 음악 앨범</h3>
            <table width='1000' border = 1>
                <tr>
                    <th></th>
                    <th width='37%'>곡명</th>
                    <th width='20%'>가수</th>
                    <th width='20%'>작곡가</th>
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
    echo "<td>". $row[composer_nm]."</td>";
    echo "<td>". $like_count."</td>";
}

echo"
            
            <button type='submit' name='DELETE_BUTTON' value='LIKE'>DELETE</button>
        </form>
    </body>
</html>
";

?>