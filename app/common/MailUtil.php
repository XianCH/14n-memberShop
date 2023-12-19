<?php
namespace app\common;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class MailUtil
{
    public static function sendMail($to, $subject, $content)
    {
        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host       = 'smtp.163.com'; // 或者 '127.0.0.1'
            $mail->CharSet = "utf8";
            $mail->SMTPAuth   = false;
            $mail->SMTPAuth = true;
            $mail->Username = "13068163953@163.com";
            $mail->Password = "XDOKRFDNQYPYTAZA";
            $mail->Port = 25;
            // $mail->Username   = config('mail.mailers.smtp.username');
            // $mail->Password   = config('mail.mailers.smtp.password');
            // $mail->SMTPSecure = config('mail.mailers.smtp.encryption');
            // $mail->Port       = 1025; // MailHog 默认 SMTP 端口

            // Recipients
            $mail->setFrom('13068163953@163.com', 'x14n');
            $mail->addAddress($to);
            $mail->addReplyTo("1368163953@163.com", "Reply");

            // Content
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $content;
            
            $mail->send();
            return 'success!';
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public static function setContentStyle($content)
    {
        // 定义样式
        $style = '
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f4;
                padding: 20px;
            }
            .container {
                max-width: 600px;
                margin: 0 auto;
                background-color: #ffffff;
                padding: 20px;
                border-radius: 8px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }
            .verification-code {
                font-size: 24px;
                color: #007bff;
            }
        ';
    
        // 返回样式
        return '
            <html>
                <head>
                    <style>' . $style . '</style>
                </head>
                <body>
                    <div class="container">
                        <p>Your verification code is: <span class="verification-code">' . $content . '</span></p>
                    </div>
                </body>
            </html>
        ';
    }
}