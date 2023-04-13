<?php
session_start();
if (isset($_SESSION['not_verified'])) {

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
                    <div class="alert alert-danger">We had sent you verification link on your email to activate your
                        email with elsa.finance.If you haven't received an email.Click the button below to
                        receive it again</div>
                    <p>
                        Don’t receive an email? <a href="resend_verify_mail"> <strong><i>Resend
                                    again</i></strong></a>
                    </p>
                </div>
                <div class="ath-note text-center tc-light">
                    Already Verify? Sign in your account <a href="login"> <strong><i>Login</i></strong></a>
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
} else {
    header('location: ../forgot');
}
?>