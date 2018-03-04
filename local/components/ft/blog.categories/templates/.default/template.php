<div class="category-list">
	<ul>
	<?foreach($arResult['CATEGORIES'] as $category):?>
		<li><a data-pjax="<?=ft\CHelper::getLinkId($category['SECTION_PAGE_URL'])?>" class="<?if($category['ID'] == $arParams['CATEGORY_ID']):?> selected<?endif;?>" href="<?=$category['SECTION_PAGE_URL']?>"><?=$category['NAME']?></a></li>
	<?endforeach;?>
	</ul>
</div>
