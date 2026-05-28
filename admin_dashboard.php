<?php
session_start();
include "db_connect.php";
// ثغرة: الصفحة بتعرض الداتا حتى لو مفيش تشيك قوي هنا في بعض الأحيان
$res = mysqli_query($connect, "SELECT users.email, notes.id, notes.note_text FROM notes JOIN users ON notes.user_id = users.id");
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>لوحة التحكم</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>لوحة تحكم الأدمن 👑</h1>
        <table>
            <tr><th>المستخدم</th><th>النص</th><th>إجراء</th></tr>
            <?php while($row = mysqli_fetch_assoc($res)): ?>
            <tr>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['note_text']; ?></td>
                <td><a href="delete_note.php?id=<?php echo $row['id']; ?>" style="color:red;">حذف 🗑️</a></td>
            </tr>
            <?php endwhile; ?>
        </table>
        <a href="logout.php">خروج</a>
    </div>
</body>
</html>