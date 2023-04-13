<?php
$conn = mysqli_connect("localhost", "root", "root", "anbswap");
mysqli_query($conn, "SET time_zone = '+5:30' ");
date_default_timezone_set('Asia/Kolkata');

if (!$conn) {

    die("Mysql Error" . mysqli_connect_error());
}