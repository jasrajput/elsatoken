<?php
session_start();
if (isset($_SESSION['not_verified'])) {
    $user_verify_id = $_SESSION['not_verified'];

    include_once 'auths/conn.php';
    include_once 'auths/send_mail.php';

    $query = $conn->prepare("SELECT id,name, user_id, email, is_verify, token FROM member WHERE user_id = ?");
    $query->bind_param('s', $user_verify_id);
    $query->execute();
    $query->bind_result($user_di_id, $name, $user_id, $email, $is_mail_verify, $token);
    $query->fetch();
    $query->close();

    if ($user_id == $user_verify_id && $is_mail_verify == 0) {
        verify_email($email, $user_id, $token); //Verify Email
    } else {
        header('location: login.php');
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
                    <h5 class="ath-heading title">Resent <small class="tc-default">Verification Link</small></h5>
                    <div class="alert alert-success">Verification Link has been sent successfully to your registered
                        email with <a href='https://elsa.finance'>
                            <i>elsa.finance</i>
                        </a></div>
                    <p>
                        Sign in your account
                    </p>
                    <a href="login.php" class="btn btn-primary">Sign In</a>
                </div>
                <div class="ath-note text-center tc-light">
                    Don’t have an account? <a href="register"> <strong>Sign up here</strong></a>
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
<?php
    unset($_SESSION['not_verified']);
} else {
    header('location: login.php');
}
?>