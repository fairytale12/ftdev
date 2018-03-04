<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty('title', 'Title');
$APPLICATION->SetTitle("Title");
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

		</div>
	</div>
</div>



<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>