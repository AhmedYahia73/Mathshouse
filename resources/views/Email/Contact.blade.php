<!-- resources/views/emails/contact.blade.php -->
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Contact Us Message</title>
  <style>
    /* Email clients often strip external CSS; keep simple and inline when possible.
       This block is for clients that support embedded CSS. */
    @media only screen and (max-width: 600px) {
      .container { width: 100% !important; padding: 16px !important; }
      .two-col { display:block !important; width:100% !important; }
      .field-label { display:block; margin-bottom:6px; }
    }
  </style>
</head>
<body style="margin:0;padding:0;background-color:#f4f6f8;font-family:Arial,Helvetica,sans-serif;">
  <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="background-color:#f4f6f8;padding:24px 0;">
    <tr>
      <td align="center">
        <table role="presentation" cellpadding="0" cellspacing="0" width="600" class="container" style="width:600px;max-width:95%;background:#ffffff;border-radius:8px;overflow:hidden;box-shadow:0 2px 6px rgba(0,0,0,0.08);">
          <!-- Header -->
          <tr>
            <td style="background: linear-gradient(90deg,#3b82f6,#06b6d4);padding:22px 24px;color:#fff;">
              <h1 style="margin:0;font-size:20px;font-weight:600;">New Contact Us Message</h1>
              <p style="margin:6px 0 0;font-size:13px;opacity:0.95;">A new message was submitted via the contact form.</p>
            </td>
          </tr>

          <!-- Body -->
          <tr>
            <td style="padding:20px 24px;color:#111;">
              <table role="presentation" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                  <td style="padding-bottom:12px;">
                    <strong style="display:block;font-size:14px;color:#333;margin-bottom:6px;">Title</strong>
                    <div style="background:#f7fafc;border:1px solid #eef2f7;padding:12px;border-radius:6px;font-size:14px;color:#111;">
                      {{ $data['title'] ?? '—' }}
                    </div>
                  </td>
                </tr>

                <tr>
                  <td style="padding-bottom:12px;">
                    <table role="presentation" cellpadding="0" cellspacing="0" width="100%">
                      <tr>
                        <td class="two-col" style="vertical-align:top;padding-right:8px;width:50%;">
                          <div style="font-size:13px;color:#666;margin-bottom:6px;">Email</div>
                          <div style="background:#f7fafc;border:1px solid #eef2f7;padding:10px;border-radius:6px;font-size:14px;color:#111;">
                            {{ $data['email'] ?? '—' }}
                          </div>
                        </td>
                        <td class="two-col" style="vertical-align:top;padding-left:8px;width:50%;">
                          <div style="font-size:13px;color:#666;margin-bottom:6px;">Phone</div>
                          <div style="background:#f7fafc;border:1px solid #eef2f7;padding:10px;border-radius:6px;font-size:14px;color:#111;">
                            {{ $data['phone'] ?? '—' }}
                          </div>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>

                <tr>
                  <td style="padding-bottom:12px;">
                    <strong style="display:block;font-size:14px;color:#333;margin-bottom:6px;">Description</strong>
                    <div style="background:#f7fafc;border:1px solid #eef2f7;padding:12px;border-radius:6px;font-size:14px;color:#111;white-space:pre-wrap;">
                      {{ $data['description'] ?? '—' }}
                    </div>
                  </td>
                </tr>

                <tr>
                  <td style="padding-top:8px;padding-bottom:16px;">
                    <small style="color:#8b8f94;font-size:12px;">Received on: {{ \Carbon\Carbon::now()->toDayDateTimeString() }}</small>
                  </td>
                </tr>

                <!-- Optional action button -->
                <tr>
                  <td style="padding-top:8px;padding-bottom:20px;">
                    <a href="mailto:{{ $data['email'] ?? '' }}" style="display:inline-block;padding:10px 16px;border-radius:6px;text-decoration:none;border:1px solid #3b82f6;background:#3b82f6;color:#fff;font-size:14px;">Reply to sender</a>
                  </td>
                </tr>
              </table>
            </td>
          </tr>

          <!-- Footer -->
          <tr>
            <td style="background:#fbfdff;padding:14px 24px;color:#8b8f94;font-size:12px;text-align:center;">
              This email was sent from your website contact form.
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>

  <!-- Plain-text fallback for clients that show HTML as attachments -->
  <div style="display:none;white-space:nowrap;font:15px/1px monospace;color:#f4f6f8;">
    Title: {{ $data['title'] ?? '—' }} | Email: {{ $data['email'] ?? '—' }} | Phone: {{ $data['phone'] ?? '—' }}
  </div>
</body>
</html>
