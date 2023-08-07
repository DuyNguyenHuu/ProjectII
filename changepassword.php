<?php
    require_once "database.php";
    require_once "session.php";

    error_reporting(E_ERROR | E_PARSE);

    $email = $_SESSION["email"];
    $sql_updateinfor = " SELECT * FROM `dangky` WHERE EMAIL = '$email'";
    $result_changepassword = $mysqli -> query($sql_updateinfor);

    if (mysqli_num_rows($result_changepassword) > 0){
        $prev = "";
        while ($row = mysqli_fetch_assoc($result_changepassword))
            if ($row["EMAIL"] != $prev){

                if ($_POST["oldpass"] !== $row[PASSWORD]){
                    die("<script>alert('Mật khẩu không chính xác');window.location.href = 'index.php';</script>");
                }   

                elseif ($_POST["newpass"] !== $_POST['againnewpass']){
                    die("<script>alert('Mật khẩu mới không trùng khớp');window.location.href = 'index.php';</script>");
                }

                elseif ( strlen($_POST["newpass"]) < 8){
                    die("<script>alert('Mật khẩu tối thiểu 8 ký tự!');window.location.href = 'index.php';</script>");
                }
        
                elseif (!preg_match('`[a-z]`',$_POST['newpass'])){
                    die("<script>alert('Mật khẩu tối thiểu 1 chữ cái thường!');window.location.href = 'index.php';</script>");
                }
        
                elseif (!preg_match('`[0-9]`',$_POST['newpass'])){
                    die("<script>alert('Mật khẩu tối thiểu 1 chữ số!');window.location.href = 'index.php';</script>");
                }
        
                elseif (!preg_match('`[A-Z]`',$_POST['newpass'])){
                    die("<script>alert('Mật khẩu tối thiểu 1 chữ cái hoa!');window.location.href = 'index.php';</script>");
                }

                else { 
                    $sql_changepassword = "UPDATE `dangky` SET `PASSWORD`='".$_POST['newpass']."' 
                                            WHERE EMAIL = '$email'";              
                    $mysqli -> query($sql_changepassword);

                    echo "<script>alert('Cập nhật thành công');window.location.href = 'index.php';</script>";
                }
            }
    }
?>