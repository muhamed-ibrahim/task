<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification Code</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .header {
            background: linear-gradient(135deg, #007bff, #0056b3);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 600;
        }
        .content {
            padding: 40px 30px;
        }
        .greeting {
            font-size: 18px;
            margin-bottom: 20px;
            color: #2c3e50;
        }
        .otp-container {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            border: 2px dashed #007bff;
            border-radius: 12px;
            padding: 30px;
            text-align: center;
            margin: 30px 0;
        }
        .otp-label {
            font-size: 14px;
            color: #6c757d;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 600;
        }
        .otp-code {
            font-size: 42px;
            font-weight: bold;
            color: #007bff;
            letter-spacing: 8px;
            font-family: 'Courier New', monospace;
            margin: 0;
            text-shadow: 2px 2px 4px rgba(0, 123, 255, 0.1);
        }
        .expiry-info {
            background-color: #fff3cd;
            border: 1px solid #ffeaa7;
            border-radius: 8px;
            padding: 15px;
            margin: 25px 0;
            text-align: center;
        }
        .expiry-info .icon {
            font-size: 20px;
            margin-right: 8px;
        }
        .instructions {
            background-color: #f8f9fa;
            border-left: 4px solid #007bff;
            padding: 20px;
            margin: 25px 0;
        }
        .instructions h3 {
            margin-top: 0;
            color: #007bff;
        }
        .instructions ul {
            margin: 10px 0;
            padding-left: 20px;
        }
        .instructions li {
            margin: 8px 0;
        }
        .security-notice {
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            border-radius: 8px;
            padding: 15px;
            margin: 25px 0;
        }
        .footer {
            background-color: #f8f9fa;
            padding: 25px 30px;
            text-align: center;
            border-top: 1px solid #dee2e6;
        }
        .footer p {
            margin: 5px 0;
            font-size: 14px;
            color: #6c757d;
        }
        .app-logo {
            font-size: 16px;
            font-weight: 600;
            color: #007bff;
        }
        @media (max-width: 600px) {
            body {
                padding: 10px;
            }
            .content {
                padding: 25px 20px;
            }
            .otp-code {
                font-size: 32px;
                letter-spacing: 4px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>🔐 Email Verification</h1>
        </div>

        <!-- Content -->
        <div class="content">
            <div class="greeting">
                Hello <strong>{{ $user->name }}</strong>,
            </div>

            <p>Welcome! We need to verify your email address to complete your account setup.</p>

            <!-- OTP Display -->
            <div class="otp-container">
                <div class="otp-label">Your Verification Code</div>
                <div class="otp-code">{{ $otp_code }}</div>
            </div>

            <!-- Expiry Information -->
            <div class="expiry-info">
                <span class="icon">⏰</span>
                <strong>Important:</strong> This code will expire in <strong>{{ $expiresIn }} minutes</strong>
            </div>

            <!-- Instructions -->
            <div class="instructions">
                <h3>📋 How to use this code:</h3>
                <ul>
                    <li>Go back to the verification page in your browser</li>
                    <li>Enter the 6-digit code exactly as shown above</li>
                    <li>Click "Verify Email" to complete the process</li>
                </ul>
            </div>

            <!-- Security Notice -->
            <div class="security-notice">
                <strong>🛡️ Security Notice:</strong> If you didn't request this verification code, please ignore this email. Your account security is important to us.
            </div>

            <p>If you're having trouble with email verification, please contact our support team.</p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <div class="app-logo">Permission System</div>
            <p>This is an automated message, please do not reply to this email.</p>
            <p>© {{ date('Y') }} Permission. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
