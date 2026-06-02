<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form Message</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; margin: 0; padding: 0; }
        .wrapper { max-width: 600px; margin: 30px auto; background: #ffffff; border-radius: 10px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.08); }
        .header { background: linear-gradient(135deg, #e36108, #f97316); padding: 30px; text-align: center; }
        .header h1 { color: #fff; margin: 0; font-size: 22px; }
        .header p { color: rgba(255,255,255,0.85); margin: 6px 0 0; font-size: 14px; }
        .body { padding: 35px 40px; }
        .info-row { margin-bottom: 18px; }
        .info-row label { font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; color: #94a3b8; display: block; margin-bottom: 4px; }
        .info-row .value { font-size: 15px; color: #1e293b; font-weight: 500; }
        .message-box { background: #f8fafc; border-left: 4px solid #e36108; padding: 18px 20px; border-radius: 6px; margin-top: 20px; }
        .message-box p { margin: 0; color: #334155; line-height: 1.7; font-size: 15px; white-space: pre-wrap; }
        .footer { background: #f8fafc; padding: 20px 40px; text-align: center; font-size: 13px; color: #94a3b8; border-top: 1px solid #e2e8f0; }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="header">
            <h1>📩 New Contact Message</h1>
            <p>Received via Jaiswal Jagriti Contact Form</p>
        </div>
        <div class="body">
            <div class="info-row">
                <label>From</label>
                <div class="value">{{ $senderName }}</div>
            </div>
            <div class="info-row">
                <label>Email</label>
                <div class="value"><a href="mailto:{{ $senderEmail }}" style="color:#e36108;text-decoration:none;">{{ $senderEmail }}</a></div>
            </div>
            <div class="info-row">
                <label>Subject</label>
                <div class="value">{{ $subject }}</div>
            </div>
            <div class="message-box">
                <p>{{ $messageBody }}</p>
            </div>
        </div>
        <div class="footer">
            This email was sent from the contact form at <strong>jaiswaljagriti.org</strong>.<br>
            Reply directly to this email to respond to {{ $senderName }}.
        </div>
    </div>
</body>
</html>
