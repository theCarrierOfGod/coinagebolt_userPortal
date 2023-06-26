<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


class mail {
    public $subject;
    public $mailTo;
    
    function resetPassword($subject, $mailTo, $password) {
        $msg =  '<body style="background-color: #e9ecef;">
                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                    <tr>
                        <td align="center" bgcolor="#e9ecef">
                            <table align="center" border="0" cellpadding="0" cellspacing="0" width="600">
                                <tr>
                                    <td align="center" valign="top" width="600">
                                        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                                            <tr>
                                                <td align="center" valign="top" style="padding: 36px 24px;">
                                                    <a href="https://user.coinagebolt.com/" target="_blank" style="display: inline-block;">
                                                        <img src="https://user.coinagebolt.com/img/logo.png" alt="Coinagebolt" border="0" width="48" style="display: block; width: 48px; max-width: 48px; min-width: 48px;">
                                                    </a>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" bgcolor="#e9ecef">
                                        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                                            <tr>
                                                <td align="left" bgcolor="#ffffff" style="padding: 36px 24px 0; font-family:  Helvetica, Arial, sans-serif; border-top: 3px solid #d4dadf;">
                                                    <h1 style="margin: 0; font-size: 32px; font-weight: 700; letter-spacing: -1px; line-height: 48px;">
                                                        Reset Password
                                                    </h1>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" bgcolor="#e9ecef">
                                        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                                            <tr>
                                                <td align="left" bgcolor="#ffffff" style="padding: 24px; font-family:  Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">
                                                    <p style="margin: 0;">
                                                        Below is the new password created for your account. If you didn\'t request for a password reset on <a href="https://user.coinagebolt.com/">Coinagebolt</a>, you can safely delete this email and reset your password.
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="left" bgcolor="#ffffff">
                                                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                                        <tr>
                                                            <td align="center" bgcolor="#ffffff" style="padding: 12px;">
                                                                <table border="0" cellpadding="0" cellspacing="0">
                                                                    <tr>
                                                                        <td align="center" bgcolor="#351673" style="border-radius: 6px;">
                                                                            <span style="display: inline-block; padding: 16px 36px; font-family:  monospace, Helvetica, Arial, sans-serif; font-size: 16px; color: #ffffff; text-decoration: none; border-radius: 6px;">
                                                                                '. $password .'
                                                                            </span>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="left" bgcolor="#ffffff" style="padding: 24px; font-family:  Helvetica, Arial, sans-serif; font-size: 14px; line-height: 24px; border-bottom: 3px solid #d4dadf">
                                                    <p style="margin: 0;">Cheers,<br> Coinagebolt</p>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" bgcolor="#e9ecef" style="padding: 24px;">
                                        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                                            <tr>
                                                <td align="center" bgcolor="#e9ecef" style="padding: 12px 24px; font-family:  Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; color: #666;">
                                                    <p style="margin: 0;">
                                                        You received this email because we received a request for password reset for your account. If you didn\'t request you can safely delete this email.
                                                    </p>
                                                </td>
                                            </tr>
                                        </table>
            
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </body>';
        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->SMTPDebug = 0;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'Coinagebolt.net';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'support@Coinagebolt.net';                     //SMTP username
            $mail->Password   = 'Coinagebolt2023';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        
            //Recipients
            $mail->setFrom('support@Coinagebolt.net', 'Coinagebolt');
            $mail->addAddress($mailTo);     //Add a recipient
            $mail->addReplyTo('help-desk@Coinagebolt.net', 'Help Center');
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body    = $msg;
            // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        
            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
    
    function registrationMail($subject, $mailTo, $code, $username) {
        $msg =  '<body style="background-color: #e9ecef;">
                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                    <tr>
                        <td align="center" bgcolor="#e9ecef">
                            <table align="center" border="0" cellpadding="0" cellspacing="0" width="600">
                                <tr>
                                    <td align="center" valign="top" width="600">
                                        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                                            <tr>
                                                <td align="center" valign="top" style="padding: 36px 24px;">
                                                    <a href="https://user.coinagebolt.com/" target="_blank" style="display: inline-block;">
                                                        <img src="https://user.coinagebolt.com/img/logo/Coinagebolt_icon_without_bg1.png" alt="Coinagebolt" border="0" width="48" style="display: block; width: 48px; max-width: 48px; min-width: 48px;">
                                                    </a>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" bgcolor="#e9ecef">
                                        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                                            <tr>
                                                <td align="left" bgcolor="#ffffff" style="padding: 36px 24px 0; font-family:  Helvetica, Arial, sans-serif; border-top: 3px solid #d4dadf;">
                                                    <h1 style="margin: 0; font-size: 32px; font-weight: 700; letter-spacing: -1px; line-height: 48px;">Confirm Your Email Address</h1>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" bgcolor="#e9ecef">
                                        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                                            <tr>
                                                <td align="left" bgcolor="#ffffff" style="padding: 24px; font-family:  Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">
                                                    <p style="margin: 0;">Copy and paste the verification token below to confirm your email address. If you didn\'t create an account with <a href="https://user.coinagebolt.com/">Coinagebolt</a>, you can safely delete this email.</p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="left" bgcolor="#ffffff">
                                                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                                        <tr>
                                                            <td align="center" bgcolor="#ffffff" style="padding: 12px;">
                                                                <table border="0" cellpadding="0" cellspacing="0">
                                                                    <tr>
                                                                        <td align="center" bgcolor="#351673" style="border-radius: 6px;">
                                                                            <span style="display: inline-block; padding: 16px 36px; font-family:  monospace, Arial, sans-serif; font-size: 16px; color: #ffffff; border-radius: 6px;">
                                                                                '. $code.'
                                                                            </span>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="left" bgcolor="#ffffff" style="padding: 24px; font-family:  Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">
                                                    <p style="margin: 0;">If that doesn\'t work, copy and paste the following link in your browser:</p>
                                                    <p style="margin: 0;"><a href="https://user.coinagebolt.com/verify_mail.php?token='. $code.'&username='. $username .'" target="_blank">https://user.coinagebolt.com/verify_mail.php?token='. $code.'&username='. $username .'</a></p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="left" bgcolor="#ffffff" style="padding: 24px; font-family:  Helvetica, Arial, sans-serif; font-size: 14px; line-height: 24px; border-bottom: 3px solid #d4dadf">
                                                    <p style="margin: 0;">Cheers,<br> Coinagebolt</p>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" bgcolor="#e9ecef" style="padding: 24px;">
                                        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                                            <tr>
                                                <td align="center" bgcolor="#e9ecef" style="padding: 12px 24px; font-family:  Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; color: #666;">
                                                    <p style="margin: 0;">You received this email because we received a request for email confirmation for your account. If you didn\'t request you can safely delete this email.</p>
                                                </td>
                                            </tr>
                                        </table>
            
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </body>';
        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->SMTPDebug = 0;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'coinagebolt.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'support@coinagebolt.com';                     //SMTP username
            $mail->Password   = 'Coinagebolt2023';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        
            //Recipients
            $mail->setFrom('support@coinagebolt.com', 'Coinagebolt');
            $mail->addAddress($mailTo);     //Add a recipient
            $mail->addReplyTo('noreply@coinagebolt.com', 'Help Center');
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body    = $msg;
            // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        
            $mail->send();
            return true;
        } catch (Exception $e) {
            return  false;
            // $mail->ErrorInfo;
        }
    }
}