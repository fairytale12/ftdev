<div class="blog-wrap-outer">
	<div class="employ-wrap">
		<div class="employ-text without-left-margin">
			<?=$arResult['DETAIL_TEXT']?>
		</div>
	</div>
	<?foreach($arResult['PROPERTY_FILES_VALUE'] as $file):?>
		<?
		if(empty($file)) {
			continue;
		}
		?>
		<div class="download-block">
			<a href="<?=$file?>">
				<i class="icon-download-alt icon-large"></i>
				Загрузить <?=basename($file)?> (<?=ft\CTPic::getShotSize(filesize($_SERVER['DOCUMENT_ROOT'] . $file))?>)
			</a>
		</div>
	<?endforeach;?>
</div>