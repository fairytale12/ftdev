<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty('title', 'Вадим Цветков - Резюме');
$APPLICATION->SetTitle("Резюме");
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
		<div class="span8">
			<h2 class="white">Опыт работы</h2>
			<div class="employ-wrap">
				<div class="employ-year">
					<h4>С мая <br>2011</h4>
				</div>
				<div class="employ-text">
					<h3>Веб разработчик <small>ITConstruct</small></h3>
					Поступил сразу после окончания университета и проработал до 24 сентября 2013 г., уволившись по собственному желанию.
					За время работы в этой замечательной компании я приобрел большой опыт в сфере программирования и овладел CMS 1С-Битрикс.
				</div>
			</div>
			<div class="employ-wrap">
				<div class="employ-year">
					<h4>С сентября <br>2013</h4>
				</div>
				<div class="employ-text">
					<h3>Веб разработчик <small> freelance</small></h3>
					Захотелось больше самостоятельности. Работал на себя, а так же на нескольких клиентов сразу. Занимался как правило различными доработками и реализацией нового функционала для уже существующих сайтов.
				</div>
			</div>
			<div class="employ-wrap">
				<div class="employ-year">
					<h4>С октября <br>2014</h4>
				</div>
				<div class="employ-text">
					<h3>Веб разработчик <small> Sebekon</small></h3>
				</div>
			</div>
		</div>
		<div class="span4">
			<h2 class="white">Мои знания</h2>
			<ul id="services-graph">
				<li><span title="85"></span><p>1C-Bitrix <strong>85%</strong></p></li>
				<li><span title="85"></span><p>HTML5/CSS <strong>85%</strong></p></li>
				<li><span title="90"></span><p>Jquery <strong>90%</strong></p></li>
				<li><span title="85"></span><p>Javascript <strong>85%</strong></p></li>
				<li><span title="90"></span><p>PHP <strong>90%</strong></p></li>
			</ul>
			<h2 class="white">Личные качества</h2>
			<ul class="unstyled awards">
				<li>Нестандартность мышления</li>
				<li>Упорство</li>
				<li>Достижение цели</li>
			</ul>

		</div>


		<div class="span12">
			<div class="divider1">&nbsp;</div>
		</div>

		<div class="span12">
			<h2 class="white">Сертификаты по Битриксу</h2>
		</div>
		<?$APPLICATION->IncludeComponent(
			"bitrix:news.list",
			"certificates",
			Array(
				"ACTIVE_DATE_FORMAT" => "d.m.Y",
				"ADD_SECTIONS_CHAIN" => "N",
				"AJAX_MODE" => "N",
				"AJAX_OPTION_ADDITIONAL" => "",
				"AJAX_OPTION_HISTORY" => "N",
				"AJAX_OPTION_JUMP" => "N",
				"AJAX_OPTION_STYLE" => "N",
				"CACHE_FILTER" => "N",
				"CACHE_GROUPS" => "N",
				"CACHE_TIME" => "36000000",
				"CACHE_TYPE" => "A",
				"CHECK_DATES" => "Y",
				"DETAIL_URL" => "",
				"DISPLAY_BOTTOM_PAGER" => "N",
				"DISPLAY_DATE" => "N",
				"DISPLAY_NAME" => "N",
				"DISPLAY_PICTURE" => "N",
				"DISPLAY_PREVIEW_TEXT" => "N",
				"DISPLAY_TOP_PAGER" => "N",
				"FIELD_CODE" => array("", ""),
				"FILTER_NAME" => "",
				"HIDE_LINK_WHEN_NO_DETAIL" => "N",
				"IBLOCK_ID" => "1",
				"IBLOCK_TYPE" => "dynamic_content",
				"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
				"INCLUDE_SUBSECTIONS" => "N",
				"MESSAGE_404" => "",
				"NEWS_COUNT" => "9999999999",
				"PAGER_BASE_LINK_ENABLE" => "N",
				"PAGER_DESC_NUMBERING" => "N",
				"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
				"PAGER_SHOW_ALL" => "N",
				"PAGER_SHOW_ALWAYS" => "N",
				"PAGER_TEMPLATE" => ".default",
				"PAGER_TITLE" => "Новости",
				"PARENT_SECTION" => "",
				"PARENT_SECTION_CODE" => "",
				"PREVIEW_TRUNCATE_LEN" => "",
				"PROPERTY_CODE" => array("", ""),
				"SET_BROWSER_TITLE" => "N",
				"SET_LAST_MODIFIED" => "N",
				"SET_META_DESCRIPTION" => "N",
				"SET_META_KEYWORDS" => "N",
				"SET_STATUS_404" => "N",
				"SET_TITLE" => "N",
				"SHOW_404" => "N",
				"SORT_BY1" => "SORT",
				"SORT_BY2" => "SORT",
				"SORT_ORDER1" => "ASC",
				"SORT_ORDER2" => "ASC"
			)
		);?>

		<div class="span12">
			<div class="divider1">&nbsp;</div>
		</div>


		<div class="span12">
			<h2 class="white">Образование</h2>
		</div>

		<div class="span6">
			<div class="employ-wrap">
				<div class="education-year">
					<h4>1998-2006</h4>
				</div>
				<div class="employ-text">
					<h3>Гимназия №4 <small>Бывшая 88 школа</small> </h3>
					Профильные предметы математика и информатика (после 9-ого класса).
				</div>
			</div>
		</div>
		<div class="span6">
			<div class="employ-wrap">
				<div class="education-year">
					<h4>2006 - 2011</h4>
				</div>
				<div class="employ-text">
					<h3>НГТУ <small>Факультет прикладной математики и информатики</small> </h3>
					Проучился 5 лет, получил квалификацию &laquo;математик, системный программист&raquo;, защитив бакалаврскую и дипломную работу:
					<ul class="unstyled awards">
						<li>бакалаврская: &laquo;Метод сравнения отпечатков пальцев по особым точкам&raquo;.</li>
						<li>дипломная: &laquo;Разработка и реализация программной системы организации сервиса совместных покупок на базе 1С-Битрикс&raquo;.</li>
					</ul>
				</div>
			</div>
		</div>

	</div>
</div>



<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>