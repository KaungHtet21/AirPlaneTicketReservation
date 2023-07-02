<!DOCTYPE html>
<html>

<head>
    <title>Congratulations! You have been upgraded to {{ $data['member'] }}</title>
    <style>
        /* CSS styles */
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #f7dede;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
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
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Congratulations! You have been upgraded to {{ $data['member'] }}</h1>
        </div>
        <div class="membership-details">
            <p>Dear {{ $data['customer'] }},</p>
            <p>We are excited to inform you that your membership with <b>KAE airline</b> has been upgraded to
                {{ $data['member'] }}. This upgrade brings you even more exclusive benefits and privileges for your
                future travels.</p>
            <p><strong>Membership Details:</strong></p>
            <ul>
                <li><strong>Member Code:</strong> {{ $data['code'] }}</li>
                <li><strong>Membership Type:</strong> {{ $data['member'] }}</li>
                <li><strong>Effective Date:</strong> {{ $data['date'] }}</li>
            </ul>
            <p>Your new member code, <strong>{{ $data['code'] }}</strong>, will serve as your unique identifier within
                our
                system. Please keep it safe and use it for all future interactions with our online flight ticket system.
            </p>
        </div>
        <div class="benefits">
            <p>With your new membership, you can enjoy enhanced features and advantages, including:</p>
            <ul>
                <li>Increased discounts and special offers on flights and travel packages.</li>
                <li>Priority access to seat selection and boarding.</li>
                <li>Access to exclusive airport lounges and expedited security clearance.</li>
                <li>Complimentary upgrades, if available.</li>
                <li>Dedicated customer support for any travel assistance you may require.</li>
            </ul>
            <p>We invite you to log in to our website or mobile app using your registered email address and password to
                explore the full range of benefits and services available to you as a valued member.</p>
        </div>
        <div class="footer">

            <p>Thank you for being a part of <b>KAE Airline</b>. We appreciate your continued loyalty, and we
                look forward to providing you with exceptional travel experiences.</p>
            <p>Best regards,<br>KAE Airline<br></p>
        </div>
    </div>
</body>

</html>
