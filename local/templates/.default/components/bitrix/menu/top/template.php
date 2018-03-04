<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
	<div class="nav">
		<div class="container">
			<div class="row">
				<div class="span12">
					<div id="sidemenu">
						<ul id="nav">

						<?
						$first = true;
						foreach($arResult as $arItem):
							if($arParams['MAX_LEVEL'] == 1 && $arItem['DEPTH_LEVEL'] > 1)
								continue;
						?>
							<?if($arItem['SELECTED']):?>
								<li class="<?=($first ? 'first ' : '')?>current">
									<a data-pjax="<?=ft\CHelper::getLinkId($arItem["LINK"])?>" href="<?=$arItem['LINK']?>"><?=$arItem['TEXT']?></a>
								</li>
							<?else:?>
								<li<?=($first ? ' class="first"' : '')?>>
									<a data-pjax="<?=ft\CHelper::getLinkId($arItem["LINK"])?>" href="<?=$arItem['LINK']?>"><?=$arItem['TEXT']?></a>
								</li>
							<?endif?>
							<?$first = false;?>
						<?endforeach?>

						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
<?endif?>