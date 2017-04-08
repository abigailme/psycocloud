<?php
use yii\helpers\Html;
use yii\widgets\Menu;
use yii\widgets\Breadcrumbs;
use yii\debug\Toolbar;
use frontend\assets\AppAsset;
use common\models\User;

// You can use the registerAssetBundle function if you'd like
//$this->registerAssetBundle('app');
AppAsset::register($this);

?>
<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
<title><?php echo Html::encode($this->title); ?></title>
<meta property='og:site_name' content='<?php echo Html::encode($this->title); ?>' />
<meta property='og:title' content='<?php echo Html::encode($this->title); ?>' />
<meta property='og:description' content='<?php echo Html::encode($this->title); ?>' />

<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

<link rel='stylesheet' type='text/css' href='<?php echo $this->theme->baseUrl; ?>/files/main_style.css' title='wsite-theme-css' />
<link href='http://fonts.googleapis.com/css?family=Neucha' rel='stylesheet' type='text/css' />
<?php $this->head(); ?>
</head>
<body class='wsite-theme-light tall-header-page wsite-page-index weeblypage-index'>
  <?php $this->beginBody(); ?>
<div class="container main-container">
  <div class="container">
    <div id="header-in">
      <table id="header">
        <tr>
          <td id="logo"><span class='wsite-logo'><a href='/'><span id="wsite-title"><?php echo Html::encode('Psycocloud '); ?></span></a></span></td>
          <td id="header-right">
            <div class="phone-number"></div>
            <table>
              <tr>
                <td class="social"></td>
                <td class="search"></td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
    </div>
  </div>
</div>
<div class="container main-container" style="width:1010px;">
  <div id="topnav">
      <?php echo Menu::widget(array(
        'options' => array('class' => 'nav'),
        'items' => array(
          array('label' => 'Home', 'url' => array('/site/index')),
          array('label' => 'Menu', 'url' => array('/site/menu')),
          array('label' => 'Registrar Usuario', 'url' => array('/site/signup')),
          Yii::$app->user->isGuest ?
            array('label' => 'Login', 'url' => array('/site/login')) :
            array('label' => 'Logout (' . Yii::$app->user->identity->username .')' , 'url' => array('/site/logout')),
          
        ),
      )); ?>
    <div style="clear:both"></div>
  </div>
  <div id="main-wrap">
    <!--<div id="banner">
      <div id="banner-outer">
        <div id="banner-mid">
          <div id="banner-wrap">
            <div class="wsite-header"></div>
          </div>
        </div>
      </div>
    </div>-->
    <div id="main">
      <div id="content"><div id='wsite-content' class='wsite-not-footer'>
        <?php echo $content; ?>
</div>
<!--</div>
    </div>
  </div>
  <div id="footer"><div id="footer"><?php //echo Html::encode(\Yii::$app->name); ?>
</div>
</div>
</div>-->

<?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage(); ?>