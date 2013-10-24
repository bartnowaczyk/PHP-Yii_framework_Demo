<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
<?
Yii:
Yii::app()->clientScript->registerCoreScript('jquery'); // Rejestrowanie biblioteki jquery
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile(Yii::app()->baseUrl.'/js/jquery-cookie-master/jquery.cookie.js'); //Dodanie pliku javascript
$cs->registerScriptFile(Yii::app()->baseUrl.'/js/cookie.js'); //Dodanie pliku javascript


?>
<title>System Wsparcia Gminnych Rad Konsultacyjnych</title>
</head>

<body>
<div class=infoCookie id=infocookie>
Ta strona posługuje się plikami cookie w celu obsługi systemu. Korzystając z systemu wsparcia rad konsultacyjnych zgadzasz się używanie ciasteczek.<?php echo CHtml::button('ok', array(''=>''), array('id'=>'buttonOk')); ?>
</div>
<div class="container" id="">

	<div id="header">
	</div><!-- header -->

	<div id="mainmenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Strona Główna', 'url'=>array('/site/index'), 'class'=>'menLink'),
				array('label'=>'O projekcie', 'url'=>array('/site/page', 'view'=>'about')),
				array('label'=>'Możliwości systemu', 'url'=>array('/site/page', 'view'=>'features')),
				array('label'=>'Moja rada', 'url'=>array('/rada/view/'. Yii::App()->user->getState('rada')), 'visible'=>Yii::App()->user->getState('rada')!=null),
//				array('label'=>'Działające rady', 'url'=>array('/rada/index')),
				array('label'=>'Zrzuty ekranu', 'url'=>array('/site/page', 'view'=>'screenshots')),
				array('label'=>'Zaloguj', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Wyloguj', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
			),
		)); ?>
	</div><!-- mainmenu -->
	
	<div id="layMainWindow">
		<div class=banner></div>
		<div id="layMainRow"> 
			<div id="layMainText"> 
				<?php echo $content; ?>
			</div><!--/layMainText-->
<!--			<div id="layMainSpace">
			</div><!--/layMainSpace-->
			<div id="layMainSide">
			<?		
				if (Yii::App()->user->getState('rada')==null && !Yii::app()->user->isGuest) {
			?>
					<div class="box2">
						<p>W tej chwili nie masz przypisanej żadnej rady konsultacyjnej. Klinij "stwórz radę" i zostań jej administatorem!</p>
						<?php echo CHtml::link('Stwórz radę', array('rada/create'), array('class'=>'createRadaLink'));?>
					</div><!--/box2 -->
			<?
			}
			else if (Yii::App()->user->getState('rada')!=null) {
			?>
					<div class="boxPanel">
						<?php $this->widget('radaPanel'); ?>
					</div><!--/box 1 -->		
			<?
			}
			?>
			</div>	<!--/layMainSide-->
		</div><!--/layMainRow-->
	</div><!--/layMainWindow-->
	<div id=caruzelka>
	<legend>Partnerzy akcji</legend>
<?php $this->widget('bootstrap.widgets.TbCarousel', array(
    'items'=>array(
        array('image'=> Yii::app()->baseurl . '/images/pgnig.jpg', 'label'=>'Polskie Górnictwo Naftowe i Gazownictwo', 'caption'=>'PGNiG rozwija projekt Gminnych Rad Konsultacyjnych w gminach, na terenie których prowadzi lub zamierza prowadzić prace wiertnicze'),
        array('image'=>Yii::app()->baseurl . '/images/krokowa.jpg', 'label'=>'Gmina Krokowa', 'caption'=>'Pierwsza Gminna Rada Konsultacyjna powstała w gminie Krokowa. W jej składzie wchodzą przedstawiciele mieszkańców, władz samorządowych i sektora pozarzadowego'),
    ),
)); ?>
	</div>
	<div class="clear">
	</div>

	
	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> Bartek Nowaczyk<br/>
		<a href=mailto:"bartek@partycypacja.org"> Kontakt</a><br/>
		All Rights Reserved.<br/>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
