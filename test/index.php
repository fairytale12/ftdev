<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("NOT_SHOW_NAV_CHAIN", "Y");
$APPLICATION->SetTitle("Тестовый раздел ...");
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

			Тестовый раздел<br/><br/>
			<?/*
			$path = '/test/';
			$fullPath = $_SERVER['DOCUMENT_ROOT'] . $path;
			foreach(glob($fullPath . '*.JPG') as $filename):
				$basename = basename($filename);
			?>
				<a target="_blank" href="<?=$path . $basename?>"><?=$basename;?></a><br/>
			<?endforeach;*/?>
		
		</div>
	</div>
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>