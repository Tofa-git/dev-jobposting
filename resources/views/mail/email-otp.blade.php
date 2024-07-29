<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <style>
        body{
            background-color: #dddddd;
        }
        div{
            margin: 0px 25px;
            background-color: white;
            border: 1px solid #aaaaaa;
        }
        p {
            font-size: 14px;
        }

        .signature {
            font-style: italic;
            color: blue;
        }

        .otp{
        	color: black; 
        	font-size: 20pt!important; 
        	font-weight: bold; 
        	padding: 3px 5px
        }
    </style>
</head>
<body>
    <div>
        <p>Kode OTP anda adalah :</p>
        <p class="otp">{{ $kode->otp }}</p>
        <p>OTP akan berakhir pada <strong>{{ $kode->expired_at }}</strong></p>
        <p class="signature">RUN8 Management</p>
    </div>
</body>
</html>