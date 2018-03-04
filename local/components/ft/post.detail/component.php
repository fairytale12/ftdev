<?php
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

$arResult = array();

if(empty($arParams['POST_ID'])) {
	LocalRedirect('/404.php');
}

if ($this->StartResultCache(false, false)) {
    CModule::IncludeModule('iblock');

	$arFilter = Array(
		'IBLOCK_ID' => BLOG_IBLOCK_ID,
		'ACTIVE' => 'Y',
		'CODE' => $arParams['POST_ID']
	);
	
	$arSelect = array(
		'ID',
		'NAME',
		'DATE_ACTIVE_FROM',
		'PREVIEW_PICTURE',
		'DETAIL_TEXT',
		'PROPERTY_FILES',
		'PROPERTY_SEO_TITLE',
		'PROPERTY_SEO_DESCRIPTION'
	);
	if(!$arResult = CIBlockElement::GetList(Array('SORT' => 'ASC'), $arFilter, false, false, $arSelect)->GetNext()) {
		$this->AbortResultCache();
		//CHTTP::SetStatus("404 Not Found");
		LocalRedirect('/404.php');
		//return;
	}
	
	// files
	foreach($arResult['PROPERTY_FILES_VALUE'] as &$file) {
		if(empty($file)) {
			continue;
		}
		$file = CFile::GetPath($file);
	}
	
	// keywords
	$rsSections = CIBlockElement::GetElementGroups($arResult['ID'], true);
	while($arSection = $rsSections->GetNext()) {
		$arResult['KEYWORDS'][] = $arSection['NAME'];
	}
	
	
    $this->IncludeComponentTemplate();
}

$APPLICATION->SetPageProperty('post-h1', $arResult['NAME']);

// Title
$postTitle = $arResult['NAME'];
if(!empty($arResult['PROPERTY_SEO_TITLE_VALUE'])) {
	$postTitle = $arResult['PROPERTY_SEO_TITLE_VALUE'];
}

$APPLICATION->SetPageProperty('title', $postTitle);

// Description
if(!empty($arResult['PROPERTY_SEO_DESCRIPTION_VALUE'])) {
	$APPLICATION->SetPageProperty('description', $arResult['PROPERTY_SEO_DESCRIPTION_VALUE']);
}

// Keywords
if(!empty($arResult['KEYWORDS'])) {
	$APPLICATION->SetPageProperty('keywords', implode(', ', $arResult['KEYWORDS']));
}

return $arResult['ID'];

?>
