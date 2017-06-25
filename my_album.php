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
    
    /*
    1. 해당 음악을 본인의 앨범에서 삭제하는 기능을 구현해야함.
    */
    
   if (isset($_POST['DELETE_BUTTON'])) { # LIKE BUTTON을 눌렀을 때,
       #@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
       #@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
        try{
            $db->begin_Transaction();
            # 1) 해당 Email의 LIKE_MUSIC에 해당 노래들을 추가한다. + 2 ) 히스토리에도.
            if( isset($_POST['Music']) && !empty($_POST['Music']) ) {
                foreach($_POST['Music'] as $one_music) {
                    $db->query("DELETE FROM USER_ALBUM where EMAIL = '$my_email' and music_no = '$one_music';");
                }
                $musicList = implode(', ', $_POST['Music']);
            }    
            $db->commit();
            echo ("<SCRIPT LANGUAGE='JavaScript'>
                    window.alert('Success DELETE')
                    window.location.href='https://dbterm-jinuhong.c9users.io/my_album_form.php';
                    </SCRIPT>");
        }catch (Exception $e){
            $db->rollback();
            echo ("<SCRIPT LANGUAGE='JavaScript'>
                    window.alert('FAIL DELETE')
                    window.location.href='https://dbterm-jinuhong.c9users.io/my_album_form.php';
                    </SCRIPT>");
        }

    } 
    
?>