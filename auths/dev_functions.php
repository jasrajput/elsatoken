<?php
include 'config.php';
include "vendor/autoload.php";
use CoinbaseCommerce\ApiClient;
use CoinbaseCommerce\Resources\Charge;

use Web3\Web3;
use Web3\Providers\HttpProvider;
use Web3\RequestManagers\HttpRequestManager;
use Web3p\EthereumTx\Transaction;

ApiClient::init(API_KEY);



function get_anb_balance($user_address)
{
    try {
        $web3 = new Web3(new HttpProvider(new HttpRequestManager(provider)));
        // get balance
        $web3->eth->getBalance($user_address, function ($err, $balance) {
            if ($err !== null) {
                return;
            }
            echo $balance->toString();
        });
    } catch (Exception $e) {
        exit($e->getMessage());
    }
}


function send_coin($user_id, $amount)
{
    include 'conn.php';
    
    $comm_dist = $conn->prepare("SELECT wallet_add FROM member WHERE id = ?");
    $comm_dist->bind_param("i", $user_id);
    $comm_dist->execute();
    $comm_dist->bind_result($user_address);
    $comm_dist->fetch();
    $comm_dist->close();
    
    try {
        $txHash = null;
        $txReceipt = null;
        $transactionCount = null;
        $secondsToWaitForReceipt = intval(500);
        $factorToMultiplyGasEstimate = intval(2300000);


        $web3 = new Web3(new HttpProvider(new HttpRequestManager(provider)));
        $eth = $web3->eth;
        $eth->getTransactionCount(owner_address, function (
            $err,
            $transactionCountResult
        ) use (&$transactionCount) {
            if (!$err) {
                $transactionCount = $transactionCountResult;
            }
        });

        $transactionParams = [
            'nonce' => "0x" . dechex($transactionCount->toString()),
            'from' => owner_address,
            'to' =>  $user_address,
            'gas' =>  '0x' . dechex(44000),
            'value' => $amount * 1e18,
        ];
        
        $gasPriceMultiplied = hexdec(dechex(10000)) * $factorToMultiplyGasEstimate;

        $transactionParams['gasPrice'] = '0x' . dechex($gasPriceMultiplied);
        $transactionParams['chainId'] = chainId;
        $tx = new Transaction($transactionParams);
        $signedTx = '0x' . $tx->sign(private_key);

        $eth->sendRawTransaction($signedTx, function ($err, $txResult) use (&$txHash) {
            if ($txResult) {
                $txHash = $txResult;
            }
        });
        
        if($txHash) {
            for ($i = 0; $i <= $secondsToWaitForReceipt; $i++) {
                $eth->getTransactionReceipt($txHash, function ($err, $txReceiptResult) use (&$txReceipt) {
                    if (!$err) {
                        $txReceipt = $txReceiptResult;
                    }
                });
                if ($txReceipt) {
                    break;
                }
    
                sleep(1);
            }
    
            $txStatus = $txReceipt->status;
    
            return array("txn_status" => $txStatus, "txn_id" => $txHash);
        } 


    } catch (Exception $e) {
        // return
    }
}


function create_charge($anb_amount, $coin_price, $user_id) {
    include 'conn.php';
    
    $usd_amount = $anb_amount * $coin_price;
    
    $chargeObj = new Charge([
        "description" => "ELSA TOKEN ICO",
        "metadata" => [
            "customer_id" => $user_id,
            "coin_price" => $coin_price,
            "anb_buy" => $anb_amount,
            "local_price" => $usd_amount,
        ],
        "redirect_url"=> "https://anbcoin.ico/coin/success",
       "cancel_url"=> "https://anbcoin.ico/coin/cancel",
        "name" => "ANBCOIN ICO",
        // "payments" => [],
        "pricing_type" => "fixed_price",
        "local_price" => [
            "amount" => $usd_amount,
            "currency" => "USD"
        ]
    ]);
    
    try {
        $chargeObj->save();
    } catch (\Exception $exception) {
        echo sprintf("Enable to create charge. Error: %s \n", $exception->getMessage());
    }
    
    return $chargeObj;
}

function level_income($user_level, $from_id, $amount, $usid) {
    include 'conn.php';
    
    $level_direction = 12;
    $description = "Level Bonus From ".$from_id;

    $comm_tra = $conn->prepare("INSERT INTO users_txns(credit, direction, user_id) VALUES (?, ?, ? )");
    $comm_tra->bind_param("dii", $amount, $level_direction, $usid);
    if ( $comm_tra->execute() ) {
        $comm_tra->close();
        
        $level_inc_details = $conn->prepare("INSERT INTO lvl_inc_details (user_id, com_got_from_id, level_com, level, description) VALUES (?, ?, ?, ?, ?)");
        $level_inc_details->bind_param("isdis", $usid, $from_id, $amount, $user_level, $description);
        $level_inc_details->execute();
        $level_inc_details->close();

        $bal_up = $conn->prepare("UPDATE wallets SET level_com = level_com + ? WHERE user_id = ?");
        $bal_up->bind_param("di", $amount, $usid);
        $bal_up->execute();
        $bal_up->close();
    }
}

function distribute_level_income($user_id, $token_buying) {
    include 'conn.php';
    $percentage = array(3,2,1);
    $j = 0;
    $level = 1;
    $user_level = 2;
    
    $sponsor_details = $conn->prepare("SELECT user_id, sponsor_id FROM member WHERE id = ?");
    $sponsor_details->bind_param("i", $user_id);
    $sponsor_details->execute();
    $sponsor_details->bind_result($ref_user_id, $real_id);
    $sponsor_details->fetch();
    $sponsor_details->close();
    
    $parent_id = $real_id;
    
    while ($parent_id != null && $j <= $user_level) {
        $comm_dist = $conn->prepare("SELECT id, sponsor_id,package_choose FROM member WHERE user_id = ?");
        $comm_dist->bind_param("s", $parent_id);
        $comm_dist->execute();
        $comm_dist->bind_result($id, $comm_sponsor_id, $package_choose);
        $comm_dist->fetch();
        $comm_dist->close();
        
        $up_comm = $token_buying * $percentage[$j] / 100;
        
        if($package_choose >= 2) {
            level_income($level, $ref_user_id, $up_comm, $id);    
        }
        
        $j++;
        $level++;
        $parent_id = $comm_sponsor_id;
    }
}

function increase_price($token_buying) {
    include 'conn.php';
    
    $inserting_level = $conn->prepare('UPDATE admin_strs SET total_sold  = total_sold + ? WHERE adm_id = 1');
    $inserting_level->bind_param('d', $token_buying);
    $inserting_level->execute();
    $inserting_level->close();
    
    $inserting_level = $conn->prepare("SELECT total_sold FROM admin_strs WHERE adm_id = 1");
    $inserting_level->execute();
    $inserting_level->bind_result($total_sold);
    $inserting_level->fetch();
    $inserting_level->close();
    
    if($total_sold >= 250000 && $total_sold < 500000) {
        $token_price = 0.50;
    } else if($total_sold >= 500000 && $total_sold < 1000000) {
        $token_price = 0.75;
    } else if($total_sold >= 1000000 && $total_sold < 1200000) {
        $token_price = 1.00;
    } else if($total_sold >= 1200000 && $total_sold < 2400000) {
        $token_price = 1.20;
    } else if($total_sold >= 2400000 && $total_sold < 3500000) {
        $token_price = 1.50;
    } else if($total_sold >= 3500000 && $total_sold < 7000000) {
        $token_price = 1.80;
    } else if($total_sold >= 7000000 && $total_sold < 14000000) {
        $token_price = 2.00;
    } else if($total_sold >= 14000000) {
        $token_price = 2.50;
    }
    
    $inserting_level = $conn->prepare('UPDATE admin_strs SET coin_price = ? WHERE adm_id = 1');
    $inserting_level->bind_param('d', $token_price);
    $inserting_level->execute();
    $inserting_level->close();
    
    return $token_price;
}

function redirect($msg, $location)
{
    echo "<script type='text/javascript'>
            alert('$msg');
            window.location='$location';
            </script>";
    exit();
}
    
?>