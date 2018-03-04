<?
include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');

CHTTP::SetStatus("404 Not Found");
@define("ERROR_404","Y");

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("NOT_SHOW_NAV_CHAIN", "Y");

$APPLICATION->SetTitle("404 Not Found");
?>
<div class="block404">
	<img src="/images/404.png">
</div>
<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>