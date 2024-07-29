<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

    <style>
        body{
            background-color: #dddddd;
        }
        .body-container{
            margin: 0px auto;
            background-color: white;
            border: 1px solid #aaaaaa;
            max-width: 800px;
        }

        .signature {
            font-style: italic;
            color: blue;
        }

        .otp{
            background-color: #aaaaaa;
        	color: white; 
        	font-size: 24pt!important; 
        	font-weight: bold; 
        	padding: 3px 5px
        }
        .img-container{
            text-align: center;
            background-color: midnightBlue;
            padding: 5px;
            color: white;
        }
        img{
            height: 75px;
            width: auto;
        }
        .content-container{
            padding: 5px 25px;
            font-size: 14pt;
            font-family: "Roboto", sans-serif;
            font-weight: 300;
            font-style: normal;
        }
    </style>
</head>
<body>
    <div class="body-container">
        <div class="img-container">
            <img src="{{ \App\Models\data_file::getLogo('logo.PNG') }}" />
            <h2 style="padding: 0px; margin: 0px;">RADAR UTAMA NUSANTARA 8</h2>
        </div>
        <div class="content-container">
            <p>Anda menerima email ini karena telah melakukan <strong>REGISTRASI</strong> atau <strong>LOGIN</strong> pada website kami.</p>
            <p>Berikut adalah kode OTP yang harus anda masukkan pada tahap selanjutnya.</p>
            <div style="text-align: center;">
                <span class="otp">{{ @$kode->otp ?? '0' }}</span>
            </div>
            <p>OTP akan berakhir pada <strong>{{ @$kode->expired_at ?? now() }}</strong></p>
            <div style="border-top: 1px solid #dddddd; padding: 5px; font-size: 10pt;">
                <label>Abaikan email ini jika anda tidak merasa melakukan request ke website kami</label><br />
                <label class="signature">RUN8 Management</label>
            </div>
        </div>
    </div>
</body>
</html>