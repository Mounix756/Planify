<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vérification du compte</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #ffffff;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
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
            text-align: center;
        }

        h1 {
            color: #007bff;
            text-align: center;
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
            text-align: center;
        }

        a.button:hover {
            background-color: #0056b3;
        }

        .footer {
            text-align: center;
            color: #555;
        }

        .signature {
            margin-top: 30px;
            text-align: center;
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
            {{-- <h1>Félicitations pour votre compte Mounix School !</h1> --}}
            <p>Bonjour {{ $get_user_name }},</p>
            <p>{!!$sms!!}</h2>
            {{-- <p>Ce code est unique et prouve que vous êtes belle et bien un parent d'élève.</p>
            <p>Si vous n'avez pas fait l'inscription d'un élève à Mounix School, veillez ignorer cet e-mail.</p> --}}
            <p class="footer">Cordialement,<br> MOUNIX SCHOOL.</p>
            <p>Email: <a href="mailto:contact@cityalert.com">contact@mounixschool.com</a></p>
            <p>Téléphone: +228 70 49 94 33</p>
        </div>
    </div>
</body>
</html>
