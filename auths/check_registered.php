<?php
include("conn.php");
function send_msg($msg, $location)
{
    echo "<script type='text/javascript'>
        alert(' $msg');
        window.location='../$location.php';
        </script>";
}

if (isset($_POST['submit_but'])) {
    session_start();

    if (true) {

        include('function_ds.php');
        // include('send_mail.php');
        $id = generateMemberID();
        $token = bin2hex(random_bytes(50)); // generate unique token
        $r_id = filter_var(trim($_POST['ref_id'], " "), FILTER_SANITIZE_STRING);
        // $passHash = filter_var($_POST['pass'], FILTER_SANITIZE_STRING);
        
        $wallet_address = filter_var($_POST['wallet_id'], FILTER_SANITIZE_STRING);
        
        $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
        
        if (!empty(trim($_POST['email']))) {

            $email = trim($_POST['email']);
            $filter_email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

            if ($email == $filter_email && filter_var($email, FILTER_VALIDATE_EMAIL)) {

                if ($stmt = $conn->prepare("SELECT email FROM member WHERE email = ?")) {
                    $stmt->bind_param("s", $email);
                    if ($stmt->execute()) {
                        $stmt->store_result();
                        $stmt->bind_result($is_exist);
                        $stmt->fetch();

                        if ($stmt->num_rows > 0 && $is_exist) {
                            send_msg("Account with same Email-ID Already Exists", "register");
                        }

                        $stmt->close();
                    }
                }
            } else {
                send_msg("Email Format not supported", "register");
            }
        } else {
            send_msg("Kindly provide your email", "register");
        }

        if (!empty(trim($_POST['mobile']))) {

            $mobile = trim($_POST['mobile']);

            if (filter_var($mobile, FILTER_SANITIZE_STRING)) {

                if ($stmt = $conn->prepare("SELECT mobile FROM member WHERE mobile = ?")) {
                    $stmt->bind_param("s", $email);
                    if ($stmt->execute()) {
                        $stmt->store_result();
                        $stmt->bind_result($is_exist);
                        $stmt->fetch();

                        if ($stmt->num_rows > 0 && $is_exist) {
                            send_msg("Account with same mobile no. already exists", "register");
                        }

                        $stmt->close();
                    }
                }
            } else {
                send_msg("Mobile No. format not supported", "register");
            }
        } else {
            send_msg("Kindly provide your mobile no.", "register");
        }
        
        $refer = $conn->prepare('SELECT count(id) FROM member WHERE wallet_add = ?');
        $refer->bind_param('s', $wallet_address);
        $refer->execute();
        $refer->bind_result($is_exist);
        $refer->fetch();
        $refer->close();

        //selecting refer id.
        $refer = $conn->prepare('SELECT id, user_id FROM member WHERE user_id = ?');
        $refer->bind_param('s', $r_id);
        $refer->execute();
        $refer->bind_result($ref_id_fetch, $ref_user_id_fetch);
        $refer->fetch();
        $refer->close();
        //selecting parent id.

        if($is_exist == 0) {
            if ($ref_user_id_fetch) {

            //Inserting new member.
            $new_insertion = $conn->prepare('INSERT INTO member(user_id, sponsor_id, name, mobile, email, token, wallet_add, dateOfJoining ) VALUES (?,?, ?, ?, ?, ?,?,  NOW() ) ');
            $new_insertion->bind_param('sssssss', $id, $ref_user_id_fetch, $name, $mobile, $email, $token, $wallet_address);
            if ($new_insertion->execute()) {
                $new_insertion->close();

                $new_id = $conn->insert_id;
                //Selecting new user's id column so that a row can be inserted in wallet table.
                $earning_insert = $conn->prepare('INSERT INTO wallets(user_id) VALUES (?)');
                $earning_insert->bind_param('i', $new_id);
                if ($earning_insert->execute()) {
                    $earning_insert->close();
                }

                $parent_id = $ref_user_id_fetch;
                $user_level = 1;
                while ($parent_id != null && $user_level <= 20) {

                    $fetching_sponsor_id = $conn->prepare('SELECT id, sponsor_id FROM member WHERE user_id = ?');
                    $fetching_sponsor_id->bind_param('s', $parent_id);
                    $fetching_sponsor_id->execute();
                    $fetching_sponsor_id->bind_result($sponsor_id, $new_sponsor);
                    $fetching_sponsor_id->fetch();
                    $fetching_sponsor_id->close();

                    $inserting_level = $conn->prepare('INSERT INTO levels(from_id, to_id, level) VALUES (?, ?, ?)');
                    $inserting_level->bind_param('iii', $new_id, $sponsor_id, $user_level);
                    $inserting_level->execute();
                    $inserting_level->close();

                    $parent_id = $new_sponsor;
                    $user_level++;
                }

                // $_SESSION['usi'] = $id;
                verify_email($email, $token); //Verify Email
                header('location: signup-success');
            } else {
                // echo $conn->error;
                $conn->close();
                send_msg('Something happened', "register");
            }
        } else {
            $conn->close();
            send_msg("Wrong Sponsor", "register");
          }
        } else {
            send_msg('Address Already registered', "register");
        }
    }
} else {
    header('location: ../register.php');
}