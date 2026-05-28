<?php
session_start();
include "db_connect.php";
if (!isset($_SESSION['user_id'])) { header("Location: login.php"); }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $note = $_POST['note'];
    $stmt = mysqli_prepare($connect, "INSERT INTO notes (user_id, note_text) VALUES (?, ?)");
    mysqli_stmt_bind_param($stmt, "is", $_SESSION['user_id'], $note);
    mysqli_stmt_execute($stmt);
}

$res = mysqli_query($connect, "SELECT * FROM notes WHERE user_id = ".$_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>ملاحظاتي</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>ملاحظاتي 📝</h2>
        <form method="post">
            <input type="text" name="note" placeholder="اكتب ملاحظة جديدة..." required>
            <button type="submit">إضافة</button>
        </form>
        <div class="notes-list">
            <?php while($row = mysqli_fetch_assoc($res)): ?>
                <div class="note-item">
                    <span><?php echo $row['note_text']; ?></span>
                    <a href="view_note.php?id=<?php echo $row['id']; ?>" class="view-btn">عرض 👁️</a>
                </div>
            <?php endwhile; ?>
        </div>
        <a href="logout.php">تسجيل خروج</a>
    </div>
</body>
</html>