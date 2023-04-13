<?php
session_start();

if (isset($_POST['sub'])) {
    if (true) {
        include("conn.php");
        $user = filter_var($_POST['username'], FILTER_SANITIZE_EMAIL);
        // $pass = filter_var($_POST['password'], FILTER_SANITIZE_STRING);


        $query = $conn->prepare("SELECT id, user_id, password, status, is_verify, email FROM member WHERE email = ?");
        $query->bind_param('s', $user);
        $query->execute();
        $query->bind_result($user_di_id, $user_id, $password, $status, $is_mail_verify, $email);
        $query->fetch();
        $query->close();

        if ($status == 1) {
            exit("Restricted Access.");
        }
        if ($user_di_id && strtolower($user) == strtolower($email)) {
            if (true) {
            // if ($pass === $password) {
                if ($is_mail_verify == 0) {
                    $_SESSION['not_verified'] = $user_id;
                    header("location: ../email-non-verify.php");
                    exit();
                } else if ($is_mail_verify == 1) {
                    if (isset($_SESSION['not_verified'])) unset($_SESSION['not_verified']);
                }
                session_regenerate_id(true);
                $_SESSION['usi'] = $user_id;
                $conn->close();
                header("location:index");
            } else {
                $conn->close();
                echo "<script type='text/javascript'>
                            alert('Wrong Password');
                            window.location='../login.php';
                            </script>";
            }
        } else {
            $conn->close();
            echo "<script type='text/javascript'>alert('Account do not exist');window.location='../login.php';</script>";
            exit();
        }
    }
} else {

    header("location:../login.php");
}