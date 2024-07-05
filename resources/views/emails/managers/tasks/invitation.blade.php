<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invitation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #ffffff;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: start;
            align-items: start;
            height: 100vh;
        }

        .outer-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .inner-container {
            max-width: 600px;
            background-color: #e7f3f9;
            padding: 20px;
            border-radius: 10px;
            text-align: start;
        }

        h1 {
            color: #007bff;
            text-align: start;
        }

        p {
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        a.button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            text-align: start;
        }

        a.button:hover {
            background-color: #0056b3;
        }

        .footer {
            text-align: start;
            color: #555;
        }

        .signature {
            margin-top: 30px;
            text-align: start;
        }

        .signature img {
            max-width: 150px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="outer-container">
        <div class="inner-container">
            <p>Bonjour {{ $get_user_name }},</p>
            <p>Vous avez une nouvelle tâche !</p>
            <p>Description :</p>
            <p>{!!$content!!}</h2>
            <p style="color: blue">Debut de la tâche : {{ \Carbon\Carbon::parse($start_time)->format('M j, Y') }} à {{ \Carbon\Carbon::parse($start_time)->format('H : i') }}</p>
            <p style="color: blue">Fin de la tâche : {{ \Carbon\Carbon::parse($end_time)->format('M j, Y') }} à {{ \Carbon\Carbon::parse($end_time)->format('H : i') }}</p>
            @if($priority == 1)
                <p>Priorité : Urgent !</p>
            @endif
                {{-- <h2 style="color: #007bff">{{ $verificationUrl }}</h2> --}}
            <p class="footer">Cordialement,<br> PLANIFY.</p>
            <p>Email: <a href="mailto:contact@planify.com">contact@planify.com</a></p>
            <p>Téléphone: +228 70 49 94 33</p>
        </div>
    </div>
</body>
</html>
