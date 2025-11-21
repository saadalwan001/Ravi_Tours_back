<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Tour Package Enquiry</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .header {
            background: linear-gradient(135deg, #155DFC 0%, #0d47d4 100%);
            color: #ffffff;
            padding: 30px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .content {
            padding: 30px;
        }
        .info-row {
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid #e0e0e0;
        }
        .info-row:last-child {
            border-bottom: none;
        }
        .label {
            font-weight: bold;
            color: #155DFC;
            margin-bottom: 5px;
            font-size: 14px;
        }
        .value {
            color: #333;
            font-size: 16px;
        }
        .message-box {
            background-color: #E0F4FF;
            padding: 15px;
            border-radius: 5px;
            margin-top: 10px;
        }
        .footer {
            background-color: #f8f9fa;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #666;
        }
        .divider {
            height: 2px;
            background: linear-gradient(90deg, #155DFC 0%, #0d47d4 100%);
            margin: 20px 0;
        }
        .trip-highlight {
            background: linear-gradient(135deg, #155DFC 0%, #0d47d4 100%);
            color: white;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1>🌏 New Tour Package Enquiry</h1>
            <p style="margin: 5px 0 0 0;">Embark Ceylon Tours</p>
        </div>
        
        <div class="content">
            <p style="font-size: 16px; color: #666;">You have received a new tour package enquiry from your website.</p>
            
            <div class="trip-highlight">
                <h2 style="margin: 0; font-size: 20px;">{{ $enquiryData['tripName'] }}</h2>
            </div>
            
            <div class="divider"></div>
            
            <div class="info-row">
                <div class="label">👤 Full Name</div>
                <div class="value">{{ $enquiryData['name'] }}</div>
            </div>
            
            <div class="info-row">
                <div class="label">📧 Email Address</div>
                <div class="value">{{ $enquiryData['email'] }}</div>
            </div>
            
            <div class="info-row">
                <div class="label">📱 Contact Number</div>
                <div class="value">{{ $enquiryData['contactNumber'] }}</div>
            </div>
            
            <div class="info-row">
                <div class="label">🌍 Country</div>
                <div class="value">{{ $enquiryData['country'] }}</div>
            </div>
            
            <div class="info-row">
                <div class="label">👥 Travel Group</div>
                <div class="value">
                    <strong>Adults:</strong> {{ $enquiryData['adults'] ?? 'Not specified' }}
                    @if(!empty($enquiryData['children']))
                        <br><strong>Children:</strong> {{ $enquiryData['children'] }}
                    @endif
                </div>
            </div>
            
            @if(!empty($enquiryData['subject']))
            <div class="info-row">
                <div class="label">📝 Subject</div>
                <div class="value">{{ $enquiryData['subject'] }}</div>
            </div>
            @endif
            
            @if(!empty($enquiryData['message']))
            <div class="info-row">
                <div class="label">💬 Message</div>
                <div class="message-box">
                    {{ $enquiryData['message'] }}
                </div>
            </div>
            @endif
        </div>
        
        <div class="footer">
            <p>This email was sent from your website tour package enquiry form.</p>
            <p style="margin: 5px 0;">Embark Ceylon Tours | Sri Lanka</p>
            <p style="margin: 5px 0; color: #999;">{{ now()->format('F d, Y - h:i A') }}</p>
        </div>
    </div>
</body>
</html>