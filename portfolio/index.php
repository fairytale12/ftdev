<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
CPageOption::SetOptionString("main", "nav_page_in_session", "N");
$APPLICATION->SetPageProperty('title', 'Вадим Цветков - Портфолио');
$APPLICATION->SetTitle("Портфолио");
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

<div class="portfolio-text">
	<div class="employ-text without-left-margin">
		К сожалению в данном разделе представлены не все проекты моего портфолио, некоторые из них я просто не могу выложить на всеобщее обозрение.
	</div>
</div>

<?$APPLICATION->IncludeComponent(
	"ft:portfolio.list",
	"",
	Array(
		"ELEMENTS_COUNT" => "8",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "360000",
		"CACHE_NOTES" => ""
	),
	false
);?>



<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>