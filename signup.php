<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>
    <link rel="stylesheet" href="style.css" />
</head>
  <body>
    <nav>
        <nav class="signup-box">
            <h1>Đăng ký</h1>
            <h4>Hoàn toàn miễn phí</h4>
            <form method = "POST" action ="process-signup.php" class = "signin-up">
                <label>Họ tên</label><br>
                <input type="text" name = "name" placeholder="Họ tên" /><br>
                <label>Email</label><br>
                <input type="email" name = "email" placeholder="Email" /><br>
                <label>Mật khẩu</label><br>
                <input type="password"  name = "password" placeholder="Mật khẩu mới" /><br>
                <label>Xác nhận mật khẩu</label><br>
                <input type="password" name = "confirm_password"placeholder="Xác nhật mật khẩu" /><br>
                <button type = "submit">Đăng ký</button>
            </form>
            <p class="have_account">
                Bạn đã có tài khoản? <a href="signin.php">Đăng nhập</a><br>
                <a href="index.php">Trang chủ</a>
            </p>
        </nav>
    </nav>
  </body>
</html>
