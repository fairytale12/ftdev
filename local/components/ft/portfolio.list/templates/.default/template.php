<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die(); ?>
<div class="container">
	<div class="row">
		<div>
			<?foreach($arResult['ELEMENTS'] as $element):?>
				<div class="portfolio-block wallpaper">
					<div class="gallery-small">                        	
						<div class="gallery-outer">
							<div class="he-wrap">
								<a data-fancybox class="a-popup" data-src="#popup_<?=$element['ID']?>" href="javascript:void(0);">
									<img alt="" src="<?=ft\CTPic::resizeImage($element['PREVIEW_PICTURE'], 'crop', 220)?>" class="max-image">
									<div class="he-view">
										<div data-animate="flipInH" class="bg a0"></div>
									</div>
								</a>
							</div>
						</div> 					
					</div>
					<div class="port-head">
						<h2><?=$element['NAME']?></h2>
						<div><?=$element['PREVIEW_TEXT']?></div>
					</div>
				</div>
				<div id="popup_<?=$element['ID']?>" class="popup-block" style="display: none;">
					<h2>Информация о проекте "<?=$element['NAME']?>"</h2>
					<?=$element['DETAIL_TEXT']?>
				</div>
			<?endforeach;?>
		</div>
		<?=$arResult["NAV"]?>
	</div>
</div>