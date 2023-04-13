<?php
session_start();
unset($_SESSION['usi']);
header("location:../index.php");