<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body style="font-family: sans-serif; color: #333;">
    <h3 style="margin-bottom: 20px; font-size: 24px;">{{ $mailData['subject'] }}</h3>

    <p style="font-size: 16px; margin-bottom: 10px;"><strong>From:</strong> {{ $mailData['name'] }} &lt;{{ $mailData['email'] }}&gt;</p>

    <p style="font-size: 16px;">{{ $mailData['body'] }}</p>
</body>
</html>

