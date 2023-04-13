<?php
session_start();
if (isset($_SESSION['usi'])) {
    include 'conn.php';
    $user_id = $_SESSION['usi'];

    $refer = $conn->prepare('SELECT  name, email, wallet_add, sponsor_id,mobile FROM member WHERE user_id = ?');
    $refer->bind_param('s', $user_id);
    $refer->execute();
    $refer->bind_result($name, $email, $wallet, $refrral, $mob);
    $refer->fetch();
    $refer->close();
    
    $refer = $conn->prepare('SELECT  name, email FROM member WHERE user_id = ?');
    $refer->bind_param('s', $refrral);
    $refer->execute();
    $refer->bind_result($rname, $remail);
    $refer->fetch();
    $refer->close();
?>
<!DOCTYPE html>
<html lang="en" class="js">
<?php
    include_once 'head.php'
?>

<body class="user-dashboard">


    <?php
    include_once 'header.php'
?>
    <!-- TopBar End -->


    <div class="user-wraper">
        <div class="container">
            <div class="d-flex">

                <div class="user-content">
                    <div class="user-panel">
                        <h2 class="user-panel-title">Account Information</h2>
                        <div class="input-item input-with-label">
                            <label for="full-name" class="input-item-label">Full Name</label>
                            <input class="input-bordered" value='<?= $name ?>'  type="text" disabled="disabled" id="full-name"
                                name="full-name">
                        </div><!-- .input-item -->
                        <div class="input-item input-with-label">
                            <label for="email-address" class="input-item-label">Email Address</label>
                            <input class="input-bordered" value='<?= $email ?>' type="email" disabled="disabled" id="email-address">
                        </div><!-- .input-item -->
                        <div class="input-item input-with-label">
                            <label for="email-address" class="input-item-label">Mobile No.</label>
                            <input class="input-bordered" value='<?= $mob ?>' type="number" disabled="disabled" id="email-address">
                        </div><!-- .input-item -->
                        <div class="input-item input-with-label">
                            <label for="email-address" class="input-item-label">Wallet Address</label>
                            <input class="input-bordered" value='<?= $wallet ?>' type="text" id="wallet-address" disabled="disabled">
                        </div><!-- .input-item -->
                        
                        <h2 class="user-panel-title">Referral Information</h2>
                        
                        <div class="input-item input-with-label">
                            <label for="full-name" class="input-item-label">Referral Name</label>
                            <input class="input-bordered" value='<?= $rname ?>'  type="text" disabled="disabled" id="rfull-name"
                                name="full-name">
                        </div><!-- .input-item -->
                        <div class="input-item input-with-label">
                            <label for="email-address" class="input-item-label">Referral Email</label>
                            <input class="input-bordered" value='<?= $remail ?>' type="email" disabled="disabled" id="remail-address">
                        </div><!-- .input-item -->
                    </div><!-- .user-panel -->
                </div><!-- .user-content -->
            </div><!-- .d-flex -->
        </div><!-- .container -->
    </div>
    <!-- UserWraper End -->


    <?php
        include_once 'footer.php'
    ?>
    <!-- FooterBar End -->


    <!-- JavaScript (include all script here) -->
    <script src="assets/js/jquery.bundle.js"></script>
    <script src="assets/js/script.js"></script>
</body>

</html>
<?php
} else {
    header("location: ../login");
}
?>