<?php
session_start();
include "db_connect.php";
// الثغرة هنا: أي حد يبعت ID هيتمسح من غير ما نتأكد إنه أدمن!
$id = $_GET['id'];
mysqli_query($connect, "DELETE FROM notes WHERE id = $id");
header("Location: admin_dashboard.php");