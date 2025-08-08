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
   <div style="max-width: 500px; margin: auto; font-family: Arial, sans-serif; border: 1px solid #ddd; border-radius: 8px; padding: 20px; background-color: #f9f9f9;">
    <!-- Header -->
    <div style="text-align: center; margin-bottom: 20px;">
        <img src="{{ asset('admin_assets/images/logos/lbsnaa_logo.jpg') }}" alt="LBSNAA Logo" style="max-width: 100px; margin-bottom: 10px;">
        <h2 style="color: #792421; margin: 0;">LBSNAA Alumni Login OTP</h2>
    </div>

    <!-- Content -->
    <div style="font-size: 16px; color: #333;">
        <p>Dear User,</p>
        <p>Your One-Time Password (OTP) for login is:</p>
        
        <div style="text-align: center; margin: 20px 0;">
            <span style="display: inline-block; font-size: 24px; font-weight: bold; color: #ffffff; background-color: #792421; padding: 10px 20px; border-radius: 6px;">
                <!-- {{ $otp }} -->123654
            </span>
        </div>

        <p>This OTP is valid for <strong>10 minutes</strong>. Please do not share it with anyone.</p>
        <p>If you did not request this OTP, please ignore this email.</p>
    </div>

    <!-- Footer -->
    <div style="margin-top: 30px; font-size: 14px; color: #666; text-align: center; border-top: 1px solid #ddd; padding-top: 10px;">
        <p>Thank you,<br><strong>LBSNAA Alumni Team</strong></p>
    </div>
</div>

</body>
</html>