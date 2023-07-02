<!DOCTYPE html>
<html>

<head>
    <title>Welcome to Air Horizon</title>
    <style>
        /* CSS styles */
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333333;
        }

        .container {

            max-width: 600px;
            margin: 0 auto;
            margin-top: 20px;
            border-radius: 10%;
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .membership-details {
            margin-bottom: 20px;
        }

        .benefits {
            margin-bottom: 20px;
        }

        .footer {
            text-align: center;
            font-size: 12px;
            color: #777777;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Welcome to Air Horizon.</h1>
        </div>
        <div class="membership-details">
            <p>Dear {{ $data['customer'] }},</p>
            <p>We are thrilled to welcome you as a new member of KAE Airline! As a member, you now
                have access to exclusive benefits and features that will enhance your travel experience.</p>
            <p><strong>Membership Details:</strong></p>
            <ul>
                <li><strong>Member Code:</strong> {{ $data['code'] }}</li>
                <li><strong>Membership Type:</strong> {{ $data['member'] }}</li>
                <li><strong>Effective Date:</strong> {{ $data['date'] }}</li>
            </ul>
            <p>Your member code, <strong>{{ $data['code'] }}</strong>, will serve as a unique identifier for your
                account.
                Please keep it safe and use it whenever you interact with our online flight ticket system.</p>
        </div>
        <div class="benefits">
            <p>As a valued member, you can take advantage of the following benefits:</p>
            <ul>
                <li>Exclusive promotions and discounts on flights and travel packages.</li>
                <li>Access to personalized offers tailored to your preferences and travel history.</li>
                <li>Faster and easier booking process with saved personal information.</li>
                <li>Accumulation of loyalty points for future rewards and upgrades.</li>
            </ul>

        </div>
        <div class="footer">

            <p>Once again, welcome to KAE AIRLINE! We look forward to serving you and making your
                travel experiences memorable.</p>
            <p>Best regards,<br>KAE Airline<br></p>
        </div>
    </div>
</body>

</html>
