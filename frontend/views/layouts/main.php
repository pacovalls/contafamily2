<?php

/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register ( $this );
?>
<?php $this->beginPage()?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
<meta charset="<?= Yii::$app->charset ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags()?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head()?>
</head>
<body>
<?php $this->beginBody()?>

<div class="wrap">
    <?php
				NavBar::begin ( [
						// 'brandLabel' => 'My Company',
						'brandLabel' => 'Contafamily_Pruebas',
						'brandUrl' => Yii::$app->homeUrl,
						'options' => [ 
								'class' => 'navbar-inverse navbar-fixed-top' 
						] 
				] );
				$menuItems = [ 
						[ 
								'label' => 'Inicio',
								'url' => [ 
										'/site/index' 
								] 
						],
						[ 
								'label' => 'Quien Soy',
								'url' => [ 
										'/site/about' 
								] 
						],
						[ 
								'label' => 'Contacto',
								'url' => [ 
										'/site/contact' 
								] 
						] 
				];
				if (Yii::$app->user->isGuest) {
					$menuItems [] = [ 
							'label' => 'Registrar',
							'url' => [ 
									'/site/signup' 
							] 
					];
					$menuItems [] = [ 
							'label' => 'Iniciar',
							'url' => [ 
									'/site/login' 
							] 
					];
				} else {
					$menuItems [] = [ 
							'label' => 'Salir (' . Yii::$app->user->identity->username . ')',
							'url' => [ 
									'/site/logout' 
							],
							'linkOptions' => [ 
									'data-method' => 'post' 
							] 
					];
				}
				echo Nav::widget ( [ 
						'options' => [ 
								'class' => 'navbar-nav navbar-right' 
						],
						'items' => $menuItems 
				] );
				NavBar::end ();
				?>

    <div class="container">
        <?=Breadcrumbs::widget ( [ 'links' => isset ( $this->params ['breadcrumbs'] ) ? $this->params ['breadcrumbs'] : [ ] ] )?>
        <?= Alert::widget()?>
        <?= $content?>
    </div>
	</div>

	<footer class="footer">
		<div class="container">
			<p class="pull-left">&copy; Contafamily <?= date('Y') ?></p>

			<p class="pull-right"><?= Yii::powered() ?></p>
		</div>
	</footer>

<?php $this->endBody()?>
</body>
</html>
<?php $this->endPage()?>
