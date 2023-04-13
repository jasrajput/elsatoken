<!DOCTYPE html>
<html lang="en" class="js">

<?php
    $title = "Reset Password | ELSA TOKEN";
    include_once 'head.php';
?>


<body class="nk-body body-wider bg-light-alt">

    <div class="nk-wrap">

        <main class="nk-pages nk-pages-centered bg-theme">
            <div class="ath-container">
                <div class="ath-header text-center">
                <a href="./" class="ath-logo"><img class='h-90' src="logo.png"
                            srcset="logo.png 2x" alt="logo"></a>
                </div>
                <div class="ath-body">
                    <h5 class="ath-heading title">Reset <small class="tc-default">with your Email</small></h5>
                    <p class="page-ath-heading text-center">If you forgot your password, well, then we’ll email
                        you instructions to reset your password.</span></p>
                    <form id="resend" action="check_forgot_password" method="POST">
                        <div class="field-item">
                            <div class="field-wrap">
                                <input type="email" name='email' class="input-bordered" placeholder="Your Email" required>
                            </div>
                        </div>
                        <div class='text-center'>
                            <button type='submit' name='sub' class="btn btn-primary btn-block btn-md">Send Password</button>
                        </div>
                    </form>
                </div>
                <div class="ath-note text-center tc-light">
                    Remembered? <a href="login"> <strong>Sign in here</strong></a>
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