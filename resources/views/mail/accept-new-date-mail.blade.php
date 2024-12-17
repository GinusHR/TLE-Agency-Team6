<!DOCTYPE html>
<html>

<head>
    <title>Sollicitatie Open Hiring</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .header {
            background-color: #d2e603;
            color: #333;
            padding: 20px;
            text-align: center;
            font-size: 1.5rem;
        }

        .content {
            padding: 20px;
            font-size: 1rem;
        }

        .content h1 {
            color: #444;
        }

        .content p {
            line-height: 1.6;
            color: #1a202c;
        }

        .button {
            display: inline-block;
            background-color: #bf0079;
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 4px;
            margin-top: 20px;
        }

        .footer {
            background-color: #f1f1f1;
            color: #666;
            text-align: center;
            padding: 15px;
            font-size: 14px;
        }

        a {
            color: #bf0079;
            text-decoration: none;
            text-underline: #1a202c;
        }

        a:hover {
            color: #d2e603;
            text-underline: #d2e603;
        }

        a:visited {
            color: #bf0079;
        }

        a:active {
            color: #bf0079;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Je bent aangenomen!</h1>
        </div>
        <div class="content">
            <p>Beste Open-Hiring-gebruiker,</p>
            <p><strong>{{ $details['company'] }}</strong> heeft je gekozen datum geaccepteerd.</p>
            <p>Je mag beginnen als <strong>{{ $details['function'] }}</strong> bij
                <strong>{{ $details['location'] }}</strong>.
            </p>
            <p>Ze verwachten dat je op
                <strong>{{ $details['workday'] }}</strong> om <strong>{{ $details['worktime'] }} zal komen werken.
            </p>
            <p>Veel succes op je nieuwe baan!</p>
        </div>
        <div class="footer">
            <p>Bedankt voor het gebruiken van Open Hiring!</p>
        </div>
    </div>
</body>

</html>
