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
        }

        .content {
            padding: 20px;
        }

        .content h1 {
            color: #444;
        }

        .content p {
            line-height: 1.6;
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
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Open Hiring - Sollicitatie gelukt!</h1>
        </div>
        <div class="content">
            <h1>Beste gebruiker,</h1>
            <p>Je sollicitatie bij <strong>{{ $details['company'] }}</strong> voor de functie
                <strong>{{ $details['function'] }}</strong> is succesvol verwerkt.
            </p>
            <p>Wij sturen je een mail zodra je wordt aangenomen.</p>
        </div>
        <div class="footer">
            <p>Bedankt voor het gebruiken van Open Hiring!</p>
        </div>
    </div>
</body>

</html>
