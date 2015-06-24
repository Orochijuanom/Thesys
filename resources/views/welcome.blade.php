<!DOCTYPE html>
<html>
<head>
    <title>Thesys - ITFIP</title>

    <!-- BOOTSTRAP STYLES-->
    <link href="{{ '/' }}assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="{{ '/' }}assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLES-->
    <link href="{{ '/' }}assets/css/custom.css" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

    <style>
        html, body {
            height: 100%;
        }

        body {
            margin: 0;
            padding: 0;
            width: 100%;
            color: #B0BEC5;
            display: table;
            font-weight: 100;
            font-family: 'Lato';
        }

        .container {
            text-align: center;
            display: table-cell;
            vertical-align: middle;
        }

        .content {
            text-align: center;
            display: inline-block;
        }

        .title {
            font-size: 96px;
            margin-bottom: 40px;
        }

        .logo img{
            width: 50%;
            min-width: 250px;
            padding: 2em;
        }

        .quote{
            color: #6F6F6F;
            font-style: italic;
            font-size: 24px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="content">
            <div class="logo">
                <img src="{{ '/' }}assets/img/logo.png">
            </div>
            <div class="col-md-4 col-md-offset-3">
                <a href="{{ '/' }}auth/login"><img src="{{ '/' }}assets/img/id.png">
                    <h3>Iniciar Sesión</h3></a>                                                    
                </div>
                <div class="col-md-4 col-lg-2">
                    <a href="{{ '/' }}search"><img src="{{ '/' }}assets/img/search.png">
                        <h3>Buscar Tesis</h3></div></a>                                                   
                    </div>

                    <div class="quote">{{ Inspiring::quote() }}</div>
                </div>
            </div>
        </body>
        </html>