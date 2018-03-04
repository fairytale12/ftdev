<?php
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();


$arResult = array();

$elementsCount = intval($arParams['ELEMENTS_COUNT']);
if(!$elementsCount) {
	$elementsCount = 8;
}

$arNavParams = array(
	'nPageSize' => $elementsCount,
	'bDescPageNumbering' => false,
	'bShowAll' => false,
);
$arNavigation = CDBResult::GetNavParams($arNavParams);
		
if ($this->StartResultCache(false, array($arNavigation))) {
    \CModule::IncludeModule('iblock');

	$arFilter = Array(
		'IBLOCK_ID' => PORTFOLIO_IBLOCK_ID,
		'ACTIVE' => 'Y',
		'!PREVIEW_PICTURE' => false
	);
	
	$arSelect = array(
		'ID',
		'NAME',
		'PREVIEW_TEXT',
		'DETAIL_TEXT',
		'PREVIEW_PICTURE'
	);
	$res = \CIBlockElement::GetList(Array('SORT' => 'ASC'), $arFilter, false, $arNavParams, $arSelect);
	while($arRes = $res->GetNext()) {
		$arResult['ELEMENTS'][] = $arRes;
	}
	
	$arResult['NAV'] = $res->GetPageNavStringEx($navComponentObject, '', '');
	
    $this->IncludeComponentTemplate();
}


?>
