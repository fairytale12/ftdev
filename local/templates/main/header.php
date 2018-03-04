<!doctype html>
<html lang="en">
<head>
	<?$asset = \Bitrix\Main\Page\Asset::getInstance();?>

	<title><?$APPLICATION->ShowTitle()?></title>
	<?$APPLICATION->ShowHead()?>

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

	<!-- CSS -->
	<?//$asset->addCss('http://fonts.googleapis.com/css?family=Patua+One')?>
	<?//$asset->addCss('http://fonts.googleapis.com/css?family=Noto+Sans:400,400italic,700')?>
	<?$asset->addCss('/css/base.css')?>
	<?$asset->addCss('/css/jquery.fancybox.min.css')?>
	<?$asset->addCss('/css/tomorrow-night-bright.css')?>
	<?$asset->addCss('/css/dev.css')?>
	<?/*
	<link href='http://fonts.googleapis.com/css?family=Patua+One' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Noto+Sans:400,400italic,700' rel='stylesheet' type='text/css'>
	*/?>

	<!-- Favicons -->
	<link rel="shortcut icon" href="/images/favicon.ico" />
	<link rel="apple-touch-icon-precomposed" href="/images/apple-touch-icon.png" />
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="/images/apple-touch-icon-57x57.png" />
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="/images/apple-touch-icon-72x72.png" />
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="/images/apple-touch-icon-114x114.png" />

	<?$asset->addJs('https://use.fontawesome.com/3dde3f250b.js')?>
	<?$asset->addJs('/js/jquery-1.8.3.min.js')?>
	<?//$asset->addJs('/js/jquery-1.11.2.min.js')?>
	<?$asset->addJs('/js/jquery.easing.1.3.js')?>
	<?$asset->addJs('/js/jquery.plugins.min.js')?>
	<?$asset->addJs('/js/tab-animation.js')?>
	<?$asset->addJs('/js/jquery.hoverex.min.js')?>
	<?$asset->addJs('/js/jquery.scrollTo-1.4.3.1-min.js')?>
	<?$asset->addJs('/js/jquery.mobilemenu.js')?>
	<?$asset->addJs('/js/bootstrap.min.js')?>
	<?$asset->addJs('/js/jflickrfeed.min.js')?>
	<?$asset->addJs('/js/jquery.prettyPhoto.js')?>
	<?$asset->addJs('/js/jquery.flexslider.js')?>
	<?$asset->addJs('/js/jquery.validate.js')?>
	<?//$asset->addJs('/js/jquery.ui.map.min.js')?>
	<?$asset->addJs('/js/jquery.pjax.js')?>
	<?$asset->addJs('/js/jquery.fancybox.min.js')?>
	<?$asset->addJs('/js/custom.js')?>
	<?$asset->addJs('/js/highlight.pack.js')?>
	<?$asset->addJs('/js/classes/helper.js')?>
	
	<script type="text/javascript">
		$(window).bind("load", function() {
			$(document).ready(function () {
				$('#ef-loader-overlay').fadeOut(800);
				ftHelper.init();
			});
		});
	</script>

</head>

<body id="inprocess-lab-page">
	<?$APPLICATION->ShowPanel();?>
	<div id="ef-loader-overlay"></div>
	<header>
		<div class="container">
			<div class="row">
				<div class="span12">
					<div class="logo">
						<?$APPLICATION->IncludeFile('/include/logo.php')?>
					</div>
					<div class="logo-text">
						<h1><?$APPLICATION->IncludeFile('/include/who.php')?></h1>
						<div class="social-icons">
							<p class="head-contact">
								<i class="icon-mobile-phone icon-large"></i> <?$APPLICATION->IncludeFile('/include/phone.php')?>
								<?$APPLICATION->IncludeFile('/include/email.php')?>
							</p>
							<?$APPLICATION->IncludeFile('/include/social.php')?>
							<div class="clearfix"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>
	
	<div id="content">
		<?$APPLICATION->IncludeComponent(
			"bitrix:menu",
			"top",
			Array(
				"ALLOW_MULTI_SELECT" => "N",
				"CHILD_MENU_TYPE" => "left",
				"DELAY" => "N",
				"MAX_LEVEL" => "1",
				"MENU_CACHE_GET_VARS" => array(""),
				"MENU_CACHE_TIME" => "3600",
				"MENU_CACHE_TYPE" => "N",
				"MENU_CACHE_USE_GROUPS" => "Y",
				"ROOT_MENU_TYPE" => "top",
				"USE_EXT" => "N"
			)
		);?>
		<div id="pjax-container" class="page tab" data-index="1">
