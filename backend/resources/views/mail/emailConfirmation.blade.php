<!DOCTYPE html>
<html>
<head>
    <title>Email Confirmation Code</title>
</head>
<body style="font-family: Arial, sans-serif; margin: 0; padding: 20px;">
    <h1 style="color: #333; text-align: center;">Email Confirmation Code</h1>
    <p style="margin-top: 30px; padding: 15px; background-color: #f0f0f0; border-radius: 5px;">
        Thank you for registering with our service. To verify your email address and activate your account, please use the following confirmation code:
        <br>
        <span style="font-weight: bold; font-size: 16px; color: #333;">Confirmation Code: <b>{{$data['code']}}</b></span>
    </p>
    <p style="text-align: center;">
        Please enter this code on our website to complete the verification process. If you did not initiate this registration or have any concerns, please contact our support team immediately.
    </p>
    <p style="text-align: center;">We look forward to serving you!</p>
    <p style="text-align: center;">Best regards,</p>
    <p style="text-align: center;"><b>Air Horizon</b></p>
</body>
</html>
