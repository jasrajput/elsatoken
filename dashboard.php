<!DOCTYPE html>
<html lang="zxx" class="js">

<?php
    $title = "Register Successfully | ELSA TOKEN";
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
                    <h5 class="ath-heading title">Verify your Mail</h5>
                    <p class='text-center'>
                    Please verify your account by clicking on the link sent to you via mail. If you can't see mail in your inbox chack spam folder also.
                    </p>
                    <form id="resend" action="/resend" method="POST">
                        <div class="text-center">
                        <button type='button'  onclick="javascript:location.href = '/logout'" class="btn btn-primary btn-block btn-md">Logout</button>
                        </div>
                    </form>
                </div>
                <div class="ath-note text-center tc-light">
                    Didn't Receive? <a href="javascript:void(0)" onclick="event.preventDefault();document.getElementById('resend').submit();"> <strong>Resent Mail</strong></a>
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