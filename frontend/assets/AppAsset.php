<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'themes/Cardio/css/animate.css',
        'themes/Cardio/css/bootstrap.css',
        'themes/Cardio/css/cardio.css',
        'themes/Cardio/css/normalize.css',
        'themes/Cardio/css/owl.css',    
        'themes/Cardio/css/bootstrap.css.map'
    ];
    public $js = [
       'themes/Cardio/js/bootstrap.min.js',
       'themes/Cardio/js/jquery-1.11.1.min.js',
       'themes/Cardio/js/jquery.onepagenav.js',
       'themes/Cardio/js/main.js',
       'themes/Cardio/js/owl.carousel.min.js',
       'themes/Cardio/js/tooltip.js',
       'themes/Cardio/js/typed.js',
       'themes/Cardio/js/typewriter.js',
       'themes/Cardio/js/wow.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        //'macgyer\yii2materializecss\assets\MaterializeAsset'
    ];
}
