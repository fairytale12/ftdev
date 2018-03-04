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
				<h1><?$APPLICATION->ShowTitle();?></h1>
			</div>
		</div>
	</div>
</div>

<div class="container">
	<div class="row">
		<div class="span8">
			<?$postId = $APPLICATION->IncludeComponent(
				"ft:post.detail",
				"",
				Array(
					"POST_ID" => $_REQUEST['ELEMENT_CODE'],
					"CACHE_TYPE" => "A",
					"CACHE_TIME" => "3600",
					"CACHE_NOTES" => ""
				),
				false
			);?>
		</div>
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