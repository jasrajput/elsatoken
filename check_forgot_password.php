<?php
function send_msg($msg, $location) {
    echo "<script type='text/javascript'>
        alert('$msg');
        window.location='$location';
        </script>";
}
if(isset($_POST['sub'])){
    include('auths/conn.php');
    $user = $_POST['email'];
    $check_user = $conn->prepare('SELECT id, user_id, email, name, password FROM member WHERE email = ?');
    $check_user->bind_param('s', $user);
    $check_user->execute();
    $check_user->bind_result($user_id_is_recoverd, $user_id, $user_email, $name, $user_password_is);
    $check_user->fetch();
    $check_user->close();
    

    if($user_id_is_recoverd){
        if( strtolower($user_email) == strtolower($user) ){

            if($user_password_is){
                
                $to = $user_email;
                $msg = "Recover Password";
                $subject = "Recover Password (ELSA TOKEN)";
                $headers = "From: elsa.finance". "\r\n";
                $headers .= "Reply-To: ". strip_tags($to) . "\r\n";
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
            
                $ms = "";
                $ms .= "<html></body><div><div>Dear $name,</div></br></br>";
                $ms .= "<div style='padding-top:8px;'>Your Password Is : $user_password_is</div>
                           
                        <div style='padding-top:4px;'>Powered by <a href='elsa.finance'>ELSA TOKEN</a></div></div>
                        </body></html>";
            
                if (mail($to, $subject, $ms, $headers)) {
                } else {
                    send_msg('Unable to send email.Please try again later', "forget-password");
                }
            }
        }else{
            send_msg('Invalid Member', "forget-password");
        }
    }else{
        send_msg('No such Member', "forget-password");
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
                <div class="ath-body text-center">
                    <h5 class="ath-heading title">Reset <small class="tc-default">Link sent to your email</small></h5>
                    <div class="alert alert-danger">We have sent you an email on your registered email with elsa.finance regarding your password details.</div>
                </div>
                <div class="ath-note text-center tc-light">
                    Remeber your password? <a href="login"> <strong><i>Sign in</i></strong></a>
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
    header('location: forget-password');
}
?>