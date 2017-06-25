<?php
    header('Content-type: text/html; charset=utf8');
    session_start();
    $my_email = $_SESSION['email'];
    $a = session_id();
    $servername = getenv('IP');
    $username = getenv('C9_USER');
    $password = "";
    $database = "music";
    $dbport = 3306;
    $db = new mysqli($servername, $username, $password, $database, $dbport);    // Conncection 이름
    mysqli_query($db, "set names utf8");
    
    $song_nm = "";
    $song_no = 0;
    
    /*
    O 1. Session으로 현재 진행 Email 얻어서   
        1) 해당 Email Album에 해당 노래들 추가하고
        2) 해당 Email Album Histroy에 해당 노래들 추가하고
        3) 해당 노래들 LIKE_MUSIC ? 하나씩 올려주고
        4) 중요한건 이 모든게 Transaction으로 이어져야한다.
    
    O 2. LIKE나 ADD하면, USER 성향 변하게 바꿈
    O 3. MY ALBUM 볼 수 있는 BUTTON 추가해서 PHP 파일 추가로 구현 들어가야함
    =====================================================================================
    4. 테이블에 있는 음악 클릭하면, 해당 음악 상세페이지로 이동되어야한다.
    5. MUSIC_COMMENT 구성해서 해야해. 4번해야 할 수 있는 것.
    6. Search기능 구현해야함
    */
    
   if (isset($_POST['LIKE_BUTTON'])) { # LIKE BUTTON을 눌렀을 때,
       #@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
       #@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
        try{
            $db->begin_Transaction();
            # 1) 해당 Email의 LIKE_MUSIC에 해당 노래들을 추가한다. + 2 ) 히스토리에도.
            if( isset($_POST['Music']) && !empty($_POST['Music']) ) {
                foreach($_POST['Music'] as $one_music) {
                    $db->query("INSERT INTO LIKE_MUSIC (EMAIL, MUSIC_NO) VALUES ('$my_email', '$one_music');");
                    $db->query("INSERT INTO LIKE_MUSIC_HIST (EMAIL, MUSIC_NO) VALUES ('$my_email', '$one_music');");
                    $db->query("UPDATE MUSIC SET MUSIC_LIKE=MUSIC_LIKE+1 WHERE MUSIC_NO='$one_music';");
                    
                    #=================================================================================================
                    $search_sql = "select * from MUSIC where MUSIC_NO = '$one_music';";
                    $result = mysqli_query($db, $search_sql);
                    $music_row = $db->query($search_sql)->fetch_assoc();
                    $music_divide = $music_row["music_div"];
                    if($music_divide == 1) $db->query("UPDATE USER_PREFER SET bar_pre = bar_pre + 1 where email = '$my_email'; ");
                    else if($music_divide == 2) $db->query("UPDATE USER_PREFER SET rap_pre = rap_pre + 1 where email = '$my_email';");
                    else if($music_divide == 3) $db->query("UPDATE USER_PREFER SET hip_pre = hip_pre + 1 where email = '$my_email';");
                    else if($music_divide == 4) $db->query("UPDATE USER_PREFER SET dan_pre = dan_pre + 1 where email = '$my_email';");
                    else if($music_divide == 5) $db->query("UPDATE USER_PREFER SET in_pre = in_pre + 1 where email = '$my_email';");
                    
                    
                }
                $musicList = implode(', ', $_POST['Music']);
            }    
            $db->commit();
            echo ("<SCRIPT LANGUAGE='JavaScript'>
                    window.alert('Success LIKING')
                    window.location.href='https://dbterm-jinuhong.c9users.io/user_main_form.php';
                    </SCRIPT>");
        }catch (Exception $e){
            $db->rollback();
            echo ("<SCRIPT LANGUAGE='JavaScript'>
                    window.alert('FAIL LIKING')
                    window.location.href='https://dbterm-jinuhong.c9users.io/user_main_form.php';
                    </SCRIPT>");
        }

    } else if (isset($_POST['ADD_BUTTON'])) { #ADD BUTTON을 눌렀을 때,
        #@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
       #@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
       try{
            $db->begin_Transaction();
            if( isset($_POST['Music']) && !empty($_POST['Music']) ) {
                foreach($_POST['Music'] as $one_music) {
                    $db->query("INSERT INTO USER_ALBUM (EMAIL, MUSIC_NO) VALUES ('$my_email', '$one_music');");
                }
                $musicList = implode(', ', $_POST['Music']);
            }    
            $db->commit();
            echo ("<SCRIPT LANGUAGE='JavaScript'>
                    window.alert('Success ADD MYALBUM')
                    window.location.href='https://dbterm-jinuhong.c9users.io/user_main_form.php';
                    </SCRIPT>");
        }catch (Exception $e){
            $db->rollback();
            echo ("<SCRIPT LANGUAGE='JavaScript'>
                    window.alert('FAIL ADD MYALBUM')
                    window.location.href='https://dbterm-jinuhong.c9users.io/user_main_form.php';
                    </SCRIPT>");
        }

    } else if(isset($_POST['MY_ALBUM'])){
        echo ("<SCRIPT LANGUAGE='JavaScript'>
                    window.location.href='https://dbterm-jinuhong.c9users.io/my_album_form.php';
                    </SCRIPT>");
    } else if (isset($_POST['DETAIL'])) { 
        foreach($_POST['Music'] as $one_music) {
            $music_row = $db->query("select m.music_no, m.music_nm, m.music_div, m.music_like, s.singer_nm, s.singer_age, s.singer_tall, s.singer_kg, s.pop_music, c.composer_nm, a.album_cnt
                                from MUSIC as m, SINGER_INFO as s, COMPO_INFO as c, ALBUM_INFO as a
                                where m.singer_no = s.singer_no and
                                c.composer_no = m.composer_no and
                                m.album_no = a.album_no and
                                m.music_no = $one_music;
                                "
                                )->fetch_assoc();
                                
            $music_nm = $music_row["music_nm"];
            $music_divide = $music_row["music_div"];
            $music_type = "";
            if($music_divide == 1) $music_type = "발라드";
            else if($music_divide == 2) $music_type = "힙합";
            else if($music_divide == 3) $music_type = "랩";
            else if($music_divide == 4) $music_type = "댄스";
            else if($music_divide == 5) $music_type = "인디";
            
            $like_cnt = $music_row["music_like"];
            $singer = $music_row["singer_nm"];
            $compo = $music_row["composer_nm"];
            $singer_age =  $music_row["singer_age"];
            $singer_tall = $music_row["singer_tall"];
            $singer_kg = $music_row["singer_kg"];
            $pop_music = $music_row["pop_music"];
            $song_nm = $music_row["music_nm"];
            $song_no = $music_row["music_no"];
            echo "
            <html>
                <head>
                    <title>음원 상세정보</title>
                    <meta charset = 'utf-8'>
                </head>
                
                <body>
                    <br><br><br><br>
                    <center>음원 상세정보</center>
                    <br>
                    <table width='600' border = 1 style='margin: 0 auto;'>
                        <tr>
                            <td width='20%'><center>제목</center></td>
                            <td width='80'>'$music_nm'</td>
                        </tr>
                        <tr>
                            <td width='20%'><center>장르</center></td>
                            <td width='80'>'$music_type'</td>
                        </tr>
                        <tr>
                            <td width='20%'><center>좋아하는 회원 수</center></td>
                            <td width='80'>'$like_cnt'</td>
                        </tr>
                        <tr>
                            <td width='20%'><center>가수</center></td>
                            <td width='80'>'$singer'</td>
                        </tr>
                        <tr>
                            <td width='20%'><center>작곡가</center></td>
                            <td width='80'>'$compo'</td>
                        </tr>
                    </table>
                   
                   <center>음원 - 가수 상세정보</center>
                    <br>     
                    
                    <table width='600' border = 1 style='margin: 0 auto;'>
                        <tr>
                            <td width='20%'><center>이름</center></td>
                            <td width='80'>'$singer'</td>
                        </tr>
                        <tr>
                            <td width='20%'><center>나이</center></td>
                            <td width='80'>'$singer_age'</td>
                        </tr>
                        <tr>
                            <td width='20%'><center>키</center></td>
                            <td width='80'>'$singer_tall'</td>
                        </tr>
                        <tr>
                            <td width='20%'><center>몸무게</center></td>
                            <td width='80'>'$singer_kg'</td>
                        </tr>
                        <tr>
                            <td width='20%'><center>대표곡</center></td>
                            <td width='80'>'$pop_music'</td>
                        </tr>
                    </table>
                    <br><br><br><br>
                    <center>음원 - 댓글정보</center>
                    <table width='600' border = 1 style='margin: 0 auto;'>
                    ";
            
            $comment_sql = "select * from MUSIC_COMMENT where music_no='$song_no';";
            $result = mysqli_query($db, $comment_sql);
            while($row = mysqli_fetch_array($result)){
                $commenting = $row[commenting];
                $email_id = $row[email];
                echo"<tr>";
                echo"<td width='30%'>".$email_id."</td>";
                echo"<td width='70%'>".$commenting."</td>";
                echo"</tr>";
            }
                    
                    
            echo "  
                    </table>
                    <form name ='TRM' method='post' action='music_detail.php'</center>
                    <input type='hidden' name='song_no' value='$song_no'>
                    <div style='margin: 0 auto;'>
                        <textarea name='comment_text' rows='4' cols='50' style='margin: 10 auto; display:block;'>
                        
                        </textarea>
                        <button type='submit' name='Comment' value='Comment' style='margin: 10 auto; display:block;'>Comment</button>
                    </div>
                </body>
            </html>
            ";
            break;
        }
        
        
    }
    

?>