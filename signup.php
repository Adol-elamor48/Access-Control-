<?php
include "db_connect.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email']; $pass = $_POST['password'];
    $stmt = mysqli_prepare($connect, "INSERT INTO users (email, password, role) VALUES (?, ?, 'user')");
    mysqli_stmt_bind_param($stmt, "ss", $email, $pass);
    if (mysqli_stmt_execute($stmt)) { header("Location: login.php"); }
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>إنشاء حساب</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="card">
        <h2>إنشاء حساب جديد 👤</h2>
        <form method="post">
            <input type="email" name="email" placeholder="البريد الإلكتروني" required>
            <input type="password" name="password" placeholder="كلمة المرور" required>
            <button type="submit" class="btn-green">تسجيل</button>
        </form>
        <a href="login.php">لديك حساب؟ سجل دخول</a>
    </div>
</body>
</html>