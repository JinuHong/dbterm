<?php
    header('Content-type: text/html; charset=utf8');
    session_start();
    
    $a = session_id();
    $servername = getenv('IP');
    $username = getenv('C9_USER');
    $password = "";
    $database = "music";
    $dbport = 3306;
    $db = new mysqli($servername, $username, $password, $database, $dbport);    // Conncection 이름
    mysqli_query($db, "set names utf8");
    
    
    $singer_nm = $_POST["singer_nm"];
    $composer_nm = $_POST["composer_nm"];
    $album_singer = $_POST["album_singer"];
    $music_nm = $_POST["music_nm"];
    
    if($singer_nm != ''){
        #@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
        #@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
        $singer_nm = $_POST["singer_nm"];
        $singer_age = $_POST["singer_age"];
        $singer_kg = $_POST["singer_kg"];
        $singer_tall = $_POST["singer_tall"];
        $pop_music = $_POST["pop_music"];
        
        $sql_cnt = "select * from SINGER_INFO;";
        $result_set = mysqli_query($db, $sql_cnt);
        $count = mysqli_num_rows($result_set);
        
        
        $sql = "INSERT INTO SINGER_INFO (singer_no, singer_nm, singer_age, singer_kg, singer_tall, pop_music) VALUES ('$count', '$singer_nm', '$singer_age' , '$singer_kg', '$singer_tall' ,'$pop_music');";
        if($db->query($sql) == TRUE){
            echo ("<SCRIPT LANGUAGE='JavaScript'>
            window.alert('Success Data Insertion')
            window.location.href='https://dbterm-jinuhong.c9users.io/admin_main_form.php';
            </SCRIPT>");
            
        }else{
            echo ("<SCRIPT LANGUAGE='JavaScript'>
            window.alert('Fail Data Insertion')
            window.location.href='https://dbterm-jinuhong.c9users.io/admin_main_form.php';
            </SCRIPT>");
        }
    
    }else if($composer_nm != ''){
        #@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
        #@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
        $composer_nm = $_POST["composer_nm"];
        $pop_music_compo = $_POST["pop_music_compo"];
        
        $sql_cnt = "select * from COMPO_INFO;";
        $result_set = mysqli_query($db, $sql_cnt);
        $count = mysqli_num_rows($result_set);
        
        
        $sql = "INSERT INTO COMPO_INFO (composer_no, composer_nm, pop_music) VALUES ('$count', '$composer_nm', '$pop_music_compo');";
        if($db->query($sql) == TRUE){
            echo ("<SCRIPT LANGUAGE='JavaScript'>
            window.alert('Success Data Insertion')
            window.location.href='https://dbterm-jinuhong.c9users.io/admin_main_form.php';
            </SCRIPT>");
            
        }else{
            echo ("<SCRIPT LANGUAGE='JavaScript'>
            window.alert('Fail Data Insertion')
            window.location.href='https://dbterm-jinuhong.c9users.io/admin_main_form.php';
            </SCRIPT>");
        }
        
    }else if($album_singer != ''){
        #@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
        #@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
        $album_singer = $_POST["album_singer"];
        $album_cnt = $_POST["album_cnt"];
        //$album_singer = str_replace(' ', '', $album_singer);
        
        $sql = "select * from SINGER_INFO where singer_nm = '$album_singer';";
        $result_set = mysqli_query($db, $sql);
        $count = mysqli_num_rows($result_set);
        //echo($album_singer);
        //echo($count);
        
        if($count == 1){
            $row = $db->query($sql)->fetch_assoc();
            $singer_no = $row["singer_no"];
            $sql_cnt = "select * from ALBUM_INFO;";
            $result_set = mysqli_query($db, $sql_cnt);
            $count = mysqli_num_rows($result_set);
            
            
            $sql = "INSERT INTO ALBUM_INFO (album_no, singer_no, album_cnt) VALUES ('$count', '$singer_no', '$album_cnt');";
            if($db->query($sql) == TRUE){
                echo ("<SCRIPT LANGUAGE='JavaScript'>
                window.alert('Success Data Insertion')
                window.location.href='https://dbterm-jinuhong.c9users.io/admin_main_form.php';
                </SCRIPT>");
                
            }else{
                echo ("<SCRIPT LANGUAGE='JavaScript'>
                window.alert('Fail Data Insertion')
                window.location.href='https://dbterm-jinuhong.c9users.io/admin_main_form.php';
                </SCRIPT>");
            }
        }
        
    }else if($music_nm != ''){
        #@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
        #@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
        $music_nm = $_POST["music_nm"];
        $music_div = $_POST["music_div"];
        $singer_nm = $_POST["mu_singer_nm"];
        $composer_nm = $_POST["mu_composer_nm"];
        $album_cnt = $_POST["album_no"];
        
        // ----- SINGER_NO 검색
        $sql = "select * from SINGER_INFO where singer_nm = '$singer_nm';";
        $result_set = mysqli_query($db, $sql);
        $singer_count = mysqli_num_rows($result_set);
        $singer_row = $db->query($sql)->fetch_assoc();
        $singer_no = $singer_row["singer_no"];
        
        // ----- COMPOSER_NO 검색
        $sql = "select * from COMPO_INFO where composer_nm = '$composer_nm';";
        $result_set = mysqli_query($db, $sql);
        $compo_count = mysqli_num_rows($result_set);
        $compo_row = $db->query($sql)->fetch_assoc();
        $compo_no = $compo_row["composer_no"];
        
        // ----- ALBUM_NO 검색
        $sql = "select * from ALBUM_INFO where singer_no = '$singer_no' and album_cnt = '$album_cnt';";
        $result_set = mysqli_query($db, $sql);
        $album_count = mysqli_num_rows($result_set);
        $album_row = $db->query($sql)->fetch_assoc();
        $album_no = $album_row["album_no"];
        
        
        
        if($singer_count == 1 && $compo_count == 1 && $album_count == 1){
            $sql_cnt = "select * from MUSIC;";
            $result_set = mysqli_query($db, $sql_cnt);
            $count = mysqli_num_rows($result_set);
            $sql = "INSERT INTO MUSIC (music_no, music_nm, music_div, singer_no, composer_no, album_no, music_like) VALUES ('$count', '$music_nm', '$music_div', '$singer_no', '$compo_no', '$album_no', 0);";
            
            if($db->query($sql) == TRUE){
                echo ("<SCRIPT LANGUAGE='JavaScript'>
                window.alert('Success Data Insertion')
                window.location.href='https://dbterm-jinuhong.c9users.io/admin_main_form.php';
                </SCRIPT>");
            }else{
            echo ("<SCRIPT LANGUAGE='JavaScript'>
            window.alert('Fail Data Insertion')
            window.location.href='https://dbterm-jinuhong.c9users.io/admin_main_form.php';
            </SCRIPT>");
            }
        }
    }else{
        #@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
        #@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
        echo "None of Them<br>";
    }

    
?>