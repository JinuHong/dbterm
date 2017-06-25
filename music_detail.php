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

$comment_text = $_POST["comment_text"];
$music_no = $_POST["song_no"];

$sql = "INSERT INTO MUSIC_COMMENT (music_no, email, commenting) VALUES ('$music_no', '$my_email', '$comment_text');";
if($db->query($sql) == TRUE){
        echo "<SCRIPT LANGUAGE='JavaScript'>
                    window.alert('Success ADD COMMENT')
                    window.location.href='https://dbterm-jinuhong.c9users.io/user_main_form.php';
                    </SCRIPT>";
    }else{
        echo "<SCRIPT LANGUAGE='JavaScript'>
                    window.alert('Fail ADD COMMENT')
                    window.location.href='https://dbterm-jinuhong.c9users.io/user_main_form.php';
                    </SCRIPT>";
    }
?>