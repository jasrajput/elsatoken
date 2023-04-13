<?php

function generateMemberID()
{
    include("conn.php");
    $min = 100000;  // minimum
    $max = 999999;  // maximum
    $quantity = 1;

    for ($i = 0; $i < $quantity; $i++) {
        $pin = "ELSA" .mt_rand($min, $max);
        $select = $conn->prepare("SELECT user_id FROM member WHERE user_id = ?");
        $select->bind_param('s', $pin);
        $select->execute();
        $select->bind_result($user_id);

        if ($select->fetch()) {
            $select->close();
            $conn->close();

            $quantity++;
            continue;
        } else {
            $select->close();
            $conn->close();
            return $pin;
        }
    }
}


function time_elapsed_string($datetime, $full = false)
{
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}


function redirect_to($msg, $location)
{
    echo "<script type='text/javascript'>
            alert('$msg');
            window.location='$location.php';
            </script>";
    exit();
}