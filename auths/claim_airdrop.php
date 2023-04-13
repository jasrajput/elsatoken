<?php
session_start();
if ( isset($_SESSION['usi']) ) {
    if ( isset($_POST['sub'])) {
        include("conn.php");

        $user_id = $_SESSION['usi'];
        
        $tokens = 50;
        $referral = 10;
        
        if (true) {
            
            if (true) {
                
                $query_member = $conn->prepare("SELECT id, is_claimed, sponsor_id FROM member WHERE user_id = ? ");
                $query_member->bind_param('s', $user_id);
                $query_member->execute();
                $query_member->bind_result($id, $is_claimed, $sponsor_id);
                $query_member->fetch();
                $query_member->close();

                $query_member = $conn->prepare("SELECT id FROM member WHERE user_id = ? ");
                $query_member->bind_param('s', $sponsor_id);
                $query_member->execute();
                $query_member->bind_result($sponsor_id_id);
                $query_member->fetch();
                $query_member->close();
                
                if ($is_claimed == 0 ) {
                    
                    $task_day_add = $conn->prepare('UPDATE member SET is_claimed = 1 WHERE id = ?');
                    $task_day_add->bind_param('i', $id);
                    $task_day_add->execute();
                    $task_day_add->close();

                    
                    $task_day_adds = $conn->prepare('UPDATE wallets SET token_wallet = token_wallet + ?  WHERE user_id = ?');
                    $task_day_adds->bind_param('di', $tokens,  $id);
                    $task_day_adds->execute();
                    $task_day_adds->close();

                    $task_day_add = $conn->prepare('UPDATE admin_strs SET total_claimed = total_claimed + ? WHERE adm_id = 1');
                    $task_day_add->bind_param('d', $tokens);
                    $task_day_add->execute();
                    $task_day_add->close();

                    if(isset($sponsor_id)) {
                        $task_day_adds = $conn->prepare('UPDATE wallets SET level_com = level_com + ?  WHERE user_id = ?');
                        $task_day_adds->bind_param('di', $referral, $sponsor_id_id);
                        $task_day_adds->execute();
                        $task_day_adds->close();

                        $task_day_add = $conn->prepare('UPDATE admin_strs SET total_referral = total_referral + ? WHERE adm_id = 1');
                        $task_day_add->bind_param('d', $referral);
                        $task_day_add->execute();
                        $task_day_add->close();
                    }
                    
                    redirect_back("Airdrop claimed successfully");
        
                } else {
                    redirect_back("Already claimed");
                }
            } else {
                redirect_back("Already completed");
            }
        } 
    }
}

function redirect_back($msg) {
    echo "<script type='text/javascript'>alert('$msg');window.location='index';</script>";
    exit();
}
?>