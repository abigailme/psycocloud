<?php

use yii\helpers\Html;
use frontend\assets\AppAsset;
use frontend\models\Cita;
AppAsset::register($this);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Psycocloud</title>
    <meta name="description" content="Cardio is a free one page template made exclusively for Codrops by Luka Cvetinovic" />
    <meta name="keywords" content="html template, css, free, one page, gym, fitness, web design" />
    <meta name="author" content="Luka Cvetinovic for Codrops" />
    <!-- Favicons (created with http://realfavicongenerator.net/)-->
    <link rel="apple-touch-icon" sizes="57x57" href="themes/Cardio/img/favicons/apple-touch-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="themes/Cardio/img/favicons/apple-touch-icon-60x60.png">
    <link rel="icon" type="image/png" href="themes/Cardio/img/favicons/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="themes/Cardio/img/favicons/favicon-16x16.png" sizes="16x16">
    <link rel="manifest" href="themes/Cardio/img/favicons/manifest.json">
    <link rel="shortcut icon" href="themes/Cardio/img/favicons/favicon.ico">
    <meta name="msapplication-TileColor" content="#00a8ff">
    <meta name="msapplication-config" content="themes/Cardio/img/favicons/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">
    <!-- Normalize -->
    <link rel="stylesheet" type="text/css" href="themes/Cardio/css/normalize.css">
    <!-- Bootstrap -->
    <link rel="stylesheet" type="text/css" href="themes/Cardio/css/bootstrap.css">
    <!-- Owl -->
    <link rel="stylesheet" type="text/css" href="themes/Cardio/css/owl.css">
    <!-- Animate.css -->
    <link rel="stylesheet" type="text/css" href="themes/Cardio/css/animate.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" type="text/css" href="themes/Cardio/fonts/font-awesome-4.1.0/css/font-awesome.min.css">
    <!-- Elegant Icons -->
    <link rel="stylesheet" type="text/css" href="themes/Cardio/fonts/eleganticons/et-icons.css">
    <!-- Main style -->
    <link rel="stylesheet" type="text/css" href="themes/Cardio/css/cardio.css">
</head>

<body>
    <div class="preloader">
        <img src="themes/Cardio/img/loader.gif" alt="Preloader image">
    </div>
    <nav class="navbar" >
        <div class="container" style="padding-left: 200px; padding-right: 200px;">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#"><img src="themes/Cardio/img/logo.png" data-active-url="themes/Cardio/img/logo-active.png" alt=""></a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right main-nav">
                    <li><a href="#intro">Inicio</a></li>
                    <li><a href="#services">Servicios</a></li>
                    <li><?= Html::a('Calendario', ['/cita/calendario'])?></li>
                    <li><?= Html::a(Yii::$app->user->isGuest ? 'Iniciar Sesión' : 'Salir (' . Yii::$app->user->identity->username .')', [Yii::$app->user->isGuest ? '/site/login' : '/site/logout'], ['class' => 'btn btn-blue']) ?></li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
    <header id="intro">
        <div class="container">
            <div class="table">
                <div class="header-text">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h1 class="light white">Bienvenidos a Psycocloud!</h1>
                            <span class="typed-cursor">|</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <section id="services" class="section section-padded">
        <div class="container" style="padding-left: 200px; padding-right: 200px">
            <div class="row text-center title">
                <h2>Servicios</h2>
                <h4 class="light muted">Utiliza estos servicios que te ofrece Psycocloud</h4>
            </div>
            <div class="row services">
                <div class="col-md-4">
                    <div class="service">
                        <div class="icon-holder">
                            <img src="themes/Cardio/img/icons/paciente.png" alt="" class="icon">
                        </div>
                        <h4 class="heading"> <?= Html::a('Crear Paciente', ['/paciente/create']) ?></h4>
                        <p class="description">Con la creación de Pacientes podrás tener el registro de todos los pacientes. <br><br>
                        <?= Html::a('Crear Paciente', ['/paciente/create'], ['class' => 'btn btn-blue btn-lg btn-block'])?>
                       </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="service">
                        <div class="icon-holder">
                            <img src="themes/Cardio/img/icons/cita.png" alt="" class="icon">
                        </div>
                        <h4 class="heading"><?= Html::a('Crear Cita', ['/cita/create']) ?></h4>
                        <p class="description">Con la creación de Citas podrás tener el registro de todos las citas. <br><br>
                        <?= Html::a('Crear Cita', ['/cita/create'], ['class' => 'btn btn-blue btn-lg btn-block'])?>
                      </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="service">
                        <div class="icon-holder">
                            <img src="themes/Cardio/img/icons/calendario.png" alt="" class="icon">
                        </div>
                        <h4 class="heading"><?= Html::a('Ver Calendario', ['/cita/calendario'])?></h4>
                        <p class="description">En la vista del calendario podrá observar todos las citas que posee. <br><br>
                        <?= Html::a('Ver Calendario', ['/cita/calendario'], ['class' => 'btn btn-blue btn-lg btn-block']) ?></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="cut cut-bottom"></div>
    </section>
        <!-- Holder for mobile navigation -->
    
    
    <!-- Scripts -->
    <script src="themes/Cardio/js/jquery-1.11.1.min.js"></script>
    <script src="themes/Cardio/js/owl.carousel.min.js"></script>
    <script src="themes/Cardio/js/bootstrap.min.js"></script>
    <script src="themes/Cardio/js/wow.min.js"></script>
    <script src="themes/Cardio/js/typewriter.js"></script>
    <script src="themes/Cardio/js/jquery.onepagenav.js"></script>
    <script src="themes/Cardio/js/main.js"></script>
</body>

</html>
