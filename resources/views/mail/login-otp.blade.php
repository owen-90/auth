<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Your Account - [Company Name]</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border: 2px solid #e2e2e2; /* Subtle border */
            border-radius: 5px;
        }

        .header {
            text-align: center;
            padding: 20px 0;
            border-bottom: 1px solid #ddd;
        }

        .logo {
            max-width: 150px;
            margin: 0 auto;
        }

        .content {
            padding: 20px;
        }

        .message {
            font-size: 16px;
            line-height: 1.5;
        }

        .otp-code {
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            margin: 20px 0;
        }

        .instructions {
            font-size: 14px;
            margin-bottom: 10px;
        }

        .footer {
            background-color: #f5f5f5;
            padding: 20px;
            font-size: 12px;
            color: #666;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .footer-links a {
            color: #999;
            text-decoration: none;
        }

        .footer-links a:hover {
            text-decoration: underline;
        }

        .footer-social a {
            color: #3b5998; /* Facebook blue */
            margin-right: 10px;
        }

        .footer-social a:hover {
            text-decoration: none;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <img src="your-logo.png" alt="[Company Logo]" class="logo">
        <h1>Verify Your Account - {{ config('app.company_name') }}</h1>
    </div>
    <div class="content">
        <p>Hi {{$user->first_name}},</p>
        <p>We sent you this code to verify your account and ensure your security.
            Please enter the following One-Time Password (OTP) to complete your registration:</p>
        <div class="otp-code">{{$code}}</div>
        <p class="instructions">This code is valid for [validity time] minutes.</p>
        <p>If you didn't request this OTP, please ignore this email and contact us for support.</p>
    </div>
    <div class="footer">
        <p>&copy; {{date('Y')}}. All rights reserved. {{ config('app.company_name') }}</p>
        <p>
            <a href="https://cetri.io">Website</a> |
            <a href="https://cetri.io/policy">Privacy Policy</a> |
            Contact: (+254) 722 674 986 or (+254) 731 873 467 |
            Email: <a href="mailto:info@cetri.io">Email Address</a>
        </p>
    </div>
</div>
</body>
</html>
