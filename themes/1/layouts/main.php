<?php

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\widgets\Menu;

AppAsset::register($this);
/**
 * @var $this \yii\base\View
 * @var $content string
 */
// $this->registerAssetBundle('app');
?>
<?php $this->beginPage(); ?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title><?php echo Html::encode(\Yii::$app->name); ?> - A ThemeFactory.net Theme</title>

        <?php $this->head() ?>


        <!-- Custom CSS -->
        <link href="<?php echo $this->theme->baseUrl ?>/css/business-casual.css" rel="stylesheet">

        <!-- Fonts -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
        <link href="http://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic" rel="stylesheet" type="text/css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>

    <body>
        <?php $this->beginBody() ?>
        <div class="brand"><?php echo Html::encode(\Yii::$app->name); ?></div>
        <div class="address-bar">Desarrollo de Aplicaciones Web</div>

        <!-- Navigation -->
        <?php
        NavBar::begin([
            'brandLabel' => Yii::$app->name,
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar navbar-default',
            ],
        ]);
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav'],
            'items' => [
                ['label' => 'Home', 'url' => ['/site/index']],
                ['label' => 'Registrate en nuestro sitio', 'url' => ['/site/registrar']],
                ['label' => 'Contacta con Nosotros', 'url' => ['/site/contacto']],
                Yii::$app->user->isGuest ? (
                        ['label' => 'Login', 'url' => ['/site/login']]
                        ) : (
                        '<li>'
                        . Html::beginForm(['/site/logout'], 'post')
                        . Html::submitButton(
                                'Logout (' . Yii::$app->user->identity->username . ')', ['class' => 'btn btn-link logout']
                        )
                        . Html::endForm()
                        . '</li>'
                        )
            ],
        ]);
        NavBar::end();
        ?>

        <div class="container">


            <div class="row">
                <div class="box">
                    <div class="col-lg-12">
                        <?php echo $content; ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="box">
                    <div class="col-lg-12 text-center">
                        <div id="carousel-example-generic" class="carousel slide">
                            <ol class="carousel-indicators hidden-xs">
                                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                            </ol>

                            <!-- Wrapper for slides -->
                            <div class="carousel-inner">
                                <div class="item active">
                                    <img class="img-responsive img-full" src="https://i.imgur.com/dQ8HOjI.jpg" alt="">
                                </div>
                                <div class="item">
                                    <img class="img-responsive img-full" src="https://i.imgur.com/2uAJKAT.jpg" alt="">
                                </div>
                                <div class="item">
                                    <img class="img-responsive img-full" src="https://i.imgur.com/ikZTOxP.jpg" alt="">
                                </div>
                            </div>

                            <!-- Controls -->
                            <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                                <span class="icon-prev"></span>
                            </a>
                            <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                                <span class="icon-next"></span>
                            </a>
                        </div>
                        <h2 class="brand-before">
                            <small>Ultimos Usuarios</small>
                        </h2>
                        <h1 class="brand-name">Curso Aplicaciones Web 2018</h1>
                        <hr class="tagline-divider">
                        <h2>
                            <small>Desarrollada
                                <strong>Alpe Formación</strong>
                            </small>
                        </h2>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container -->

        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <p>Copyright &copy; <?php echo Html::encode(\Yii::$app->name); ?> 2018</p>
                    </div>
                </div>
            </div>
        </footer>

        <?php
        $this->registerJs(
                "$('.carousel').carousel({
                interval: 5000
            });"
        );
        ?>
        <?php $this->endBody(); ?>
    </body>
</html>
<?php $this->endPage(); ?>