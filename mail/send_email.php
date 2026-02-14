<?php
header('Content-Type: application/json');

// Enable error reporting for debugging (remove in production)
error_reporting(E_ALL);
ini_set('display_errors', 0);

// Function to sanitize input
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Check if request is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Get and sanitize form data
    $yourName = sanitize_input($_POST['yourName'] ?? '');
    $recipientEmail = sanitize_input($_POST['recipientEmail'] ?? '');
    $surpriseUrl = sanitize_input($_POST['surpriseUrl'] ?? '');
    $personalMessage = sanitize_input($_POST['personalMessage'] ?? '');
    
    // Validation
    if (empty($yourName) || empty($recipientEmail) || empty($surpriseUrl)) {
        echo json_encode([
            'success' => false,
            'message' => 'Please fill in all required fields.'
        ]);
        exit;
    }
    
    // Validate email
    if (!filter_var($recipientEmail, FILTER_VALIDATE_EMAIL)) {
        echo json_encode([
            'success' => false,
            'message' => 'Please enter a valid email address.'
        ]);
        exit;
    }
    
    // Validate URL
    if (!filter_var($surpriseUrl, FILTER_VALIDATE_URL)) {
        echo json_encode([
            'success' => false,
            'message' => 'Please enter a valid URL for the surprise page.'
        ]);
        exit;
    }
    
    // Email subject
    $subject = "💝 Someone Special Has a Surprise for You!";
    
    // Create beautiful HTML email
    $htmlMessage = getEmailTemplate($yourName, $surpriseUrl, $personalMessage);
    
    // Plain text version (fallback)
    $textMessage = "Hi Bisakha!\n\n";
    $textMessage .= "Someone special has created something just for you!\n\n";
    if (!empty($personalMessage)) {
        $textMessage .= $personalMessage . "\n\n";
    }
    $textMessage .= "Click here to see your surprise: " . $surpriseUrl . "\n\n";
    $textMessage .= "With love,\n" . $yourName . " 💕";
    
    // Email headers
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type: text/html; charset=UTF-8" . "\r\n";
    $headers .= "From: " . $yourName . " <noreply@yourdomain.com>" . "\r\n";
    $headers .= "Reply-To: noreply@yourdomain.com" . "\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();
    
    // Send email
    $mailSent = mail($recipientEmail, $subject, $htmlMessage, $headers);
    
    if ($mailSent) {
        echo json_encode([
            'success' => true,
            'message' => 'Your love letter has been sent successfully to Bisakha! 💝'
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Failed to send email. Please check your server mail configuration.'
        ]);
    }
    
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Invalid request method.'
    ]);
}

// Function to generate beautiful HTML email template
function getEmailTemplate($senderName, $surpriseUrl, $personalMessage) {
    $personalSection = '';
    if (!empty($personalMessage)) {
        $personalSection = '
        <div style="background: linear-gradient(135deg, #ffe5e5 0%, #ffd6d6 100%); padding: 25px; border-radius: 15px; margin: 30px 0; border-left: 5px solid #ff6b6b;">
            <p style="color: #c44569; font-size: 1.1em; line-height: 1.8; margin: 0; font-style: italic;">
                "' . nl2br($personalMessage) . '"
            </p>
        </div>';
    }
    
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
                            
                            ' . $personalSection . '
                            
                            <p style="color: #666; font-size: 1.1em; line-height: 1.8; margin: 25px 0;">
                                Ready to see what\'s waiting for you? Click the button below to discover your surprise! 🎁
                            </p>
                            
                            <!-- Call to Action Button -->
                            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin: 40px 0;">
                                <tr>
                                    <td align="center">
                                        <a href="' . $surpriseUrl . '" style="display: inline-block; background: linear-gradient(135deg, #ff6b6b 0%, #c44569 100%); color: white; text-decoration: none; padding: 20px 50px; border-radius: 50px; font-size: 1.3em; font-weight: bold; box-shadow: 0 8px 20px rgba(196, 69, 105, 0.4); transition: all 0.3s ease;">
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
                                ' . $senderName . ' 💕
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
    
    return $html;
}
?>