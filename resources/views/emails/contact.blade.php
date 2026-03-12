<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Contact Message</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f5f5f5; margin: 0; padding: 20px; color: #333; }
        .wrapper { max-width: 600px; margin: 0 auto; background: #fff; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.08); }
        .header { background: #0d401c; padding: 28px 32px; }
        .header h1 { color: #fff; margin: 0; font-size: 20px; font-weight: 700; }
        .header p { color: rgba(255,255,255,0.7); margin: 4px 0 0; font-size: 13px; }
        .body { padding: 32px; }
        .field { margin-bottom: 20px; }
        .label { font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; color: #888; margin-bottom: 4px; }
        .value { font-size: 15px; color: #222; line-height: 1.6; }
        .message-box { background: #f8faf7; border-left: 4px solid #0d401c; border-radius: 0 6px 6px 0; padding: 16px 20px; }
        .footer { background: #f8faf7; padding: 18px 32px; font-size: 12px; color: #aaa; border-top: 1px solid #eee; }
        hr { border: none; border-top: 1px solid #eee; margin: 24px 0; }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="header">
            <h1>New Contact Form Submission</h1>
            <p>CorpusFeed Limited &mdash; corpusfeed.co.ke</p>
        </div>
        <div class="body">
            <div class="field">
                <div class="label">Name</div>
                <div class="value">{{ $formData['name'] }}</div>
            </div>
            <div class="field">
                <div class="label">Email</div>
                <div class="value"><a href="mailto:{{ $formData['email'] }}" style="color:#0d401c;">{{ $formData['email'] }}</a></div>
            </div>
            @if(!empty($formData['phone']))
            <div class="field">
                <div class="label">Phone</div>
                <div class="value">{{ $formData['phone'] }}</div>
            </div>
            @endif
            @if(!empty($formData['subject']))
            <div class="field">
                <div class="label">Subject</div>
                <div class="value">{{ $formData['subject'] }}</div>
            </div>
            @endif
            <hr>
            <div class="field">
                <div class="label">Message</div>
                <div class="message-box value">{{ $formData['message'] }}</div>
            </div>
        </div>
        <div class="footer">
            Sent from the contact form at {{ url('/contact') }} &bull; {{ now()->format('d M Y, H:i') }}
        </div>
    </div>
</body>
</html>
