<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
CPageOption::SetOptionString("main", "nav_page_in_session", "N");
$APPLICATION->SetPageProperty('title', 'Вадим Цветков - Блог');
$APPLICATION->SetTitle("Блог");
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
		<?
		global $blogSectionId;

		$_REQUEST['SECTION_CODE'] = trim(htmlspecialchars($_REQUEST['SECTION_CODE']));

		if(!empty($_REQUEST['SECTION_CODE'])) {
			\Bitrix\Main\Loader::includeModule('iblock');
			if($arSection = \CIBlockSection::GetList(array(), array('CODE' => $_REQUEST['SECTION_CODE']), false, array('ID'))->fetch()) {
				$blogSectionId = $arSection['ID'];
			}
		}
		?>
		<?$APPLICATION->IncludeComponent(
			"bitrix:news.list",
			"blog",
			array(
				"ACTIVE_DATE_FORMAT" => "d.m.Y",
				"ADD_SECTIONS_CHAIN" => "N",
				"AJAX_MODE" => "N",
				"AJAX_OPTION_ADDITIONAL" => "",
				"AJAX_OPTION_HISTORY" => "N",
				"AJAX_OPTION_JUMP" => "N",
				"AJAX_OPTION_STYLE" => "N",
				"CACHE_FILTER" => "Y",
				"CACHE_GROUPS" => "N",
				"CACHE_TIME" => "36000000",
				"CACHE_TYPE" => "A",
				"CHECK_DATES" => "Y",
				"DETAIL_URL" => "",
				"DISPLAY_BOTTOM_PAGER" => "Y",
				"DISPLAY_DATE" => "N",
				"DISPLAY_NAME" => "N",
				"DISPLAY_PICTURE" => "N",
				"DISPLAY_PREVIEW_TEXT" => "N",
				"DISPLAY_TOP_PAGER" => "N",
				"FIELD_CODE" => array(
					0 => "",
					1 => "",
				),
				"FILTER_NAME" => "",
				"HIDE_LINK_WHEN_NO_DETAIL" => "N",
				"IBLOCK_ID" => "3",
				"IBLOCK_TYPE" => "dynamic_content",
				"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
				"INCLUDE_SUBSECTIONS" => "N",
				"MESSAGE_404" => "",
				"NEWS_COUNT" => "20",
				"PAGER_BASE_LINK_ENABLE" => "N",
				"PAGER_DESC_NUMBERING" => "N",
				"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
				"PAGER_SHOW_ALL" => "N",
				"PAGER_SHOW_ALWAYS" => "N",
				"PAGER_TEMPLATE" => ".default",
				"PAGER_TITLE" => "Новости",
				"PARENT_SECTION" => $blogSectionId,
				"PARENT_SECTION_CODE" => "",
				"PREVIEW_TRUNCATE_LEN" => "",
				"PROPERTY_CODE" => array(
					0 => "",
					1 => "",
				),
				"SET_BROWSER_TITLE" => "N",
				"SET_LAST_MODIFIED" => "N",
				"SET_META_DESCRIPTION" => "N",
				"SET_META_KEYWORDS" => "N",
				"SET_STATUS_404" => "N",
				"SET_TITLE" => "N",
				"SHOW_404" => "N",
				"SORT_BY1" => "SORT",
				"SORT_BY2" => "ACTIVE_FROM",
				"SORT_ORDER1" => "ASC",
				"SORT_ORDER2" => "DESC",
				"COMPONENT_TEMPLATE" => "blog"
			),
			false
		);?>
		<div class="span4" id="sidebar">
			<div class="blog-widget">
				<h2 class="white">Категории</h2>
				<?$APPLICATION->IncludeComponent(
					"ft:blog.categories",
					"",
					Array(
						"CATEGORY_ID" => $blogSectionId,
						"CACHE_TYPE" => "A",
						"CACHE_TIME" => "3600"
					),
					false
				);?>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>



<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>