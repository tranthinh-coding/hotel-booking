<?php

namespace HotelBooking\Services;

class MailSender
{
    private $fromEmail;
    private $fromName;
    private $charset;
    
    public function __construct()
    {
        $this->fromEmail = $_ENV['MAIL_FROM_ADDRESS'] ?? 'noreply@hotelbooking.com';
        $this->fromName = $_ENV['MAIL_FROM_NAME'] ?? 'Ocean Pearl Hotel';
        $this->charset = 'UTF-8';
    }
    
    /**
     * Send password reset email
     */
    public function sendPasswordReset($email, $name, $resetToken)
    {
        $subject = 'Đặt lại mật khẩu - Ocean Pearl Hotel';
        $resetUrl = ($_ENV['APP_URL'] ?? 'http://localhost') . "/reset-password?token={$resetToken}";
        
        $body = $this->getPasswordResetTemplate($name, $resetUrl);
        
        return $this->sendEmail($email, $subject, $body, true);
    }
    
    /**
     * Send welcome email
     */
    public function sendWelcomeEmail($email, $name)
    {
        $subject = 'Chào mừng bạn đến với Ocean Pearl Hotel';
        $body = $this->getWelcomeTemplate($name);
        
        return $this->sendEmail($email, $subject, $body, true);
    }
    
    /**
     * Send booking confirmation email
     */
    public function sendBookingConfirmation($email, $name, $bookingDetails)
    {
        $subject = 'Xác nhận đặt phòng - Ocean Pearl Hotel';
        $body = $this->getBookingConfirmationTemplate($name, $bookingDetails);
        
        return $this->sendEmail($email, $subject, $body, true);
    }
    
    /**
     * Send custom email
     */
    public function sendCustomEmail($to, $subject, $body, $isHTML = true)
    {
        return $this->sendEmail($to, $subject, $body, $isHTML);
    }
    
    /**
     * Core email sending function using PHP mail()
     */
    private function sendEmail($to, $subject, $body, $isHTML = true)
    {
        try {
            // Prepare headers
            $headers = [];
            $headers[] = "MIME-Version: 1.0";
            
            if ($isHTML) {
                $headers[] = "Content-Type: text/html; charset={$this->charset}";
            } else {
                $headers[] = "Content-Type: text/plain; charset={$this->charset}";
            }
            
            $headers[] = "From: {$this->fromName} <{$this->fromEmail}>";
            $headers[] = "Reply-To: {$this->fromEmail}";
            $headers[] = "X-Mailer: PHP/" . phpversion();
            $headers[] = "X-Priority: 3";
            
            // Encode subject for UTF-8
            $encodedSubject = "=?{$this->charset}?B?" . base64_encode($subject) . "?=";
            
            // Send email
            $result = mail($to, $encodedSubject, $body, implode("\r\n", $headers));
            
            if ($result) {
                return true;
            } else {
                return false;
            }
            
        } catch (\Exception $e) {
            return false;
        }
    }
    
    /**
     * Password reset email template
     */
    private function getPasswordResetTemplate($name, $resetUrl)
    {
        return "
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset='UTF-8'>
            <title>Đặt lại mật khẩu</title>
            <style>
                body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; margin: 0; padding: 0; }
                .container { max-width: 600px; margin: 0 auto; padding: 20px; }
                .header { background: #007bff; color: white; padding: 20px; text-align: center; border-radius: 8px 8px 0 0; }
                .content { padding: 30px; background: #f9f9f9; border: 1px solid #e0e0e0; }
                .button { 
                    display: inline-block; 
                    padding: 15px 30px; 
                    background: #007bff; 
                    color: white; 
                    text-decoration: none; 
                    border-radius: 5px; 
                    margin: 20px 0;
                    font-weight: bold;
                }
                .footer { padding: 20px; text-align: center; color: #666; font-size: 12px; background: #f0f0f0; border-radius: 0 0 8px 8px; }
                .warning { background: #fff3cd; border: 1px solid #ffeaa7; padding: 10px; margin: 15px 0; border-radius: 4px; }
            </style>
        </head>
        <body>
            <div class='container'>
                <div class='header'>
                    <h1>🏨 Ocean Pearl Hotel</h1>
                </div>
                <div class='content'>
                    <h2>🔐 Đặt lại mật khẩu</h2>
                    <p>Xin chào <strong>{$name}</strong>,</p>
                    <p>Bạn đã yêu cầu đặt lại mật khẩu cho tài khoản của mình. Vui lòng nhấp vào nút bên dưới để đặt lại mật khẩu:</p>
                    
                    <div style='text-align: center; margin: 30px 0;'>
                        <a href='{$resetUrl}' class='button'>🔑 Đặt lại mật khẩu</a>
                    </div>
                    
                    <div class='warning'>
                        <p><strong>⚠️ Lưu ý quan trọng:</strong></p>
                        <ul>
                            <li>Link này sẽ hết hạn sau <strong>1 giờ</strong></li>
                            <li>Nếu bạn không yêu cầu đặt lại mật khẩu, vui lòng bỏ qua email này</li>
                            <li>Không chia sẻ link này với bất kỳ ai</li>
                        </ul>
                    </div>
                    
                    <p>Nếu nút không hoạt động, bạn có thể copy link sau vào trình duyệt:</p>
                    <p style='word-break: break-all; background: #e9ecef; padding: 10px; border-radius: 4px;'>{$resetUrl}</p>
                </div>
                <div class='footer'>
                    <p>© 2025 Ocean Pearl Hotel. All rights reserved.</p>
                    <p>📧 Email này được gửi tự động, vui lòng không reply.</p>
                </div>
            </div>
        </body>
        </html>";
    }
    
    /**
     * Welcome email template
     */
    private function getWelcomeTemplate($name)
    {
        $loginUrl = ($_ENV['APP_URL'] ?? 'http://localhost') . '/login';
        
        return "
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset='UTF-8'>
            <title>Chào mừng</title>
            <style>
                body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; margin: 0; padding: 0; }
                .container { max-width: 600px; margin: 0 auto; padding: 20px; }
                .header { background: #28a745; color: white; padding: 20px; text-align: center; border-radius: 8px 8px 0 0; }
                .content { padding: 30px; background: #f9f9f9; border: 1px solid #e0e0e0; }
                .button { 
                    display: inline-block; 
                    padding: 15px 30px; 
                    background: #28a745; 
                    color: white; 
                    text-decoration: none; 
                    border-radius: 5px; 
                    margin: 20px 0;
                    font-weight: bold;
                }
                .footer { padding: 20px; text-align: center; color: #666; font-size: 12px; background: #f0f0f0; border-radius: 0 0 8px 8px; }
                .features { background: white; padding: 20px; margin: 20px 0; border-radius: 8px; border: 1px solid #e0e0e0; }
            </style>
        </head>
        <body>
            <div class='container'>
                <div class='header'>
                    <h1>🎉 Chào mừng đến với Ocean Pearl Hotel!</h1>
                </div>
                <div class='content'>
                    <h2>Xin chào <strong>{$name}</strong>! 👋</h2>
                    <p>Chúc mừng! Tài khoản của bạn đã được tạo thành công tại <strong>Ocean Pearl Hotel</strong>.</p>
                    
                    <div class='features'>
                        <h3>🌟 Những gì bạn có thể làm:</h3>
                        <ul>
                            <li>🏨 Đặt phòng trực tuyến 24/7</li>
                            <li>💳 Thanh toán an toàn và tiện lợi</li>
                            <li>📱 Quản lý booking trên điện thoại</li>
                            <li>🎁 Nhận ưu đãi đặc biệt cho thành viên</li>
                            <li>⭐ Đánh giá và chia sẻ trải nghiệm</li>
                        </ul>
                    </div>
                    
                    <div style='text-align: center; margin: 30px 0;'>
                        <a href='{$loginUrl}' class='button'>🚀 Đăng nhập ngay</a>
                    </div>
                    
                    <p>Cảm ơn bạn đã tin tưởng và chọn Ocean Pearl Hotel. Chúng tôi cam kết mang đến cho bạn những trải nghiệm tuyệt vời nhất!</p>
                </div>
                <div class='footer'>
                    <p>© 2025 Ocean Pearl Hotel. All rights reserved.</p>
                    <p>📞 Hotline: 1900-1234 | 📧 nhom4@gmail.com</p>
                </div>
            </div>
        </body>
        </html>";
    }
    
    /**
     * Booking confirmation email template
     */
    private function getBookingConfirmationTemplate($name, $bookingDetails)
    {
        $detailsHtml = '';
        
        if (is_array($bookingDetails)) {
            foreach ($bookingDetails as $key => $value) {
                $detailsHtml .= "<tr><td style='padding: 8px; border-bottom: 1px solid #eee;'><strong>{$key}:</strong></td><td style='padding: 8px; border-bottom: 1px solid #eee;'>{$value}</td></tr>";
            }
        } else {
            $detailsHtml = "<tr><td colspan='2' style='padding: 8px;'>{$bookingDetails}</td></tr>";
        }
        
        return "
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset='UTF-8'>
            <title>Xác nhận đặt phòng</title>
            <style>
                body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; margin: 0; padding: 0; }
                .container { max-width: 600px; margin: 0 auto; padding: 20px; }
                .header { background: #17a2b8; color: white; padding: 20px; text-align: center; border-radius: 8px 8px 0 0; }
                .content { padding: 30px; background: #f9f9f9; border: 1px solid #e0e0e0; }
                .booking-details { 
                    background: white; 
                    padding: 20px; 
                    margin: 20px 0; 
                    border-left: 4px solid #17a2b8; 
                    border-radius: 4px;
                    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
                }
                .footer { padding: 20px; text-align: center; color: #666; font-size: 12px; background: #f0f0f0; border-radius: 0 0 8px 8px; }
                table { width: 100%; border-collapse: collapse; }
                .success-badge { background: #d4edda; color: #155724; padding: 10px 15px; border-radius: 20px; display: inline-block; margin: 10px 0; }
            </style>
        </head>
        <body>
            <div class='container'>
                <div class='header'>
                    <h1>✅ Xác nhận đặt phòng</h1>
                    <h2>Ocean Pearl Hotel</h2>
                </div>
                <div class='content'>
                    <div class='success-badge'>
                        🎉 Đặt phòng thành công!
                    </div>
                    
                    <p>Xin chào <strong>{$name}</strong>,</p>
                    <p>Cảm ơn bạn đã chọn Ocean Pearl Hotel! Đặt phòng của bạn đã được <strong>xác nhận thành công</strong>.</p>
                    
                    <div class='booking-details'>
                        <h3>📋 Thông tin đặt phòng:</h3>
                        <table>
                            {$detailsHtml}
                        </table>
                    </div>
                    
                    <div style='background: #e7f3ff; border: 1px solid #b3d9ff; padding: 15px; margin: 20px 0; border-radius: 4px;'>
                        <h4>📞 Liên hệ hỗ trợ:</h4>
                        <p>Nếu bạn có bất kỳ câu hỏi nào, vui lòng liên hệ:</p>
                        <ul>
                            <li>📞 Hotline: <strong>1900-1234</strong></li>
                            <li>📧 Email: <strong>support@oceanpearl.com</strong></li>
                            <li>🕐 Thời gian: 24/7</li>
                        </ul>
                    </div>
                    
                    <p>Chúng tôi rất mong được đón tiếp bạn tại Ocean Pearl Hotel và mang đến cho bạn kỳ nghỉ tuyệt vời!</p>
                </div>
                <div class='footer'>
                    <p>© 2025 Ocean Pearl Hotel. All rights reserved.</p>
                    <p>🏨 123 Đường ABC, Quận XYZ, TP. Hồ Chí Minh</p>
                </div>
            </div>
        </body>
        </html>";
    }
}
