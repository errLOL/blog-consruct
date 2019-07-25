<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Titles -->
	<title><?=$title?></title>
    <meta name="keywords" content="Разработка сайтов, web разработка, верстка psd макетов">
    <meta name="description" content="Сайт портфолио web разработчика">

    <!-- FavIcons -->
    <link rel="shortcut icon" href="<?= ROOT?>img/favicons/favicon-48x48.ico"  type="image/x-icon" />
    <link rel="apple-touch-icon" href="<?= ROOT?>img/favicons/apple-touch-icon.png">
	<!-- Bootstrap -->
    <link rel="stylesheet" href="<?= ROOT?>assets/libs/bootstrap/css/bootstrap.min.css">

    <!-- User css -->
    <link rel="stylesheet" href="<?= ROOT?>assets/css/main.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	
</head>
<body>

	<div class="top">
		<span class="arrow arrow-top"></span>
		<span class="arrow arrow-bottom"></span>
	</div>

	<!--[if lt IE 9]>
	    <p class="browserupgrade">Вы используете <strong>устаревшую</strong> версию браузера. Пожалуйста <a href="https://support.microsoft.com/en-us/help/17621/internet-explorer-downloads">обновите свой браузер</a>.</p>
	<![endif]-->

	<!-- Header-->
	<header id="top" class="header">
		<div class="container">
			<!-- Главная навигация на обложке -->
			<nav class="navigation">
				<button id="navigation__button" class="cmn-toggle-switch cmn-toggle-switch__htx">
					<span>toggle menu</span>
                </button>
				<ul class="navigation__list">
					<li><a href="<?= ROOT?>">Главная</a></li>
				<? if($is_auth) :?>
					<li><a href="<?= ROOT?>login">Выйти</a></li>
				<? else : ?>
                	<li><a href="<?= ROOT?>login">Войти</a></li>
					<li><a href="<?= ROOT?>signin">Зарегистрироваться</a></li>
				<? endif; ?>
				</ul>
			</nav>
			<!-- Аватар на обложке -->
			<div class="header__avatar">
				<img class="header__avatar-img" src="<?= ROOT?>assets/usercontent/img/photo-small.jpg">
			</div>
			<!-- Главный текст в обложке -->
			<div class="header__heading">
				<h1 class="header__title">noname noname</h1>
				<span class="typed header__subtitle"></span>
				 <h2 class="header__subtitle">Web резработчик</h2>
				<!-- <div class="button button--download button--none" style="margin-top: 30px; text-transform: uppercase;">
					<a href="#popup" rel="modal:open">Связаться со мной</a>
				</div> -->
				
			</div>			
			<!-- Главная паращая кнопка start-->
			<!-- <div class="header__hoverButton">
				<a id="mouse_scroll" href="#resume" class="mouse_scroll">
					<div class="mouse">
						<div class="wheel"></div>
					</div>
					<div>
						<span class="m_scroll_arrows unu"></span>
						<span class="m_scroll_arrows doi"></span>
						<span class="m_scroll_arrows trei"></span>
					</div>
				</a>
			</div> -->
			<!-- Главная паращая кнопка end-->
		</div>
	</header>
	<!-- // Header -->

	<main>
		<div id="contacts" class="contacts contacts--bg-cloud">
			<div class="container">
				<div class="row">
							
					 <?=$content?>
						
				</div>
			</div>
		</div>
	</main>

	<footer class="footer">
		<div class="container">
			<div class="footer__block">
				<p class="footer__copyright">© <?=date('Y')?> ИП Ярмухамедов Н.А</p>
				<p class="footer__text">Веб-разработчик из Бугульмы, занимаюсь версткой и созданием сайтов.</p>
				<p class="footer__text">Этот сайт сделал в качестве новостного портала</p>
			</div>
		</div>		
	</footer>

    

    <!-- fancyBox -->
	<link rel="stylesheet" href="<?= ROOT?>assets/libs/fancybox/jquery.fancybox.min.css">
	
	<!--  JQuery -->
	<script src="<?= ROOT?>assets/libs/jquery/jquery-3.3.1.min.js"></script>

	<!-- JQuery-modal -->
	<script src="<?= ROOT?>assets/libs/jquery/jquery.modal.min.js"></script>
	<!-- JQuery-modal -->
	<link rel="stylesheet" href="<?= ROOT?>libs/jquery/jquery.modal.min.css">

	<!-- Typed -->
	<script src="<?= ROOT?>assets/libs/typed/typed.min.js"></script>

	<!-- Font Awesome -->
	<script src="<?= ROOT?>assets/js/fontawesome-all.min.js"></script>

	<!--  Pagescroll2id -->
	<script src="<?= ROOT?>assets/libs/pagescroll2id/jquery.malihu.PageScroll2id.js"></script>

	<!--  JQuery mouseWheel -->
	<script src="<?= ROOT?>assets/libs/jquery/jquery.mousewheel-3.0.6.pack.js"></script>

	<!--  EqualHeight -->
	<!-- <script src="assets/libs/jquery/jquery.equalheights.js"></script> -->

	<!--  fancyBox -->
	<script src="<?= ROOT?>assets/libs/fancybox/jquery.fancybox.min.js"></script>

	<!--  mixitup -->
	<script src="<?= ROOT?>assets/libs/mixitup/mixitup.min.js"></script>

	<!--  JQuery Validate -->
	<script src="<?= ROOT?>assets/libs/jquery/jquery.validate.js"></script>

	<!--  User custom JS scripts -->
	<script src="<?= ROOT?>assets/js/navigation.js"></script>
	<script src="<?= ROOT?>assets/js/main.js"></script>

</body>
</html>