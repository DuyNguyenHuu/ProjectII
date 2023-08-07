<?php
    require_once "database.php";
    require_once "session.php";

    error_reporting(E_ERROR | E_PARSE);


    $email = $_SESSION["email"];
    $sql_updateinfor = "UPDATE `dangky` SET `TENHIENTHI`='".$_POST['hoten']."', `MSSV`='".$_POST['mssv']."', 
                                            `CLASS`='".$_POST['lop']."', `COURSE`='".$_POST['khoa']."'  
                                        WHERE EMAIL = '$email'";              
    $mysqli -> query($sql_updateinfor);

    echo "<script>alert('Cập nhật thành công');window.location.href = 'index.php';</script>";
?>