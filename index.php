<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php"); //
$APPLICATION->SetPageProperty("NOT_SHOW_NAV_CHAIN", "Y");
$APPLICATION->SetTitle("Обо мне");
$APPLICATION->SetPageProperty('title', "Вадим Цветков - персональный сайт веб-программиста CMS 1С-Битрикс");
$APPLICATION->SetPageProperty("keywords", "Вадим,Цветков,персональный сайт,веб-программист,1C-Битрикс,bitrix,личный сайт,блог программиста,cms");
$APPLICATION->SetPageProperty("description", "Персональный сайт веб-программиста Вадима Цветкова, посвященный разработке в CMS 1С-Битрикс и не только.");
?>

<div class="main-head">
	<div class="container">
		<div class="row">
			<div class="span12">
				<h1><?$APPLICATION->ShowTitle(false);?></h1>
			</div>
		</div>
	</div>
</div>

<div class="container">
	<div class="row">
		<div class="span12">
			<blockquote>
				<p>Добрый день, рад приветствовать вас на своем сайте.</p>
				<p>Меня зовут Вадим и я <span>интерактивный веб разработчик CMS 1C-Bitrix</span>.</p>
				<p>За плечами я имею более чем 6-ти летний опыт работы в этой сфере и больше 50-ти успешно выполненных заказов разного уровня сложности.</p>
				<p>Основная моя деятельность, это <span>программирование и доработка сайтов</span>, а также <span>интеграция внешних сервисов</span> и <span>разработка собственного api</span> для работы с ними. При программировании предпочитаю использовать javascript и JQuery.</p>
				<p>Я постоянно расширяю свои знания и навыки, посредством специализированных курсов и конференций. Все это позволяет мне браться за проекты любой сложности и получать высокие результаты.</p>
			</blockquote>

			<div class="divider1">&nbsp;</div>

		</div>

		<div class="span12">
			<h2 class="white">Опыт</h2>
		</div>
		<div class="span4 service-wrap">
			<h3><span>1</span>Разработка сайтов на основе "1С-Битрикс"</h3>
			<p>Разработка сайтов от новостных до интернет-магазинов, различные доработки стандартного функционала.</p>
		</div>
		<div class="span4 service-wrap">
			<h3><span>2</span>Нестандартные решения</h3>
			<p>Разработка API функций для взаимодействия сайта с внешними сервисами, написание собственных компонентов, модулей, свойств для ИБ, систем оплаты и доставок, модификация callback функций и прочее</p>
		</div>
		<div class="span4 service-wrap">
			<h3><span>3</span>Опыт веб разработчика</h3>
			<p>Знание html, php, sql, css, javascript, JQuery.<br/>CMS: 1C-Bitrix, MODx, LiveStreet, OpenCart</p>
		</div>
		<div class="span12">
			<div class="divider1">&nbsp;</div>
		</div>

		<div class="span12">
			<h2 class="white">Быстрые контакты</h2>
		</div>
		<div class="span4">
			<div class="contant-info">
				<i class="icon-mobile-phone icon-large"></i> +7 (961) 217-43-43
			</div>
		</div>
		<div class="span4">
			<div class="contant-info">
				<i class="icon-globe icon-large"></i> <a href="mailto:fairytale.work@gmail.com">fairytale.work@gmail.com</a>
			</div>
		</div>
		<div class="span4">
			<div class="contant-info">
				<i class="icon-map-marker icon-large"></i> Новосибирск, Россия
			</div>
		</div>

	</div>
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>