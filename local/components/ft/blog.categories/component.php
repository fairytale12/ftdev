<?php
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

$arResult = array();

if ($this->StartResultCache(false, false)) {
    \CModule::IncludeModule('iblock');

	$arFilter = Array(
		'IBLOCK_ID' => BLOG_IBLOCK_ID,
		'ACTIVE' => 'Y',
		'GLOBAL_ACTIVE' => 'Y'
	);
	
	$arSelect = array(
		'ID',
		'NAME',
		'SECTION_PAGE_URL',
	);
	$res = CIBlockSection::GetList(Array('SORT' => 'ASC'), $arFilter, false, $arSelect);
	while($arRes = $res->GetNext()) {
		$arResult['CATEGORIES'][] = $arRes;
	}
	
    $this->IncludeComponentTemplate();
}


?>
