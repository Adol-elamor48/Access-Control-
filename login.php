<?php
session_start();
include "db_connect.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $stmt = mysqli_prepare($connect, "SELECT id, role FROM users WHERE email = ? AND password = ?");
    mysqli_stmt_bind_param($stmt, "ss", $email, $pass);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if ($user = mysqli_fetch_assoc($result)) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];
        header($user['role'] === 'admin' ? "Location: admin_dashboard.php" : "Location: notes.php");
    }
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>تسجيل الدخول</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="card">
        <h2>تسجيل الدخول 🔑</h2>
        <form method="post">
            <input type="email" name="email" placeholder="البريد الإلكتروني" required>
            <input type="password" name="password" placeholder="كلمة المرور" required>
            <button type="submit" class="btn-blue">دخول</button>
        </form>
        <a href="signup.php">ليس لديك حساب؟ سجل الآن</a>
    </div>
</body>

</html>