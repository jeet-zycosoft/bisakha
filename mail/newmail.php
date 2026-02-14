<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);

$html = '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A Special Surprise For You</title>
</head>
<body style="margin: 0; padding: 0; font-family: Arial, Helvetica, sans-serif; background-color: #f5f5f5;">
    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #f5f5f5; padding: 40px 20px;">
        <tr>
            <td align="center">
                <!-- Main Container -->
                <table width="600" cellpadding="0" cellspacing="0" border="0" style="background: linear-gradient(135deg, #ff6b6b 0%, #ee5a6f 50%, #c44569 100%); border-radius: 30px; overflow: hidden; box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);">
                    <!-- Header with Hearts -->
                    <tr>
                        <td align="center" style="padding: 50px 40px 30px 40px;">
                            <div style="font-size: 80px; line-height: 1;">💝</div>
                            <h1 style="color: white; font-size: 2.5em; margin: 20px 0 10px 0; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);">
                                A Special Surprise!
                            </h1>
                            <p style="color: rgba(255, 255, 255, 0.95); font-size: 1.2em; margin: 0;">
                                Just for you, Bisakha 💕
                            </p>
                        </td>
                    </tr>
                    
                    <!-- White Content Area -->
                    <tr>
                        <td style="background-color: white; padding: 50px 40px; border-radius: 30px 30px 0 0;">
                            <p style="color: #333; font-size: 1.2em; line-height: 1.8; margin: 0 0 25px 0;">
                                Hi Bisakha! 🌟
                            </p>
                            
                            <p style="color: #666; font-size: 1.1em; line-height: 1.8; margin: 0 0 25px 0;">
                                Someone very special has created something amazing just for you! They\'ve put their heart into making this surprise, and they can\'t wait for you to see it! ✨
                            </p>
                            
                            <p style="color: #666; font-size: 1.1em; line-height: 1.8; margin: 25px 0;">
                                Ready to see what\'s waiting for you? Click the button below to discover your surprise! 🎁
                            </p>
                            
                            <!-- Call to Action Button -->
                            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin: 40px 0;">
                                <tr>
                                    <td align="center">
                                        <a href="https://jeet-zycosoft.github.io/bisakha" style="display: inline-block; background: linear-gradient(135deg, #ff6b6b 0%, #c44569 100%); color: white; text-decoration: none; padding: 20px 50px; border-radius: 50px; font-size: 1.3em; font-weight: bold; box-shadow: 0 8px 20px rgba(196, 69, 105, 0.4); transition: all 0.3s ease;">
                                            ✨ Open Your Surprise! ✨
                                        </a>
                                    </td>
                                </tr>
                            </table>
                            
                            <!-- Decorative Hearts -->
                            <div style="text-align: center; font-size: 2.5em; margin: 30px 0; line-height: 1;">
                                💖 💕 💝 💗
                            </div>
                            
                            <p style="color: #999; font-size: 0.95em; text-align: center; margin: 30px 0 0 0; font-style: italic;">
                                This is a one-time special surprise made just for you!
                            </p>
                        </td>
                    </tr>
                    
                    <!-- Footer -->
                    <tr>
                        <td style="background: linear-gradient(135deg, #c44569 0%, #8e3a5b 100%); padding: 30px 40px; text-align: center;">
                            <p style="color: rgba(255, 255, 255, 0.9); margin: 0 0 10px 0; font-size: 1.1em;">
                                With all my love,
                            </p>
                            <p style="color: white; margin: 0; font-size: 1.3em; font-weight: bold;">
                               Jeet 💕
                            </p>
                            <div style="margin-top: 20px; font-size: 1.8em;">
                                ❤️
                            </div>
                        </td>
                    </tr>
                </table>
                
                <!-- Email Footer -->
                <table width="600" cellpadding="0" cellspacing="0" border="0" style="margin-top: 20px;">
                    <tr>
                        <td align="center" style="padding: 20px;">
                            <p style="color: #999; font-size: 0.85em; margin: 0; line-height: 1.6;">
                                This is a special one-time surprise email.<br>
                                If you have any questions, please contact the sender directly.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>';

try {
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'jeet.tc.work@gmail.com';
    $mail->Password   = 'cevdvijnxltobfhc'; // App Password
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    $mail->setFrom('jeet.tc.work@gmail.com', 'Jeet');
    $mail->addAddress('jeetsamanta2004@gmail.com');
    $mail->isHTML(true);
    $mail->CharSet = 'UTF-8';
    $mail->Encoding = 'base64';
    $mail->Subject = "💝 Someone Special Has a Surprise for You!";
    $mail->Body    = $html;
    $mail->AltBody =  $html;

    $mail->send();
    echo "Email sent successfully";
} catch (Exception $e) {
    echo "Mailer Error: " . $mail->ErrorInfo;
}
