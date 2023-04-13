<?php
session_start();
$url = 'https://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
if (preg_match("/([@&%*\$#\*]+)/", $url)) {
    header('location: 404');
}
if (isset($_GET['sponsor_id'])) {

    $affiliate_id = htmlspecialchars(filter_var(trim($_GET['sponsor_id'], " "), FILTER_SANITIZE_STRING));

    include 'auths/conn.php';

    $refer = $conn->prepare('SELECT id, user_id FROM member WHERE user_id = ?');
    $refer->bind_param('s', $affiliate_id);
    $refer->execute();
    $refer->bind_result($refer_s_id, $pin_s);
    $refer->fetch();
    $refer->close();

    if ($refer_s_id) {
        $affiliate_id = $pin_s;
    } else {
        header('location: 404');
    }
} else {
    $affiliate_id = "";
}

?>
<!DOCTYPE html>
<html lang="en" class="js">

<?php
$title = "Register | ELSA TOKEN - World’s First Ecosystem that Scaling Decentralized Applications";
include_once 'head.php';
?>

<body class="nk-body body-wider bg-light-alt">

    <div class="nk-wrap">

        <main class="nk-pages nk-pages-centered bg-theme">
            <div class="ath-container">
                <div class="ath-header text-center">
                    <a href="./" class="ath-logo"><img class='h-90' src="logo-white.png" srcset="logo-white.png 2x" alt="logo"></a>
                </div>
                <div class="ath-body">
                    <h5 class="ath-heading title">Sign Up <small class="tc-default">Create New ELSA Account</small>
                    </h5>
                    <form action="auths/check_registered.php" class='auth-card__right' method="POST">
                        <div class="field-item">
                            <div class="field-wrap">
                                <input name="ref_id" value='<?= $affiliate_id ?>'
                                    <?= $affiliate_id != '' ? 'readonly' : '' ?> required id="ref_id"  type="text" class="input-bordered"
                                    placeholder="Enter your Referral ID">
                            </div>
                        </div>
                        <div class='row'>
                            <div class='col-md-6'>
                                <div class="field-item">
                                    <div class="field-wrap">
                                        <input type="name" name='name' class="input-bordered"
                                            placeholder="Your Full Name" required>
                                    </div>
                                </div>
                            </div>

                            <div class='col-md-6'>
                                <div class="field-item">
                                    <div class="field-wrap">
                                        <input type="number" name='mobile' class="input-bordered"
                                            placeholder="Your Mobile No." required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="field-item">
                            <div class="field-wrap">
                                <input type="email" name='email' class="input-bordered" placeholder="Your Email"
                                    required>
                            </div>
                        </div>
                        
                        <div class="field-item">
                            <div class="field-wrap">
                                <input type="text" id='amv_address' onkeyup='check_address()' class="input-bordered"
                                    name='wallet_id' placeholder="Metamask/ELSA Wallet Address">
                                <small class='text-danger' id='err'></small>
                            </div>
                        </div>
                        <div class="field-item">
                            <input class="input-checkbox" required id="agree-term-2" type="checkbox">
                            <label for="agree-term-2">I agree to <a href="#">Terms & Condition</a></label>
                        </div>

                        <button onkeydown="return (event.keyCode!=13);" type='submit' id='openButton' name='submit_but'
                            class="btn btn-primary btn-block btn-md col-md-12">Sign
                            Up</button>
                        <div class="ath-note text-center tc-">
                            Already have an account? <a href="login"> <strong>Sign in here</strong></a>
                        </div>
                    </form>
                </div>

            </div>
        </main>

    </div>
    <div class="preloader"><span class="spinner spinner-round"></span></div>

    <!-- JavaScript -->
    <script src="assets/js/jquery.bundle.js"></script>
    <script src="assets/js/scripts.js"></script>
    <script src="assets/js/charts.js"></script>
    <script src="assets/js/wallet-address-validator.min.js"></script>

    <script>
        $(function () {
            $("#openButton").attr("disabled", true);
        })

        function check_address() {
            const amv_address = $("#amv_address").val();
            const valid = WAValidator.validate(amv_address, 'Ethereum')
            if (valid) {
                $("#openButton").attr("disabled", false);
                $("#err").text("VALID").addClass("text-success").removeClass("text-danger");
            } else {
                $("#openButton").attr("disabled", true);
                $("#err").text("INVALID ADDRESS").removeClass("text-success").addClass("text-danger").before(
                    "<i class='fa fa-mark'>");
            }
        }
    </script>
</body>

</html>