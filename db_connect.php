<?php
$connect = mysqli_connect("localhost", "root", "", "lab_db");
if (!$connect) { die("خطأ في الاتصال"); }