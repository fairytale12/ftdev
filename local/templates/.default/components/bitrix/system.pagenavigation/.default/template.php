<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if(!$arResult["NavShowAlways"])
{
   if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false))
      return;
}

$strNavQueryStringArray = explode('&amp;', $arResult['NavQueryString']); 
foreach($strNavQueryStringArray as $key => $urlParam) {
	$tempPramArray = explode('=', $urlParam);
	if($tempPramArray[0] != '_pjax' && $tempPramArray[0] != '_') {
		continue;
	}
	unset($strNavQueryStringArray[$key]);
}
$arResult["NavQueryString"] = implode('&amp;', $strNavQueryStringArray);



$strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"]."&amp;" : "");

$strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?".$arResult["NavQueryString"] : "");
?>

<div class="span12">            
	<div class="pagination pagination-centered">
		<ul>
		<?if($arResult["NavPageNomer"] != 1):?>
			<?$href = $arResult["sUrlPath"] . '?' . $strNavQueryString . 'PAGEN_' . $arResult["NavNum"] . '=' . ($arResult["NavPageNomer"] - 1)?>
			<li><a data-pjax="<?=ft\CHelper::getLinkId($href)?>" href="<?=$href?>">Пред</a></li>
		<?else:?>
			<li><a href="javascript:void(0)">Пред</a></li>
		<?endif;?>
		<?while($arResult["nStartPage"] <= $arResult["nEndPage"]):?>
			<?if ($arResult["nStartPage"] == $arResult["NavPageNomer"]):?>
				<li class="active"><a href="javascript:void(0)"><?=$arResult["nStartPage"]?></a></li>
			<?else:?>
				<?$href = $arResult["sUrlPath"] . '?' . $strNavQueryString . 'PAGEN_' . $arResult["NavNum"] . '=' . $arResult["nStartPage"]?>
				<li><a data-pjax="<?=ft\CHelper::getLinkId($href)?>" href="<?=$href?>"><?=$arResult["nStartPage"]?></a></li>
			<?endif?>
			<?$arResult["nStartPage"]++?>
		<?endwhile?>
		<?if($arResult["NavPageNomer"] != $arResult["NavPageCount"]):?>
			<?$href = $arResult["sUrlPath"] . '?' . $strNavQueryString . 'PAGEN_' . $arResult["NavNum"] . '=' . ($arResult["NavPageNomer"] + 1)?>
			<li><a data-pjax="<?=ft\CHelper::getLinkId($href)?>" href="<?=$href?>">След</a></li>
		<?else:?>
			<li><a href="javascript:void(0)">След</a></li>
		<?endif;?>
		</ul>
	</div>
</div>
