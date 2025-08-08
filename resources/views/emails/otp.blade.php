<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Your OTP Code</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            padding-bottom: 20px;
        }
        .header img {
            max-width: 100px;
        }
        .content {
            font-size: 16px;
            line-height: 1.6;
            color: #333333;
        }
        .otp {
            font-size: 24px;
            font-weight: bold;
            color: #af2910;
            text-align: center;
            margin: 20px 0;
        }
        .footer {
            text-align: center;
            font-size: 14px;
            color: #777777;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="{{ asset('admin_assets/images/logos/lbsnaa_logo.jpg') }}" alt="LBSNAA Logo">
            <h1>LBSNAA Alumni Login OTP</h1>
        </div>
        <div class="content">
            <p>Dear User,</p>
            <p>Your One-Time Password (OTP) for login is:</p>
            <p>Your OTP is: <strong>{{ $otp }}</strong></p>
            <p>This OTP is valid for 10 minutes. Please do not share it with anyone.</p>
            <p>If you did not request this OTP, please ignore this email.</p>
        </div>
        <div class="footer">
            <p>Thank you,<br>LBSNAA Alumni Team</p>
        </div>
    </div>
</body>
</html>