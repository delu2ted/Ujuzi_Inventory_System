<!DOCTYPE html>
<html>
<body style="font-family: sans-serif; color: #333;">
    <h2>Hi {{ $name }},</h2>
    <p>Your verification code is:</p>
    <p style="font-size: 32px; font-weight: bold; letter-spacing: 4px;">{{ $otp }}</p>
    <p>This code expires in 10 minutes. If you didn't request this, you can ignore this email.</p>
</body>
</html>