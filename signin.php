<?php
    require_once "session.php";

    if ($_SERVER["REQUEST_METHOD"] =="POST"){
        $mysqli = require "database.php";
        $sql = sprintf("SELECT * from dangky where email = '%s'", $mysqli -> real_escape_string($_POST["email"]));
        $result = $mysqli -> query($sql);
        $users = $result -> fetch_assoc();
            if ($users){
                if ($_POST["password"] == $users["PASSWORD"]){
                    $_SESSION["email"] = $users["EMAIL"];
                    header("Location: index.php");
                }
                else die("<script>alert('Tài khoản hoặc mật khẩu sai!');window.location.href = 'signin.php';</script>");
            }
            else die("<script>alert('Tài khoản hoặc mật khẩu sai!');window.location.href = 'signin.php';</script>");
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="style.css" />
</head>
  <body>
    <nav>
        <nav class="signin-box">
            <h1>Đăng nhập</h1>
            <form method = "POST" class="signin-up">
                <label>Email</label><br>
                <input type="email" name = "email" placeholder="Email" /><br>
                <label>Mật khẩu</label><br>
                <input type="password"  name = "password" placeholder="Mật khẩu mới" /><br>
                <button type = "submit">Đăng nhập</button>
            </form>
            <p class="have_account">
                Bạn chưa có tài khoản? <a href="signup.php">Đăng ký</a><br>
                <a href="index.php">Trang chủ</a>
            </p>
        </nav>
    </nav>
  </body>
</html>
