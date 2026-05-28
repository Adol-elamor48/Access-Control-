<?php
session_start();
include "db_connect.php";
if (!isset($_SESSION['user_id'])) { header("Location: login.php"); }

$id = $_GET['id']; // الثغرة هنا: مفيش تأكد إن الـ user_id هو صاحب الـ id ده
$res = mysqli_query($connect, "SELECT * FROM notes WHERE id = $id");
$note = mysqli_fetch_assoc($res);
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="card">
        <h3>تفاصيل الملاحظة</h3>
        <p><?php echo $note ? $note['note_text'] : "غير موجودة"; ?></p>
        <a href="notes.php">رجوع</a>
    </div>
</body>
</html>