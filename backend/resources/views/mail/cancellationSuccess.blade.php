<!DOCTYPE html>
<html>

<head>
    <title>Re-sending Confirmation for Canceled Flight Tickets</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        h1 {
            text-align: center;
        }

        p {
            margin-bottom: 10px;
        }

        .details {
            background-color: #f9f9f9;
            padding: 10px;
            margin-bottom: 20px;
        }

        .details h2 {
            margin: 0;
            font-size: 18px;
        }

        .details ul {
            margin: 0;
            padding: 0;
            list-style-type: none;
        }

        .details li {
            margin-bottom: 5px;
        }

        .contact {
            font-size: 14px;
        }

        .contact p {
            margin-bottom: 5px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Re-sending Confirmation for Canceled Flight Tickets</h1>

        <p>Dear {{ $data['contact_name'] }},</p>

        <p>
            I hope this email finds you well. I am writing to resend the confirmation email regarding the cancellation
            of your flight tickets. Please accept my sincere apologies for any inconvenience caused by the cancellation.
        </p>

        <div class="details">
            <h2>Canceled Booking Details:</h2>
            <ul>
                <li><strong>Flight Details:</strong> Departure: {{ $data['from'] }} to {{ $data['to'] }}</li>
                <li><strong>Flight Date:</strong> {{ $data['depart_date'] }} </li>
                <li><strong>Cancellation Date:</strong> [Cancellation Date]</li>
            </ul>
        </div>

        <p>
            If you have any questions or require further assistance regarding the cancellation or any related matters,
            please feel free to contact our customer support team. They will
            be more than happy to assist you.
        </p>


        <div class="contact">
            <p>Thank you for your attention, and we appreciate your continued support.</p>
            <p>KAE AIRLINE</p>
        </div>
    </div>
</body>

</html>
