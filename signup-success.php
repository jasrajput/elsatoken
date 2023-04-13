<?php
session_start();
if (isset($_SESSION['us_id_reference']) && isset($_SESSION['us_pass_reference'])) {
    $user_id = $_SESSION['us_id_reference'];
    $pass = $_SESSION['us_pass_reference'];

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
                <div class="ath-body text-center">
                    <h5 class="ath-heading title">Verify <small class="tc-default">your email address</small></h5>
                    <h4 class="page-ath-heading">Thank you! <small>Your signup process is alomost done.Your details has
                            been sent to your email account.</small>
                    </h4>
                    <p class="text-success">Please check your
                        mail and verify.</p>
                    <p>
                        Click here to <a href="login" class='font-weight-bold'>sign in</a>
                    </p>

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
    unset($_SESSION['us_id_reference']);
    unset($_SESSION['us_pass_reference']);
} else {
    header("location: login.php");
}
?>