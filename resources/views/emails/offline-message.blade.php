<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>LBSNAA Alumni - New Message</title>
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
        blockquote {
            background-color: #f4f4f4;
            border-left: 4px solid #af2910;
            margin: 20px 0;
            padding: 10px 15px;
            font-style: italic;
            color: #555555;
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
        <!-- Header -->
        <div class="header">
            <img src="{{ asset('admin_assets/images/logos/lbsnaa_logo.jpg') }}" alt="LBSNAA Logo">
            <h2 style="color: #792421; margin: 10px 0 0;">LBSNAA Alumni - New Message Received</h2>
        </div>

        <!-- Content -->
        <div class="content">
            <p>Hi {{ $receiverName }},</p>
            <p>You have received a new message from <strong>{{ $senderName }}</strong>:</p>

            <blockquote>{{ $messageText }}</blockquote>

            <p>Please log in to the platform to reply.</p>
            <p>Thanks,<br>Team LBSNAA Alumni</p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>Thank you,<br><strong>LBSNAA Alumni Team</strong></p>
        </div>
    </div>
</body>
</html>
