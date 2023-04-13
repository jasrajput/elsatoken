<?php
session_start();
$url = 'https://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
if (preg_match("/([@&%*\$#\*]+)/", $url)) {
    exit("Malformed URL");
}

if (isset($_GET['token'])) {

    $token = htmlspecialchars(filter_var(trim($_GET['token'], " "), FILTER_SANITIZE_STRING));

    include 'auths/conn.php';

    $refer = $conn->prepare('SELECT token, is_verify FROM member WHERE token = ?');
    $refer->bind_param('s', $token);
    $refer->execute();
    $refer->bind_result($token_db, $is_verify);
    $refer->fetch();
    $refer->close();

    if ($token_db == $token && $is_verify == 0) {
        $refer = $conn->prepare('UPDATE member SET is_verify = 1 WHERE token = ?');
        $refer->bind_param('s', $token_db);
        $refer->execute();
        $refer->close();
    } else {
        header("location:404.php");
    }
} else {
    header("location:404.php");
}

?>
<!DOCTYPE html>
<html lang="en" class="js">

<?php
include_once 'head.php'
?>



<body class="nk-body body-wider bg-light-alt">

    <div class="nk-wrap">

        <main class="nk-pages nk-pages-centered bg-theme">
            <div class="ath-container">
                <div class="ath-header text-center">
                    <a href="./index" class="ath-logo"><img class='h-90' src="logo.png" srcset="logo.png 2x"
                            alt="logo"></a>
                </div>
                <div class="ath-body">
                    <h5 class="ath-heading title">Verification Success</h5>
                    <div class="alert alert-success">Your email is successfull verified.</div>
                </div>
                <div class="ath-note text-center tc-light">
                    Sign in to your account? <a href="login.php"> <strong><i>Sign in</i></strong></a>
                </div>
            </div>
        </main>

    </div>
    <div class="preloader"><span class="spinner spinner-round"></span></div>

    <!-- JavaScript -->
    <script src="assets/js/jquery.bundle.js"></script>
    <script src="assets/js/scripts.js"></script>
    <script src="assets/js/charts.js"></script>
</body>

</html>