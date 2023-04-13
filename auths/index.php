<?php
session_start();
if(isset($_SESSION['usi'])) {
    $user_id = $_SESSION['usi']; 
    include 'conn.php';
    include("dev_functions.php");
    
    $refer = $conn->prepare('SELECT id, user_id, wallet_add, name,email, package_choose, is_claimed FROM member WHERE user_id = ?');
    $refer->bind_param('s', $user_id);
    $refer->execute();
    $refer->bind_result($id, $users_id, $user_address,$name, $email, $package_choose, $is_claimed);
    $refer->fetch();
    $refer->close();
   
    $coin_p = $conn->prepare('SELECT coin_price, total_claimed, total_referral FROM admin_strs WHERE adm_id = 1');
    $coin_p->execute();
    $coin_p->bind_result($coin_price, $total_sold, $total_referral);
    $coin_p->fetch();
    $coin_p->close();

    $coin_p = $conn->prepare('SELECT token_wallet, level_com FROM wallets WHERE user_id = ?');
    $coin_p->bind_param('s', $id);
    $coin_p->execute();
    $coin_p->bind_result($token_wallet, $level_com);
    $coin_p->fetch();
    $coin_p->close();
    
    // ob_start();
    // get_anb_balance($user_address);
    $total_sold = number_format($total_sold + $total_referral, 8);
        // $user_balance = ob_get_contents();
    // ob_get_clean();
    // $user_balance = $user_balance  / 1000000000000000000;

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
                        <div class="row">
                            <div class="col-md-6">
                                <div class="tile-item tile-primary">
                                    <div class="tile-bubbles"></div>
                                    <h6 class="tile-title">ELSA TOKEN BALANCE</h6>
                                    <h1 class="tile-info balance"><?= $token_wallet?></h1>

                                </div>
                            </div><!-- .col -->
                            <div class="col-md-6">
                                <div class="tile-item tile-light">
                                    <div class="tile-bubbles"></div>
                                    <h6 class="tile-title">Referral Bonus</h6>
                                    <h1 class="tile-info balance text-dark"><?= $level_com ?></h1>
                                </div>
                            </div><!-- .col -->

                            <!-- <div class="col-md-4">
                                <div class="tile-item tile-light">
                                    <div class="tile-bubbles"></div>
                                    <h6 class="tile-title">UNSTAKE TIME</h6>
                                    <h1 class="tile-info balance text-dark" id='unstake_time'>00:00:00:00</h1>
                                </div>
                            </div> -->
                        </div><!-- .row -->
                        <div class="">
                            <div class="d-flex justify-content-around">
                                <?php
                                    if($is_claimed == 0) {
                                        ?>
                                        <form action="claim_airdrop.php" class='w-100' method='POST'>
                                            <button type='submit' name='sub' class="get_airdrop btn btn-primary btn-bslock w-100 ">GET AIRDROP</button>
                                        </form>
                                        <?php
                                    }
                                ?>
                                &nbsp;&nbsp;
                                <form action="#" method='POST' class='w-100'>
                                    <button class="btn btn-primary btn-sblock w-100">WITHDRAW</button>
                                </form>
                            </div>

                        </div>
                        <br>
                        <div class="info-card info-card-bordered">
                            <div class="row align-items-center">
                                <div class="col-sm-12">
                                    <h4>Thank you for your interest towards to our Project</h4>
                                    <p>You can get airdrop tokens worth 50 here.</p>
                                    <p>You can get a quick response to any questions, and chat with the project in our
                                        Telegram: <a href="https://t.me/elsatoken">https://t.me/elsatoken</a></p>
                                    <p>Don’t hesitate to invite your friends! so they can also get free airdrop worth 50
                                        tokens and you will get 10 token of referral bonus</p>
                                </div>
                            </div>
                        </div><!-- .info-card -->
                        <div class="token-card">
                            <div class="token-info">
                                <span class="token-smartag">Get Airdrop</span>
                                <h2 id='total_distributed' class="token-bonus"><?= $total_sold ?> <span>Total
                                        Distributed</span></h2>
                                <ul class="token-timeline">
                                    <li><span>START DATE</span>1 May 2023</li>
                                    <li><span>END DATE</span>1 June 2023</li>
                                </ul>
                            </div>
                            <div class="token-countdown">
                                <span class="token-countdown-title">AIRDROP STARTS ON</span>
                                <div class="token-countdown-clock" data-date="2023/05/1"></div>
                            </div>
                        </div><!-- .token-card -->
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
    <script>
        function anb() {
            // const buying_coin = $("#paymentGet").val()
            // if(buying_coin % 50 == 0 && buying_coin > 0) {
            //     $('#bc_btn').attr("disabled", false);
            // } else {
            //     $('#bc_btn').attr("disabled", true);
            // }
        }
    </script>
</body>

</html>
<?php
} else {
    header("location: ../login");
}
?>