<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<div class="span8">
	<?foreach($arResult["ITEMS"] as $arItem):?>
		<?
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		?>
		<div id="<?=$this->GetEditAreaId($arItem['ID']);?>" class="blog-wrap-outer">
			<?if(!empty($arItem['PREVIEW_PICTURE'])):?>
				<div class="blog-wrap">
					<a class="pjax" href="<?=$arItem['DETAIL_PAGE_URL']?>">
						<img src="<?=ft\CTPic::resizeImage($arItem['PREVIEW_PICTURE']['ID'], 'crop', 620, 315);?>" alt="<?=$arItem['NAME']?>" title="<?=$arItem['NAME']?>"/>
					</a>
				</div>
			<?endif;?>
			<div class="employ-wrap">
				<div class="employ-year">
					<?=preg_replace('/([0-9]+)\s([А-Я]+)/i', '<h4>$1 <br>$2</h4>', mb_strtoupper(FormatDate('d F', MakeTimeStamp($arItem['ACTIVE_FROM'], 'DD.MM.YYYY HH:MI:SS'))));?>
				</div>
				<div class="employ-text">
					<h2><a data-pjax="<?=ft\CHelper::getLinkId($arItem['DETAIL_PAGE_URL'])?>" href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=$arItem['NAME']?></a></h2>
					<?=$arItem['PREVIEW_TEXT']?>
				</div>
			</div>
		</div>
	<?endforeach;?>
	<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
		<?=$arResult["NAV_STRING"]?>
	<?endif;?>
</div>
