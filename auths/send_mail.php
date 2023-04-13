<?php

function send_wel_mail($email, $pass)
{

    $subject = "Account Details";
    $message = "
<html>
<head>
    <title>Account Details</title>
</head>
<body>
<div style='font-family:HelveticaNeue-Light,Arial,sans-serif;background-color:#eeeeee'>
    <table align='center' width='100%' border='0' cellspacing='0' cellpadding='0' bgcolor='#eeeeee'>
        <tbody>
        <tr>
            <td>
                <table align='center' width='750px' border='0' cellspacing='0' cellpadding='0' bgcolor='#eeeeee' style='width:750px!important;'>
                    <tbody>
                    <tr>
                        <td>
                            <table style='margin: 30px' width='690' align='center' border='0' cellspacing='0' cellpadding='0' bgcolor='#eeeeee'>
                                <tbody>
                                <tr>
                                    <td colspan='3' align='center'>
                                        <table style='background-color: white; box-shadow: 0 0 3px #ccc;' width='630' align='center' border='0' cellspacing='0' cellpadding='0'>
                                            <tbody>



                                            <tr>
                                                <td colspan='3' height='80' align='center' border='0' cellspacing='0' cellpadding='0' style='padding:0;margin:30px;font-size:0;line-height:0'>
                                                    <table width='690' align='center' border='0' cellspacing='0' cellpadding='0'>
                                                        <tbody>
                                                        <tr>
                                                            <td width='30'></td>
                                                            <td align='center' valign='center' style='padding:10px;margin:10px;font-size:0;line-height:0'>
                                                                <a href='#' target='_blank'>
                                                                    <img style='width: 400px; position: relative; top: 2rem' src='https://elsa.finance/logo.png' alt='ElSA TOKEN' >
                                                                </a></td>
                                                            <td width='30'></td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan='3' height='60'></td></tr><tr><td width='25'></td>
                                                <td align='center'>
                                                    <h4 style='font-family:HelveticaNeue-Light,arial,sans-serif;font-size:28px;color:#404040;line-height:48px;font-weight:bold;margin:0;padding:0'>WELCOME TO ElSA TOKEN</h4>
                                                </td>
                                                <td width='25'></td>
                                            </tr>
                                            <tr>
                                                <td align='left' colspan='3' height='40' style='padding: 10px'>
                                                    <p style='color:#404040; font-size:16px; line-height:22px; padding:20px;'>
                                                            It is so great that you've become part of the ElSA TOKEN ICO.Please verify your email
                                                        </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align='left' colspan='3' height='40' style='padding: 10px'>

                                                    <p style='margin-left: 20px;'> You will receive another email to verify your email account.Once you verify your account you will be able to make use of your dashboard</p>
                                                    <p style='margin-left: 20px;'> Thank you for joining us.</p>
                                                    <b style='margin-left: 20px; margin-top: 0'>elsa.finance</b>
                                                </td>

                                            </tr>


                                            <tr>

                                                <td colspan='3' height='40'></td></tr><tr><td colspan='5' align='center'>

                                                    <div style='width:100%;text-align:center;margin:30px 0'>
                                                        <table align='center' cellpadding='0' cellspacing='0' style='font-family:HelveticaNeue-Light,Arial,sans-serif;margin:0 auto;padding:0'>
                                                            <tbody>
                                                            <tr>
                                                                <td align='center' style='margin:0;text-align:center'><a href='http://elsa.finance/auths/login.php' style='font-size:21px;line-height:22px;text-decoration:none;color:#ffffff;font-weight:bold;border-radius:2px;background-color:#0096d3;padding:14px 40px;display:block;letter-spacing:1.2px' target='_blank'>Login now</a></td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>

                                                </td>
                                            </tr>


                                            <tr><td colspan='3' height='30'></td></tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>

                                </tbody>
                            </table>
</div>
</body>
</html>
";
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    // $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    $headers .= "From: elsa.finance";
    mail($email, $subject, $message, $headers);
}



function verify_email($email, $token)
{

    $subject = "Verify Email";
    $message = '
<html>
<head>
  <title>ElSA TOKEN</title>
<style>
    .email-wraper { background: #e0e8f3; font-size: 14px; line-height: 22px; font-weight: 400; color: #758698; width: 100%; }
    .email-wraper a { color: #1babfe; word-break: break-all; }
    .email-wraper .link-block { display: block; }
    .email-ul { margin: 5px 0; padding: 0; }
    .email-ul:not(:last-child) { margin-bottom: 10px; }
    .email-ul li { list-style: disc; list-style-position: inside; }
    .email-ul-col2 { display: flex; flex-wrap: wrap; }
    .email-ul-col2 li { width: 50%; padding-right: 10px; }
    .email-body { width: 96%; max-width: 620px; margin: 0 auto; background: #ffffff; border: 1px solid #e6effb; border-bottom: 4px solid #1babfe; }
    .email-success { border-bottom-color: #00d285; }
    .email-warning { border-bottom-color: #ffc100; }
    .email-btn { background: #1babfe; border-radius: 4px; color: #ffffff !important; display: inline-block; font-size: 13px; font-weight: 600; line-height: 44px; text-align: center; text-decoration: none; text-transform: uppercase; padding: 0 30px; }
    .email-btn-sm { line-height: 38px; }
    .email-header, .email-footer { width: 100%; max-width: 620px; margin: 0 auto; }
    .email-logo { height: 40px; }
    .email-title { font-size: 13px; color: #1babfe; padding-top: 12px; }
    .email-heading { font-size: 18px; color: #1babfe; font-weight: 600; margin: 0; }
    .email-heading-sm { font-size: 16px; }
    .email-heading-s2 { font-size: 15px; color: #000000; font-weight: 600; margin: 0; text-transform: uppercase; margin-bottom: 10px; }
    .email-heading-s3 { font-size: 18px; color: #1babfe; font-weight: 400; margin-bottom: 8px; }
    .email-heading-success { color: #00d285; }
    .email-heading-warning { color: #ffc100; }
    .email-note { margin: 0; font-size: 13px; line-height: 22px; color: #6e81a9; }
    .email-copyright-text { font-size: 13px; }
    .email-social li { display: inline-block; padding: 4px; }
    .email-social li a { display: inline-block; height: 30px; width: 30px; border-radius: 50%; background: #ffffff; }
    .email-social li a img { width: 30px; }
    
    @media (max-width: 480px) { .email-preview-page .card { border-radius: 0; margin-left: -20px; margin-right: -20px; }
      .email-ul-col2 li { width: 100%; } }
      
     page-user{min-height:100vh;position:relative;display:flex;flex-direction:column}

</style>
</head>


<body class="page-user">
<table class="email-wraper">
    <tbody>
        <tr>
            <td class="pdt-4x pdb-4x">
                <table class="email-header">
                    <tbody>
                        <tr align="center">
                            <td align="center" class="text-center pdb-2-5x"><a href="https://elsa.finance"><img style="height: 140px;"
                                        class="email-logo" src="https://elsa.finance/logo.png"
                                        alt="logo"></a>
                                <p class="email-title">ElSA TOKEN - A Decentralized Financial Infrastructure</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table class="email-body" style="padding: 15px">
                    <tbody>
                        <tr>
                            <td class="pd-3x pdb-1-5x">
                                <h2 class="email-heading">Confirm Your E-Mail Address</h2>
                            </td>
                        </tr>
                        <tr>
                            <td class="pdl-3x pdr-3x pdb-2x">
                                <p class="mgb-1x">Welcome! <br> You are receiving this email
                                    because you have registered on our site.</p>
                                <p class="mgb-1x">Click the link below to active your
                                    ElSA TOKEN ICO account.</p>
                                <p class="mgb-2-5x">This link will expire in 15 minutes and
                                    can only be used once.</p><a href="https://elsa.finance/email-verified?token=' . $token . '"
                                    class="email-btn">Verify Email</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="pdl-3x pdr-3x">
                                <h4 class="email-heading-s2">or</h4>
                                <p class="mgb-1x">If the button above does not work, paste
                                    this link into your web browser:</p><a href="#"
                                    class="link-block">https://elsa.finance/email-verified?token=' . $token . '</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="pd-3x pdt-2x pdb-3x">
                                <p>If you did not make this request, please contact us or
                                    ignore this message.</p>
                                <p class="email-note">This is an automatically generated
                                    email please do not reply to this email. If you face any
                                    issues, please contact us at info@elsa.finance</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table class="email-footer">
                    <tbody>
                        <tr>
                            <td class="text-center pdt-2-5x pdl-2x pdr-2x">
                                <p class="email-copyright-text">Copyright ©2023 ElSA TOKEN
                                    <br></p>
                                <ul class="email-social">
                                    <li><a href="https://www.facebook.com/#"><img src="https://elsa.finance/auths/images/brand-b.png"
                                                alt="brand"></a></li>
                                    <li><a href="https://twitter.com/#"><img src="https://elsa.finance/auths/images/brand-e.png"
                                                alt="brand"></a></li>
                                    <li><a href="https://www.youtube.com/#"><img src="https://elsa.finance/auths/images/brand-d.png"
                                                alt="brand"></a></li>
                                    <li><a href="https://medium.com"><img src="https://elsa.finance/auths/images/brand-c.png"
                                                alt="brand"></a></li>
                                </ul>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
    </table>
</body>';
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    $headers .= "From: elsa.finance";
    mail($email, $subject, $message, $headers);
}