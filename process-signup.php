<?php

if (empty($_POST["name"])){
    die("<script>alert('Vui lòng điền họ tên!');window.location.href = 'signup.php';</script>");
}

if ( ! filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
    die("<script>alert('Vui lòng điền email chính xác!');window.location.href = 'signup.php';</script>");
}

if ( strlen($_POST["password"]) < 8){
    die("<script>alert('Mật khẩu tối thiểu 8 ký tự!');window.location.href = 'signup.php';</script>");
}

if (!preg_match('`[a-z]`',$_POST['password'])){
    die("<script>alert('Mật khẩu tối thiểu 1 chữ cái thường!');window.location.href = 'signup.php';</script>");
}

if (!preg_match('`[0-9]`',$_POST['password'])){
    die("<script>alert('Mật khẩu tối thiểu 1 chữ số!');window.location.href = 'signup.php';</script>");
}

if (!preg_match('`[A-Z]`',$_POST['password'])){
    die("<script>alert('Mật khẩu tối thiểu 1 chữ cái hoa!');window.location.href = 'signup.php';</script>");
}

if ($_POST["password"] !== $_POST["confirm_password"]){
    die("<script>alert('Vui lòng xác nhận đúng mật khẩu!');window.location.href = 'signup.php';</script>");
}

require_once "database.php";

$sql = "INSERT INTO dangky(TENHIENTHI, EMAIL, PASSWORD, VAITRO)
        VALUES ('".$_POST["name"]."', '".$_POST["email"]."', '".$_POST["password"]."','0')";

$mysqli -> query($sql);

header("Location: signup-success.php");