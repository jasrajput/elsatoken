<!DOCTYPE html>
<html lang="en" class="js">

<?php
$title = "Login | ELSA TOKEN";
include_once 'head.php'
?>

<body class="nk-body body-wider bg-light-alt">

    <div class="nk-wrap">

        <main class="nk-pages nk-pages-centered bg-theme">
            <div class="ath-container">
                <div class="ath-header text-center">
                    <a href="./index" class="ath-logo"><img class='h-90' src="logo-white.png" srcset="logo-white.png 2x" alt="logo"></a>
                </div>
                <div class="ath-body">
                    <h5 class="ath-heading title">Sign in <small class="tc-default">with your ELSA Account</small></h5>
                    <form action="auths/check_logged.php" method="POST">
                        <div class="field-item">
                            <div class="field-wrap">
                                <input type="email" name='username' class="input input-bordered" placeholder="Your Email" required>
                            </div>
                        </div>
                        <!-- <div class="field-item">
                            <div class="field-wrap">
                                <input type="password" name='password' class="input input-bordered" placeholder="Password" required>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center pdb-r">
                            <div class="field-item pb-0">
                                <input class="input-checkbox" id="remember-me-2" type="checkbox">
                                <label for="remember-me-2">Remember Me</label>
                            </div>
                            <div class="forget-link fz-6">
                                <a href="forget-password">Forgot password?</a>
                            </div>
                        </div> -->
                        <button type="submit" name='sub' class="btn btn-primary col-md-12 btn-block btn-md">Sign In</button>
                    </form>
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